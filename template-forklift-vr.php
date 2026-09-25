<?php
/**
 * Template Name: Immensive – Forklift VR
 *
 * Single-product page, structured the same way as template-weld-vr.php
 * (same section classes/markup, single-accent color trick — see the
 * body.page-template-template-forklift-vr rule in homepage.css).
 *
 * Content is adapted from https://www.immensive.it/forklift-vr/. That page
 * has no Confronta i Modelli comparison table and no Soluzioni di Acquisto
 * pricing — those sections are dropped here rather than filled with invented
 * copy (same call as Firefighter VR). Requisiti/Opzioni Disponibili cards
 * were added afterwards, reusing Weld VR's workstation/HTC Vive hardware
 * requirements plus a driving-sim-specific dual-monitor requisito.
 *
 * Its "Dotazione" equivalent has THREE tiers (Lite / Pro / Pro VR), not two,
 * so .ih-pdota__switch is used here with 3 options — see the
 * --pdota-opts custom property on the switch below and the matching generic
 * width/transform math in homepage.css / homepage.js (Weld/Firefighter's
 * 2-option switches need no change, they just don't set the property).
 * Each tier's content is a checklist built from the source page's FAQ (its
 * real per-tier detail lives in separate Elementor library templates the
 * page's own content feed doesn't expose), same approach as Firefighter's
 * Versione Vive/Meta.
 *
 * No hero-photo exists on the source page either (a plain product cutout,
 * not a moody banner shot), so the hero uses a color gradient instead of a
 * pinned photo, same departure as Firefighter VR for the same reason.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-pprod-hero" id="ih-hero" style="background-image: url( '<?php echo esc_url( $immensive_img . 'forklift-vr-hero-cover.webp' ); ?>' );">
		<div class="ih-pprod-hero__scrim" aria-hidden="true"></div>
		<div class="ih-pprod-hero__inner">
			<h1 class="ih-pprod-hero__logo">
				<img src="<?php echo esc_url( $immensive_img . 'forklift-vr-logo.webp' ); ?>" alt="Forklift VR Simulator" width="1024" height="274">
			</h1>
			<p class="ih-pprod-hero__sub"><?php esc_html_e( 'Simulatore di Guida del Carrello Elevatore in Realtà Virtuale Immersiva', 'immensive' ); ?></p>
		</div>
	</section>

	<nav class="ih-pnav" id="ih-pnav" aria-label="<?php esc_attr_e( 'Sezioni del prodotto', 'immensive' ); ?>">
		<div class="ih-container ih-pnav__inner">
			<a class="ih-pnav__brand" href="#ih-hero">
				<img src="<?php echo esc_url( $immensive_img . 'forklift-vr-logo.webp' ); ?>" alt="Forklift VR Simulator" width="1024" height="274">
			</a>

			<ul class="ih-pnav__links">
				<li><a href="#ih-sistema"><?php esc_html_e( 'Il sistema', 'immensive' ); ?></a></li>
				<li><a href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a></li>
				<li><a href="#ih-benefici"><?php esc_html_e( 'Benefici', 'immensive' ); ?></a></li>
				<li><a href="#ih-caratteristiche"><?php esc_html_e( 'Caratteristiche', 'immensive' ); ?></a></li>
				<li><a href="#ih-dotazione"><?php esc_html_e( 'Dotazione', 'immensive' ); ?></a></li>
			</ul>

			<a class="ih-btn ih-btn--ghost ih-pnav__cta" href="#ih-contact"><?php esc_html_e( 'Contattaci', 'immensive' ); ?></a>
		</div>
	</nav>

	<div class="ih-flow">

	<section class="ih-psys" id="ih-sistema">
		<div class="ih-psys__grid">
			<div class="ih-psys__text ih-reveal">
				<h2 class="ih-psys__title">FORKLIFT VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Forklift VR Simulator rappresenta un innovativo strumento di formazione che consente di effettuare simulazioni di guida del carrello elevatore mediante l\'utilizzo di visore di realtà virtuale o monitor, riproducendo in maniera realistica diverse esercitazioni di guida da gestire.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'forklift-vr-kit.webp' ); ?>" alt="Postazione Forklift VR Simulator" loading="lazy" width="1024" height="575">
			</div>
		</div>
	</section>

	<section class="ih-pteach" style="background-image: linear-gradient(160deg, #1a1a1a 0%, #6b5808 60%, #4d3f05 100%);">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<p class="ih-pteach__eyebrow">Forklift VR Simulator</p>
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Innova il tuo modo di formare gli addetti alla guida di carrelli elevatori', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Introduci il sistema Forklift VR Simulator nei tuoi corsi di formazione ed offri ai partecipanti un\'esperienza coinvolgente, efficace e sicura.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfunziona" id="ih-come-funziona">
		<div class="ih-pfunziona__sticky">
			<div class="ih-pfunziona__head">
				<h2 class="ih-pfunziona__heading"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></h2>
				<p class="ih-pfunziona__desc"><?php esc_html_e( 'Grazie al volante, alla pedaliera e alle leve, l\'utente può esercitarsi all\'interno di un ambiente virtuale maneggiando una strumentazione reale. Il simulatore Forklift VR ricrea in maniera estremamente fedele l\'attività di guida del carrello elevatore, monitorando con precisione le azioni e le manovre eseguite dall\'utente, elaborando a fine esercizio un report valutativo della performance.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-pfunziona__media-wrap">
			<div class="ih-pfunziona__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'forklift-vr-kit.webp' ); ?>" alt="Postazione Forklift VR Simulator" loading="lazy" width="1024" height="575">
			</div>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-benefici">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Perché fare formazione con Forklift VR Simulator', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'I principali benefici per gli Enti di Formazione che scelgono di erogare corsi di formazione integrando il sistema Forklift VR Simulator sono:', 'immensive' ); ?></p>

			<?php
			$immensive_benefici = array(
				array(
					'tone'  => 'dark',
					'icon'  => 'forklift-vr-icon-sicuro.webp',
					'title' => 'Sicuro ed ecosostenibile',
					'desc'  => 'Nessun rischio per l\'utente che svolge l\'esercizio e per le persone che lo circondano. Zero emissioni di CO2.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'forklift-vr-icon-coinvolgimento.webp',
					'title' => 'Maggiore coinvolgimento',
					'desc'  => 'Crea maggiore coinvolgimento nei partecipanti al corso, aumentando il grado di apprendimento.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'forklift-vr-icon-simulazione.webp',
					'title' => 'Simulazione di ambienti e situazioni particolari',
					'desc'  => 'Simulazione di ambienti e condizioni particolari, difficilmente riproducibili durante le classiche esercitazioni reali.',
				),
				array(
					'tone'  => 'dark',
					'icon'  => 'forklift-vr-icon-grado.webp',
					'title' => 'Maggiore grado di esercitazione',
					'desc'  => 'Elimina i tempi di setup tra gli esercizi, massimizzando il tempo a disposizione che ogni utente può dedicare ai task. Permette di svolgere l\'esercitazione in spazi ridotti (2 mq).',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'forklift-vr-icon-gap.webp',
					'title' => 'Colma il gap tra teoria e pratica',
					'desc'  => 'Permette all\'utente di comprendere velocemente la modalità di guida e di eseguire più volte i task prima di passare all\'esercitazione reale.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'forklift-vr-icon-monitoraggio.webp',
					'title' => 'Monitoraggio dell\'apprendimento',
					'desc'  => 'Monitora le azioni di guida e i progressi di apprendimento dell\'utente. Elabora un report valutativo della performance.',
				),
			);
			?>
			<div class="ih-pbenefici__grid">
				<?php foreach ( $immensive_benefici as $immensive_ben ) : ?>
					<article class="ih-pbenefici__card ih-pbenefici__card--<?php echo esc_attr( $immensive_ben['tone'] ); ?> ih-reveal">
						<span class="ih-pbenefici__icon"><img src="<?php echo esc_url( $immensive_img . $immensive_ben['icon'] ); ?>" alt="" width="64" height="64" loading="lazy" decoding="async"></span>
						<h3 class="ih-pbenefici__title"><?php echo esc_html( $immensive_ben['title'] ); ?></h3>
						<p class="ih-pbenefici__desc"><?php echo esc_html( $immensive_ben['desc'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pgap" id="ih-gap">
		<div class="ih-container">
			<h2 class="ih-pgap__heading"><?php esc_html_e( 'Colma il gap tra la fase di teoria e di pratica', 'immensive' ); ?></h2>

			<div class="ih-pgap__steps">
				<span class="ih-pgap__line ih-pgap__line--edge" aria-hidden="true"></span>

				<div class="ih-pgap__step ih-reveal">
					<span class="ih-pgap__num" aria-hidden="true">1</span>
					<div class="ih-pgap__box">
						<span class="ih-pgap__label"><?php esc_html_e( 'Teoria', 'immensive' ); ?></span>
					</div>
				</div>

				<span class="ih-pgap__line" aria-hidden="true"></span>

				<div class="ih-pgap__step ih-reveal">
					<span class="ih-pgap__num" aria-hidden="true">2</span>
					<div class="ih-pgap__box">
						<span class="ih-pgap__logo">FORKLIFT<span class="ih-pgap__logo-vr">VR</span><br><span class="ih-pgap__logo-sub">SIMULATOR</span></span>
					</div>
				</div>

				<span class="ih-pgap__line" aria-hidden="true"></span>

				<div class="ih-pgap__step ih-reveal">
					<span class="ih-pgap__num" aria-hidden="true">3</span>
					<div class="ih-pgap__box">
						<span class="ih-pgap__label"><?php esc_html_e( 'Pratica', 'immensive' ); ?></span>
					</div>
				</div>

				<span class="ih-pgap__line ih-pgap__line--edge" aria-hidden="true"></span>
			</div>

			<p class="ih-pgap__desc"><?php esc_html_e( 'L\'introduzione del sistema Forklift VR Simulator nei corsi di formazione permette ai partecipanti di esercitarsi nella pratica di guida del carrello elevatore in modo sicuro ed efficace, potendo ripetere gli esercizi innumerevoli volte, in diversi ambienti (anche personalizzabili) e con diversi task da svolgere, finché non acquisiscono la sicurezza necessaria per passare alla prova reale.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfeat" id="ih-caratteristiche">
		<div class="ih-container">
			<h2 class="ih-pfeat__heading"><?php esc_html_e( 'Caratteristiche Principali', 'immensive' ); ?></h2>

			<?php
			$immensive_features = array(
				array(
					'icon' => 'forklift-vr-feat-guida.webp',
					'desc' => 'Guida libera e movimentazione carichi.',
				),
				array(
					'icon' => 'forklift-vr-feat-teaching.webp',
					'desc' => 'Teaching dei comandi delle fasi di avvio e di arresto di un carrello elevatore.',
				),
				array(
					'icon' => 'forklift-vr-feat-esercizi.webp',
					'desc' => '11 esercizi per simulare i principali casi reali di guida.',
				),
				array(
					'icon' => 'forklift-vr-feat-errori.webp',
					'desc' => 'Monitoraggio errori: carico non posto in bersaglio, brandeggio non eseguito, etc.',
				),
				array(
					'icon' => 'forklift-vr-feat-report.webp',
					'desc' => 'Report istantaneo dell\'esercizio con salvataggio dei risultati.',
				),
				array(
					'icon' => 'forklift-vr-feat-utenti.webp',
					'desc' => 'Gestione utenti per un corretto monitoraggio dei progressi dell\'aula.',
				),
			);
			?>
			<div class="ih-pfeat__grid ih-pfeat__grid--3col">
				<?php foreach ( $immensive_features as $immensive_feat ) : ?>
					<div class="ih-pfeat__item ih-reveal">
						<span class="ih-pfeat__icon"><img src="<?php echo esc_url( $immensive_img . $immensive_feat['icon'] ); ?>" alt="" width="40" height="40" loading="lazy" decoding="async"></span>
						<p class="ih-pfeat__desc"><?php echo esc_html( $immensive_feat['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pdota" id="ih-dotazione">
		<div class="ih-container">
			<h2 class="ih-pdota__heading"><?php esc_html_e( 'Scopri le tre Versioni', 'immensive' ); ?></h2>

			<div class="ih-pdota__switch" role="tablist" aria-label="<?php esc_attr_e( 'Versione del kit', 'immensive' ); ?>" style="--pdota-opts: 3;">
				<span class="ih-pdota__switch-thumb" aria-hidden="true"></span>
				<button type="button" class="ih-pdota__switch-opt is-active" data-version="provr" role="tab" aria-selected="true"><?php esc_html_e( 'Pro Plus', 'immensive' ); ?></button>
				<button type="button" class="ih-pdota__switch-opt" data-version="pro" role="tab" aria-selected="false"><?php esc_html_e( 'Pro', 'immensive' ); ?></button>
				<button type="button" class="ih-pdota__switch-opt" data-version="lite" role="tab" aria-selected="false"><?php esc_html_e( 'Lite', 'immensive' ); ?></button>
			</div>

			<?php
			// Three tiers exist on the source page (Lite / Pro / Pro VR) but
			// each one's real detail lives in a separate Elementor library
			// template the page's own content feed doesn't expose — these
			// checklists are built from what its FAQ states each tier
			// includes, same approach as Firefighter VR's version toggle.
			// No per-tier Funzionalità breakdown, per the dropped sections
			// noted at the top of this file (Requisiti/Opzioni Disponibili
			// below are separate, generic-hardware sections, not per-tier).
			// Order matches the switch above: Pro VR, Pro, Lite.
			$immensive_kit_versions = array(
				'provr' => array(
					'image' => 'forklift-vr-kit-provr.webp',
					'alt'   => 'Kit Forklift VR Simulator versione Pro Plus',
					'title' => 'Dotazione Kit Pro Plus',
					'desc'  => 'La versione Forklift Pro Plus è caratterizzata da un kart che, oltre a riprodurre la plancia comandi di un carrello elevatore in scala 1:1, viene fornito di serie con 3 monitor frontali, per garantire un\'esperienza di guida ancora più immersiva e un campo visivo ampliato, fedele a quello reale di un carrello elevatore. Il sistema è dotato di ruote che, unitamente alle dimensioni ridotte dell\'ingombro (125×75 cm), lo rendono un prodotto facilmente trasportabile: può infatti essere caricato in ascensori e facilmente introdotto all\'interno dei propri uffici.',
					'items' => array(
						'Licenza software Forklift VR',
						'Kit Pro Plus',
						'3 Monitor frontali',
					),
				),
				'pro'   => array(
					'image' => 'forklift-vr-kit-pro.webp',
					'alt'   => 'Kit Forklift VR Simulator versione Pro',
					'title' => 'Dotazione Kit Pro',
					'desc'  => 'La versione Forklift Pro è caratterizzata da un kart dotato di comandi che permettono all\'utente di simulare la guida completa del carrello elevatore. Il kart riproduce la plancia comandi di un carrello elevatore in scala 1:1, in modo da restituire una sensazione di guida reale. Il sistema è dotato di ruote che, unitamente alle dimensioni ridotte dell\'ingombro (125×75 cm), ne fanno un prodotto facilmente trasportabile: può infatti essere caricato in ascensori e facilmente introdotto all\'interno dei propri uffici.',
					'items' => array(
						'Licenza software Forklift VR',
						'Kit Pro',
					),
				),
				'lite'  => array(
					'image' => 'forklift-vr-kit.webp',
					'alt'   => 'Kit Forklift VR Simulator versione Lite',
					'title' => 'Kit Lite',
					'desc'  => 'Il sistema Lite comprende la licenza di utilizzo del software Forklift VR e il Kit Lite. Se disponi già di un PC VR Ready, puoi acquistare solo il software e il Kit Lite.',
					'items' => array(
						'Licenza software Forklift VR',
						'Kit Lite',
					),
				),
			);
			?>

			<?php foreach ( $immensive_kit_versions as $immensive_kit_key => $immensive_kit ) : ?>
				<div class="ih-pdota__panel" data-version-panel="<?php echo esc_attr( $immensive_kit_key ); ?>" <?php echo 'provr' === $immensive_kit_key ? '' : 'hidden'; ?>>

					<div class="ih-pdota__row">
						<div class="ih-pdota__media ih-reveal">
							<img src="<?php echo esc_url( $immensive_img . $immensive_kit['image'] ); ?>" alt="<?php echo esc_attr( $immensive_kit['alt'] ); ?>" loading="lazy" width="1024" height="575">
						</div>
						<div class="ih-pdota__content ih-reveal">
							<h3 class="ih-pdota__title"><?php echo esc_html( $immensive_kit['title'] ); ?></h3>
							<p class="ih-pdota__desc"><?php echo esc_html( $immensive_kit['desc'] ); ?></p>
							<div class="ih-pdota__list">
								<?php foreach ( $immensive_kit['items'] as $immensive_kit_item ) : ?>
									<div class="ih-pdota__item">
										<span class="ih-pdota__check" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
										</span>
										<span><?php echo esc_html( $immensive_kit_item ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ih-pdota" id="ih-requisiti">
		<div class="ih-container">
			<div class="ih-pdota__block ih-pdota__block--req">
				<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Requisiti', 'immensive' ); ?></h3>
				<div class="ih-pdota__cards ih-pdota__cards--req">
					<?php
					// PC workstation + dual-monitor driving-sim setup this
					// product needs, alongside the generic hardware in
					// Opzioni Disponibili below — workstation image reused
					// from Weld VR's; monitor shot is the Pro tier's own
					// (forklift-vr-requisiti-monitor.webp).
					$immensive_requisiti = array(
						array(
							'title' => 'Workstation',
							'image' => 'weld-vr-workstation.webp',
							'desc'  => 'PC VR Ready ad elevate prestazioni grafiche necessario per offrire un\'esperienza fluida e di qualità.',
							'items' => array( '1 Notebook' ),
						),
						array(
							'title' => 'Monitor da 40”',
							'image' => 'forklift-vr-opzione-monitor.webp',
							'desc'  => 'Doppio monitor da 40” con supporto flessionale per una simulazione di guida elevata e più coinvolgente.',
							'items' => array(
								'2 Monitor da 40”',
								'2 Supporti per Monitor',
							),
						),
					);
					?>
					<?php foreach ( $immensive_requisiti as $immensive_req ) : ?>
						<article class="ih-pdota__card ih-reveal">
							<div class="ih-pdota__card-media" aria-hidden="true" <?php if ( ! empty( $immensive_req['image'] ) ) : ?>style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_req['image'] ); ?>')"<?php endif; ?>></div>
							<div class="ih-pdota__card-body">
								<h4 class="ih-pdota__card-title"><?php echo esc_html( $immensive_req['title'] ); ?></h4>
								<p class="ih-pdota__card-desc"><?php echo esc_html( $immensive_req['desc'] ); ?></p>
								<div class="ih-pdota__card-list">
									<?php foreach ( $immensive_req['items'] as $immensive_req_item ) : ?>
										<div class="ih-pdota__card-item">
											<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
											<span><?php echo esc_html( $immensive_req_item ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-pdota" id="ih-opzioni">
		<div class="ih-container">
			<div class="ih-pdota__block ih-pdota__block--req">
				<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Opzioni Disponibili', 'immensive' ); ?></h3>
				<div class="ih-pdota__cards ih-pdota__cards--req">
					<?php
					// Same PC + HTC Vive hardware every Immensive simulator
					// needs — reused from Weld VR's Requisiti cards rather
					// than restated, since it's genuinely the same
					// requirement, not per-tier content.
					$immensive_opzioni = array(
						array(
							'title' => 'Kit HTC Vive Pro Room-Scale VR',
							'image' => 'vive-pro-2-full-kit-buy.webp',
							'desc'  => 'Vive Pro – Full Kit è il sistema progettato da HTC per vivere un\'esperienza di realtà virtuale professionale. Si compone di:',
							'items' => array(
								'Visore HTC Vive Pro 2',
								'2 Stazioni di Base',
								'2 Supporti per camere',
								'2 Controller HTC Vive',
							),
						),
						array(
							'title' => 'Versione Meta',
							'image' => 'metaQ2.webp',
							'desc'  => 'Kit Meta Quest 3s è il sistema standalone che offre libertà di movimento totale, senza necessità di PC o cavi, per un\'esperienza di realtà virtuale immersiva e immediata.',
							'items' => array(
								'Visore Meta Quest 3',
								'2 Controller Touch Plus',
							),
						),
					);
					?>
					<?php foreach ( $immensive_opzioni as $immensive_opz ) : ?>
						<article class="ih-pdota__card ih-reveal">
							<div class="ih-pdota__card-media" aria-hidden="true" style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_opz['image'] ); ?>')"></div>
							<div class="ih-pdota__card-body">
								<h4 class="ih-pdota__card-title"><?php echo esc_html( $immensive_opz['title'] ); ?></h4>
								<p class="ih-pdota__card-desc"><?php echo esc_html( $immensive_opz['desc'] ); ?></p>
								<div class="ih-pdota__card-list">
									<?php foreach ( $immensive_opz['items'] as $immensive_opz_item ) : ?>
										<div class="ih-pdota__card-item">
											<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
											<span><?php echo esc_html( $immensive_opz_item ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-pdett2" id="ih-dettaglio">
		<div class="ih-container">
			<h2 class="ih-pdett2__heading"><?php esc_html_e( 'Scoprilo nel Dettaglio', 'immensive' ); ?></h2>

			<?php
			$immensive_dett2 = array(
				array(
					'image'  => 'forklift-vr-detail-comandi.webp',
					'alt'    => 'Cambio, freno, volante e pedaliera del Forklift VR Simulator',
					'groups' => array(
						array(
							'title' => 'Cambio/Freno',
							'items' => array( 'Cambio marce', 'Freno di stazionamento' ),
						),
						array(
							'title' => 'Volante/Pedali',
							'items' => array( 'Volante', 'Pedaliera' ),
						),
					),
				),
				array(
					'image'  => 'forklift-vr-detail-leve.webp',
					'alt'    => 'Modulo leve del Forklift VR Simulator',
					'groups' => array(
						array(
							'title' => 'Modulo Leve',
							'items' => array(
								'Leva traslazione forche',
								'Leva brandeggio forche',
								'Leva allargamento forche',
								'Leva stringimento forche',
							),
						),
						array(
							'title' => 'Switch On/Off',
							'items' => array( 'Switch on/off con chiave' ),
						),
					),
				),
			);
			?>

			<div class="ih-pdett2__grid">
				<?php foreach ( $immensive_dett2 as $immensive_dett2_pair ) : ?>
					<figure class="ih-pdett2__img ih-reveal">
						<img src="<?php echo esc_url( $immensive_img . $immensive_dett2_pair['image'] ); ?>" alt="<?php echo esc_attr( $immensive_dett2_pair['alt'] ); ?>" loading="lazy" width="500" height="500">
					</figure>
					<div class="ih-pdett2__panel ih-reveal">
						<?php foreach ( $immensive_dett2_pair['groups'] as $immensive_dett2_group ) : ?>
							<div>
								<h4 class="ih-pdett2__group-title"><?php echo esc_html( $immensive_dett2_group['title'] ); ?></h4>
								<div class="ih-pdota__card-list">
									<?php foreach ( $immensive_dett2_group['items'] as $immensive_dett2_item ) : ?>
										<div class="ih-pdota__card-item">
											<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
											<span><?php echo esc_html( $immensive_dett2_item ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-casi" id="ih-casi">
		<div class="ih-container">
			<h2 class="ih-casi__heading"><?php esc_html_e( 'Casi', 'immensive' ); ?><br><?php esc_html_e( 'Reali', 'immensive' ); ?></h2>
		</div>

		<?php
		$immensive_casi = array(
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-01.webp', 'alt' => 'Partecipante al Safety Day Frascarelli con Forklift VR Simulator' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-02.webp', 'alt' => 'Gruppo di partecipanti al Safety Day Frascarelli con Forklift VR Simulator' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-03.webp', 'alt' => 'Prova alla guida del Forklift VR Simulator al Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-04.webp', 'alt' => 'Postazione Forklift VR Simulator allestita al Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-05.webp', 'alt' => 'Allievo con visore HTC Vive durante il Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-06.webp', 'alt' => 'Dimostrazione del Forklift VR Simulator al Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-07.webp', 'alt' => 'Partecipanti in coda per provare il Forklift VR Simulator al Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-safety-day-frascarelli-08.webp', 'alt' => 'Formatore assiste un allievo sul Forklift VR Simulator al Safety Day Frascarelli' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-installazioni-01.webp', 'alt' => 'Installazione del Forklift VR Simulator presso il cliente' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-installazioni-02.webp', 'alt' => 'Postazione Forklift VR Simulator installata e pronta all\'uso' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-installazioni-03.webp', 'alt' => 'Dettaglio dell\'installazione del Forklift VR Simulator' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-caaem-01.webp', 'alt' => 'Sessione di formazione con Forklift VR Simulator presso Caaem' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-caaem-02.webp', 'alt' => 'Allievo alla guida del Forklift VR Simulator durante la lezione Caaem' ),
			array( 'file' => 'casi-reali/forklift-vr/forklift-vr-caso-caaem-03.webp', 'alt' => 'Postazione Forklift VR Simulator allestita per la lezione Caaem' ),
		);
		?>
		<div class="ih-casi__viewport" id="ih-casi-viewport">
			<ul class="ih-casi__track">
				<?php foreach ( $immensive_casi as $immensive_caso ) : ?>
					<li class="ih-casi__card">
						<img src="<?php echo esc_url( $immensive_img . $immensive_caso['file'] ); ?>" alt="<?php echo esc_attr( $immensive_caso['alt'] ); ?>" loading="lazy">
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="ih-casi__controls">
			<button type="button" class="ih-casi__nav" data-dir="-1" aria-label="<?php esc_attr_e( 'Caso precedente', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
			<div class="ih-casi__progress"><span class="ih-casi__progress-bar" id="ih-casi-bar"></span></div>
			<button type="button" class="ih-casi__nav" data-dir="1" aria-label="<?php esc_attr_e( 'Caso successivo', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
		</div>
	</section>

	<section class="ih-pdual" id="ih-contact">
		<div class="ih-container ih-pdual__inner">
			<div class="ih-pdual__col ih-reveal">
				<p class="ih-pdual__label"><?php esc_html_e( 'Voglio una demo', 'immensive' ); ?></p>
				<button type="button" class="ih-btn ih-btn--cyan" data-demo-modal-open><?php esc_html_e( 'Richiedi Demo', 'immensive' ); ?></button>
			</div>
			<div class="ih-pdual__col ih-reveal">
				<p class="ih-pdual__label"><?php esc_html_e( "I'm a reseller in EU", 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--ghost" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Get More Info', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Forklift VR Simulator' ) ); ?>

</div>

<?php
get_footer();
