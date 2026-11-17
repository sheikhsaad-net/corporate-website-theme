<?php
/**
 * Template Name: Immensive – Pagina legale
 *
 * Plain text page (Privacy Policy, Cookie Policy): shared "ih" header and
 * footer, the page title and the editor content in one readable column.
 * No hero, no sidebar. Styles: .ih-legal in assets/css/homepage.css.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="ih ih--no-hero ih--legal">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<main class="ih-legal" id="contenuto">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article class="ih-legal__inner">
				<h1 class="ih-legal__title"><?php the_title(); ?></h1>
				<div class="ih-legal__content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
