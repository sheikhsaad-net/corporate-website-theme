<?php
/**
 * The template for displaying single posts in the Immensive theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>

		<?php the_post_navigation(); ?>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>

<?php
get_sidebar();
get_footer();
