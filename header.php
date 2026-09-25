<?php
/**
 * The header for the Immensive theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! immensive_is_ih_page() ) : ?>
	<header id="site-header">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<?php
				$immensive_description = get_bloginfo( 'description', 'display' );
				if ( $immensive_description ) {
					?>
					<p class="site-description"><?php echo esc_html( $immensive_description ); ?></p>
					<?php
				}
			}
			?>
		</div>

		<nav id="site-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'immensive' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => immensive_get_nav_theme_location(),
					'menu_id'        => 'primary-menu',
					'fallback_cb'    => false,
					// This fallback header has no dropdown/mega-menu styling (that
					// lives in homepage.css, scoped to the ih templates) — cap at
					// top-level links so a "product" item's children don't dump
					// out as a second, unstyled flat list underneath it.
					'depth'          => 1,
				)
			);
			?>
		</nav>
	</header>

	<div id="content" class="site-content">
<?php endif; ?>
