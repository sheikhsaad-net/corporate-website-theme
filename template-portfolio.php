<?php
/**
 * Template Name: Portfolio
 *
 * The Portfolio listing as an editable WP page, so it sits under Pages
 * alongside Chi Siamo, Piani, Prodotti and the rest instead of existing only
 * as the /progetti/ CPT archive.
 *
 * The listing markup is shared with archive-immensive_work.php via
 * template-parts/portfolio-body.php — edit that, not this.
 *
 * The page's own title and excerpt drive the heading and the line under it,
 * so both are editable from the dashboard. Leaving the excerpt empty falls
 * back to the archive's wording.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$immensive_pf_sub = has_excerpt() ? get_the_excerpt() : '';
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<?php
	get_template_part(
		'template-parts/portfolio-body',
		null,
		array_filter(
			array(
				'title' => get_the_title(),
				'sub'   => $immensive_pf_sub,
			)
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
