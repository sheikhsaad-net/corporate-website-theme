<?php
/**
 * The Header for our theme.
 *
 * @package Betheme
 * @author Muffin group
 * @link https://muffingroup.com
 */
?><!DOCTYPE html>
<?php
	if ($_GET && key_exists('mfn-rtl', $_GET)):
		echo '<html class="no-js" lang="ar" dir="rtl">';
	else:
?>
<html <?php language_attributes(); ?> class="no-js <?php echo esc_attr(mfn_html_classes()); ?>"<?php mfn_tag_schema(); ?> >
<?php endif; ?>

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PFLKZBX');</script>
<!-- End Google Tag Manager -->
<meta name="google-site-verification" content="dT9REyuETruNCFJBNBJQUIryrZavfTmU6ZDK0wEP2cg" />
<meta charset="<?php bloginfo('charset'); ?>" />
<?php wp_head(); ?>

	<!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/640af0fd4247f20fefe51543/1gr5chkk2';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PFLKZBX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php if( !empty(get_post_meta(get_the_ID(), 'mfn-post-one-page', true)) && get_post_meta(get_the_ID(), 'mfn-post-one-page', true) == '1' ) echo '<div id="home"></div>'; ?>

	<?php do_action('mfn_hook_top'); ?>

	<?php get_template_part('includes/header', 'sliding-area'); ?>

	<?php
		if (mfn_header_style(true) == 'header-creative') {
			get_template_part('includes/header', 'creative');
		}
	?>

	<div id="Wrapper">

	<?php
		if (mfn_header_style(true) == 'header-below') {
			echo mfn_slider();
		}

		$header_tmp_id = mfn_template_part_ID('header');

		// be setup wizard
		if( isset( $_GET['mfn-setup-preview'] ) ){
			$header_tmp_id = false;
		}

		if( $header_tmp_id ){
			$is_visual = false;
			if( !empty($_GET['visual']) ) $is_visual = true;
			get_template_part( 'includes/header', 'template', array( 'id' => $header_tmp_id, 'visual' => $is_visual ) );
		}else{
			get_template_part( 'includes/header', 'classic' );
		}

		if ( 'intro' == get_post_meta( mfn_ID(), 'mfn-post-template', true ) ) {
			get_template_part( 'includes/header', 'single-intro' );
		}
	?>

	<?php do_action( 'mfn_hook_content_before' );
