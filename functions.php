<?php
/**
 * Theme Functions
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */

define('MFN_THEME_VERSION', '26.4.0.8');

// theme related filters

add_filter('widget_text', 'do_shortcode');

add_filter('the_excerpt', 'shortcode_unautop');
add_filter('the_excerpt', 'do_shortcode');

/**
 * White Label
 * IMPORTANT: We recommend the use of Child Theme to change this
 */

defined('WHITE_LABEL') or define('WHITE_LABEL', false);

/**
 * textdomain
 */

load_theme_textdomain('betheme', get_template_directory() .'/languages'); // frontend
load_theme_textdomain('mfn-opts', get_template_directory() .'/languages'); // admin panel

/**
 * theme options
 */

require_once(get_theme_file_path('/muffin-options/theme-options.php'));

/**
 * theme functions
 */

$theme_disable = mfn_opts_get('theme-disable');

require_once(get_theme_file_path('/functions/theme-functions.php'));
require_once(get_theme_file_path('/functions/theme-head.php'));

if ( is_admin() ) {
	require_once(get_theme_file_path('/functions/admin/class-mfn-api.php'));
}

// menu

require_once(get_theme_file_path('/functions/theme-menu.php'));
if (! isset($theme_disable['mega-menu'])) {
	require_once(get_theme_file_path('/functions/theme-mega-menu.php'));

}


// builder

require_once(get_theme_file_path('/functions/builder/class-mfn-builder.php'));

// post types

$post_types_disable = mfn_opts_get('post-type-disable');

require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type.php'));

if (! isset($theme_disable['custom-icons'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-icons.php'));
}
if (! isset($post_types_disable['template'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-template.php'));
}
if (! isset($post_types_disable['client'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-client.php'));
}
if (! isset($post_types_disable['offer'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-offer.php'));
}
if (! isset($post_types_disable['portfolio'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-portfolio.php'));
}
if (! isset($post_types_disable['slide'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-slide.php'));
}
if (! isset($post_types_disable['testimonial'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-testimonial.php'));
}

if (! isset($post_types_disable['layout'])) {
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-layout.php'));
}

if(function_exists('is_woocommerce')){
	require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-product.php'));
}

require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-page.php'));
require_once(get_theme_file_path('/functions/post-types/class-mfn-post-type-post.php'));

// includes

require_once(get_theme_file_path('/includes/content-post.php'));
require_once(get_theme_file_path('/includes/content-portfolio.php'));

// shortcodes

require_once(get_theme_file_path('/functions/theme-shortcodes.php'));

// hooks

require_once(get_theme_file_path('/functions/theme-hooks.php'));

// sidebars

require_once(get_theme_file_path('/functions/theme-sidebars.php'));

// widgets

require_once(get_theme_file_path('/functions/widgets/class-mfn-widgets.php'));

// TinyMCE

require_once(get_theme_file_path('/functions/tinymce/tinymce.php'));

// plugins

require_once(get_theme_file_path('/functions/class-mfn-love.php'));
require_once(get_theme_file_path('/functions/plugins/visual-composer.php'));
require_once(get_theme_file_path('/functions/plugins/elementor/class-mfn-elementor.php'));

// gdpr

require_once(get_theme_file_path('/functions/modules/class-mfn-gdpr.php'));

// WooCommerce functions

if (function_exists('is_woocommerce')) {
	require_once(get_theme_file_path('/functions/theme-woocommerce.php'));
}

// dashboard

if ( is_admin() ) {

	defined('MFN_DISABLE_LIVE') or define('MFN_DISABLE_LIVE', false);

	require_once(get_theme_file_path('/functions/admin/class-mfn-helper.php'));
	require_once(get_theme_file_path('/functions/admin/class-mfn-update.php'));

	require_once(get_theme_file_path('/functions/admin/class-mfn-dashboard.php'));
	$mfn_dashboard = new Mfn_Dashboard();

	if (! isset($theme_disable['demo-data'])) {
		require_once(get_theme_file_path('/functions/importer/class-mfn-importer.php'));
	}

	require_once(get_theme_file_path('/functions/admin/tgm/class-mfn-tgmpa.php'));

	if (! mfn_is_hosted()) {
		require_once(get_theme_file_path('/functions/admin/class-mfn-status.php'));
	}

	require_once(get_theme_file_path('/functions/admin/class-mfn-support.php'));
	require_once(get_theme_file_path('/functions/admin/class-mfn-changelog.php'));
	require_once(get_theme_file_path('/functions/admin/class-mfn-tools.php'));

	if( ! MFN_DISABLE_LIVE ){
		require_once(get_theme_file_path('/visual-builder/visual-builder.php'));
	}

}

/* Hide all notices WP */
add_action('admin_head', 'wphelp_hide_notices_wp'); function wphelp_hide_notices_wp() { ?> <style> .notice { display: none;} </style> <?php }

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );

/* Remove Menu Pages in Admin Area */
function remove_menu(){
	
	remove_menu_page('tools.php');			//tools Options
	remove_menu_page('users.php');			//users Options
	remove_menu_page('betheme');			//Theme Options
	//remove_menu_page('options-general.php');//Setting Options
	remove_menu_page('edit.php?post_type=template');			//template Options
	remove_menu_page('scrollsequence-dashboard');	//Moving Animation
	
}
add_action('admin_menu', 'remove_menu');

/* Add PostType for Courses */
register_post_type( 'courses',
array(

'labels' => array(
'name' => __( 'Courses' ),
'singular_name' => __( 'Course' ),
'add_new' => __( 'Add New Course' ),
'add_new_item' => __( 'Add New Course' ),
'new_item' => __( 'New Course' ),
'view_item' => __( 'View Course' ),
'search_items' => __( 'Search Course Items' ),
'not_found_in_trash' => __( 'No Course Items Found in Trash' ),
),
'public' => true,
'menu_icon' => 'dashicons-book',
'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
)
);


/*

add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to News
function cp_change_post_object() {
    $get_post_type = get_post_type_object('portfolio');
	$get_post_type->menu_icon = 'dashicons-book';
    $labels = $get_post_type->labels;
        $labels->name = 'Corsi';
        $labels->singular_name = 'corsa';
        $labels->add_new = 'Add corsa';
        $labels->add_new_item = 'Add corsa';
        $labels->edit_item = 'Edit corsa';
        $labels->new_item = 'corsa';
        $labels->view_item = 'View corsa';
        $labels->search_items = 'Search corsa';
        $labels->not_found = 'No corsa found';
        $labels->not_found_in_trash = 'No corsafound in Trash';
        $labels->all_items = 'All corsa';
        $labels->menu_name = 'Corsi';
		$labels->category = 'Corsi categories';
        $labels->name_admin_bar = 'Corsi';
		
}

*/

/**
 * @deprecated 21.0.5
 * Below constants are deprecated and will be removed soon
 * Please check if you use these constants in your Child Theme
 */

define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

define('THEME_NAME', 'betheme');
define('THEME_VERSION', MFN_THEME_VERSION);

define('LIBS_DIR', get_template_directory() .'/functions');
define('LIBS_URI', get_template_directory() .'/functions');
