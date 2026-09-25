<?php
/**
 * Single project (portfolio detail).
 *
 * Layout follows the Figma PORTFOLIO detail frame (node 1567:781):
 *   1. dark band — oversized Bebas title, then the project's Settore /
 *      Tecnologia terms as outlined pills;
 *   2. a full-bleed hero built from the featured image;
 *   3. a light editorial block where the post content is rendered, with
 *      headings styled as the small Bebas labels ("TIPO DI PROGETTO",
 *      "CARATTERISTICHE", "IN BREVE") and the text under each as the value;
 *   4. any gallery in the content laid out as the 2-column tile grid.
 *
 * Everything after the pills comes from the editor on purpose — the client
 * fills in the copy, the featured image and the gallery, and the CSS does the
 * rest. That is why there are no extra meta fields here: no dashboard field
 * to forget, and the labels are just h2/h3 in the editor.
 *
 * The ih shell (homepage.css / homepage.js) is already enqueued for this
 * screen — immensive_is_ih_page() treats is_singular( immensive_work ) as an
 * ih page, so nothing needs to change in functions.php.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$immensive_pj_settori = get_the_terms( get_the_ID(), IMMENSIVE_TAX_SETTORE );
$immensive_pj_tech    = get_the_terms( get_the_ID(), IMMENSIVE_TAX_TECNOLOGIA );

$immensive_pj_pills = array();
foreach ( array( $immensive_pj_settori, $immensive_pj_tech ) as $immensive_pj_set ) {
	if ( is_array( $immensive_pj_set ) ) {
		foreach ( $immensive_pj_set as $immensive_pj_term ) {
			$immensive_pj_pills[] = $immensive_pj_term;
		}
	}
}

/* Where "torna al portfolio" points: the editable Portfolio page if one
   exists, otherwise the CPT archive. */
$immensive_pj_back = get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );
$immensive_pj_page = get_page_by_path( 'portfolio' );
if ( $immensive_pj_page ) {
	$immensive_pj_back = get_permalink( $immensive_pj_page );
}
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article class="ih-pj" id="ih-project">

			<header class="ih-pj__head">
				<div class="ih-container">
					<h1 class="ih-pj__title"><?php the_title(); ?></h1>

					<?php if ( $immensive_pj_pills ) : ?>
						<ul class="ih-pj__pills">
							<?php foreach ( $immensive_pj_pills as $immensive_pj_term ) : ?>
								<?php
								// Rather than the term archive, send the visitor to the
								// Portfolio page with this term pre-selected — its filter
								// JS (see the pfLinked block in homepage.js) reads
								// ?settore=/?tecnologia= on load and presses the matching
								// button itself.
								$immensive_pj_group = IMMENSIVE_TAX_SETTORE === $immensive_pj_term->taxonomy ? 'settore' : 'tecnologia';
								$immensive_pj_href  = add_query_arg( $immensive_pj_group, $immensive_pj_term->slug, $immensive_pj_back );
								?>
								<li>
									<a class="ih-pj__pill" href="<?php echo esc_url( $immensive_pj_href ); ?>">
										<?php echo esc_html( $immensive_pj_term->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="ih-pj__hero">
					<?php the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'decoding' => 'async' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="ih-pj__body">
				<div class="ih-container">
					<div class="ih-pj__content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<nav class="ih-pj__pages">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>
				</div>
			</div>

			<?php
			$immensive_pj_prev = get_previous_post();
			$immensive_pj_next = get_next_post();
			?>
			<nav class="ih-pj__nav" aria-label="<?php esc_attr_e( 'Altri progetti', 'immensive' ); ?>">
				<div class="ih-container">
					<div class="ih-pj__nav-row">
						<span class="ih-pj__nav-slot ih-pj__nav-slot--prev">
							<?php if ( $immensive_pj_prev ) : ?>
								<a href="<?php echo esc_url( get_permalink( $immensive_pj_prev ) ); ?>">
									<span class="ih-pj__nav-label"><?php esc_html_e( 'Progetto precedente', 'immensive' ); ?></span>
									<span class="ih-pj__nav-title"><?php echo esc_html( get_the_title( $immensive_pj_prev ) ); ?></span>
								</a>
							<?php endif; ?>
						</span>

						<a class="ih-pj__back" href="<?php echo esc_url( $immensive_pj_back ); ?>">
							<?php esc_html_e( 'Tutti i progetti', 'immensive' ); ?>
						</a>

						<span class="ih-pj__nav-slot ih-pj__nav-slot--next">
							<?php if ( $immensive_pj_next ) : ?>
								<a href="<?php echo esc_url( get_permalink( $immensive_pj_next ) ); ?>">
									<span class="ih-pj__nav-label"><?php esc_html_e( 'Progetto successivo', 'immensive' ); ?></span>
									<span class="ih-pj__nav-title"><?php echo esc_html( get_the_title( $immensive_pj_next ) ); ?></span>
								</a>
							<?php endif; ?>
						</span>
					</div>
				</div>
			</nav>

		</article>

		<?php
	endwhile;
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	<div class="ih-lightbox" id="ih-lightbox" aria-hidden="true">
		<div class="ih-lightbox__overlay" data-lightbox-close></div>
		<button type="button" class="ih-lightbox__close" data-lightbox-close aria-label="<?php esc_attr_e( 'Chiudi', 'immensive' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>
		<button type="button" class="ih-lightbox__nav ih-lightbox__nav--prev" aria-label="<?php esc_attr_e( 'Immagine precedente', 'immensive' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
		<button type="button" class="ih-lightbox__nav ih-lightbox__nav--next" aria-label="<?php esc_attr_e( 'Immagine successiva', 'immensive' ); ?>">
			<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
		<figure class="ih-lightbox__figure">
			<img class="ih-lightbox__img" src="" alt="">
			<figcaption class="ih-lightbox__caption" hidden></figcaption>
			<span class="ih-lightbox__counter"></span>
		</figure>
	</div>

	<div class="ih-video-modal" id="ih-video-modal" aria-hidden="true">
		<div class="ih-video-modal__overlay" data-video-modal-close></div>
		<button type="button" class="ih-video-modal__close" data-video-modal-close aria-label="<?php esc_attr_e( 'Chiudi', 'immensive' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>
		<div class="ih-video-modal__box">
			<video controls playsinline></video>
			<iframe hidden title="<?php esc_attr_e( 'Video', 'immensive' ); ?>" src="" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>

</div>

<?php
get_footer();
