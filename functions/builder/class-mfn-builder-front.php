<?php
/**
 * Muffin Builder | Front
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

if( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

if( ! class_exists('Mfn_Builder_Front') )
{
  class Mfn_Builder_Front {

    public $post_id = false;
    public $content_field = false; // use post field instead of the_content()
    public $template_type = false;
    public $is_bebuilder = false;

		public $classes = array(
			'divider' => 'divider',
			'1/6' => 'one-sixth',
			'1/5' => 'one-fifth',
			'1/4' => 'one-fourth',
			'1/3' => 'one-third',
			'2/5' => 'two-fifth',
			'1/2' => 'one-second',
			'3/5' => 'three-fifth',
			'2/3' => 'two-third',
			'3/4' => 'three-fourth',
			'4/5' => 'four-fifth',
			'5/6' => 'five-sixth',
			'1/1' => 'one'
		);

		public $tablet_classes = array(
			'divider' => '',
			'1/6' => 'tablet-one-sixth',
			'1/5' => 'tablet-one-fifth',
			'1/4' => 'tablet-one-fourth',
			'1/3' => 'tablet-one-third',
			'2/5' => 'tablet-two-fifth',
			'1/2' => 'tablet-one-second',
			'3/5' => 'tablet-three-fifth',
			'2/3' => 'tablet-two-third',
			'3/4' => 'tablet-three-fourth',
			'4/5' => 'tablet-four-fifth',
			'5/6' => 'tablet-five-sixth',
			'1/1' => 'tablet-one'
		);

		public $mobile_classes = array(
			'divider' => '',
			'1/6' => 'mobile-one-sixth',
			'1/5' => 'mobile-one-fifth',
			'1/4' => 'mobile-one-fourth',
			'1/3' => 'mobile-one-third',
			'2/5' => 'mobile-two-fifth',
			'1/2' => 'mobile-one-second',
			'3/5' => 'mobile-three-fifth',
			'2/3' => 'mobile-two-third',
			'3/4' => 'mobile-three-fourth',
			'4/5' => 'mobile-four-fifth',
			'5/6' => 'mobile-five-sixth',
			'1/1' => 'mobile-one'
		);

    /**
     * Constructor
     */

    public function __construct($post_id, $content_field = false) {

			$this->post_id = $post_id;
 			$this->content_field = $content_field;

 			if( get_post_type($post_id) == 'template' ) $this->template_type = get_post_meta($post_id, 'mfn_template_type', true);

 			$this->is_bebuilder = apply_filters('bebuilder_preview', true);
    }

  	/**
  	 * Show WordPress Editor Content
  	 */

  	public function the_content(){

			// FIX: Elementor - prevent showing first post content on blog page

			if( ( 'post' == get_post_type() ) && ( ! is_singular() ) ){
				return false;
			}

      // check if editor content exists

			$content = get_post_field( 'post_content', $this->post_id );
  		$class = $content ? 'has_content' : 'no_content' ;
			$is_elementor = mfn_is_elementor( $this->post_id ) ? 'is-elementor' : false;

  		// output -----

  		echo '<div class="section the_content '. esc_attr( $class ) .'">';
  			if ( ! get_post_meta( $this->post_id, 'mfn-post-hide-content', true ) ) {
  				echo '<div class="section_wrapper">';
  					echo '<div class="the_content_wrapper '. esc_attr( $is_elementor ) .'">';
  						if ( $this->content_field ) {
  							echo apply_filters( 'the_content', $content );
  						} else {
  							the_content();
  						}
  					echo '</div>';
  				echo '</div>';
  			}
  		echo '</div>';

  	}

		/**
  	 * Enqueue BeBuilder local style css
  	 */

		public function enqueue_local_style( $enqueue = true ){

			$path = '';
			$handle = 'mfn-post-local-styles';

			if( ( ! empty($_GET['mfn-preview']) || ! empty($_GET['preview']) ) && get_post_meta($this->post_id, 'mfn-builder-preview-local-style') ){

				// preview

				$path = '/betheme/css/post-'. $this->post_id .'-preview.css';
				$handle = 'mfn-builder-preview-local-style-'. Mfn_Builder_Helper::unique_ID();

			}else{

				$dir = wp_upload_dir()['basedir'] . $path;

				if( get_post_meta($this->post_id, 'mfn-page-local-style', true) && file_exists($dir) ){

					// frontend

					$path = '/betheme/css/post-'. $this->post_id .'.css';
					$handle = 'mfn-post-local-styles-'. $this->post_id . time();

				} elseif( defined( 'ICL_SITEPRESS_VERSION' ) ){

					// FIX: WPML | Use native language page styles

					$default_language = apply_filters( 'wpml_default_language', null );
					$post_type = get_post_type($this->post_id);

					$native_id = apply_filters( 'wpml_object_id', $this->post_id, $post_type, false, $default_language );

					if( get_post_meta($native_id, 'mfn-page-local-style', true) ){
						$path = '/betheme/css/post-'. $native_id .'.css';
						$handle = 'mfn-post-local-styles-WPML-'. $this->post_id .'-'. Mfn_Builder_Helper::unique_ID();
					}

				}

			}

			if( $path ) {
				if( $enqueue ) {
					wp_enqueue_style($handle, wp_upload_dir()['baseurl'] . $path, false, time(), 'all');
				} else {
					return wp_upload_dir()['basedir'] . $path;
				}
			}

		}

		/**
  	 * Show BeBuilder Content
  	 */

    public function show( $items = false, $vbtoolsoff = false ){

    	//echo get_the_title($this->post_id).' - '.$this->post_id;

			// GET builder items

  		if( isset( $items ) && is_array( $items ) ){
				// ajax
  			$mfn_items = $items;
  		} elseif( ( (empty($_GET['preview']) && empty($_GET['mfn-preview']) ) || ( $this->is_bebuilder && !empty($_GET['preview'] ) ) ) ){
				$mfn_items = get_post_meta($this->post_id, 'mfn-page-items', true);
			} else {
				$mfn_items = get_post_meta($this->post_id, 'mfn-builder-preview', true);
			}

  		// FIX | Muffin builder 2 compatibility

  		if ( $mfn_items && ! is_array( $mfn_items ) ) {
  			$mfn_items = unserialize(call_user_func('base'.'64_decode', $mfn_items));
  		}

			// apply filters

			$mfn_items = apply_filters( 'mfn_builder_items_show', $mfn_items );

			// debug
			// print_r( $mfn_items );
			// exit;

  		// WordPress Editor | before builder

  		if ( 1 == mfn_opts_get('display-order') ) {
  			$this->the_content();
  		}

  		// Muffin Builder

  		if( !$items ){
	  		if( $this->template_type ){
	  			if( $this->template_type == 'megamenu' ){
	  				echo '<div class="mfn-builder-content mfn-'.$this->template_type.'-tmpl-builder container">';
	  			}else{
	  				echo '<div '.( !empty($_GET['visual']) ? 'data-id="'.$this->post_id.'"' : false ).' class="mfn-builder-content mfn-'.$this->template_type.'-tmpl-builder">';
	  			}
	  		}else{
	  			 echo '<div class="mfn-builder-content mfn-default-content-buider">';
	  		}
	  	}

  		if ( post_password_required() ) {

  			// password protected page

  			if ( get_post_meta( $this->post_id, 'mfn-post-hide-content', true ) ) {
  				echo '<div class="section the_content">';
  					echo '<div class="section_wrapper">';
  						echo '<div class="the_content_wrapper">';
  							echo get_the_password_form();
  						echo '</div>';
  					echo '</div>';
  				echo '</div>';
  			}

			} elseif ( function_exists('wc_memberships') && ( ! current_user_can('wc_memberships_view_restricted_post_content', $this->post_id) ) ){

				// do not show builder if wc memberships active do not allow current user

  		} elseif (is_array($mfn_items)) {

  			// SECTIONS -----

  			foreach ($mfn_items as $s => $section) {

					// unique ID

					if( empty( $section['uid'] ) ) {
						$section['uid'] = Mfn_Builder_Helper::unique_ID();
					}

  				if( $this->template_type && $this->template_type == 'header' && !empty($section['ver']) && $section['ver'] == 'header-sticky' && !empty( get_post_meta($this->post_id, 'header_sticky', true) ) && get_post_meta($this->post_id, 'header_sticky', true) == 'disabled' ) continue;
  				if( $this->template_type && $this->template_type == 'header' && !empty($section['ver']) && $section['ver'] == 'header-mobile' && !empty( get_post_meta($this->post_id, 'header_mobile', true) ) && get_post_meta($this->post_id, 'header_mobile', true) == 'disabled' ) continue;

					$section_class = [];
					$inner_section_class_uid = 'mcb-section-inner-'. $section['uid'] .'';

					$refresh_content = '';
					$global_section_id = '';

					// be global sections
					if( !empty($section['mfn_global_section_id']) ){
						$refresh_content = get_post_meta($section['mfn_global_section_id'], 'mfn-page-items', true);

						if( !is_array($refresh_content) ) {
							$refresh_content = unserialize( call_user_func('base'.'64_decode', $refresh_content) );
						}

						//refresh content
						$section['attr']  = $refresh_content[0]['attr'];
						$section['wraps'] = $refresh_content[0]['wraps'];
						$section_class[] .= ' mfn-global-section';

						$global_section_id = ' data-mfn-global="' . $section['mfn_global_section_id'] .'"';

						//styles
						$path = wp_upload_dir()['baseurl'] .'/betheme/css/post-'. $section['mfn_global_section_id'] .'.css';
						wp_enqueue_style('mfn-global-section-styles-'. Mfn_Builder_Helper::unique_ID(), $path, false, time(), 'all');
					}

					$section_id = false;
					$parallax = false;
					$closeable = false;

  				// hidden sections

  				if ( ! empty( $section['attr']['hide'] ) ) {

						// visual builder

            if( wp_doing_ajax() || $this->is_bebuilder ){
              $section_class[] = 'hide';
            } else {
              continue;
            }

					}

					if( empty($_GET['visual']) && isset($_COOKIE['mfn_closed_section']) && $_COOKIE['mfn_closed_section'] == $section['uid'] ) continue; // closeable section

  				// section attributes

  				// classes ---

  				if( !empty($section['ver']) ){
  					$section_class[] = 'mfn-'.$section['ver'].'-section';
  				}else{
  					$section_class[] = 'mfn-default-section';
  				}

					if( !empty($section['mfn_global_section_id'])) {
						//set the original uid of the section. global sections
						$section_class[] = 'mcb-section-'. $refresh_content[0]['uid'];
						$inner_section_class_uid = 'mcb-section-inner-'.$refresh_content[0]['uid'];
					} else {
						$section_class[] = 'mcb-section-'. $section['uid'];
					}

  				if( $this->template_type && $this->template_type == 'header' ) $section_class[] = 'mcb-header-section';

  				// custom style & class

  				// if( empty( $section['attr'] ) ) continue;

  				if( ! empty($section['attr']['style']) ) {
  					$section_class[] = $section['attr']['style'];
  				}

  				if( ! empty($section['attr']['class']) ) {
  					$section_class[] = $section['attr']['class'];
  				}

  				if( ! empty($section['attr']['classes']) ) {
  					$section_class[] = $section['attr']['classes'];
  				}

  				// visibility

  				$hide_label = 'Hide section';

  				if( ! empty($section['attr']['visibility']) ) {
  					$section_class[] = $section['attr']['visibility'];
  					$hide_label = 'Show section';
  				}

  				// background video

					if( ! empty($section['attr']['bg_video_mp4']) ) {
  					$section_class[] = 'has-video';
  				}

  				// navigation arrows

					if( ! empty($section['attr']['navigation']) ) {
  					$section_class[] = 'has-navi';
  				}

  				if( ! empty($section['attr']['height_switcher']) && $section['attr']['height_switcher'] == 'full-screen' ){
  					$section_class[] = 'full-screen';
  				}

  				if( $this->template_type && $this->template_type == 'header' && ! empty($section['attr']['closeable-x']) ) {
  					$section_class[] = 'close-button-'.$section['attr']['closeable-x'];
  				}

  				if( $this->template_type && $this->template_type == 'header' && ! empty($section['attr']['closeable']) ) {
  					$section_class[] = 'closeable-active';
  				}

  				if( ! empty($section['attr']['width_switcher']) ) {
  					$section_class[] = $section['attr']['width_switcher'].'-width';
  				}

  				if( $this->template_type && $this->template_type == 'header' && ! empty($section['attr']['scroll-visibility']) ) {
  					$section_class[] = $section['attr']['scroll-visibility'].'-on-scroll';
  				}

					// reverse order on mobile

					if( ! empty($section['attr']['reverse_order']) ) {
						if( $section['attr']['reverse_order'] == 1 ){
							$section_class[] = 'wrap-reverse';
						}elseif( $section['attr']['reverse_order'] == 2 ){
							$wrap_class[] = 'wrap-reverse-rows';
						}
					}

  				// background size

  				if( isset($section['attr']['bg_size']) && ($section['attr']['bg_size'] != 'auto') ) {
  					$section_class[] = 'bg-'. $section['attr']['bg_size'];
  				}

  				$section_class = implode(' ', $section_class);

  				// styles ---

  				$section_style = $section_bg = array();

  				// ACM new input name
  				if( ! empty($section['attr']['custom_css']) ) {
  					$section_style[] = $section['attr']['custom_css'];
  				}

					if( ! empty($section['attr']['padding_top']) ) {
						$section_style[] = 'padding-top:'. intval($section['attr']['padding_top']) .'px';
					}
					if( ! empty($section['attr']['padding_bottom']) ) {
						$section_style[] = 'padding-bottom:'. intval($section['attr']['padding_bottom']) .'px';
					}
					if( ! empty($section['attr']['padding_horizontal']) ) {
						if( is_numeric($section['attr']['padding_horizontal']) ){
							$section['attr']['padding_horizontal'] .= 'px';
						}
						$section_style[] = 'padding-left:'. esc_attr($section['attr']['padding_horizontal']);
						$section_style[] = 'padding-right:'. esc_attr($section['attr']['padding_horizontal']);
					}
					if( ! empty($section['attr']['bg_color']) ) {
						$section_style[] = 'background-color:'. $section['attr']['bg_color'];
					}

  				// background image attributes

  				if( ! empty( $section['attr']['bg_image'] ) ) {

  					$section_bg['image'] = 'background-image:url('. $section['attr']['bg_image'] .')';

  					if( !empty($section['attr']['bg_position']) ){

							$section_bg_attr = explode(';', $section['attr']['bg_position']);

							if( isset($section_bg_attr[0]) ) {
		  					$section_bg['repeat'] = 'background-repeat:'. $section_bg_attr[0];
							}
							if( isset($section_bg_attr[1]) ) {
	  						$section_bg['position'] = 'background-position:'. $section_bg_attr[1];
							}
							if( isset($section_bg_attr[2]) ) {
		  					$section_bg['attachment'] = 'background-attachment:'. $section_bg_attr[2];
							}
							if( isset($section_bg_attr[3]) ) {
	  						$section_bg['size'] = 'background-size:'. $section_bg_attr[3];
							}

						}
  				}

					if( empty( $_GET['visual'] ) || ! isset( $items ) ){

						// parallax for Muffin Builder

	  				if ( ! empty( $section['attr']['bg_image'] ) && !empty($section_bg_attr[2]) &&  $section_bg_attr[2] == 'fixed' ) {

							if ( empty( $section_bg_attr[4] ) || $section_bg_attr[4] != 'still') {

	  						$parallax = mfn_parallax_data();
								$parallax_bg_image = $section['attr']['bg_image'];

	  						if ( mfn_parallax_plugin() == 'translate3d' ) {
	  							if ( mfn_is_mobile() ) {
	  								$section_bg['attachment'] = 'background-attachment:scroll';
	  							} else {
	  								$section_bg = array();
	  							}
	  						}

	  					} else {

	  						// cover
	  						$section_class .= ' bg-cover';

	  					}

	  				}

						// parallax for BeBuilder

						if ( ! empty( $section['attr']['style:.mcb-section-mfnuidelement:background-image'] ) && ! empty( $section['attr']['style:.mcb-section-mfnuidelement:background-attachment'] ) && ( $section['attr']['style:.mcb-section-mfnuidelement:background-attachment'] == 'parallax' ) ) {

  						$parallax = mfn_parallax_data();
							$parallax_bg_image = $section['attr']['style:.mcb-section-mfnuidelement:background-image'];

  						if ( mfn_parallax_plugin() == 'translate3d' ) {
  							if ( mfn_is_mobile() ) {
  								$section_bg['attachment'] = 'background-attachment:scroll';
  							} else {
  								$section_bg = array();
  							}
  						}

	  				}

					}

  				// visual builder

  				if( isset( $items ) && is_array( $items ) ){
  					$section_class .= ' blink';
  				}

  				$section_style = array_merge($section_style, $section_bg);
  				$section_style = implode(';', $section_style);

  				// custom section ID

  				if( ! empty($section['attr']['section_id']) && $section['attr']['section_id'] ) {
  					$section_id = 'id="'. $section['attr']['section_id'] .'"';
  				} elseif( ! empty($section['attr']['custom_id']) && $section['attr']['custom_id']) {
						$section_id = 'id="'. $section['attr']['custom_id'] .'"';
					}

  				if( !empty($section['attr']['style:.mcb-section-mfnuidelement:background-size']) && $section['attr']['style:.mcb-section-mfnuidelement:background-size'] == 'cover-ultrawide' ){
  					$section_class .= ' bg-cover-ultrawide';
  				}

  				// output SECTION -----

  				if( !$vbtoolsoff && ( $this->is_bebuilder || ( isset( $items ) && is_array( $items ) ) ) ){

  					if ( $this->template_type && $this->template_type == 'header' && isset( $section['wraps'] ) && is_array($section['wraps']) && count($section['wraps']) >= 3 ) $section_class .= ' mfn-new-wraps-disabled';

  					echo '<div class="section vb-item mcb-section '. $section_class .'" '. $section_id .' data-order="'. $s .'" data-uid="'. $section['uid'] .'"  '. $global_section_id .' style="'. $section_style .'" '. $parallax .'>'; // 100%
  					echo Mfn_Builder_Helper::sectionTools();


					  // Global Section edit button
					  if( !empty($section['mfn_global_section_id']) ){
						echo '<a href="'.get_site_url().'/wp-admin/post.php?post='.$section['mfn_global_section_id'].'&action=mfn-live-builder" target="_blank" data-tooltip="Edit Global Section" class="btn-edit-section" data-position="before">Edit Global Section</a>';
					  }

					} else {

						if( $this->template_type && $this->template_type == 'header' && ! empty($section['attr']['closeable']) && ! empty($section['attr']['closeable-time']) ){
							$closeable = 'data-uid="'.$section['uid'].'" data-close-days="'. $section['attr']['closeable-time'] .'"';
						}

  					echo '<div class="section mcb-section '. $section_class .'" '. $section_id .' '. $closeable .' style="'. $section_style .'" '. $parallax .'>'; // 100%

  				}

					// shape divider

					if( $this->template_type != 'header' ){

						foreach (array('top', 'bottom') as $position) {

							if ( ! empty($section['attr']['shape_divider_type_'.$position]) ){

								$shape_name = $section['attr']['shape_divider_type_'.$position];

								$is_inverted = !empty($section['attr']['shape_divider_invert_'.$position]) ? 1 : 0;
								$is_flipped = !empty($section['attr']['shape_divider_flip_'.$position]) ? 1 : 0;
								$bring_front = !empty($section['attr']['shape_divider_bring_front_'.$position]) ? 1 : 0;

								echo Mfn_Builder_Helper::shapedDivider( $shape_name, $position, $is_inverted, $is_flipped, $bring_front );

							} elseif( $this->is_bebuilder || ( isset( $items ) && is_array( $items ) ) ){

								echo Mfn_Builder_Helper::shapedDivider( 'empty', $position );

							}

						}

					}

					// background: parallax | translate3d background image

					if ( $parallax && ! mfn_is_mobile() && 'translate3d' == mfn_parallax_plugin() ) {
						echo '<img class="mfn-parallax" src="'. $parallax_bg_image .'" alt="parallax background" style="opacity:0" />';
					}

					// background: video

					if (!empty($section['attr']['bg_video_mp4']) && ($mp4 = $section['attr']['bg_video_mp4'])) {
						echo '<div class="section_video">';

							echo '<div class="mask"></div>';

							$poster = false;

							if( !empty($section['attr']['bg_image']) ) $poster = $section['attr']['bg_image'];

							if( $this->is_bebuilder ){

							echo '<div class="mfn-vb-video-lazy"><!--';
							echo '<video poster="'. $poster .'" autoplay="true" loop="true" muted="muted">';
								echo '<source type="video/mp4" src="'. $mp4 .'" />';
								if (key_exists('bg_video_ogv', $section['attr']) && $ogv = $section['attr']['bg_video_ogv']) {
									echo '<source type="video/ogg" src="'. $ogv .'" />';
								}

							echo '</video>';
							echo '--></div>';

							}else{
								echo '<video poster="'. $poster .'" autoplay="true" loop="true" muted="muted">';
									echo '<source type="video/mp4" src="'. $mp4 .'" />';
									if (key_exists('bg_video_ogv', $section['attr']) && $ogv = $section['attr']['bg_video_ogv']) {
										echo '<source type="video/ogg" src="'. $ogv .'" />';
									}

								echo '</video>';
							}

						echo '</div>';

					}

					// Background Overlay

					echo '<div class="mcb-background-overlay"></div>';

					// shape divider

					foreach (array('top', 'bottom') as $position) {

						if ( ! empty($section['attr']['shape_divider_type_'.$position]) ){

							$shape_name = $section['attr']['shape_divider_type_'.$position];

							$is_inverted = !empty($section['attr']['shape_divider_invert_'.$position]) ? 1 : 0;
							$is_flipped = !empty($section['attr']['shape_divider_flip_'.$position]) ? 1 : 0;
							$bring_front = !empty($section['attr']['shape_divider_bring_front_'.$position]) ? 1 : 0;

							echo Mfn_Builder_Helper::shapedDivider( $shape_name, $position, $is_inverted, $is_flipped, $bring_front );

						} elseif( $this->is_bebuilder || ( isset( $items ) && is_array( $items ) ) ){

							echo Mfn_Builder_Helper::shapedDivider( 'empty', $position );

						}

					}

					// decoration: SVG

					if ( !empty($section['attr']['divider']) && $divider = $section['attr']['divider']) {
						echo '<div class="section-divider '. $divider .'"></div>';
					}

					// decoration: image top

					if ( !empty($section['attr']['decor_top']) && $decor_top = $section['attr']['decor_top']) {
						echo '<div class="section-decoration top" style="background-image:url('. $decor_top .');height:'. mfn_get_attachment_data($decor_top, 'height') .'px"></div>';
					}

					// navigation arrows

					if ( !empty($section['attr']['navigation']) && $section['attr']['navigation']) {
						echo '<div class="section-nav prev"><i class="icon-up-open-big" aria-label="previous section"></i></div>';
						echo '<div class="section-nav next"><i class="icon-down-open-big" aria-label="next section"></i></div>';
					}

					echo '<div class="section_wrapper mcb-section-inner '.$inner_section_class_uid.'">';

						// WRAPS -----

						// FIX | Muffin Builder 2 compatibility
						// there were no wraps inside section in Muffin Builder 2

						if ( ! isset( $section['wraps'] ) && ! empty( $section['items'] ) ) {
							$fix_wrap = array(
								'size' => '1/1',
								'uid' => Mfn_Builder_Helper::unique_ID(),
								'items'	=> $section['items'],
							);
							$section['wraps'] = array( $fix_wrap );
						}

						// print inside wraps

						if (isset($section['wraps']) && key_exists('wraps', $section) && is_array($section['wraps'])) {
              // visual builder
              ksort( $section['wraps'] );
              $vb = false;
              if( !$vbtoolsoff && ( $this->is_bebuilder || ( isset( $items ) && is_array( $items ) ) ) ) $vb = true;
							foreach ($section['wraps'] as $w => $wrap) {

								// Muffin Builder ACM compatibility
								if( !isset($wrap['tablet_size']) ){
									$wrap['tablet_size'] = isset($wrap['size']) ? $wrap['size'] : '1/1';
									$wrap['mobile_size'] = '1/1';
								}

								$this->show_wraps($wrap, $w, $vb);
							}
						}


					echo '</div>';

					// decoration: image top

					if( ! empty($section['attr']['decor_bottom']) ) {
						$decor_bottom = $section['attr']['decor_bottom'];
						echo '<div class="section-decoration bottom" style="background-image:url('. $decor_bottom .');height:'. mfn_get_attachment_data($decor_bottom, 'height') .'px"></div>';
					}


  				if( $this->is_bebuilder || ( isset( $items ) && is_array( $items ) ) ){
  					echo '<a href="#" data-tooltip="Add new section" class="btn-section-add mfn-icon-add-light mfn-section-add siblings next" data-position="after">Add section</a>';
  				}

  				// closeable
  				if( $this->template_type && $this->template_type == 'header' && ! empty($section['attr']['closeable']) && $section['attr']['closeable'] == '1' ) {
  					echo '<span class="close-closeable-section mfn-close-icon"><span class="icon">&#10005;</span></span>';
  				}

  				echo '</div>';
  			}

  		}

  		if( !$items ) echo '</div>';

  		// WordPress Editor | after builder

  		if ( 0 == mfn_opts_get('display-order') && ( !isset($items) || get_post_type( $this->post_id ) != 'template' ) ) {
  			$this->the_content();
  		}

			// CSS local styles

			$is_template = false;
			if( mfn_ID() !== get_the_ID() ) {
				$is_template = true;
			}

			if( $is_template || $vbtoolsoff || ( empty( $_GET['visual'] ) && ( !mfn_opts_get('local-styles-location') || ( $this->template_type && in_array($this->template_type, array('megamenu', 'footer', 'shop-archive', 'single-product')) ) ) ) ){
				if( $this->template_type != 'header' ) {
					$this->enqueue_local_style();
				}
			}

  	}

  	public function show_wraps($wrap, $w, $vb){

			// unique ID

			if( empty( $wrap['uid'] ) ) {
				$wrap['uid'] = Mfn_Builder_Helper::unique_ID();
			}

			// wrap attributes

			$wrap_class = array();
			$original_uid = $wrap['uid'];
			$global_wrap_attr = '';
			$is_global_wrap = isset($wrap['attr']['global_wraps_select']) && intval($wrap['attr']['global_wraps_select']);
			$global_wrap_id = '';

			// be global sections
			if( $is_global_wrap ){
				$global_wrap_id = $wrap['attr']['global_wraps_select'];
				$global_wrap_attr = 'data-mfn-global="'.$global_wrap_id.'"';
				$refresh_content = get_post_meta($global_wrap_id, 'mfn-page-items', true);

				if( !is_array($refresh_content) ) {
					$refresh_content = unserialize( call_user_func('base'.'64_decode', $refresh_content) );
				}

				$wrap['items'] = $refresh_content[0]['wraps'][0]['items'];
				$wrap['uid'] = $refresh_content[0]['wraps'][0]['uid'];
				$wrap['attr'] = $refresh_content[0]['wraps'][0]['attr'];

				$wrap['size'] = $refresh_content[0]['wraps'][0]['size'];
				$wrap['tablet_size'] = $refresh_content[0]['wraps'][0]['tablet_size'];
				$wrap['mobile_size'] = $refresh_content[0]['wraps'][0]['mobile_size'];

				$wrap_class[] = ' mfn-global-wrap';

				//styles
				$path = wp_upload_dir()['baseurl'] .'/betheme/css/post-'. $global_wrap_id.'.css';
				wp_enqueue_style('mfn-global-wrap-styles-'. Mfn_Builder_Helper::unique_ID(), $path, false, time(), 'all');
			}

			// FIX: LUK empty wrap created in error
			if(!isset($wrap['size']) || empty($wrap['size'])){
				return;
			}

			$wrap_class[] = 'mcb-wrap-'. $wrap['uid'];

			if( $this->template_type && $this->template_type == 'header' ) $wrap_class[] = 'mcb-header-wrap';

			// classes ---

			$wrap_class[] = $this->classes[ $wrap['size'] ];

			if( !empty($wrap['tablet_size']) ){
				$wrap_class[] = $this->tablet_classes[ $wrap['tablet_size'] ];
			}else{
				$wrap_class[] = $this->tablet_classes[ $wrap['size'] ];
			}

			if( !empty($wrap['mobile_size']) ){
				$wrap_class[] = $this->mobile_classes[ $wrap['mobile_size'] ];
			}else{
				$wrap_class[] = 'mobile-one';
			}

			if( key_exists('attr', $wrap) ) {

				if( ! empty($wrap['attr']['class']) ){
					$wrap_class[] = $wrap['attr']['class'];
				}

				if( ! empty($wrap['attr']['classes']) ){
					$wrap_class[] = $wrap['attr']['classes'];
				}

				// items margin

				if( ! empty($wrap['attr']['column_margin']) ) {
					$wrap_class[] = 'column-margin-'. $wrap['attr']['column_margin'];
				}

				if( !empty($wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-size']) && $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-size'] == 'cover-ultrawide' ){
  					$wrap_class[] = 'bg-cover-ultrawide';
  			}

				// items vertical align

				if( ! empty($wrap['attr']['vertical_align']) ) {
					$wrap_class[] = 'valign-'. $wrap['attr']['vertical_align'];
				}

				// reverse order on mobile

				if( ! empty($wrap['attr']['reverse_order']) ) {
					if( $wrap['attr']['reverse_order'] == 1 ){
						$wrap_class[] = 'column-reverse';
					}else if( $wrap['attr']['reverse_order'] == 2 ){
						$wrap_class[] = 'column-reverse-rows';
					}
				}

				// background size

				if( ! empty($wrap['attr']['bg_size']) && ($wrap['attr']['bg_size'] != 'auto') ) {
					$wrap_class[] = 'bg-'. $wrap['attr']['bg_size'];
				}

				if ( ! empty($wrap['attr']['visibility']) ) {
					$wrap_class[] = $wrap['attr']['visibility'];
				}

				// sticky

				if( ! empty( $wrap['attr']['sticky'] ) ) {
					$wrap_class[] = 'sticky sticky-desktop';
				}

				if( ! empty( $wrap['attr']['tablet_sticky'] ) ) {
					$wrap_class[] = 'sticky sticky-tablet';
				}

				if( ! empty( $wrap['attr']['mobile_sticky'] ) ) {
					$wrap_class[] = 'sticky sticky-mobile';
				}

			}

			// styles ---

			$wrap_style = $wrap_bg = array();
			$wrap_data = array();
			$parallax = false;
			$wrap_id = false;

			if( key_exists('attr', $wrap) ){

				// padding

				if( isset($wrap['attr']['padding']) ) {
					$wrap_style[] = 'padding:'. $wrap['attr']['padding'];
				}

				// background color

				if( isset($wrap['attr']['bg_color']) ){
					$wrap_style[] = 'background-color:'. $wrap['attr']['bg_color'];
				}

				// move up

				if( ! empty($wrap['attr']['move_up']) ) {
					$wrap_class[] = 'move-up';
					$wrap_style[] = 'margin-top:-'. intval($wrap['attr']['move_up']) .'px';

					if ($moveup = mfn_opts_get('builder-wrap-moveup')) {
						if ('no-tablet' == $moveup) {
							$wrap_data[] = 'data-tablet="no-up"';
						}
						$wrap_data[] = 'data-mobile="no-up"';
					}
				}

				// background image attributes

				if( ! empty($wrap['attr']['bg_image']) ){

					$wrap_bg[] = 'background-image:url('. $wrap['attr']['bg_image'] .')';

					if( ! empty($wrap['attr']['bg_position']) ){

						$wrap_bg_attr = explode(';', $wrap['attr']['bg_position']);

						if( ! empty($wrap_bg_attr[0]) ) {
							$wrap_bg[] = 'background-repeat:'. $wrap_bg_attr[0];
						}
						if( ! empty($wrap_bg_attr[1]) ) {
							$wrap_bg[] = 'background-position:'. $wrap_bg_attr[1];
						}
						if( ! empty($wrap_bg_attr[2]) ) {
							$wrap_bg['attachment'] = 'background-attachment:'. $wrap_bg_attr[2];
						}
						if( ! empty($wrap_bg_attr[3]) ) {
							$wrap_bg[] = 'background-size:'. $wrap_bg_attr[3];
						}

					}

				}

				// parallax

				if( empty( $_GET['visual'] ) || ! isset( $items ) ){

					// parallax for Muffin Builder

					if ( ! empty( $wrap['attr']['bg_image'] ) && ! empty($wrap_bg_attr[2]) && $wrap_bg_attr[2] == 'fixed' ) {
						if ( empty( $wrap_bg_attr[4] ) || $wrap_bg_attr[4] != 'still' ) {

							$parallax = mfn_parallax_data();
							$parallax_bg_image = $wrap['attr']['bg_image'];

							if (mfn_parallax_plugin() == 'translate3d') {
								if (mfn_is_mobile()) {
									$wrap_bg['attachment'] = 'background-attachment:scroll';
								} else {
									$wrap_bg = array();
								}
							}

						}
					}

					// parallax for BeBuilder

					if ( ! empty( $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-image'] ) && ! empty( $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-attachment'] ) && ( $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-attachment'] == 'parallax' ) ) {

						$parallax = mfn_parallax_data();
						$parallax_bg_image = $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement .mcb-wrap-inner:background-image'];

						if ( mfn_parallax_plugin() == 'translate3d' ) {
							if ( mfn_is_mobile() ) {
								$wrap_bg['attachment'] = 'background-attachment:scroll';
							} else {
								$wrap_bg = array();
							}
						}

					}

				}

				// ACM new input name

				if(key_exists('custom_id', $wrap['attr']) && $wrap['attr']['custom_id']) {
					$wrap_id = 'id="'. $wrap['attr']['custom_id'] .'"';
				}
			}

			// ACM new input name
			if( ! empty( $wrap['attr']['custom_css'] ) ){
				$wrap_style[] = $wrap['attr']['custom_css'];
			}

			$wrap_class	= implode(' ', $wrap_class);

			$wrap_style = array_merge($wrap_style, $wrap_bg);
			$wrap_style = implode( ';', $wrap_style );

			if( ! empty( $wrap['attr']['style'] ) ){
				$wrap_style .= ';'. $wrap['attr']['style'];
			}

			$desktop_size = $wrap['size'];
			$tablet_size = !empty($wrap['tablet_size']) ? $wrap['tablet_size'] : $desktop_size;
			$mobile_size = !empty($wrap['mobile_size']) ? $wrap['mobile_size'] : '1/1';

			if( !empty($wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex']) ){
				$desktop_size = $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex'];
			}

			if( !empty($wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex_tablet']) ){
				$tablet_size = $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex_tablet'];
			}

			if( !empty($wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex_mobile']) ){
				$mobile_size = $wrap['attr']['style:.mcb-section .mcb-wrap-mfnuidelement:flex_mobile'];
			}

			$wrap_data = implode( ' ', $wrap_data );

			$desktop_size_col = !empty($this->classes[ $desktop_size ]) ? $this->classes[ $desktop_size ] : '';
			$tablet_size_col = !empty($this->tablet_classes[ $tablet_size ]) ? $this->tablet_classes[ $tablet_size ] : '';
			$mobile_size_col = !empty($this->mobile_classes[ $mobile_size ]) ? $this->mobile_classes[ $mobile_size ] : '';


			// output WRAP -----


			if( $vb ){
				echo '<div '. $wrap_id .' class="wrap vb-item mcb-wrap '. $wrap_class .' clearfix" '. $global_wrap_attr .' data-desktop-col="'. $desktop_size_col .'" data-tablet-col="'. $tablet_size_col .'" data-mobile-col="'. $mobile_size_col .'" data-desktop-size="'. $desktop_size .'" data-tablet-size="'. $tablet_size .'" data-mobile-size="'. $mobile_size .'" data-order="'. $w .'"  data-uid="'. $original_uid .'" style="'. $wrap_style .'" '. $parallax .' '. $wrap_data .'>';
				// echo Mfn_Builder_Helper::wrapTools($wrap['size']);

				// Global Section edit button
				if( $is_global_wrap ){
					echo '<a href="'.get_site_url().'/wp-admin/post.php?post='.$global_wrap_id.'&action=mfn-live-builder" target="_blank" data-tooltip="Edit Global Wrap" class="btn-edit-wrap" data-position="before">Edit Global Wrap</a>';
				}
			} else {
				echo '<div '. $wrap_id .' class="wrap mcb-wrap '. $wrap_class .' clearfix" data-desktop-col="'. $desktop_size_col .'" data-tablet-col="'. $tablet_size_col .'" data-mobile-col="'. $mobile_size_col .'" style="'. $wrap_style .'" '. $parallax .' '. $wrap_data .'>';
			}


				// parallax | translate3d background image

				if ( $parallax && ! mfn_is_mobile() && 'translate3d' == mfn_parallax_plugin() ) {
					echo '<img class="mfn-parallax" src="'. $parallax_bg_image .'" alt="parallax background" style="opacity:0" />';
				}

				echo '<div class="mcb-wrap-inner mcb-wrap-inner-'.$wrap['uid'].'">';

					if( $vb ){
						echo Mfn_Builder_Helper::wrapTools($desktop_size);
					}

					// Background Overlay

					echo '<div class="mcb-wrap-background-overlay"></div>';

					// ITEMS -----

					if ( isset($wrap['items'] ) && is_array( $wrap['items'] )) {
            // visual builder
            ksort($wrap['items']);

            // loop items
            foreach ($wrap['items'] as $i => $item) {

            	if( !isset($item['tablet_size']) ){
            		$item['tablet_size'] = !empty($item['size']) ? $item['size'] : '1/1';
            		$item['mobile_size'] = '1/1';
            	}

            	$this->show_items($item, $i, $vb);
            }

					}else{
						echo '<div class="mfn-drag-helper placeholder-wrap"></div>';
					}

				echo '</div>';

			echo '</div>';
  	}

  	public function show_items($item, $i, $vb){

			$type = 'item_'. $item['type'];

			if ( method_exists( 'Mfn_Builder_Items', $type ) ) {

				$item_class = array();
				$animate = '';

				// FIX: LUK empty wrap created in error

				if( empty( $item['size'] ) ){
        	return;
        }

				if( ! isset( $item['fields'] ) ){
					$item['fields'] = array();
				}

				// unique ID

				if( empty( $item['uid'] ) ) {
					$item['uid'] = Mfn_Builder_Helper::unique_ID();
				}

				$item_class[] = 'mcb-item-'. $item['uid'];

				// size

				if( isset( $this->classes[$item['size']] ) ){
					$item_class[] = $this->classes[$item['size']];
				}

				if( isset( $item['tablet_size'] ) ){
					$item_class[] = $this->tablet_classes[$item['tablet_size']];
				}else{
					$item_class[] = $this->tablet_classes[$item['size']];
				}

				if( isset( $item['mobile_size'] ) ){
					$item_class[] = $this->mobile_classes[$item['mobile_size']];
				}else{
					$item_class[] = '1/1';
				}

				// type

				$item_class[] = 'column_'. $item['type'];

				// animate

				if ( ! empty( $item['fields']['animate'] ) ) {
					$item_class[] = 'animate';
					$animate = 'data-anim-type="'. $item['fields']['animate'] .'"';
				}

				// custom classes

				if ( ! empty($item['fields']['classes']) ) {
					$item_class[] = $item['fields']['classes'];
				}

				if ( ! empty($item['fields']['width_switcher']) && $item['fields']['width_switcher'] == 'inline' ) {
					$item_class[] = 'mfn-item-inline';
				}

				if ( ! empty($item['fields']['visibility']) ) {
					$item_class[] = $item['fields']['visibility'];
				}

				// margin bottom

				if ($item['type'] == 'column' && (! empty($item['fields']['margin_bottom']))) {
					$item_class[] = 'column-margin-'. $item['fields']['margin_bottom'];
				}

				// pricing item

				if( 'pricing_item' == $item['type'] && ! empty($item['fields']['style']) ) {
					$item_class[] = 'pricing_item-style-'. $item['fields']['style'];
				}

				// custom id

				if(key_exists('custom_id', $item['fields']) && $item['fields']['custom_id']) {
					$item_id = 'id="'. $item['fields']['custom_id'] .'"';
				} else {
					$item_id = false;
				}

				$item_style = '';

				// ACM new input name
				if( ! empty( $item['fields']['custom_css'] ) ){
					$item_style .= ';'. $item['fields']['custom_css'];
				}

				$desktop_size = $item['size'];
				$tablet_size = !empty($item['tablet_size']) ? $item['tablet_size'] : $desktop_size;
				$mobile_size = !empty($item['mobile_size']) ? $item['mobile_size'] : '1/1';

				if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex']) ){
					$desktop_size = $item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex'];
				}

				if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex_tablet']) ){
					$tablet_size = $item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex_tablet'];
				}

				if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex_mobile']) ){
					$mobile_size = $item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:flex_mobile'];
				}

				if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement .mcb-column-inner:background-size']) && $item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement .mcb-column-inner:background-size'] == 'cover-ultrawide' ){
  					$item_class[] = 'bg-cover-ultrawide';
  			}


				$item_class	= implode(' ', $item_class);

				// output -----
				if( $vb ){
					$tooltip = false;

					if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:hide_under_custom']) ) $tooltip = 'data-position="bottom" data-tooltip="Hide under '.$item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:hide_under_custom'].'"';

					if( !empty($item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:show_under_custom']) ) $tooltip = 'data-position="bottom" data-tooltip="Show under '.$item['fields']['style:.mcb-section .mcb-wrap .mcb-item-mfnuidelement:show_under_custom'].'"';

					echo '<div '.$tooltip.' '.$item_id.' data-order="'. $i .'"  data-uid="'. $item['uid'] .'" data-minsize="'.$item['size'].'" data-desktop-size="'.$desktop_size.'" data-tablet-size="'.$tablet_size.'" data-mobile-size="'.$mobile_size.'" class="column vb-item mcb-column '. $item_class .'" style="'.$item_style.'">';
					// echo Mfn_Builder_Helper::itemTools($item['size']);
				} else {
					echo '<div '. $item_id .' class="column mcb-column '. $item_class .'" style="'. $item_style .'" '. $animate .'>';
				}

					echo '<div class="mcb-column-inner mcb-column-inner-'.$item['uid'].' mcb-item-'.$item['type'].'-inner">';
						if( $vb ) { echo Mfn_Builder_Helper::itemTools($desktop_size); }
						echo Mfn_Builder_Items::$type( $item['fields'], $vb );
					echo '</div>';

				echo '</div>';
			}
  	}

  }
}
