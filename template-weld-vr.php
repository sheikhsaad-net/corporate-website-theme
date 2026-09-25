<?php
/**
 * Template Name: Immensive – Weld VR
 *
 * Single-product page. Uses the shared "ih" header/footer. The hero's
 * background image is pinned (background-attachment: fixed) so the kit photo
 * stays put while the title/subtitle scroll over it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-pprod-hero" id="ih-hero" style="background-image: url( '<?php echo esc_url( $immensive_img . 'hero-weld-kit.webp' ); ?>' );">
		<div class="ih-pprod-hero__scrim" aria-hidden="true"></div>
		<div class="ih-pprod-hero__inner">
			<h1 class="ih-pprod-hero__logo">
				<img src="<?php echo esc_url( $immensive_img . 'product-weld-vr.webp' ); ?>" alt="Weld VR Simulator" width="700" height="284">
			</h1>
			<p class="ih-pprod-hero__sub"><?php esc_html_e( 'Simulatore di Saldatura in Realtà Virtuale Immersiva', 'immensive' ); ?></p>
		</div>
	</section>

	<nav class="ih-pnav" id="ih-pnav" aria-label="<?php esc_attr_e( 'Sezioni del prodotto', 'immensive' ); ?>">
		<div class="ih-container ih-pnav__inner">
			<a class="ih-pnav__brand" href="#ih-hero">
				<img src="<?php echo esc_url( $immensive_img . 'product-weld-vr.webp' ); ?>" alt="Weld VR Simulator" width="700" height="284">
			</a>

			<ul class="ih-pnav__links">
				<li><a href="#ih-sistema"><?php esc_html_e( 'Il sistema', 'immensive' ); ?></a></li>
				<li><a href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a></li>
				<li><a href="#ih-benefici"><?php esc_html_e( 'Benefici', 'immensive' ); ?></a></li>
				<li><a href="#ih-caratteristiche"><?php esc_html_e( 'Caratteristiche', 'immensive' ); ?></a></li>
				<li><a href="#ih-dotazione"><?php esc_html_e( 'Dotazione', 'immensive' ); ?></a></li>
				<li><a href="#ih-installazioni"><?php esc_html_e( 'Installazioni', 'immensive' ); ?></a></li>
			</ul>

			<a class="ih-btn ih-btn--ghost ih-pnav__cta" href="#ih-contact"><?php esc_html_e( 'Contattaci', 'immensive' ); ?></a>
		</div>
	</nav>

	<div class="ih-flow">

	<section class="ih-psys" id="ih-sistema">
		<div class="ih-psys__grid">
			<div class="ih-psys__text ih-reveal">
				<h2 class="ih-psys__title">WELD VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Weld VR Simulator rappresenta un innovativo strumento di formazione che consente di effettuare pratiche di saldatura realistiche in Realtà Virtuale Immersiva, riproducendo i tre processi di saldatura più diffusi (Smaw, Mig, Tig).', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . '18-giu-2026-10_33_381.webp' ); ?>" alt="Postazione Weld VR Simulator" loading="lazy" width="1337" height="753">
			</div>
		</div>
	</section>

	<section class="ih-pteach" style="background-image: url( '<?php echo esc_url( $immensive_img . 'hero-weld-kit.webp' ); ?>' );">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<p class="ih-pteach__eyebrow">Weld VR Simulator</p>
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Innova il tuo modo di insegnare le pratiche di saldatura', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Introduci il sistema Weld VR Simulator nei tuoi corsi di formazione ed offri ai tuoi studenti un\'esperienza efficace, coinvolgente e sicura.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfunziona" id="ih-come-funziona">
		<div class="ih-pfunziona__sticky">
			<div class="ih-pfunziona__head">
				<h2 class="ih-pfunziona__heading"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></h2>
				<p class="ih-pfunziona__desc"><?php esc_html_e( 'Durante gli esercizi, il sistema Weld-VR rileva con estrema precisione il movimento dell\'utente e monitora la sua destrezza manuale durante le varie posizioni di saldatura.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-pfunziona__media-wrap">
			<div class="ih-pfunziona__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'hero-weld-kit.webp' ); ?>" alt="Kit Weld VR Simulator" loading="lazy" width="1672" height="941">
			</div>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-benefici">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Perché fare formazione con Weld VR Simulator', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'I principali benefici per le Aziende, le Scuole, gli Enti formativi e le APL che scelgono di erogare percorsi formativi integrando il sistema Weld VR Simulator sono:', 'immensive' ); ?></p>

			<?php
			$immensive_benefici = array(
				array(
					'tone'  => 'dark',
					'icon'  => 'icons/icon-eco-cyan.webp',
					'title' => 'Zero rischi, zero impatto',
					'desc'  => 'Nessun rischio di infortunio per l\'alunno e zero emissioni di carbonio e gas e zero rifiuti metallici.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'icons/icon-costi-cyan.webp',
					'title' => 'Risparmio immediato e misurabile',
					'desc'  => 'Elimina tutti i costi dei materiali necessari per le esercitazioni e massimizza il tempo dedicato agli esercizi.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'icons/icon-efficace-cyan.webp',
					'title' => 'Veloce, mirato, efficace',
					'desc'  => 'Monitoraggio costante dei progressi di apprendimento; massimo tempo in arco per ogni allievo.',
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

			<div class="ih-pbenefici__actions">
				<a class="ih-btn ih-btn--cyan ih-pbenefici__btn" href="https://www.immensive.it/brochure/weldvr/brochure_weld.pdf" target="_blank" rel="noopener"><?php esc_html_e( 'Scarica la Brochure', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--ghost-dark ih-pbenefici__btn" href="https://www.immensive.it/brochure/weldvr/#page/1" target="_blank" rel="noopener"><?php esc_html_e( 'Sfoglia la Brochure', 'immensive' ); ?></a>
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
						<span class="ih-pgap__logo">WELD<span class="ih-pgap__logo-vr">VR</span><br><span class="ih-pgap__logo-sub">SIMULATOR</span></span>
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

			<p class="ih-pgap__desc"><?php esc_html_e( 'L\'introduzione del sistema Weld VR Simulator all\'interno di un corso di saldatura permette di colmare il naturale gap esistente tra la fase di teoria e la pratica di laboratorio.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfeat" id="ih-caratteristiche">
		<div class="ih-container">
			<h2 class="ih-pfeat__heading"><?php esc_html_e( 'Caratteristiche Principali', 'immensive' ); ?></h2>

			<?php
			$immensive_features = array(
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 12.5V5a1.5 1.5 0 0 1 3 0v6M11 11V3.5a1.5 1.5 0 0 1 3 0V11M14 11.5V5a1.5 1.5 0 0 1 3 0v8M17 9.5a1.5 1.5 0 0 1 3 0V15c0 3.9-3.1 7-7 7h-1c-2.2 0-3.8-.7-5-2l-3.5-4a1.4 1.4 0 0 1 2-2L8 12" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'desc' => 'Selezione della mano con la quale l\'allievo svolgerà la saldatura.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 21l3.5-3.5M9 15l7-7M13 3l1.5 1.5L18 1l2 2-3.5 3.5L18 8l-6 6-4-4 6-6-1.5-1.5L13 3Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'desc' => '3 tipi di saldatura: Smaw, Mig/Mag, Tig.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 15a8 8 0 1 1 16 0" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><path d="M12 15l4.5-4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => '2 Gradi di difficoltà. Adatto a principianti ed esperti.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 16 16 4l4 4L8 20l-4-4Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M13 7l4 4M10 10l4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => '34 tipi di giunti per simulare i principali casi reali di saldatura.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v18M8 6l4-3 4 3M8 18l4 3 4-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'desc' => 'Altezza regolabile del piano di lavoro per saldature eseguite in piedi o seduto.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="2.5" y="4.5" width="15" height="10" rx="1.5" stroke="currentColor" stroke-width="1.4"/><path d="M5 9.5l2-2 2 2 3-3.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="18.5" cy="16.5" r="4" stroke="currentColor" stroke-width="1.4"/><path d="M17 16.5h1v1.2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'desc' => 'Monitoraggio e analisi del processo di saldatura.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 20V10M9 20V4M14 20v-7M19 20V8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => 'Report istantaneo dell\'esercizio con salvataggio dei risultati.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="8.5" cy="8" r="2.8" stroke="currentColor" stroke-width="1.4"/><circle cx="16" cy="9" r="2.2" stroke="currentColor" stroke-width="1.4"/><path d="M3 19c0-3 2.5-5 5.5-5s5.5 2 5.5 5M14.5 14.5c2.5.2 4.5 2 4.5 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => 'Gestione utenti per un corretto monitoraggio dei progressi dell\'aula.',
				),
			);
			?>
			<div class="ih-pfeat__grid">
				<?php foreach ( $immensive_features as $immensive_feat ) : ?>
					<div class="ih-pfeat__item ih-reveal">
						<span class="ih-pfeat__icon"><?php echo $immensive_feat['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG, not user input. ?></span>
						<p class="ih-pfeat__desc"><?php echo esc_html( $immensive_feat['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pdota" id="ih-dotazione">
		<div class="ih-container">
			<h2 class="ih-pdota__heading"><?php esc_html_e( 'Scopri le Versioni', 'immensive' ); ?></h2>

			<div class="ih-pdota__switch" role="tablist" aria-label="<?php esc_attr_e( 'Versione del kit', 'immensive' ); ?>">
				<span class="ih-pdota__switch-thumb" aria-hidden="true"></span>
				<button type="button" class="ih-pdota__switch-opt is-active" data-version="pro" role="tab" aria-selected="true"><?php esc_html_e( 'Pro', 'immensive' ); ?></button>
				<button type="button" class="ih-pdota__switch-opt" data-version="lite" role="tab" aria-selected="false"><?php esc_html_e( 'Lite', 'immensive' ); ?></button>
			</div>

			<?php
			// Placeholder copy/images throughout this array — swap in the
			// real kit photos, requisiti/opzioni product shots and finalized
			// copy once available. Requisiti/opzioni cards use the site's
			// existing "no shot yet" gradient placeholder in the meantime.
			$immensive_kit_versions = array(
				'pro'  => array(
					'image'      => 'weld-vr-kit-pro.webp',
					'alt'        => 'Dotazione Kit Pro Weld VR Simulator',
					'title'      => 'Dotazione Kit Pro',
					'desc'       => 'Il kit in dotazione include lo stand con i giunti reali e torce azionabili a comando, come nella realtà. La pinza porta elettrodo ritrae l\'elettrodo in automatico garantendo un feedback estremamente realistico in fase di innesco. Lo stand si adatta a ogni tipo di supporto ed è facile da calibrare, trasformando qualsiasi scrivania in un banco di saldatura completo.',
					'items'      => array(
						'Stand supporto per tutte le posizioni come da norma UNI EN ISO 9606-1',
						'Torcia TIG con tasto di innesco',
						'Giunti fisici per tutte le tipologie disponibili nel software',
						'Torcia MIG con tasto di innesco',
						'Pinza Portaelettrodo con simulazione consumo',
					),
					'func_desc'  => 'La versione Weld VR Pro offre l\'esperienza di saldatura completa e senza limitazioni. È possibile saldare un giunto in tutte le posizioni previste dalla norma UNI EN ISO 9606-1, scegliendo liberamente materiale, elettrodo e spessore del giunto da saldare, con parametri macchina completamente configurabili.',
					'func_specs' => array(
						'Tipologie di Materiale: Acciaio al Carbonio, Acciaio Inox, Alluminio',
						'Tipologie di Elettrodo: E6013, E7018, E308L',
						'SMAW: Controllo Amperaggio',
						'MIG/MAG: Controllo Tensione, Velocità Filo, Flusso Gas',
						'TIG: Controllo Amperaggio, Flusso Gas, Materiale d\'apporto',
					),
					'requisiti'  => array(
						array(
							'title' => 'Workstation',
							'image' => 'weld-vr-workstation.webp',
							'desc'  => 'PC VR Ready ad elevate prestazioni grafiche necessario per offrire un\'esperienza fluida e di qualità.',
							'items' => array(
								'1 Notebook',
							),
						),
						array(
							'title' => 'Kit HTC Vive Pro Room-Scale VR',
							'image' => 'weld-vr-vive-pro.webp',
							'desc'  => 'Vive Pro – Full Kit è il sistema progettato da HTC per vivere un\'esperienza di realtà virtuale professionale. Si compone di:',
							'items' => array(
								'Visore HTC Vive Pro',
								'2 Stazioni di Base',
								'2 Supporti per camere',
								'3 Tracker Vive',
							),
						),
					),
					'opzioni'    => array(
						array(
							'title' => 'Postazione Docente',
							'image' => 'weld-vr-postazione-docente.webp',
							'desc'  => 'Consente al docente di monitorare in tempo reale le operazioni di ogni postazione del laboratorio Weld VR durante le esercitazioni di saldatura.',
							'items' => array( '1 Notebook' ),
						),
						array(
							'title' => 'Trolley',
							'image' => 'weld-vr-trolley.webp',
							'desc'  => 'Comodo borsone con ruote e manico per l\'alloggiamento e trasporto del kit Weld VR.',
							'items' => array( '1 Borsone con ruote' ),
						),
						array(
							'title' => 'Carrello Portautensili',
							'image' => 'weld-vr-carrello.webp',
							'desc'  => 'Struttura in acciaio con 3 scaffali per tutti gli accessori e supporti per torce',
							'items' => array( 'Carrello con ruote' ),
						),
						array(
							'title' => 'Valigia',
							'image' => 'weld-vr-valigia.webp',
							'desc'  => 'Permette al docente di monitorare le postazioni del laboratorio Weld VR durante le esercitazioni di saldatura',
							'items' => array( '1 Notebook' ),
						),
					),
				),
				'lite' => array(
					'image'      => 'weld-vr-kit-base.webp',
					'alt'        => 'Dotazione Kit Base Weld VR Simulator',
					'title'      => 'Dotazione Kit Base',
					'desc'       => 'La versione del kit base di Weld VR Simulator include le torce realmente utilizzate nel mondo professionale dotate di supporti compatibili con sistema di tracciamento HTC Vive, soluzione che consente l\'esercitazione manuale con pesi e ingombri reali mediante l\'utilizzo di visore di realtà virtuale, riproducendo in maniera realistica le diverse tecniche di saldatura in tutta sicurezza.',
					'items'      => array(
						'1 Torcia Smaw',
						'1 Torcia Mig/Mag',
						'1 Torcia Tig',
						'1 Porta Filler',
					),
					'func_desc'  => 'La versione Weld VR Lite offre un\'esperienza di saldatura completa anche se con delle limitazioni. In particolare offre la possibilità di saldare un giunto in un\'unica posizione secondo la norma UNI EN ISO 9606-1. I parametri della macchina sono comunque controllabili e producono un effetto reale sulla qualità del cordone eseguito, mettendo a disposizione un unico materiale e un unico spessore del giunto da saldare.',
					'func_specs' => array(
						'1 Tipologia di Materiale: Acciaio al Carbonio',
						'1 Tipologia di Elettrodo: E6013',
						'SMAW: Controllo Amperaggio',
						'MIG/MAG: Controllo Tensione, Velocità Filo, Flusso Gas',
						'TIG: Controllo Amperaggio, Flusso Gas, Materiale d\'apporto',
					),
					'requisiti'  => array(
						array(
							'title' => 'Workstation',
							'image' => 'weld-vr-workstation.webp',
							'desc'  => 'PC VR Ready ad elevate prestazioni grafiche necessario per offrire un\'esperienza fluida e di qualità.',
							'items' => array(
								'1 Notebook',
							),
						),
						array(
							'title' => 'Kit HTC Vive Pro Room-Scale VR',
							'image' => 'weld-vr-vive-pro.webp',
							'desc'  => 'Vive Pro – Full Kit è il sistema progettato da HTC per vivere un\'esperienza di realtà virtuale professionale. Si compone di:',
							'items' => array(
								'Visore HTC Vive Pro',
								'2 Stazioni di Base',
								'2 Supporti per camere',
								'3 Tracker Vive',
							),
						),
					),
					'opzioni'    => array(
						array(
							'title' => 'Postazione Docente',
							'image' => 'weld-vr-postazione-docente.webp',
							'desc'  => 'Consente al docente di monitorare in tempo reale le operazioni di ogni postazione del laboratorio Weld VR durante le esercitazioni di saldatura.',
							'items' => array( '1 Notebook' ),
						),
						array(
							'title' => 'Trolley',
							'image' => 'weld-vr-trolley.webp',
							'desc'  => 'Comodo borsone con ruote e manico per l\'alloggiamento e trasporto del kit Weld VR.',
							'items' => array( '1 Borsone con ruote' ),
						),
						array(
							'title' => 'Carrello Portautensili',
							'image' => 'weld-vr-carrello.webp',
							'desc'  => 'Struttura in acciaio con 3 scaffali per tutti gli accessori e supporti per torce',
							'items' => array( 'Carrello con ruote' ),
						),
						array(
							'title' => 'Valigia',
							'image' => 'weld-vr-valigia.webp',
							'desc'  => 'Permette al docente di monitorare le postazioni del laboratorio Weld VR durante le esercitazioni di saldatura',
							'items' => array( '1 Notebook' ),
						),
					),
				),
			);
			?>

			<?php foreach ( $immensive_kit_versions as $immensive_kit_key => $immensive_kit ) : ?>
				<div class="ih-pdota__panel" data-version-panel="<?php echo esc_attr( $immensive_kit_key ); ?>" <?php echo 'pro' === $immensive_kit_key ? '' : 'hidden'; ?>>

					<div class="ih-pdota__row">
						<div class="ih-pdota__media ih-reveal">
							<img src="<?php echo esc_url( $immensive_img . $immensive_kit['image'] ); ?>" alt="<?php echo esc_attr( $immensive_kit['alt'] ); ?>" loading="lazy" width="1672" height="941">
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

					<div class="ih-pdota__func ih-reveal">
						<div class="ih-pdota__func-col">
							<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Funzionalità', 'immensive' ); ?></h3>
							<p class="ih-pdota__func-desc"><?php echo esc_html( $immensive_kit['func_desc'] ); ?></p>
						</div>
						<ul class="ih-pdota__specs">
							<?php foreach ( $immensive_kit['func_specs'] as $immensive_spec ) : ?>
								<li><?php echo esc_html( $immensive_spec ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>

					<div class="ih-pdota__block ih-pdota__block--req">
						<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Requisiti', 'immensive' ); ?></h3>
						<div class="ih-pdota__cards ih-pdota__cards--req">
							<?php foreach ( $immensive_kit['requisiti'] as $immensive_req ) : ?>
								<article class="ih-pdota__card ih-reveal">
									<div class="ih-pdota__card-media" aria-hidden="true" <?php if ( ! empty( $immensive_req['image'] ) ) : ?>style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_req['image'] ); ?>')"<?php endif; ?>></div>
									<div class="ih-pdota__card-body">
										<h4 class="ih-pdota__card-title"><?php echo esc_html( $immensive_req['title'] ); ?></h4>
										<p class="ih-pdota__card-desc"><?php echo esc_html( $immensive_req['desc'] ); ?></p>
										<?php if ( ! empty( $immensive_req['items'] ) ) : ?>
											<div class="ih-pdota__card-list">
												<?php foreach ( $immensive_req['items'] as $immensive_req_item ) : ?>
													<div class="ih-pdota__card-item">
														<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
														<span><?php echo esc_html( $immensive_req_item ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="ih-pdota__block">
						<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Opzioni Disponibili', 'immensive' ); ?></h3>
						<div class="ih-pdota__cards ih-pdota__cards--opz">
							<?php foreach ( $immensive_kit['opzioni'] as $immensive_opz ) : ?>
								<article class="ih-pdota__card ih-reveal">
									<div class="ih-pdota__card-media" aria-hidden="true" <?php if ( ! empty( $immensive_opz['image'] ) ) : ?>style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_opz['image'] ); ?>')"<?php endif; ?>></div>
									<div class="ih-pdota__card-body">
										<h4 class="ih-pdota__card-title"><?php echo esc_html( $immensive_opz['title'] ); ?></h4>
										<p class="ih-pdota__card-desc"><?php echo esc_html( $immensive_opz['desc'] ); ?></p>
										<?php if ( ! empty( $immensive_opz['items'] ) ) : ?>
											<div class="ih-pdota__card-list">
												<?php foreach ( $immensive_opz['items'] as $immensive_opz_item ) : ?>
													<div class="ih-pdota__card-item">
														<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
														<span><?php echo esc_html( $immensive_opz_item ); ?></span>
													</div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ih-pdett" id="ih-dettaglio">
		<div class="ih-container">
			<h2 class="ih-pdett__heading"><?php esc_html_e( 'Scoprilo nel Dettaglio', 'immensive' ); ?></h2>

			<?php
			$immensive_dettagli = array(
				array(
					'label' => 'Pinza portaelettrodo',
					'image' => 'weld-vr-elettrodo.webp',
					'desc'  => 'Pinza portaelettrodo con simulazione consumo',
				),
				array(
					'label' => 'Sistema rotante',
					'image' => 'weld-vr-stand.webp',
					'desc'  => 'Sistema rotante per simulazione dell’angolazione dell’elettrodo',
				),
				array(
					'label' => 'Stand supporto',
					'image' => 'weld-vr-stand.webp',
					'desc'  => 'Stand supporto per tutte le posizioni come da norma UNI EN ISO 9606-1',
				),
				array(
					'label' => 'Giunti fisici',
					'image' => 'weld-vr-giunti.webp',
					'desc'  => 'Giunti fisici per tutte le tipologie disponibili nel software',
				),
				array(
					'label' => 'Weaving patterns',
					'image' => 'weld-vr-weaving.webp',
					'desc'  => 'Weaving Patterns: guide visive alle trame di saldatura',
				),
			);
			?>

			<div class="ih-pdett__stage ih-reveal" id="ih-dett">
				<div class="ih-pdett__pills" role="tablist" aria-label="<?php esc_attr_e( 'Dettagli del prodotto', 'immensive' ); ?>">
					<?php foreach ( $immensive_dettagli as $immensive_dett_i => $immensive_dett ) : ?>
						<div class="ih-pdett__item" role="presentation">
							<button type="button" class="ih-pdett__pill<?php echo 0 === $immensive_dett_i ? ' is-active' : ''; ?>" data-dett="<?php echo esc_attr( $immensive_dett_i ); ?>" role="tab" aria-selected="<?php echo 0 === $immensive_dett_i ? 'true' : 'false'; ?>"><?php echo esc_html( $immensive_dett['label'] ); ?></button>
							<div class="ih-pdett__desc">
								<div class="ih-pdett__desc-inner">
									<p><?php echo esc_html( $immensive_dett['desc'] ); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="ih-pdett__slides">
					<?php foreach ( $immensive_dettagli as $immensive_dett_i => $immensive_dett ) : ?>
						<figure class="ih-pdett__slide<?php echo 0 === $immensive_dett_i ? ' is-active' : ''; ?>" data-dett-slide="<?php echo esc_attr( $immensive_dett_i ); ?>">
							<img src="<?php echo esc_url( $immensive_img . $immensive_dett['image'] ); ?>" alt="<?php echo esc_attr( $immensive_dett['label'] ); ?>" loading="lazy" width="1672" height="941">
						</figure>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-pcomp" id="ih-confronta">
		<div class="ih-container">
			<h2 class="ih-pcomp__heading"><?php esc_html_e( 'Confronta i Modelli', 'immensive' ); ?></h2>

			<div class="ih-pcomp__switch" id="ih-comp-switch" role="tablist" aria-label="<?php esc_attr_e( 'Categoria di confronto', 'immensive' ); ?>">
				<span class="ih-pcomp__switch-thumb" aria-hidden="true"></span>
				<button type="button" class="ih-pcomp__switch-opt is-active" data-comp="funzionalita" role="tab" aria-selected="true"><?php esc_html_e( 'Funzionalità', 'immensive' ); ?></button>
				<button type="button" class="ih-pcomp__switch-opt" data-comp="hardware" role="tab" aria-selected="false"><?php esc_html_e( 'Hardware', 'immensive' ); ?></button>
			</div>

			<?php
			// `true` renders a check badge; a string renders as the cell text.
			// Hardware rows are placeholder copy — confirm against the real
			// spec sheet before launch.
			$immensive_comp = array(
				'funzionalita' => array(
					'title' => 'Funzionalità',
					'rows'  => array(
						array( 'label' => 'Gestione utenti', 'lite' => true, 'pro' => true ),
						array( 'label' => 'Report esercizi per utente', 'lite' => true, 'pro' => true ),
						array( 'label' => 'N. esercizi', 'lite' => '34', 'pro' => '34 x Spessore x Materiale' ),
						array( 'label' => 'Posizioni', 'lite' => 'UNI EN ISO 9606-1', 'pro' => 'UNI EN ISO 9606-1' ),
						array( 'label' => 'Materiale da saldare', 'lite' => 'Acciaio al Carbonio', 'pro' => 'Acciaio al Carbonio, Alluminio, Acciaio Inox' ),
						array( 'label' => 'Spessori giunti', 'lite' => '10mm', 'pro' => '1,5mm, 3mm, 6mm, 10mm, 15mm, 20mm, 25mm' ),
						array( 'label' => 'Tipo elettrodo', 'lite' => 'E6013', 'pro' => 'E6013, E7018, E8010, E9018, E308L, E316L' ),
						array( 'label' => 'Spessore elettrodi', 'lite' => '2,4 - 3,2 - 4mm', 'pro' => '2,4 - 3,2 - 4mm' ),
						array( 'label' => 'Spessore filo continuo', 'lite' => '0,8 - 1,0 - 1,2mm', 'pro' => '0,8 - 1,0 - 1,2mm' ),
						array( 'label' => 'Parametri saldatrice', 'lite' => 'Limitati', 'pro' => 'Completi' ),
						array( 'label' => 'Grafici performance (angoli, velocità, distanza)', 'lite' => true, 'pro' => true ),
						array( 'label' => 'CTWD', 'lite' => true, 'pro' => true ),
						array( 'label' => 'Analisi saldatura', 'lite' => true, 'pro' => 'Heatmap, Penetrazione, Porosità, Splatter' ),
					),
				),
				'hardware'     => array(
					'title' => 'Hardware',
					'rows'  => array(
						array( 'label' => 'Stand supporto', 'lite' => 'Posizione fissa', 'pro' => 'Tutte le posizioni' ),
						array( 'label' => 'Sistema rotante', 'lite' => false, 'pro' => true ),
						array( 'label' => 'Giunti fisici', 'lite' => 'Tipologie base', 'pro' => 'Tutte le tipologie' ),
						array( 'label' => 'Torcia MIG con tasto di innesco', 'lite' => true, 'pro' => true ),
						array( 'label' => 'Torcia TIG con tasto di innesco', 'lite' => true, 'pro' => true ),
						array( 'label' => 'Pinza portaelettrodo', 'lite' => true, 'pro' => 'Con simulazione consumo' ),
						array( 'label' => 'Visore VR', 'lite' => 'HTC Vive Pro', 'pro' => 'HTC Vive Pro Room-Scale' ),
						array( 'label' => 'Workstation', 'lite' => 'Requisiti minimi', 'pro' => 'Requisiti consigliati' ),
						array( 'label' => 'Postazione docente', 'lite' => 'Opzionale', 'pro' => 'Opzionale' ),
						array( 'label' => 'Trolley / valigia di trasporto', 'lite' => 'Opzionale', 'pro' => 'Opzionale' ),
					),
				),
			);

			$immensive_comp_check = '<span class="ih-pcomp__check" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>';
			$immensive_comp_x     = '<span class="ih-pcomp__x" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>';
			?>

			<?php foreach ( $immensive_comp as $immensive_comp_key => $immensive_comp_tab ) : ?>
				<div class="ih-pcomp__panel" data-comp-panel="<?php echo esc_attr( $immensive_comp_key ); ?>" <?php echo 'funzionalita' === $immensive_comp_key ? '' : 'hidden'; ?>>
					<div class="ih-pcomp__scroll">
						<div class="ih-pcomp__table">

							<span class="ih-pcomp__colbg ih-pcomp__colbg--lite" aria-hidden="true"></span>
							<span class="ih-pcomp__colbg ih-pcomp__colbg--pro" aria-hidden="true"></span>

							<?php // Hover hit-areas: cursor-following glare, same trick as .ih-psol__card (see homepage.js), but per column so only the hovered card glows. ?>
							<div class="ih-pcomp__hit ih-pcomp__hit--lite">
								<span class="ih-pcomp__glare" aria-hidden="true"></span>
							</div>
							<div class="ih-pcomp__hit ih-pcomp__hit--pro">
								<span class="ih-pcomp__glare" aria-hidden="true"></span>
							</div>

							<h3 class="ih-pcomp__title"><?php echo esc_html( $immensive_comp_tab['title'] ); ?></h3>

							<div class="ih-pcomp__tabsrow">
								<span aria-hidden="true"></span>
								<span class="ih-pcomp__tab ih-pcomp__tab--lite">Weld VR <em>Lite</em></span>
								<span class="ih-pcomp__tab ih-pcomp__tab--pro">Weld VR <em>Pro</em></span>
							</div>

							<span class="ih-pcomp__glass" aria-hidden="true"></span>

							<div class="ih-pcomp__rows">
								<?php foreach ( $immensive_comp_tab['rows'] as $immensive_row ) : ?>
									<div class="ih-pcomp__row">
										<span class="ih-pcomp__row-label"><?php echo esc_html( $immensive_row['label'] ); ?></span>

										<?php foreach ( array( 'lite', 'pro' ) as $immensive_tier ) : ?>
											<span class="ih-pcomp__row-val ih-pcomp__row-val--<?php echo esc_attr( $immensive_tier ); ?>">
												<?php
												if ( true === $immensive_row[ $immensive_tier ] ) {
													echo $immensive_comp_check; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG.
												} elseif ( false === $immensive_row[ $immensive_tier ] ) {
													echo $immensive_comp_x; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG.
												} else {
													echo esc_html( $immensive_row[ $immensive_tier ] );
												}
												?>
											</span>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
							</div>

						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ih-psol" id="ih-soluzioni">
		<div class="ih-container">
			<p class="ih-psol__eyebrow"><?php esc_html_e( 'Scegli come comprare Weld VR.', 'immensive' ); ?></p>

			<h2 class="ih-psol__heading">
				<?php esc_html_e( 'Soluzioni di', 'immensive' ); ?><br>
				<span class="ih-psol__heading-line">
					<?php esc_html_e( 'Acquisto', 'immensive' ); ?>
					<span class="ih-psol__price">
						<span class="ih-psol__price-label"><?php esc_html_e( 'A partire da', 'immensive' ); ?></span>
						<span class="ih-psol__price-value">&euro;40,00<span class="ih-psol__price-unit">/mo</span></span>
					</span>
				</span>
			</h2>

			<?php
			$immensive_soluzioni = array(
				array(
					'title'    => 'Lifetime',
					'sub'      => 'Paghi una volta, usi per sempre',
					'featured' => false,
					'items'    => array(
						'Pagamento una tantum',
						'Nessun canone ricorrente',
						'Solo aggiornamenti critici',
						'Supporto base a ticket',
					),
				),
				array(
					'title'    => 'Lifetime + Manutenzione',
					'sub'      => 'Proprietà a vita con assistenza continua',
					'featured' => false,
					'items'    => array(
						'Pagamento una tantum + canone',
						'Aggiornamenti software inclusi',
						'Supporto prioritario',
						'Sostituzione kit consumabili inclusa',
					),
				),
				array(
					'title'    => 'Abbonamento Annuale',
					'sub'      => 'Il massimo servizio con flessibilità media',
					'featured' => true,
					'badge'    => 'Più scelto',
					'items'    => array(
						'Canone annuale',
						'Aggiornamenti software inclusi',
						'Supporto prioritario + onboarding',
						'Sostituzione kit consumabili inclusa',
					),
				),
				array(
					'title'    => 'Abbonamento Mensile',
					'sub'      => 'Massima flessibilità, zero vincoli',
					'featured' => false,
					'items'    => array(
						'Canone mensile',
						'Aggiornamenti software inclusi',
						'Supporto standard',
						'Sostituzione kit consumabili inclusa',
					),
				),
			);
			?>

			<div class="ih-psol__grid">
				<?php foreach ( $immensive_soluzioni as $immensive_sol ) : ?>
					<article class="ih-psol__card<?php echo $immensive_sol['featured'] ? ' is-featured' : ''; ?> ih-reveal">
						<span class="ih-psol__glare" aria-hidden="true"></span>
						<div class="ih-psol__card-head">
							<h3 class="ih-psol__card-title"><?php echo esc_html( $immensive_sol['title'] ); ?></h3>
							<?php if ( ! empty( $immensive_sol['badge'] ) ) : ?>
								<span class="ih-psol__card-badge"><?php echo esc_html( $immensive_sol['badge'] ); ?></span>
							<?php endif; ?>
						</div>
						<div class="ih-psol__card-body">
							<p class="ih-psol__card-sub"><?php echo esc_html( $immensive_sol['sub'] ); ?></p>
							<ul class="ih-psol__list">
								<?php foreach ( $immensive_sol['items'] as $immensive_sol_item ) : ?>
									<li>
										<span class="ih-psol__check" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
										</span>
										<span><?php echo esc_html( $immensive_sol_item ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="ih-psol__footer">
				<p class="ih-psol__tagline">
					<span><?php esc_html_e( 'Quattro', 'immensive' ); ?></span> <strong><?php esc_html_e( 'modelli,', 'immensive' ); ?></strong><br>
					<span><?php esc_html_e( 'un solo', 'immensive' ); ?></span> <strong><?php esc_html_e( 'prodotto.', 'immensive' ); ?></strong>
				</p>
				<a class="ih-btn ih-btn--cyan" href="#ih-confronta"><?php esc_html_e( 'Confronta i 4 Modelli', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ih-pinst" id="ih-installazioni">
		<div class="ih-container ih-pinst__inner">
			<p class="ih-pinst__text ih-reveal">
				<?php esc_html_e( 'Molti istituti scolastici superiori hanno già acquistato l\'attrezzatura', 'immensive' ); ?>
				<strong><?php esc_html_e( 'Weld VR Simulator', 'immensive' ); ?></strong>
			</p>

			<div class="ih-pinst__map ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'mappa_transparent_aggiornata1.webp' ); ?>" alt="<?php esc_attr_e( 'Mappa delle installazioni Weld VR Simulator in Italia', 'immensive' ); ?>" loading="lazy" width="904" height="771">

				<ul class="ih-pinst__legend">
					<li>
						<span class="ih-pinst__dot ih-pinst__dot--multi" aria-hidden="true"></span>
						<?php esc_html_e( 'Multi-station', 'immensive' ); ?> <strong><?php esc_html_e( 'laboratories', 'immensive' ); ?></strong>
					</li>
					<li>
						<span class="ih-pinst__dot ih-pinst__dot--single" aria-hidden="true"></span>
						<?php esc_html_e( 'Single', 'immensive' ); ?> <strong><?php esc_html_e( 'installation', 'immensive' ); ?></strong>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="ih-casi" id="ih-casi">
		<div class="ih-container">
			<h2 class="ih-casi__heading"><?php esc_html_e( 'Casi', 'immensive' ); ?><br><?php esc_html_e( 'Reali', 'immensive' ); ?></h2>
		</div>

		<?php
		// Placeholder shots — swap for the real installation photography.
		$immensive_casi = array(
			array( 'file' => 'casi-reali/weld-vr-caso-campionato-01.webp', 'alt' => 'Allievo durante una prova al Campionato di Saldatura con Weld VR Simulator' ),
			array( 'file' => 'casi-reali/weld-vr-caso-campionato-02.webp', 'alt' => 'Partecipante al Campionato di Saldatura con visore HTC Vive e torcia Weld VR' ),
			array( 'file' => 'casi-reali/weld-vr-caso-campionato-03.webp', 'alt' => 'Due allievi si esercitano insieme con Weld VR Simulator al Campionato di Saldatura' ),
			array( 'file' => 'casi-reali/weld-vr-caso-campionato-04.webp', 'alt' => 'Allievo al Campionato di Saldatura con torcia e visore Weld VR Simulator' ),
			array( 'file' => 'casi-reali/weld-vr-caso-campionato-05.webp', 'alt' => 'Due allievi si esercitano in coppia con Weld VR Simulator al Campionato di Saldatura' ),
			array( 'file' => 'casi-reali/weld-vr-caso-fedegari-01.webp', 'alt' => 'Lezione Weld VR Simulator presso Fedegari, aula con dimostrazione su schermo' ),
			array( 'file' => 'casi-reali/weld-vr-caso-fedegari-02.webp', 'alt' => 'Postazione Weld VR Simulator allestita per la lezione presso Fedegari' ),
			array( 'file' => 'casi-reali/weld-vr-caso-fedegari-03.webp', 'alt' => 'Studente durante l\'esercitazione di saldatura in VR alla lezione Fedegari' ),
			array( 'file' => 'casi-reali/weld-vr-caso-fedegari-04.webp', 'alt' => 'Studente calibra la torcia Weld VR Simulator durante la lezione Fedegari' ),
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

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Weld VR Simulator' ) ); ?>

</div>

<?php
get_footer();
