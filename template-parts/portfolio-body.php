<?php
/**
 * Portfolio listing body — the filter rail plus the projects grouped by
 * Tecnologia.
 *
 * Shared by two entry points that render the identical listing:
 *   - archive-immensive_work.php  (the CPT archive at /progetti/)
 *   - template-portfolio.php      (an editable WP page, so the listing shows
 *                                  up under Pages like every other section)
 *
 * The Tecnologia term's DESCRIPTION is the blurb under each panel heading, so
 * filling those in is what makes this page read well.
 *
 * Filtering is client-side (see the portfolioArchive block in homepage.js):
 * every card carries its sector slugs in data-settori and every panel its own
 * slug, so toggling a filter hides cards and empty panels instantly rather
 * than reloading. With no filters active everything shows.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_settori    = immensive_portfolio_terms( IMMENSIVE_TAX_SETTORE );
$immensive_tecnologie = immensive_portfolio_terms( IMMENSIVE_TAX_TECNOLOGIA );

// The archive uses <h1> for the page title; the page template passes its own
// heading level in so a WP page can carry the <h1> on its edited title.
$immensive_pf_title = isset( $args['title'] ) ? $args['title'] : __( 'Portfolio', 'immensive' );
$immensive_pf_sub   = isset( $args['sub'] ) ? $args['sub'] : __( 'Scopri i nostri ultimi lavori', 'immensive' );
?>

	<section class="ih-pf" id="ih-portfolio">
		<div class="ih-container">

			<header class="ih-pf__head">
				<h1 class="ih-pf__title"><?php echo esc_html( $immensive_pf_title ); ?></h1>
				<?php if ( $immensive_pf_sub ) : ?>
					<p class="ih-pf__sub"><?php echo esc_html( $immensive_pf_sub ); ?></p>
				<?php endif; ?>
			</header>

			<div class="ih-pf__layout">

				<aside class="ih-pf__side" aria-label="<?php esc_attr_e( 'Filtri', 'immensive' ); ?>">
					<?php if ( $immensive_settori ) : ?>
						<div class="ih-pf__group">
							<h2 class="ih-pf__group-title"><?php esc_html_e( 'Settori', 'immensive' ); ?></h2>
							<ul class="ih-pf__filters" data-filter-group="settore">
								<?php foreach ( $immensive_settori as $immensive_term ) : ?>
									<li>
										<button type="button" class="ih-pf__filter" data-slug="<?php echo esc_attr( $immensive_term->slug ); ?>" aria-pressed="false">
											<?php echo esc_html( $immensive_term->name ); ?>
										</button>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( $immensive_tecnologie ) : ?>
						<div class="ih-pf__group">
							<h2 class="ih-pf__group-title"><?php esc_html_e( 'Tecnologie', 'immensive' ); ?></h2>
							<ul class="ih-pf__filters" data-filter-group="tecnologia">
								<?php foreach ( $immensive_tecnologie as $immensive_term ) : ?>
									<li>
										<button type="button" class="ih-pf__filter" data-slug="<?php echo esc_attr( $immensive_term->slug ); ?>" aria-pressed="false">
											<?php echo esc_html( $immensive_term->name ); ?>
										</button>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<button type="button" class="ih-pf__reset" hidden><?php esc_html_e( 'Azzera filtri', 'immensive' ); ?></button>
				</aside>

				<div class="ih-pf__main">
					<?php
					if ( ! $immensive_tecnologie ) :
						?>
						<p class="ih-pf__empty"><?php esc_html_e( 'Nessun progetto pubblicato.', 'immensive' ); ?></p>
						<?php
					else :
						foreach ( $immensive_tecnologie as $immensive_tech ) :
							$immensive_projects = immensive_portfolio_by_term( IMMENSIVE_TAX_TECNOLOGIA, $immensive_tech->term_id );
							if ( ! $immensive_projects ) {
								continue;
							}
							?>
							<section class="ih-pfp" data-tecnologia="<?php echo esc_attr( $immensive_tech->slug ); ?>">
								<div class="ih-pfp__bar">
									<span class="ih-pfp__icon" aria-hidden="true"><?php echo immensive_portfolio_tech_icon( $immensive_tech->slug ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?></span>
									<span class="ih-pfp__text">
										<h2 class="ih-pfp__name"><?php echo esc_html( $immensive_tech->name ); ?></h2>
										<?php if ( $immensive_tech->description ) : ?>
											<p class="ih-pfp__desc"><?php echo esc_html( $immensive_tech->description ); ?></p>
										<?php endif; ?>
									</span>
								</div>

								<div class="ih-pfp__body">
									<div class="ih-pf-grid">
										<?php foreach ( $immensive_projects as $immensive_project ) : ?>
											<a class="ih-pfc" href="<?php echo esc_url( get_permalink( $immensive_project ) ); ?>" data-settori="<?php echo esc_attr( immensive_portfolio_settore_slugs( $immensive_project->ID ) ); ?>">
												<span class="ih-pfc__media" aria-hidden="true">
													<?php
													if ( has_post_thumbnail( $immensive_project ) ) {
														echo get_the_post_thumbnail( $immensive_project, 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) );
													}
													?>
												</span>
												<span class="ih-pfc__play" aria-hidden="true">
													<svg viewBox="0 0 24 24" fill="none" focusable="false"><path d="m9.5 5 7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
												</span>
												<span class="ih-pfc__title"><?php echo esc_html( get_the_title( $immensive_project ) ); ?></span>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
							</section>
							<?php
						endforeach;
					endif;
					?>

					<p class="ih-pf__noresults" hidden><?php esc_html_e( 'Nessun progetto corrisponde ai filtri selezionati.', 'immensive' ); ?></p>
				</div>

			</div>
		</div>
	</section>
