<?php
/**
 * Portfolio project cards for one host page, as used by the services landing
 * pages (Soluzioni Culturali Creative, Ricerca, Innovazione).
 *
 * Args:
 *   'page_id'    host page whose placements to render; defaults to the page
 *                being viewed
 *   'wide_first' true  -> first card spans the row, the rest pair up
 *                false -> cards pair up and a trailing odd card spans
 *
 * Which projects appear is set per project, in the "Mostra nelle pagine" box
 * on the project editor (see inc/portfolio.php) — tick this page and give a
 * position. Nothing here queries a taxonomy any more.
 *
 * Both designs alternate one full-width card with rows of two; they differ
 * only in which end the wide card sits at, hence the flag rather than two
 * copies of this markup.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_pg_page_id = isset( $args['page_id'] ) ? (int) $args['page_id'] : 0;
$immensive_pg_wide1st = ! empty( $args['wide_first'] );

$immensive_pg_items = function_exists( 'immensive_portfolio_for_page' )
	? immensive_portfolio_for_page( $immensive_pg_page_id )
	: array();

$immensive_pg_total = count( $immensive_pg_items );

if ( ! $immensive_pg_items ) :
	?>
	<p class="ih-sccprog__empty"><?php esc_html_e( 'Nessun progetto pubblicato.', 'immensive' ); ?></p>
	<?php
	return;
endif;
?>
<div class="ih-sccprog__grid">
	<?php
	foreach ( $immensive_pg_items as $immensive_pg_i => $immensive_pg_p ) :
		$immensive_pg_is_last = ( $immensive_pg_total - 1 === $immensive_pg_i );

		if ( $immensive_pg_wide1st ) {
			// Wide opener, then pairs; a lone trailing card goes wide too
			// rather than sitting in a half-empty row.
			$immensive_pg_wide = ( 0 === $immensive_pg_i )
				|| ( $immensive_pg_is_last && 1 === ( $immensive_pg_total - 1 ) % 2 );
		} else {
			// Pairs first, wide closer on the trailing odd card.
			$immensive_pg_wide = ( $immensive_pg_is_last && 1 === $immensive_pg_total % 2 );
		}

		$immensive_pg_tech = wp_get_post_terms( $immensive_pg_p->ID, IMMENSIVE_TAX_TECNOLOGIA, array( 'fields' => 'names' ) );
		?>
		<a class="ih-sccp<?php echo $immensive_pg_wide ? ' ih-sccp--wide' : ''; ?> ih-reveal" href="<?php echo esc_url( get_permalink( $immensive_pg_p ) ); ?>">
			<span class="ih-sccp__media" aria-hidden="true">
				<?php
				if ( has_post_thumbnail( $immensive_pg_p ) ) {
					echo get_the_post_thumbnail( $immensive_pg_p, 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) );
				}
				?>
			</span>
			<span class="ih-sccp__bar">
				<span class="ih-sccp__title"><?php echo esc_html( get_the_title( $immensive_pg_p ) ); ?></span>
				<?php if ( ! empty( $immensive_pg_tech ) && ! is_wp_error( $immensive_pg_tech ) ) : ?>
					<span class="ih-sccp__pill"><?php echo esc_html( $immensive_pg_tech[0] ); ?></span>
				<?php endif; ?>
			</span>
		</a>
	<?php endforeach; ?>
</div>
