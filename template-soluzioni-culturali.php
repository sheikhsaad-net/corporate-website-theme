<?php
/**
 * Template Name: Immensive – Soluzioni Culturali Creative
 *
 * Rebuilt from the approved concept (soluzioni-culturali-creative.html):
 * statue hero with the VR-headset / wireframe reveal and topographic lines,
 * "La cultura diventa esperienza" with the four cards, project tiles and
 * "Per chi lavoriamo". Shared site header/footer, contact band and theme
 * buttons are kept. Styles: assets/css/cultura.css (scoped under .svz);
 * scripts: assets/js/cultura.js — both enqueued only here
 * (immensive_cultura_assets() in functions.php).
 *
 * "Progetti realizzati" still lists the projects placed on this page from the
 * "Mostra nelle pagine" box on each project (see inc/portfolio.php).
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

// Contatti page for the CTA; falls back to the mail address if it's missing.
$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

// "Esplora il portfolio": the Portfolio page, else the projects archive.
$immensive_portfolio_page = get_page_by_path( 'portfolio' );
$immensive_portfolio_href = $immensive_portfolio_page ? get_permalink( $immensive_portfolio_page ) : get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );

/* What we build — the four coloured cards. 'tone' picks the skin. */
$immensive_scc_what = array(
	array(
		'tone'  => 'dark',
		'label' => 'Applicazioni VR e AR per la cultura',
		'desc'  => 'Sviluppiamo esperienze immersive che permettono di esplorare in prima persona contesti storici e artistici, o di arricchire con contenuti digitali la visita di un luogo reale.',
	),
	array(
		'tone'  => 'gradient',
		'label' => 'Percorsi interattivi multimediali',
		'desc'  => 'Progettiamo installazioni e app fruibili su più dispositivi (visori, tablet, postazioni museali, smartphone), pensate per adattarsi a contesti espositivi diversi.',
	),
	array(
		'tone'  => 'light',
		'label' => 'VR Storytelling',
		'desc'  => 'Raccontiamo storie, tradizioni e territori attraverso narrazioni immersive che uniscono ricostruzione digitale e sceneggiatura.',
	),
	array(
		'tone'  => 'green',
		'label' => 'Virtual Tour 3D',
		'desc'  => 'Realizziamo il gemello digitale di spazi culturali (musei, siti storici, edifici), esplorabile da remoto e integrabile in percorsi didattici o promozionali.',
	),
);

