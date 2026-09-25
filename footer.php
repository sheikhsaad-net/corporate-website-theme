<?php
/**
 * The footer for the Immensive theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<?php if ( ! immensive_is_ih_page() ) : ?>
		</div><!-- #content -->

		<footer id="site-footer">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>

			<nav id="footer-navigation" aria-label="<?php esc_attr_e( 'Footer menu', 'immensive' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<p class="site-info">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
			</p>
		</footer>
	<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
