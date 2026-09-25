<?php
/**
 * Portfolio archive (/progetti/).
 *
 * Dark page: big PORTFOLIO title, a filter rail on the left (Settori and
 * Tecnologie), and the projects grouped by Tecnologia.
 *
 * The listing itself lives in template-parts/portfolio-body.php, shared with
 * template-portfolio.php so the archive and the editable Portfolio page can
 * never drift apart.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<?php get_template_part( 'template-parts/portfolio-body' ); ?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