/* Who we work for — inline SVGs so there are no extra image requests. */
$immensive_scc_who = array(
	array(
		'label' => 'Musei',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2 2 7v2h20V7L12 2Zm-7 9v7H3v2h18v-2h-2v-7h-2v7h-3v-7h-2v7H7v-7H5Z"/></svg>',
	),
	array(
		'label' => 'Enti<br>pubblici',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 1 3 6v2h18V6l-9-5Zm-1 4.5a1 1 0 1 1 2 0 1 1 0 0 1-2 0ZM5 10v7H3v2h18v-2h-2v-7h-2v7h-2v-7h-2v7h-2v-7H9v7H7v-7H5Zm-3 11v2h20v-2H2Z"/></svg>',
	),
	array(
		'label' => 'Fondazioni',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M2 10.5 6 7l4 3 2-1 2 1 4-3 4 3.5-4 4.5-2-1.5-2 2-2-1-2 1-2-2L6 15l-4-4.5Z"/></svg>',
	),
	array(
		'label' => 'Istituzioni<br>culturali',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 5.5C10 4 7 3.5 3 4v14c4-.5 7 0 9 1.5 2-1.5 5-2 9-1.5V4c-4-.5-7 0-9 1.5Zm0 2.2c1.7-1 4-1.4 7-1.2v10c-3-.2-5.3.2-7 1.1V7.7Z"/></svg>',
	),
	array(
		'label' => 'Aziende',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 21V3h11v5h7v13H3Zm2-2h7V5H5v14Zm9 0h5v-9h-5v9ZM6.5 7h4v2h-4V7Zm0 4h4v2h-4v-2Zm0 4h4v2h-4v-2Zm9-1h2v2h-2v-2Z"/></svg>',
	),
);

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<main class="svz" id="contenuto">

		<section class="immersive-hero vr-hero" id="inizio" data-page="cultura" aria-label="<?php esc_attr_e( 'Soluzioni Culturali Creative', 'immensive' ); ?>">
			<div class="vr-background-lines" aria-hidden="true"></div>
			<div class="vr-stage" aria-hidden="true">
				<div class="vr-halo"></div>
				<div class="vr-object">
					<img class="vr-statue" src="<?php echo esc_url( $immensive_img . 'cultura/statua-vr.webp' ); ?>" width="1086" height="1448" alt="" fetchpriority="high" decoding="async">
					<div class="vr-sheen"></div>
					<div class="vr-device-layers">
						<img class="vr-wire" src="<?php echo esc_url( $immensive_img . 'cultura/vr-wire.svg' ); ?>" alt="" width="1086" height="1448">
						<img class="vr-headset" src="<?php echo esc_url( $immensive_img . 'cultura/vr-headset.webp' ); ?>" alt="" width="1086" height="1448">
						<img class="vr-wire vr-wire-local" src="<?php echo esc_url( $immensive_img . 'cultura/vr-wire.svg' ); ?>" alt="" width="1086" height="1448">
					</div>
				</div>
			</div>
			<button class="vr-hit-area" type="button" aria-label="<?php esc_attr_e( 'Mostra o nascondi il visore VR', 'immensive' ); ?>" aria-pressed="false"></button>
			<div class="vr-caption" aria-hidden="true"><?php esc_html_e( 'Patrimonio culturale.', 'immensive' ); ?><br><?php esc_html_e( 'Nuove dimensioni.', 'immensive' ); ?></div>
			<div class="shell">
				<p class="ih-new-top"><?php esc_html_e( 'Immensive / Soluzioni Culturali Creative', 'immensive' ); ?></p>
				<h1><?php esc_html_e( 'Diamo forma', 'immensive' ); ?><br><?php esc_html_e( 'alle idee.', 'immensive' ); ?><br><span class="hero-outline"><?php esc_html_e( 'Vita alle', 'immensive' ); ?><br><?php esc_html_e( 'esperienze.', 'immensive' ); ?></span></h1>
				<p class="ih-new-copy"><?php esc_html_e( 'Diamo nuova vita al patrimonio attraverso esperienze da esplorare. Narrazione, ricostruzione digitale e interazione avvicinano le persone a musei, luoghi e territori.', 'immensive' ); ?></p>
				<div class="ih-new-actions">
					<a class="ih-btn ih-btn--solid" href="#progetti-cultura"><?php esc_html_e( 'Esplora i progetti', 'immensive' ); ?></a>
					<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Parliamo del tuo progetto', 'immensive' ); ?></a>
				</div>
				<div class="ih-hero-base">
					<p><?php esc_html_e( 'Patrimonio, persone,', 'immensive' ); ?><br><?php esc_html_e( 'nuove prospettive.', 'immensive' ); ?></p>
					<a class="scroll-cue" href="#progetti-cultura"><?php esc_html_e( 'Scorri per esplorare', 'immensive' ); ?> <span aria-hidden="true"></span>↓</a>
				</div>
			</div>
		</section>

		<section class="page-section">
			<div class="shell culture-offer">
				<div class="culture-intro">
					<div class="eyebrow"><?php esc_html_e( 'Tecnologia al servizio della cultura', 'immensive' ); ?></div>
					<h2 class="page-title"><?php esc_html_e( 'La cultura diventa esperienza', 'immensive' ); ?></h2>
					<div class="body-copy">
						<p><?php esc_html_e( 'Un luogo da conoscere, una storia da comprendere, un patrimonio da condividere. Ogni esperienza parte dai contenuti e dal pubblico a cui si rivolge.', 'immensive' ); ?></p>
						<p><?php esc_html_e( 'Progettiamo soluzioni culturali creative per rendere musei, siti archeologici, monumenti e itinerari accessibili ed esplorabili con modalità nuove.', 'immensive' ); ?></p>
					</div>
					<p class="svz-cta"><a class="ih-btn ih-btn--ghost-dark" href="#progetti-cultura"><?php esc_html_e( 'Esplora i progetti', 'immensive' ); ?></a></p>
				</div>
				<div class="ih-sccwhat__grid">
					<?php foreach ( $immensive_scc_what as $immensive_card ) : ?>
						<article class="ih-scccard ih-scccard--<?php echo esc_attr( $immensive_card['tone'] ); ?>">
							<h3 class="ih-scccard__label"><?php echo esc_html( $immensive_card['label'] ); ?></h3>
							<p class="ih-scccard__desc"><?php echo esc_html( $immensive_card['desc'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="project-gallery" id="progetti-cultura">
			<div class="shell">
				<div class="eyebrow"><?php esc_html_e( 'Progetti realizzati', 'immensive' ); ?></div>
				<h2><?php esc_html_e( 'Il patrimonio,', 'immensive' ); ?><br><?php esc_html_e( 'messo in esperienza.', 'immensive' ); ?></h2>
				<p class="gallery-intro"><?php esc_html_e( 'Dalle esigenze dei nostri clienti a soluzioni reali.', 'immensive' ); ?></p>
				<?php get_template_part( 'template-parts/projects-grid', null, array( 'tiles' => true ) ); ?>
				<p class="svz-cta"><a class="ih-btn ih-btn--outline" href="<?php echo esc_url( $immensive_portfolio_href ); ?>"><?php esc_html_e( 'Esplora il portfolio', 'immensive' ); ?></a></p>
			</div>
		</section>

		<section class="ih-sccwho" id="ih-per-chi-lavoriamo">
			<div class="ih-container">
				<h2 class="ih-sccwho__heading"><?php esc_html_e( 'Per chi', 'immensive' ); ?><br><?php esc_html_e( 'lavoriamo', 'immensive' ); ?></h2>
				<p class="ih-sccwho__sub"><?php esc_html_e( 'Collaboriamo con musei, enti pubblici, fondazioni, istituzioni culturali e aziende che vogliono valorizzare un patrimonio, un territorio o una tradizione, offrendo strumenti di divulgazione innovativi per un pubblico sempre più ampio e digitale.', 'immensive' ); ?></p>
				<ul class="ih-sccwho__grid">
					<?php foreach ( $immensive_scc_who as $immensive_aud ) : ?>
						<li class="ih-sccaud">
							<span class="ih-sccaud__icon" aria-hidden="true"><?php echo $immensive_aud['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG. ?></span>
							<span class="ih-sccaud__label"><?php echo wp_kses( $immensive_aud['label'], array( 'br' => array() ) ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

	</main>

	<?php
	get_template_part(
		'template-parts/contact-cta',
		null,
		array(
			'eyebrow' => __( 'Hai un progetto in mente ?', 'immensive' ),
			'heading' => __( 'Iniziamo', 'immensive' ),
			'label'   => __( 'Contattaci', 'immensive' ),
			'href'    => $immensive_contatti_url,
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
