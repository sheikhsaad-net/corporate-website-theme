<?php
/**
 * Custom post type: Template
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (! class_exists('Mfn_Post_Type_Template')) {
	class Mfn_Post_Type_Template extends Mfn_Post_Type
	{
		/**
		 * Mfn_Post_Type_Template constructor
		 */

		public function __construct(){

			if( !apply_filters('bebuilder_access', false) ){
				return false;
			}

			if( !current_user_can('editor') && !current_user_can('administrator') ){
				return false;
			}

			parent::__construct();

			// fires after WordPress has finished loading but before any headers are sent
			add_action('init', array($this, 'register'));

			// admin only methods

			if( is_admin() ){
				$this->builder = new Mfn_Builder_Admin();
				$this->fields = $this->set_fields();

				$post_id = false;
				$tmpl_type = $this->getReferer();

				if( !empty($_GET['post']) ){
					$post_id = $_GET['post'];
					$tmpl_type = get_post_meta($post_id, 'mfn_template_type', true);
				}

				if( in_array($tmpl_type, array('header', 'footer', 'megamenu')) ){
					$this->fields = $this->set_bebuilder_only($post_id);
				}

				add_filter( 'admin_body_class', array($this, 'adminClass') );

				add_filter('views_edit-template', array( $this, 'list_tabs_wrapper' ));
				add_action('pre_get_posts', array( $this, 'filter_by_tab'));

  			add_filter( 'manage_template_posts_columns', array( $this, 'mfn_set_template_columns' ) );
    		add_action( 'manage_template_posts_custom_column' , array( $this, 'mfn_template_column'), 10, 2 );

				add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'mfn_menu_item_icon_field') );
				add_action( 'wp_update_nav_menu_item', array( $this, 'mfn_save_menu_item_icon'), 10, 2 );

				add_action('admin_footer-nav-menus.php', array( $this, 'mfn_append_icons_modal') );
				add_action( "admin_print_scripts-nav-menus.php", array($this, 'mfn_admin_menus') );

				if( $GLOBALS['pagenow'] == 'post-new.php' ){
					add_filter('admin_footer_text', array($this, 'templateStartPopup'));
				}
				if( $GLOBALS['pagenow'] == 'edit.php' ){
					add_action('all_admin_notices', array($this, 'dashboardHeader'));
					add_action('admin_enqueue_scripts', array($this, 'dashboardEnqueue'));
				}

				//add_action('admin_footer-post-new.php', array($this, 'templateStartPopup'));
			}
		}

		public function dashboardHeader() {

			$post_type = filter_input(INPUT_GET, 'post_type');
	    	$screen = get_current_screen();

		    if( $screen->id == 'edit-template' && !empty($post_type) && $post_type == 'template' ){
				echo '<div class="mfn-ui mfn-templates" data-page="templates">';
					// header
					include_once get_theme_file_path('/functions/admin/templates/parts/header.php');
				echo '</div>';
		    }

		}

		public function dashboardEnqueue() {

			$post_type = filter_input(INPUT_GET, 'post_type');
	    $screen = get_current_screen();

	    if( $screen->id == 'edit-template' && !empty($post_type) && $post_type == 'template' ){
				wp_enqueue_style( 'mfn-dashboard', get_theme_file_uri('/functions/admin/assets/dashboard.css'), array(), MFN_THEME_VERSION );
				wp_enqueue_script('mfn-dashboard', get_theme_file_uri('/functions/admin/assets/dashboard.js'), false, MFN_THEME_VERSION, true);
	    }

		}

		public function templateStartPopup() {

			$post_type = filter_input(INPUT_GET, 'post_type');
	    $screen = get_current_screen();

	    if( $screen->id == 'template' && !empty($post_type) && $post_type == 'template' ){
	    	echo '<div class="mfn-ui">';
					require_once(get_theme_file_path('/visual-builder/partials/template-type-modal.php'));
				echo '</div>';
	    }
		}

		public function adminClass($classes){

			$tmpl_type = false;

			if( !empty($_GET['post']) ){
				$tmpl_type = get_post_meta($_GET['post'], 'mfn_template_type', true);
			}else{
				$tmpl_type = $this->getReferer();
			}

			if( empty($tmpl_type) ) $tmpl_type = 'default';

			if( strpos($classes, 'mfn-template-builder') === false ) $classes .= ' mfn-template-builder mfn-template-builder-'.$tmpl_type;

			return $classes;
		}

		public function mfn_append_icons_modal() {
			echo '<div class="mfn-ui">';
				require_once(get_theme_file_path('/visual-builder/partials/modal-icons.php'));
			echo '</div>';
		}

		public function mfn_admin_menus(){
			wp_enqueue_script('mfnadmin', get_theme_file_uri('/functions/admin/assets/admin.js'), array('jquery'), time(), true);
			wp_enqueue_media();
		}

		/**
		 * HEADER TEMPLATE: Icon field
		 * */

		public function mfn_menu_item_icon_field($item_id) {

			$menu_item_icon = get_post_meta( $item_id, 'mfn_menu_item_icon', true );
			$menu_item_icon_img = get_post_meta( $item_id, 'mfn_menu_item_icon_img', true );
			$menu_item_mm = get_post_meta( $item_id, 'mfn_menu_item_megamenu', true );
			$mfn_mega_menus = mfna_templates('megamenu');

			echo '<div class="mfn-ui"><div class="mfn-form">';

		    echo '<div class="field-mfn-icon description description-wide">
		    	Item icon<br>
			    <div class="form-group browse-icon has-addons has-addons-prepend '.( $menu_item_icon ? "not-empty" : "empty" ).'">
			    	<div class="form-addon-prepend">
						<a href="#" class="mfn-button-upload">
							<span class="label">
								<span class="text">'. esc_html__( 'Browse', 'mfn-opts' ) .'</span>
								<i class="'. esc_attr( $menu_item_icon ) .'"></i>
							</span>
						</a>
					</div>
					<div class="form-control has-icon has-icon-right">
						<input type="text" name="mfn_menu_item_icon['.$item_id.']" class="widefat mfn-form-control mfn-field-value mfn-form-input preview-icon" id="mfn-menu-item-icon-'.$item_id.'" value="'.$menu_item_icon.'" />
						<a class="mfn-option-btn mfn-button-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>
					</div>
				</div>
			</div>';

			echo '<div class="field-mfn-icon-img description description-wide">
		    	Item image icon<br>
			    <div class="form-group browse-image has-addons has-addons-append '.( $menu_item_icon_img ? "not-empty" : "empty" ).'">
					<div class="form-control has-icon has-icon-right">
						<input type="text" name="mfn_menu_item_icon_img['.$item_id.']" class="widefat mfn-form-control mfn-field-value mfn-form-input preview-icon" id="mfn-menu-item-icon-'.$item_id.'" value="'.$menu_item_icon_img.'" />
						<a class="mfn-option-btn mfn-button-delete" title="Delete" href="#"><span class="mfn-icon mfn-icon-delete"></span></a>
					</div>
					<div class="form-addon-append">
						<a href="#" class="mfn-button-upload"><span class="label">'. esc_html__( 'Browse', 'mfn-opts' ) .'</span></a>
					</div>

					<div class="selected-image">
						<img src="'. esc_attr( $menu_item_icon_img ) .'" alt="" />
					</div>
				</div>
			</div>';

			echo '<div class="field-mfn-icon-img description description-wide">
		    	Mega menu<br>
			    <select id="mfn_menu_item_megamenu-'.$item_id.'" name="mfn_menu_item_megamenu['.$item_id.']" class="widefat mfn-form-control mfn-field-value mfn-form-input">';
			    if( is_iterable($mfn_mega_menus) ){
			    	foreach ($mfn_mega_menus as $m=>$mm) {
			    		echo '<option '. ( $menu_item_mm && $menu_item_mm == $m ? "selected" : "" ) .' value="'.$m.'">'.$mm.'</option>';
			    	}
			    }
			echo '</select>
			</div>';

			echo '</div></div>';

		}

		/**
		 * HEADER TEMPLATE: Save icon field
		 * */

		function mfn_save_menu_item_icon( $menu_id, $menu_item_db_id ) {

			if ( !empty( $_POST['mfn_menu_item_icon'][$menu_item_db_id]  ) ) {
				$sanitized_data = sanitize_text_field( $_POST['mfn_menu_item_icon'][$menu_item_db_id] );
				update_post_meta( $menu_item_db_id, 'mfn_menu_item_icon', $sanitized_data );
			} else {
				delete_post_meta( $menu_item_db_id, 'mfn_menu_item_icon' );
			}

			if ( !empty( $_POST['mfn_menu_item_icon_img'][$menu_item_db_id] ) ) {
				$sanitized_data = sanitize_text_field( $_POST['mfn_menu_item_icon_img'][$menu_item_db_id] );
				update_post_meta( $menu_item_db_id, 'mfn_menu_item_icon_img', $sanitized_data );
			} else {
				delete_post_meta( $menu_item_db_id, 'mfn_menu_item_icon_img' );
			}

			if ( !empty( $_POST['mfn_menu_item_megamenu'][$menu_item_db_id] ) ) {
				$sanitized_data = sanitize_text_field( $_POST['mfn_menu_item_megamenu'][$menu_item_db_id] );

				if( $sanitized_data == 'enabled' ){
					update_post_meta($menu_item_db_id, 'menu-item-mfn-megamenu', 'enabled'); // automatic mega menu
				}else{
					delete_post_meta( $menu_item_db_id, 'menu-item-mfn-megamenu' );
				}

				update_post_meta( $menu_item_db_id, 'mfn_menu_item_megamenu', $sanitized_data );

			} else {
				delete_post_meta( $menu_item_db_id, 'mfn_menu_item_megamenu' );
				delete_post_meta( $menu_item_db_id, 'menu-item-mfn-megamenu' );
			}
		}

		/**
		 * Templates list view display conditions
		 */

		public function mfn_set_template_columns($columns) {

			$columns['tmpltype'] = esc_html__('Type', 'mfn-opts');
			$columns['conditions'] = esc_html__('Conditions', 'mfn-opts');

    	return $columns;
		}

		public function mfn_template_column($column, $post_id){

			if($column == 'tmpltype'){
				$tmpl_type = get_post_meta($post_id, 'mfn_template_type', true);
				echo '<span class="mfn-label-table-list mfn-label-'.$tmpl_type.'">';
				if( $tmpl_type == 'default' ) $tmpl_type = 'Page template';
				echo ucfirst(str_replace('-', ' ', $tmpl_type)).'</span>';
			}elseif($column == 'conditions'){
				$conditions = (array) json_decode( get_post_meta($post_id, 'mfn_template_conditions', true) );
				if(isset($conditions) && count($conditions) > 0){
					foreach($conditions as $c=>$con){
						if($con->rule == 'include'){ echo '<span style="color: green;">+ '; }else{ echo '<span style="color: red;">- '; }

						//print_r($con);

						if($con->var == 'everywhere'){
							echo 'Entire Site';
						}elseif($con->var == 'archives'){
							if( empty($con->archives) ){
								echo 'All archives';
							}else{

								if( strpos($con->archives, ':') !== false){
									$expl = explode(':', $con->archives);
									$pt = get_post_type_object( $expl[0] );
									$term = get_term( $expl[1] );
								}elseif( !empty($con->archives) ){
									$pt = get_post_type_object( $con->archives );
								}

								echo 'Archive: '.$pt->label;

								if( !empty($term->name) ) echo '/'.$term->name;

							}
						}elseif($con->var == 'singular'){
							if( empty($con->singular) ){
								echo 'All singulars';
							}else{

								if( strpos($con->singular, ':') !== false){
									$expl = explode(':', $con->singular);
									$pt = get_post_type_object( $expl[0] );
									$term = get_term( $expl[1] );
								}elseif( !empty($con->singular) && $con->singular == 'front-page' ){
									echo 'Front Page</span><br>';
									continue;
								}elseif( !empty($con->singular) ){
									$pt = get_post_type_object( $con->singular );
								}

								echo 'Singular: '.$pt->label;

								if( !empty($term->name) ) echo '/'.$term->name;

							}
						}elseif($con->var == 'shop'){
							if( get_post_meta($post_id, 'mfn_template_type', true) == 'single-product' ){
								echo ' All products';
							}else{
								echo ' Shop';
							}
						}elseif($con->var == 'productcategory'){
							if($con->productcategory == 'all'){
								echo ' All categories';
							}else{
								$term = get_term_by('term_id', $con->productcategory, 'product_cat');
								echo 'Category: '.$term->name;
							}
						}elseif($con->var == 'producttag'){
							if($con->producttag == 'all'){
								echo ' All tags';
							}else{
								$term = get_term_by('term_id', $con->producttag, 'product_tag');
								echo 'Tag: '.$term->name;
							}
						}
						echo '</span><br>';
					}
				}
			}
		}

		/**
		 * Set post type fields
		 */

		public function set_fields(){

			$type = $this->getReferer();

			$template_types = array(
				'default' => 'Page template',
				'section' => 'Sections template',
				'wrap' => 'Wraps template',
			);

			if(function_exists('is_woocommerce')){
				$template_types['shop-archive'] = 'Shop archive';
				$template_types['single-product'] = 'Single product';
			}

			$template_types['header'] = 'Header';
			$template_types['megamenu'] = 'Mega menu';
			$template_types['footer'] = 'Footer';

			return array(

				'id' => 'mfn-meta-template',
				'title' => esc_html__('Template Options', 'mfn-opts'),
				'page' => 'template',
				'fields' => array(

					array(
  					'id' => 'mfn_template_type',
  					'type' => 'select',
  					'class' => 'mfn_template_type mfn-hidden-field',
  					'title' => __('Template type', 'mfn-opts'),
  					'options' => $template_types,
  					'std' => $type,
					),

					// layout

  				array(
  					'title' => __('Layout', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-post-hide-content',
  					'type' => 'switch',
  					'title' => __('The content', 'mfn-opts'),
  					'desc' => __('The content from the WordPress editor', 'mfn-opts'),
  					'options'	=> array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

					array(
						'id' => 'mfn-post-layout',
						'type' => 'radio_img',
						'title' => __('Layout', 'mfn-opts'),
						'desc' => __('Full width sections works only without sidebars', 'mfn-opts'),
						'options' => array(
							'' => __('Use page options', 'mfn-opts'),
							'no-sidebar' => __('Full width', 'mfn-opts'),
							'left-sidebar' => __('Left sidebar', 'mfn-opts'),
							'right-sidebar' => __('Right sidebar', 'mfn-opts'),
							'both-sidebars' => __('Both sidebars', 'mfn-opts'),
							'offcanvas-sidebar' => __('Off-canvas sidebar', 'mfn-opts'),
						),
						'std' => mfn_opts_get('sidebar-layout'),
						'alias' => 'sidebar',
						'class' => 'form-content-full-width small',
					),

  				array(
  					'id' => 'mfn-post-sidebar',
  					'type' => 'select',
  					'title' => __('Sidebar', 'mfn-opts'),
  					'desc' => __('Shows only if layout with sidebar is selected', 'mfn-opts'),
  					'options' => mfn_opts_get('sidebars'),
  					'js_options' => 'sidebars',
  				),

  				array(
  					'id' => 'mfn-post-sidebar2',
  					'type' => 'select',
  					'title' => __('Sidebar 2nd', 'mfn-opts'),
  					'desc' => __('Shows only if layout with both sidebars is selected', 'mfn-opts'),
  					'options' => mfn_opts_get('sidebars'),
  					'js_options' => 'sidebars',
  				),

					// media

  				array(
  					'title' => __('Media', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-post-slider',
  					'type' => 'select',
  					'title' => __('Slider Revolution', 'mfn-opts'),
  					'options' => Mfn_Builder_Helper::get_sliders('rev'),
  					'js_options' => 'rev_slider',
  				),

  				array(
  					'id' => 'mfn-post-slider-layer',
  					'type' => 'select',
  					'title' => __('Layer Slider', 'mfn-opts'),
  					'options' => Mfn_Builder_Helper::get_sliders('layer'),
  					'js_options' => 'layer_slider',
  				),

  				array(
  					'id' => 'mfn-post-slider-shortcode',
  					'type' => 'text',
  					'title' => __('Slider shortcode', 'mfn-opts'),
  					'desc' => __('Paste slider shortcode if you use other slider plugin', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-post-subheader-image',
  					'type' => 'upload',
  					'title' => __('Subheader image', 'mfn-opts'),
  				),

					// options

  				array(
  					'title' => __('Options', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-post-one-page',
  					'type' => 'switch',
  					'title' => __('One Page', 'mfn-opts'),
  					'options'	=> array(
							'0' => __('Disable', 'mfn-opts'),
							'1' => __('Enable', 'mfn-opts'),
						),
  					'std' => '0'
  				),

					array(
  					'id' => 'mfn-post-full-width',
  					'type' => 'switch',
  					'title' => __('Full width', 'mfn-opts'),
  					'desc' => __('Set page to full width ignoring <a target="_blank" href="admin.php?page=be-options#general">Site width</a> option. Works for Layout Full width only.', 'mfn-opts'),
  					'options'	=> array(
							'0' => __('Disable', 'mfn-opts'),
							'site' => __('Enable', 'mfn-opts'),
							'content' => __('Content only', 'mfn-opts'),
						),
  					'std' => '0'
  				),

  				array(
  					'id' => 'mfn-post-hide-title',
  					'type' => 'switch',
  					'title' => __('Subheader', 'mfn-opts'),
  					'options'	=> array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

  				array(
  					'id' => 'mfn-post-remove-padding',
  					'type' => 'switch',
  					'title' => __('Content top padding', 'mfn-opts'),
  					'options' => array(
							'1' => __('Hide', 'mfn-opts'),
							'0' => __('Show', 'mfn-opts'),
						),
  					'std' => '0'
  				),

  				array(
  					'id' => 'mfn-post-custom-layout',
  					'type' => 'select',
  					'title' => __('Custom layout', 'mfn-opts'),
  					'desc' => __('Custom layout overwrites Theme Options', 'mfn-opts'),
  					'options' => $this->get_layouts(),
  					'js_options' => 'layouts',
  				),

  				array(
  					'id' => 'mfn-post-menu',
  					'type' => 'select',
  					'title' => __('Custom menu', 'mfn-opts'),
  					'desc' => __('Does not work with Split Menu', 'mfn-opts'),
  					'options' => mfna_menu(),
  					'js_options' => 'menus',
  				),

					// custom css

  				array(
  					'title' => __('Custom CSS', 'mfn-opts'),
  				),

  				array(
  					'id' => 'mfn-post-css',
  					'type' => 'textarea',
  					'title' => __('Custom CSS', 'mfn-opts'),
  					'desc' => __('Custom CSS code for this page', 'mfn-opts'),
  					'class' => 'form-content-full-width',
						'cm' => 'css',
  				),

				),
			);
		}

		public function set_header_fields(){

			return array(
				'id' => 'mfn-meta-template',
				'title' => esc_html__('Header Options', 'mfn-opts'),
				'page' => 'template',
				'fields' => array(

					array(
	  					'title' => __('Default header', 'mfn-opts'),
	  				),

					array(
	  					'id' => 'header_position',
	  					'attr_id' => 'header_position',
	  					'type' => 'select',
	  					'title' => __('Position', 'mfn-opts'),
	  					'options' => array(
	  						'default' => __('Default', 'mfn-opts'),
	  						'absolute' => __('Absolute', 'mfn-opts'),
	  						'fixed' => __('Fixed', 'mfn-opts')
	  					),
	  					'std' => 'default',
  					),

  					array(
	  					'id' => 'body_offset_header',
	  					'type' => 'select',
	  					'condition' => array( 'id' => 'header_position', 'opt' => 'isnt', 'val' => 'default' ),
	  					'class' => 'body_offset_header',
	  					'title' => __('Body offset for header', 'mfn-opts'),
	  					'options' => array(
	  						'' => __('No', 'mfn-opts'),
	  						'active' => __('Yes', 'mfn-opts'),
	  					),
	  					'std' => '',
  					),

  					array(
	  					'id' => 'header_content_on_submenu',
	  					'attr_id' => 'header_content_on_submenu',
	  					'type' => 'select',
	  					'title' => __('Content overlay', 'mfn-opts'),
	  					'options' => array(
	  						'' => __('Default', 'mfn-opts'),
	  						'blur' => __('Blur', 'mfn-opts'),
	  						'gray' => __('Gray out', 'mfn-opts'),
	  						'overlay' => __('Overlay', 'mfn-opts')
	  					),
	  					'std' => '',
  					),

  					array(
						'type' => 'helper',
						'title' => __('Need help', 'mfn-opts'),
						'link' => 'https://support.muffingroup.com/video-tutorials/menu-content-overlay/',
						),

  					array(
						'id' => 'header_content_on_submenu_color',
						'condition' => array( 'id' => 'header_content_on_submenu', 'opt' => 'is', 'val' => 'blur,overlay' ),
						'type' => 'color',
						'title' => __('Overlay color', 'mfn-opts'),
						'std' => 'rgba(0,0,0,0.5)'
					),

					array(
						'id' => 'header_content_on_submenu_blur',
						'condition' => array( 'id' => 'header_content_on_submenu', 'opt' => 'is', 'val' => 'blur' ),
						'type' => 'sliderbar',
						'title' => __('Blur', 'mfn-opts'),
						'param' => array(
							'min' => '0',
							'max' => '20',
							'step' => '1',
						),
						'std' => '2'
					),

  					array(
	  					'title' => __('Sticky header', 'mfn-opts'),
	  				),

  					array(
	  					'id' => 'header_sticky',
	  					'type' => 'select',
	  					'title' => __('Status', 'mfn-opts'),
	  					'options' => array(
	  						'disabled' => __('Disabled', 'mfn-opts'),
	  						'enabled' => __('Enabled', 'mfn-opts'),
	  					),
	  					'std' => 'disabled',
  					),

  					array(
	  					'title' => __('Mobile header', 'mfn-opts'),
	  				),

	  				array(
	  					'id' => 'header_mobile',
	  					'attr_id' => 'header_mobile',
	  					'type' => 'select',
	  					'title' => __('Status', 'mfn-opts'),
	  					'options' => array(
	  						'disabled' => __('Disabled', 'mfn-opts'),
	  						'enabled' => __('Enabled', 'mfn-opts'),
	  					),
	  					'std' => 'disabled',
  					),

	  				array(
	  					'id' => 'mobile_header_position',
	  					'type' => 'select',
	  					'condition' => array( 'id' => 'header_mobile', 'opt' => 'is', 'val' => 'enabled' ),
	  					'title' => __('Position', 'mfn-opts'),
	  					'options' => array(
	  						'default' => __('Default', 'mfn-opts'),
	  						'absolute' => __('Absolute', 'mfn-opts'),
	  						'fixed' => __('Fixed', 'mfn-opts')
	  					),
	  					'std' => 'fixed',
  					),

  					array(
	  					'id' => 'mobile_body_offset_header',
	  					'type' => 'select',
	  					'condition' => array( 'id' => 'header_mobile', 'opt' => 'is', 'val' => 'enabled' ),
	  					'class' => 'mobile_body_offset_header',
	  					'title' => __('Body offset for header', 'mfn-opts'),
	  					'options' => array(
	  						'' => __('No', 'mfn-opts'),
	  						'active' => __('Yes', 'mfn-opts'),
	  					),
	  					'std' => '',
  					),

  				),
			);
		}

		public function set_megamenu_fields(){

			return array(
				'id' => 'mfn-meta-template',
				'title' => esc_html__('Mega menu Options', 'mfn-opts'),
				'page' => 'template',
				'fields' => array(

					array(
	  					'title' => __('Settings', 'mfn-opts'),
	  				),

					array(
	  					'id' => 'megamenu_width',
	  					'attr_id' => 'megamenu_width',
	  					'type' => 'select',
	  					'title' => __('Type', 'mfn-opts'),
	  					'options' => array(
	  						'full-width' => __('Full width', 'mfn-opts'),
	  						'grid' => __('Grid', 'mfn-opts'),
	  						'custom-width' => __('Custom', 'mfn-opts')
	  					),
	  					'std' => 'full-width',
  					),

  					array(
	  					'id' => 'megamenu_custom_width',
	  					'condition' => array( 'id' => 'megamenu_width', 'opt' => 'is', 'val' => 'custom-width' ),
	  					'type' => 'text',
	  					'title' => __('Custom width', 'mfn-opts'),
	  					'desc' => __('Works with Custom type', 'mfn-opts'),
	  					'default_unit' => 'px',
	  					'std' => '220px',
  					),

  					array(
	  					'id' => 'megamenu_custom_position',
	  					'condition' => array( 'id' => 'megamenu_width', 'opt' => 'is', 'val' => 'custom-width' ),
	  					'type' => 'select',
	  					'title' => __('Position', 'mfn-opts'),
	  					'options' => array(
	  						'left' => __('Left', 'mfn-opts'),
	  						'right' => __('Right', 'mfn-opts')
	  					),
	  					'std' => 'left',
  					),

  				),
			);
		}

		public function set_footer_fields(){

			return array(
				'id' => 'mfn-meta-template',
				'title' => esc_html__('Footer Options', 'mfn-opts'),
				'page' => 'template',
				'fields' => array(

					array(
	  					'title' => __('Settings', 'mfn-opts'),
	  				),

					array(
	  					'id' => 'footer_type',
	  					'type' => 'select',
	  					'title' => __('Style', 'mfn-opts'),
	  					'options' => array(
	  						'default' => __('Default', 'mfn-opts'),
	  						'fixed' => __('Fixed (covers content)', 'mfn-opts'),
	  						'sliding' => __('Sliding (under content)', 'mfn-opts'),
	  						'stick' => __('Stick to bottom if content is too short', 'mfn-opts'),
	  					),
	  					'std' => 'full-width',
  					),

  				),
			);
		}

		public function set_bebuilder_only($post_id){

			$type = $this->getReferer();

			return array(
				'id' => 'mfn-meta-template',
				'title' => esc_html__('Edit with '. apply_filters('betheme_label', "Be") .'Builder', 'mfn-opts'),
				'page' => 'template',
				'fields' => array(

					array(
	  					'id' => 'mfn_template_type',
	  					'type' => 'text',
	  					'class' => 'mfn_template_type mfn-hidden-field',
	  					'title' => __('Template type', 'mfn-opts'),
	  					'std' => $type,
  					),

					array(
						'id' => 'go-live',
						'type' => 'redirect_button',
						'html' => '<div class="mfn-admin-button-box"><a href="link_here" class="mfn-btn mfn-switch-live-editor button-hero mfn-btn-green button button-primary">Edit with '. apply_filters('betheme_label', "Be") .'Builder</a></div>',
					),

  			),
			);
		}

		/**
		 * Register new post type and related taxonomy
		 */

		public function register()
		{
			$labels = array(
				'name' => esc_html__('Templates', 'mfn-opts'),
				'singular_name' => esc_html__('Template', 'mfn-opts'),
				'add_new' => esc_html__('Add New', 'mfn-opts'),
				'add_new_item' => esc_html__('Add New Template', 'mfn-opts'),
				'edit_item' => esc_html__('Edit Template', 'mfn-opts'),
				'new_item' => esc_html__('New Template', 'mfn-opts'),
				'view_item' => esc_html__('View Template', 'mfn-opts'),
				'search_items' => esc_html__('Search Template', 'mfn-opts'),
				'not_found' => esc_html__('No templates found', 'mfn-opts'),
				'not_found_in_trash' => esc_html__('No templates found in Trash', 'mfn-opts'),
				'parent_item_colon' => ''
			);

			$args = array(
				'labels' => $labels,
				'menu_icon' => 'dashicons-layout',
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 3,
				'rewrite' => array('slug'=>'template-item', 'with_front'=>true),
				'supports' => array( 'title', 'author' ),
			);

			register_post_type('template', $args);
		}

		public function filter_by_tab($query){

			$tab = '';

      if ( is_admin() && $query->get('post_type') == 'template' && ( !$query->get('post_status') || empty($query->get('post_status')) ) ) {

		  	if( ! function_exists('is_woocommerce')){
					$meta_query = array(
						array(
							'key'=> 'mfn_template_type',
							'value'=> 'single-product',
							'compare'=> '!=',
						),
						array(
							'key'=> 'mfn_template_type',
							'value'=> 'shop-archive',
							'compare'=> '!=',
						),
					);
					$query->set('meta_query',$meta_query);
				}

        if( !empty($_GET['tab']) ) {

        	$tab = $_GET['tab'];

        	$meta_query = array(
						array(
							'key'=> 'mfn_template_type',
							'value'=> $tab,
							'compare'=> '=',
						),
					);

					$query->set('meta_query',$meta_query);

	      }

	    }

		}

		public function list_tabs_wrapper($actions) {
			global $post_ID;
			$screen = get_current_screen();

			$tab = null;

			if( isset($screen->post_type) && $screen->post_type == 'template' ) :

			if( !empty($_GET['tab']) && ( empty($_GET['post_status']) ) ) $tab = $_GET['tab'];
			?>

			<nav class="nav-tab-wrapper" style="margin-bottom: 30px;">
				<a href="?post_type=template" class="nav-tab <?php if(empty($tab)):?>nav-tab-active<?php endif; ?>">All</a>
				<a href="?post_type=template&tab=header" class="nav-tab mfn-label-nav-tab mfn-label-header <?php if($tab==='header'):?>nav-tab-active<?php endif; ?>">Header</a>
				<a href="?post_type=template&tab=footer" class="nav-tab mfn-label-nav-tab mfn-label-footer <?php if($tab==='footer'):?>nav-tab-active<?php endif; ?>">Footer</a>
				<a href="?post_type=template&tab=megamenu" class="nav-tab mfn-label-nav-tab mfn-label-megamenu <?php if($tab==='megamenu'):?>nav-tab-active<?php endif; ?>">Mega menu</a>
				<?php if(function_exists('is_woocommerce')): ?>
				<a href="?post_type=template&tab=shop-archive" class="nav-tab mfn-label-nav-tab mfn-label-shop-archive <?php if($tab==='shop-archive'):?>nav-tab-active<?php endif; ?>">Shop archive</a>
				<a href="?post_type=template&tab=single-product" class="nav-tab mfn-label-nav-tab mfn-label-single-product <?php if($tab==='single-product'):?>nav-tab-active<?php endif; ?>">Single product</a>
				<?php endif; ?>
				<a href="?post_type=template&tab=section" class="nav-tab mfn-label-nav-tab mfn-label-section <?php if($tab==='section'):?>nav-tab-active<?php endif; ?>">Sections</a>
				<a href="?post_type=template&tab=wrap" class="nav-tab mfn-label-nav-tab mfn-label-wrap <?php if($tab==='wrap'):?>nav-tab-active<?php endif; ?>">Wraps</a>
				<a href="?post_type=template&tab=default" class="nav-tab mfn-label-nav-tab mfn-label-default <?php if($tab==='default'):?>nav-tab-active<?php endif; ?>">Page templates</a>
		    </nav>

			<?php endif;

			return $actions;

		}

		public function getReferer(){

			$type = 'default';

			if( !empty($_GET['post_type']) && ('template' == $_GET['post_type']) && !empty($_GET['tab']) ){

				$type = $_GET['tab'];

			} else {

				$ref = parse_url(wp_get_referer());
				if( isset($ref['query']) && $ref['query'] ){
					$ex_ref = explode('post_type=template&tab=', $ref['query']);
					if(isset($ex_ref[1])){
						$type = $ex_ref[1];
					}
				}

			}

			return $type;
		}

	}
}

new Mfn_Post_Type_Template();
