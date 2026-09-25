<?php
/**
 * Template Name: Immensive – Soluzioni Culturali Creative
 *
 * The "beni culturali" landing page, linked from the first card of the
 * "Due mondi, una missione" deck on Altri Servizi.
 *
 * Follows the standard ih skeleton: pinned full-viewport hero + .ih-flow
 * scrolling over it, then the shared contact CTA and site footer.
 *
 * "Progetti realizzati" lists the projects placed on this page from the
 * "Mostra nelle pagine" box on each project (see inc/portfolio.php). The grid
 * rhythm from the design — one wide card, then pairs, wide again on a
 * trailing odd item — lives in template-parts/projects-grid.php.
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

	<section class="ih-phero ih-phero--scc" id="ih-hero">
		<span class="ih-scchero__media" aria-hidden="true">
			<img src="<?php echo esc_url( $immensive_img . 'servizi/mission-beni-culturali.webp' ); ?>" alt="" fetchpriority="high" decoding="async">
		</span>
		<div class="ih-phero__inner ih-scchero__inner">
			<h1 class="ih-scchero__title"><?php esc_html_e( 'Soluzioni culturali creative', 'immensive' ); ?></h1>
		</div>
	</section>

	<div class="ih-flow">

		<section class="ih-sccintro">
			<div class="ih-container">
				<p class="ih-sccintro__text ih-reveal"><?php esc_html_e( "Da oltre 10 anni Immensive lavora nell'ambito dei beni culturali, unendo tecnologia e narrazione per dare nuova vita al patrimonio artistico, storico e territoriale. Attraverso percorsi interattivi multi-dispositivo, applicazioni in realtà virtuale e aumentata e ricostruzioni digitali, rendiamo accessibili ed esplorabili in modi nuovi musei, siti archeologici, monumenti e itinerari culturali.", 'immensive' ); ?></p>
			</div>
		</section>

		<section class="ih-sccwhat" id="ih-cosa-realizziamo">
			<div class="ih-container">
				<h2 class="ih-sccwhat__heading ih-reveal"><?php esc_html_e( 'Cosa realizziamo', 'immensive' ); ?></h2>

				<span class="ih-sccwhat__mark" aria-hidden="true">
					<span class="ih-sccwhat__mark-dot"></span>
					<span class="ih-sccwhat__mark-stem"></span>
				</span>

				<div class="ih-sccwhat__grid">
					<?php foreach ( $immensive_scc_what as $immensive_scc_card ) : ?>
						<article class="ih-scccard ih-scccard--<?php echo esc_attr( $immensive_scc_card['tone'] ); ?> ih-reveal">
							<h3 class="ih-scccard__label"><?php echo esc_html( $immensive_scc_card['label'] ); ?></h3>
							<p class="ih-scccard__desc"><?php echo esc_html( $immensive_scc_card['desc'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="ih-sccwho" id="ih-per-chi-lavoriamo">
			<div class="ih-container">
				<h2 class="ih-sccwho__heading ih-reveal"><?php esc_html_e( 'Per chi', 'immensive' ); ?><br><?php esc_html_e( 'lavoriamo', 'immensive' ); ?></h2>
				<p class="ih-sccwho__sub ih-reveal"><?php esc_html_e( 'Collaboriamo con musei, enti pubblici, fondazioni, istituzioni culturali e aziende che vogliono valorizzare un patrimonio, un territorio o una tradizione, offrendo strumenti di divulgazione innovativi per un pubblico sempre più ampio e digitale.', 'immensive' ); ?></p>

				<ul class="ih-sccwho__grid">
					<?php foreach ( $immensive_scc_who as $immensive_scc_aud ) : ?>
						<li class="ih-sccaud ih-reveal">
							<span class="ih-sccaud__icon" aria-hidden="true"><?php echo $immensive_scc_aud['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?></span>
							<span class="ih-sccaud__label"><?php echo wp_kses( $immensive_scc_aud['label'], array( 'br' => array() ) ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

		<section class="ih-sccprog" id="ih-progetti-realizzati">
			<div class="ih-container">
				<h2 class="ih-sccprog__heading ih-reveal"><?php esc_html_e( 'Progetti', 'immensive' ); ?><br><?php esc_html_e( 'realizzati', 'immensive' ); ?></h2>
				<p class="ih-sccprog__sub ih-reveal"><?php esc_html_e( 'Dalle esigenze dei nostri clienti a soluzioni reali.', 'immensive' ); ?></p>

				<?php
				get_template_part(
					'template-parts/projects-grid',
					null,
					array(
						'wide_first' => true,
					)
				);
				?>

			</div>
		</section>

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
</div>

<?php
get_footer();
