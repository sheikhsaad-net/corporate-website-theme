<?php
/**
 * Template Name: Immensive – Altri Servizi
 *
 * Uses the shared "ih" header/footer. Body content to follow.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<?php
	/*
	 * Hero: project slider (Figma "servizi-hero", node 2618:1310).
	 *
	 * Each slide's photo is split down the middle and the two halves wipe in
	 * from opposite directions — see .ih-shero in homepage.css and the sHero
	 * block in homepage.js.
	 *
	 * Five real project shots now exist (no more placeholder frames — see
	 * assets/images/portfolio/shero/), each linking to its own portfolio
	 * page where one exists.
	 */
	// Same "Portfolio page if it exists, else the CPT archive" fallback as
	// single-immensive_work.php's own "Tutti i progetti" link.
	$immensive_shero_all_href = get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );
	$immensive_shero_portfolio_page = get_page_by_path( 'portfolio' );
	if ( $immensive_shero_portfolio_page ) {
		$immensive_shero_all_href = get_permalink( $immensive_shero_portfolio_page );
	}

	$immensive_shero_href = function ( $slug ) {
		$immensive_work = get_page_by_path( $slug, OBJECT, IMMENSIVE_PORTFOLIO_POST_TYPE );
		return $immensive_work ? get_permalink( $immensive_work ) : '#ih-servizi';
	};

	$immensive_shero_slides = array(
		array(
			'title' => "Luoghi e Percorsi Immersivi d'Italia",
			'tags'  => array( 'Heritage' ),
			'img'   => $immensive_img . 'portfolio/shero/shero-archeoclub.webp',
			'alt'   => "Luoghi e Percorsi Immersivi d'Italia — valorizzazione digitale del patrimonio archeologico",
			'href'  => $immensive_shero_href( 'luoghi-e-percorsi-immersivi-ditalia' ),
		),
		array(
			'title' => 'Museo Digitale Palazzo Serra di Cassano',
			'tags'  => array( 'Esperienza Museale Interattiva' ),
			'img'   => $immensive_img . 'portfolio/shero/shero-museo-digitale.webp',
			'alt'   => 'Museo Digitale Palazzo Serra di Cassano',
			'href'  => $immensive_shero_href( 'museo-digitale-palazzo-serra-di-cassano' ),
		),
		array(
			'title' => 'Oceania',
			'tags'  => array( 'Esperienza VR/ Tablet Gamificata', 'Supporto medico pediatrico' ),
			'img'   => $immensive_img . 'portfolio/shero/shero-oceania.webp',
			'alt'   => 'Oceania — ambiente sottomarino esplorabile in realtà virtuale',
			'href'  => $immensive_shero_href( 'medipass' ),
		),
		array(
			'title' => 'POY',
			'tags'  => array( 'App-Gioco VR/AR', 'Turismo Culturale Slow' ),
			'img'   => $immensive_img . 'portfolio/shero/shero-poy.webp',
			'alt'   => 'POY — Points of You, narrazione territoriale in realtà aumentata',
			'href'  => $immensive_shero_href( 'points-of-you' ),
		),
		array(
			'title' => 'Veins Catheter Simulator',
			'tags'  => array( 'Software Desktop' ),
			'img'   => $immensive_img . 'portfolio/shero/shero-veins-catheter.webp',
			'alt'   => 'Veins Catheter Simulator — simulazione desktop di cateterismo venoso',
			'href'  => $immensive_shero_href( 'veins-catheter-simulator' ),
		),
	);

	$immensive_shero_total = count( $immensive_shero_slides );
	?>

	<section class="ih-shero" id="ih-hero" data-dir="next" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Progetti in evidenza', 'immensive' ); ?>">

		<div class="ih-shero__stage">
			<?php foreach ( $immensive_shero_slides as $immensive_i => $immensive_slide ) : ?>
				<div class="ih-shero__slide<?php echo 0 === $immensive_i ? ' is-current' : ''; ?>" data-index="<?php echo (int) $immensive_i; ?>" aria-hidden="<?php echo 0 === $immensive_i ? 'false' : 'true'; ?>">
					<span class="ih-shero__half ih-shero__half--sx">
						<img src="<?php echo esc_url( $immensive_slide['img'] ); ?>" alt="<?php echo esc_attr( $immensive_slide['alt'] ); ?>"<?php echo $immensive_i < 2 ? ( 0 === $immensive_i ? ' fetchpriority="high"' : '' ) : ' loading="lazy"'; ?> decoding="async">
					</span>
					<span class="ih-shero__half ih-shero__half--dx">
						<img src="<?php echo esc_url( $immensive_slide['img'] ); ?>" alt=""<?php echo $immensive_i < 2 ? ( 0 === $immensive_i ? ' fetchpriority="high"' : '' ) : ' loading="lazy"'; ?> decoding="async">
					</span>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="ih-shero__scrim" aria-hidden="true"></div>

		<div class="ih-shero__copies">
			<?php foreach ( $immensive_shero_slides as $immensive_i => $immensive_slide ) : ?>
				<div class="ih-shero__copy<?php echo 0 === $immensive_i ? ' is-current' : ''; ?>" data-index="<?php echo (int) $immensive_i; ?>">
					<?php if ( ! empty( $immensive_slide['tags'] ) ) : ?>
						<div class="ih-shero__tags">
							<?php foreach ( $immensive_slide['tags'] as $immensive_tag ) : ?>
								<span class="ih-shero__tag"><?php echo esc_html( $immensive_tag ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( 0 === $immensive_i ) : ?>
						<h1 class="ih-shero__title"><?php echo esc_html( $immensive_slide['title'] ); ?></h1>
					<?php else : ?>
						<p class="ih-shero__title"><?php echo esc_html( $immensive_slide['title'] ); ?></p>
					<?php endif; ?>

					<div class="ih-shero__actions">
						<a class="ih-shero__btn" href="<?php echo esc_url( $immensive_slide['href'] ); ?>"><?php esc_html_e( 'Scopri il progetto', 'immensive' ); ?></a>
						<a class="ih-shero__link" href="<?php echo esc_url( $immensive_shero_all_href ); ?>"><?php esc_html_e( 'Tutti i progetti', 'immensive' ); ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="ih-shero__counter" aria-hidden="true">
			<span class="ih-shero__count-cur">01</span>
			<span class="ih-shero__count-sep">/</span>
			<span class="ih-shero__count-total"><?php echo esc_html( str_pad( (string) $immensive_shero_total, 2, '0', STR_PAD_LEFT ) ); ?></span>
		</div>

		<button class="ih-shero__nav ih-shero__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Progetto precedente', 'immensive' ); ?>">
			<svg viewBox="0 0 74 30" fill="none" aria-hidden="true"><path d="M73 15H2m0 0 13-13M2 15l13 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>
		<button class="ih-shero__nav ih-shero__nav--next" type="button" aria-label="<?php esc_attr_e( 'Progetto successivo', 'immensive' ); ?>">
			<svg viewBox="0 0 74 30" fill="none" aria-hidden="true"><path d="M1 15h71m0 0L59 2m13 13-13 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
		</button>

	</section>

	<div class="ih-flow" id="ih-servizi">

	<?php
	/*
	 * Intro under the hero (Figma nodes 327:244 / 408:354 / 2618:1357).
	 * Oversized white Bebas heading sitting almost flush with the light grey
	 * background — a deliberate ghost/watermark treatment, so the dark
	 * paragraph below it carries the actual message. The "i" badge is pinned
	 * to the gap between the two heading lines (dead centre of a two-line
	 * block) and is the same mark used on the home page's split hero seam.
	 */
	?>
	<section class="ih-xrintro" id="ih-xrintro">
		<div class="ih-container">
			<div class="ih-xrintro__head">
				<h2 class="ih-xrintro__title">Soluzioni XR<br>per la tua azienda</h2>
				<span class="ih-xrintro__badge" aria-hidden="true"></span>
			</div>

			<p class="ih-xrintro__sub ih-reveal"><?php esc_html_e( 'Immensive offre una vasta gamma di servizi su misura in grado di soddisfare le specifiche esigenze dei propri clienti.', 'immensive' ); ?></p>
		</div>
	</section>

	<?php
	/*
	 * "Due mondi, una missione" (Figma node 2618:1365 + the two cards
	 * 2618:1353 / 2618:1364).
	 *
	 * Reuses the Prodotti page's pinned scroll-through deck wholesale:
	 * .ih-showcase__grid + sticky .ih-acc cards, driven by the showcase
	 * block in homepage.js. That block is bound to #ih-showcase /
	 * #ih-showcase-stack, so those ids are intentional here — the two
	 * sections live on different templates and never collide. Only the skin
	 * is overridden, via .ih-showcase--mission / .ih-acc--mission.
	 *
	 * Two cards only, matching the Figma.
	 */
	$immensive_mission_cards = array(
		array(
			'label' => 'Soluzioni culturali creative',
			'desc'  => 'Diamo nuova vita al patrimonio culturale attraverso percorsi interattivi multi-dispositivo, applicazioni in realtà virtuale e aumentata e ricostruzioni digitali, per rendere arte, storia e territorio accessibili ed esplorabili in modi nuovi.',
			'img'   => 'servizi/mission-beni-culturali.webp',
			'href'  => home_url( '/soluzioni-culturali-creative/' ),
		),
		array(
			'label' => 'Ricerca e innovazione',
			'desc'  => "Sviluppiamo progetti di ricerca in collaborazione con aziende, enti ed università — spesso nell'ambito di bandi regionali, nazionali ed europei — dalla diagnostica medica alla manutenzione assistita di apparati complessi, fino all'AEC con simulazioni ingegneristiche e visualizzazioni architettoniche avanzate. Realizziamo inoltre soluzioni digitali custom per la configurazione di spazi e prodotti, su misura per le esigenze di ogni azienda. Dall'idea al prototipo funzionante, con tecnologie immersive e intelligenza artificiale.",
			'img'   => 'servizi/mission-ricerca.webp',
			// This card covers both the Ricerca and Innovazione pages — no
			// single page holds both, so it points at Ricerca as the primary
			// of the two (matches the "Ricerca e Innovazione" nav parent's
			// first child).
			'href'  => home_url( '/ricerca/' ),
		),
	);
	?>
	<section class="ih-showcase ih-showcase--mission" id="ih-showcase">
		<div class="ih-showcase__sticky">
			<div class="ih-container ih-showcase__grid">
				<div class="ih-showcase__intro-col ih-reveal">
					<h2 class="ih-heading">Due mondi<br>una missione</h2>
					<p class="ih-showcase__intro"><?php esc_html_e( "Da oltre 10 anni, Immensive realizza progetti di ricerca, sviluppo e innovazione nell'ambito dei beni culturali e delle tecnologie applicate alla scienza, con un approccio orientato alla ricerca costante e all'innovazione tecnologica. Immensive segue tutte le fasi del progetto: dall'analisi delle esigenze e la valutazione di fattibilità, allo sviluppo, fino alla realizzazione di prototipi funzionanti e soluzioni pronte per l'uso reale. Tra i risultati di Immensive rientra SMAV – Supporto alla Manutenzione Aumentata e Virtuale, progetto cofinanziato dall'Unione Europea, dallo Stato Italiano e dalla Regione Campania nell'ambito del POR Campania FESR 2014-2020.", 'immensive' ); ?></p>
				</div>

				<div class="ih-showcase__stack" id="ih-showcase-stack">
					<?php foreach ( $immensive_mission_cards as $immensive_card ) : ?>
						<a class="ih-acc ih-acc--mission" href="<?php echo esc_url( $immensive_card['href'] ); ?>" style="--acc-img:url('<?php echo esc_url( $immensive_img . $immensive_card['img'] ); ?>')">
							<span class="ih-mcard__label"><?php echo esc_html( $immensive_card['label'] ); ?></span>
							<p class="ih-mcard__desc"><?php echo esc_html( $immensive_card['desc'] ); ?></p>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-realities" id="ih-realities">
		<div class="ih-realities__sticky">
			<h2 class="ih-realities__heading">GLI STRUMENTI DIETRO<br>L'INNOVAZIONE</h2>
		</div>

		<div class="ih-container ih-realities__cards">
			<div class="ih-esplora-grid">
				<div class="ih-esplora-col">
					<article class="ih-esplora-card ih-esplora-card--tall ih-reveal" id="ih-servizi-xr">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri_servizi_xr.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">Servizi XR</span>
						<span class="ih-esplora-card__num">01</span>
						<div class="ih-esplora-card__subs">
							<div class="ih-esplora-card__sub">
								<h4>Realtà Virtuale</h4>
								<p>Ambienti totalmente ricostruiti al computer con immersione multisensoriale. Ideale per formazione e simulazione di processi con interazione umana.</p>
							</div>
							<div class="ih-esplora-card__sub">
								<h4>Realtà Aumentata</h4>
								<p>Contenuti virtuali sovrapposti al mondo reale tramite smartphone o device indossabili. Perfetta per musei, entertainment, ristorazione e marketing.</p>
							</div>
							<div class="ih-esplora-card__sub ih-esplora-card__sub--wide">
								<h4>Realtà Mista</h4>
								<p>Fusione di AR e VR: oggetti virtuali ancorati alla realtà fisica per un'interazione dinamica. Ideale per industria, assistenza remota e manutenzione.</p>
							</div>
						</div>
					</article>

					<article class="ih-esplora-card ih-reveal" id="ih-sviluppo-web">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri-servizi_sviluppo_web.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">Sviluppo Web</span>
						<span class="ih-esplora-card__num">04</span>
						<p class="ih-esplora-card__desc">Piattaforme web e portali gestionali: dashboard di monitoraggio, configuratori online, automazione di processi e collegamento con i sistemi del cliente.</p>
					</article>

					<article class="ih-esplora-card ih-reveal" id="ih-prototipazione">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri-servizi_prototipazione.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">Prototipazione</span>
						<span class="ih-esplora-card__num">05</span>
						<p class="ih-esplora-card__desc">Realizziamo prototipi industriali completi di meccanica, elettronica, sensoristica e PLC: dalla piccola serie per ricerca e sviluppo fino alla produzione su larga scala.</p>
					</article>
				</div>

				<div class="ih-esplora-col">
					<article class="ih-esplora-card ih-reveal" id="ih-software-desktop">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri_servizi_software_desktop.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">Software Desktop</span>
						<span class="ih-esplora-card__num">02</span>
						<p class="ih-esplora-card__desc">Visualizzazione grafica 3D e simulazione per desktop, con integrazioni su misura: sensoristica, PLC, automazioni e CRM.</p>
					</article>

					<article class="ih-esplora-card ih-reveal" id="ih-app-mobile">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri-servizi_app_mobile.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">App Mobile</span>
						<span class="ih-esplora-card__num">03</span>
						<p class="ih-esplora-card__desc">App mobile native iOS e Android: esperienze AR, configuratori prodotto, dashboard aziendali e funzioni gestionali collegate ai sistemi esistenti.</p>
					</article>

					<article class="ih-esplora-card ih-esplora-card--tall ih-reveal" id="ih-integrazione-ai">
						<img src="<?php echo esc_url( $immensive_img . 'servizi/immensive_altri_servizi_integrazioneai.webp' ); ?>" alt="" loading="lazy">
						<span class="ih-esplora-card__label">Integrazione AI</span>
						<span class="ih-esplora-card__num">06</span>
						<p class="ih-esplora-card__desc">Integriamo modelli AI nei tuoi applicativi e processi: assistenti vocali, computer vision, generazione di contenuti, analisi predittive e automazioni personalizzate.</p>
					</article>
				</div>
			</div>
		</div>
	</section>

	<?php
	/*
	 * "Selected works" (Figma node 425:569).
	 *
	 * Two-column grid of square project cards: full-bleed artwork with a dark
	 * bar across the bottom carrying the project title on the left and a small
	 * pill with its type on the right.
	 *
	 * Content is the immensive_work post type — see inc/portfolio.php. Only
	 * projects ticked "Mostra in Selected Works" appear, ordered by the
	 * Order field in Attributi pagina. The whole section is skipped when
	 * nothing is curated, so the page never shows an empty grid.
	 */
	$immensive_works = function_exists( 'immensive_get_featured_works' ) ? immensive_get_featured_works() : array();

	if ( $immensive_works ) :
		?>
	<section class="ih-works" id="ih-works">
		<div class="ih-container">
			<h2 class="ih-works__heading">Selected<br>works</h2>
			<p class="ih-works__sub"><?php esc_html_e( 'Ogni progetto è una conversazione tra idea e risultato.', 'immensive' ); ?></p>

			<div class="ih-works__grid">
				<?php
				foreach ( $immensive_works as $immensive_work ) :
					$immensive_work_tag = get_post_meta( $immensive_work->ID, IMMENSIVE_PORTFOLIO_TAG_META, true );
					?>
					<a class="ih-work ih-reveal" href="<?php echo esc_url( get_permalink( $immensive_work ) ); ?>">
						<span class="ih-work__media" aria-hidden="true">
							<?php
							if ( has_post_thumbnail( $immensive_work ) ) {
								echo get_the_post_thumbnail( $immensive_work, 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) );
							}
							?>
						</span>

						<span class="ih-work__bar">
							<span class="ih-work__title"><?php echo esc_html( get_the_title( $immensive_work ) ); ?></span>
							<?php if ( $immensive_work_tag ) : ?>
								<span class="ih-work__tag"><?php echo esc_html( $immensive_work_tag ); ?></span>
							<?php endif; ?>
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
	/*
	 * Portfolio CTA band.
	 *
	 * Wide artwork banner with a frosted panel floating on it: headline left,
	 * green pill button right. The button points at the portfolio archive
	 * registered by the immensive_work post type (/progetti/), so it stays
	 * correct if the archive slug changes.
	 *
	 * The background artwork is a theme stand-in (green light on black, same
	 * family as the design) — the banner's own render wasn't available from
	 * Figma. Swap the --band-img url below when it is.
	 */
	$immensive_band_href = get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );
	?>
	<section class="ih-band" aria-labelledby="ih-band-title">
		<div class="ih-container">
			<div class="ih-band__art ih-reveal" style="--band-img:url('<?php echo esc_url( $immensive_img . 'banner-altri-progetti.webp' ); ?>')">
				<div class="ih-band__panel">
					<p class="ih-band__title" id="ih-band-title"><?php esc_html_e( 'Scopri i nostri ultimi lavori', 'immensive' ); ?></p>

					<?php if ( $immensive_band_href ) : ?>
						<a class="ih-band__btn" href="<?php echo esc_url( $immensive_band_href ); ?>"><?php esc_html_e( 'Guarda il portfolio', 'immensive' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/contact-cta',
		null,
		array(
			'eyebrow' => __( 'Hai un progetto in mente ?', 'immensive' ),
			'heading' => 'INIZIAMO',
			'label'   => __( 'Contattaci', 'immensive' ),
			'href'    => 'mailto:info@immensive.it',
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
