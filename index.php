<?php
/**
 * The main template file for the Immensive theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
					endif;
					?>
				</header>

				<div class="entry-content">
					<?php
					if ( is_singular() ) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
			</article>
			<?php
		endwhile;

		the_posts_navigation();

	else :
		?>
		<p><?php esc_html_e( 'Nothing found.', 'immensive' ); ?></p>
		<?php
	endif;
	?>
</main>

<?php
get_sidebar();
get_footer();
