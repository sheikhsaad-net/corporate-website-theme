<?php
/**
 * Shared site header for all "ih" (Immensive) page templates.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';
?>
	<header class="ih-header" id="ih-header">
		<div class="ih-header__inner">
			<?php if ( has_custom_logo() ) : ?>
				<?php // the_custom_logo() prints its own home link, so it must not be nested in another <a>. ?>
				<div class="ih-logo"><?php the_custom_logo(); ?></div>
			<?php else : ?>
				<a class="ih-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $immensive_img . 'logo-immensive-white.webp' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="140" height="43">
				</a>
			<?php endif; ?>

			<?php
			/**
			 * Which menu (if any) this page shows is a per-page setting — see
			 * immensive_get_nav_choice(). When it resolves to 'none' the menu and
			 * the burger that opens it are omitted rather than hidden with CSS:
			 * hiding would leave a hoverable/focusable mega panel and a dead
			 * toggle button in the DOM. Logo and Area Clienti stay regardless.
			 */
			$immensive_show_nav = immensive_show_nav();
			?>

			<?php if ( $immensive_show_nav ) : ?>
			<nav class="ih-nav" id="ih-nav" aria-label="<?php esc_attr_e( 'Menu principale', 'immensive' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => immensive_get_nav_theme_location(),
						'menu_id'        => 'ih-primary-menu',
						'container'      => false,
						'fallback_cb'    => 'immensive_nav_fallback',
						'walker'         => new Immensive_Nav_Walker(),
					)
				);
				?>
			</nav>
			<?php endif; ?>

			<a class="ih-btn ih-btn--pill ih-header__cta" href="https://soluzioni.immensive.it/" target="_blank" rel="noopener">
				<?php esc_html_e( 'Area Clienti', 'immensive' ); ?>
			</a>

			<?php if ( $immensive_show_nav ) : ?>
			<button class="ih-burger" id="ih-burger" aria-expanded="false" aria-controls="ih-nav" aria-label="<?php esc_attr_e( 'Apri il menu', 'immensive' ); ?>">
				<span></span><span></span><span></span>
			</button>
			<?php endif; ?>
		</div>
	</header>
