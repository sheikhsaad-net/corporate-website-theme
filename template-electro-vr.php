<?php
/**
 * Template Name: Immensive – Electro VR
 *
 * Single-product page, structured the same way as template-weld-vr.php
 * (same section classes/markup, single-accent color trick — see the
 * body.page-template-template-electro-vr rule in homepage.css).
 *
 * Content is adapted from https://www.immensive.it/electro-vr/. That page
 * has no Confronta i Modelli comparison table, no Soluzioni di Acquisto
 * pricing, no "Scoprilo nel Dettaglio", and only ONE kit tier — "Dotazione
 * Kit Base", not a Lite/Pro split — so the version switch is dropped
 * entirely here (a single static panel instead). Its awards banner and FAQ
 * aren't part of Weld VR's section set either, so they're left out too,
 * same call as Firefighter/Forklift VR.
 *
 * Its Opzioni Disponibili is real, native content on the source page (not a
 * reused generic requirement like Firefighter/Forklift needed) — four cards:
 * Workstation Docente, Workstation, Trolley, Kit HTC Vive Pro. Three of
 * those are the exact same hardware Weld VR's cards describe (the source
 * site itself reuses the same generic PC/bag photos across product pages),
 * so those three reuse Weld VR's existing images/copy rather than
 * duplicating assets; only "Workstation Docente" needed nothing new either
 * — same reuse.
 *
 * One genuinely new bit of real content Weld VR's structure has no place
 * for: a short "Novità" callout that the software also runs on Meta Quest
 * headsets. Added as a small note under Opzioni Disponibili rather than a
 * whole new section, since that's all the source material amounts to.
 *
 * No dark hero-banner photo exists on the source page (its images are
 * on-white product/demo shots), so the hero uses a color gradient instead
 * of a pinned photo, same departure as Firefighter/Forklift VR.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-pprod-hero" id="ih-hero" style="background-image: url( '<?php echo esc_url( $immensive_img . 'hero-electro-vr.webp' ); ?>' );">
		<div class="ih-pprod-hero__scrim" aria-hidden="true"></div>
		<div class="ih-pprod-hero__inner">
			<h1 class="ih-pprod-hero__logo">
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-logo.webp' ); ?>" alt="Electro VR Simulator" width="1024" height="324">
			</h1>
			<p class="ih-pprod-hero__sub"><?php esc_html_e( 'Simulatore di Impianti Elettrici in Realtà Virtuale Immersiva', 'immensive' ); ?></p>
			<div class="ih-pprod-hero__actions">
				<button type="button" class="ih-btn ih-btn--outline" data-demo-modal-open><?php esc_html_e( 'Richiedi una Demo', 'immensive' ); ?></button>
				<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( home_url( '/piani/' ) ); ?>"><?php esc_html_e( 'Scopri i Piani', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Diventa Rivenditore', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<nav class="ih-pnav ih-pnav--side" id="ih-pnav" aria-label="<?php esc_attr_e( 'Sezioni del prodotto', 'immensive' ); ?>">
			<ul class="ih-pnav__links">
				<li><a href="#ih-sistema" aria-label="Il sistema"><span class="ih-pnav__label"><?php esc_html_e( 'Il sistema', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-come-funziona" aria-label="Come Funziona"><span class="ih-pnav__label"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-caratteristiche" aria-label="Caratteristiche"><span class="ih-pnav__label"><?php esc_html_e( 'Caratteristiche', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-dotazione" aria-label="Dotazione"><span class="ih-pnav__label"><?php esc_html_e( 'Dotazione', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-benefici" aria-label="Benefici"><span class="ih-pnav__label"><?php esc_html_e( 'Benefici', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-contact" aria-label="Contattaci"><span class="ih-pnav__label"><?php esc_html_e( 'Contattaci', 'immensive' ); ?></span></a></li>
			</ul>
		</nav>

	<div class="ih-flow">

	<section class="ih-psys" id="ih-sistema">
		<div class="ih-psys__grid">
			<div class="ih-psys__text ih-reveal">
				<h2 class="ih-psys__title">ELECTRO VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Electro VR Simulator rappresenta un innovativo strumento di formazione che consente di effettuare simulazioni di realizzazione collegamenti elettrici in ambito civile mediante l\'utilizzo di visore di realtà virtuale, riproducendo in maniera realistica diverse esercitazioni operative.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-system.webp' ); ?>" alt="Postazione Electro VR Simulator" loading="lazy" width="1525" height="858">
			</div>
		</div>
	</section>

	<section class="ih-pteach ih-pteach--flow" style="--pc: #f7971e; background-image: linear-gradient(160deg, #1a1a1a 0%, #8a3c1e 60%, #6b2c15 100%);">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Innova il tuo modo di formare gli elettricisti del domani', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Introduci il sistema Electro VR Simulator nei tuoi corsi di formazione ed offri ai partecipanti un\'esperienza coinvolgente, efficace e sicura.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfunziona" id="ih-come-funziona">
		<div class="ih-pfunziona__sticky">
			<div class="ih-pfunziona__head">
				<h2 class="ih-pfunziona__heading"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></h2>
				<p class="ih-pfunziona__desc"><?php esc_html_e( 'Grazie all\'utilizzo di controller che simulano la presenza delle mani nell\'ambiente virtuale, l\'utente può esercitarsi all\'interno di un ambiente simulato in totale libertà. Il simulatore Electro VR ricrea in maniera estremamente fedele l\'attività di realizzazione di impianti elettrici, partendo da simulazioni semplificate fino ad arrivare alla creazione di un impianto elettrico all\'interno di un\'abitazione civile tipo, elaborando in tutti i casi a fine esercizio un report valutativo delle performance dell\'utente.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-pfunziona__media-wrap">
			<div class="ih-pfunziona__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-video-cover.webp' ); ?>" alt="Electro VR Simulator — guarda il video dimostrativo" loading="lazy" width="1671" height="940">
				<button type="button" class="ih-pfunziona__video" data-video-src="https://youtu.be/QxBAtNBAwQY" aria-label="<?php esc_attr_e( 'Riproduci il video Electro VR', 'immensive' ); ?>">
					<span class="ih-pfunziona__play-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m9 6 10 6-10 6V6Z" fill="currentColor"/></svg></span>
				</button>
			</div>
		</div>
	</section>

	<section class="ih-pfeat" id="ih-caratteristiche">
		<div class="ih-container">
			<h2 class="ih-pfeat__heading"><?php esc_html_e( 'Caratteristiche Principali', 'immensive' ); ?></h2>

			<?php
			$immensive_features = array(
				array(
					'icon' => 'electro-vr-feat-modalita.webp',
					'desc' => 'Due modalità esercitative: ambiente neutro e ambiente residenziale.',
				),
				array(
					'icon' => 'electro-vr-feat-componenti.webp',
					'desc' => 'Possibilità di scelta di un\'ampia serie di componenti (interruttori, deviatori, cavi, relè, ecc.).',
				),
				array(
					'icon' => 'electro-vr-feat-esercizi.webp',
					'desc' => 'Oltre 20 esercizi per simulare diverse condizioni operative.',
				),
				array(
					'icon' => 'electro-vr-feat-errori.webp',
					'desc' => 'Monitoraggio errori: segnalazione errori con simulazione conseguenza (cortocircuito, principio incendio, ecc.).',
				),
				array(
					'icon' => 'electro-vr-feat-report.webp',
					'desc' => 'Report istantaneo dell\'esercizio con salvataggio dei risultati.',
				),
				array(
					'icon' => 'electro-vr-feat-utenti.webp',
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
			<h2 class="ih-pdota__heading"><?php esc_html_e( 'Scopri le Versioni', 'immensive' ); ?></h2>

			<div class="ih-pdota__switch" role="tablist" aria-label="<?php esc_attr_e( 'Versione del sistema', 'immensive' ); ?>">
				<span class="ih-pdota__switch-thumb" aria-hidden="true"></span>
				<button type="button" class="ih-pdota__switch-opt is-active" data-version="pro" role="tab" aria-selected="true"><?php esc_html_e( 'HTC', 'immensive' ); ?></button>
				<button type="button" class="ih-pdota__switch-opt" data-version="lite" role="tab" aria-selected="false"><?php esc_html_e( 'Meta', 'immensive' ); ?></button>
			</div>

			<?php
			// Same switch as Firefighter VR. Requisiti = workstation + the
			// headset of the chosen version; Opzioni = instructor workstation
			// and trolley (same generic hardware/copy as Weld VR).
			$immensive_workstation = array(
				'title' => 'Workstation',
				'image' => 'weld-vr-workstation.webp',
				'desc'  => 'PC VR Ready ad elevate prestazioni grafiche necessario per offrire un\'esperienza fluida e di qualità.',
				'items' => array( '1 Notebook' ),
			);
			$immensive_electro_options = array(
				array(
					'title' => 'Postazione Docente',
					'image' => 'weld-vr-postazione-docente.webp',
					'desc'  => 'Consente al docente di monitorare in tempo reale le operazioni di ogni postazione del laboratorio Electro VR durante le esercitazioni.',
					'items' => array( '1 Notebook' ),
				),
				array(
					'title' => 'Trolley',
					'image' => 'weld-vr-trolley.webp',
					'desc'  => 'Comodo borsone con ruote e manico per l\'alloggiamento e trasporto del kit Electro VR.',
					'items' => array( '1 Borsone con ruote' ),
				),
			);
			$immensive_kit_versions = array(
				'pro'  => array(
					'alt'       => 'Kit Base Electro VR Simulator con controller hand-tracking',
					'title'     => 'Kit Versione HTC',
					'requisiti' => array(
						$immensive_workstation,
						array(
							'title' => 'Kit HTC Vive Pro Room-Scale VR',
							'image' => 'vive-pro-2-full-kit-buy.webp',
							'desc'  => 'Vive Pro – Full Kit è il sistema progettato da HTC per vivere un\'esperienza di realtà virtuale professionale. Si compone di:',
							'items' => array( 'Visore HTC Vive Pro 2', '2 Stazioni di Base', '2 Supporti per camere', '2 Controller HTC Vive' ),
						),
					),
				),
				'lite' => array(
					'alt'       => 'Kit Base Electro VR Simulator con controller hand-tracking',
					'title'     => 'Kit Versione Meta',
					'requisiti' => array(
						$immensive_workstation,
						array(
							'title' => 'Kit Meta Quest',
							'image' => 'metaQ2.webp',
							'desc'  => 'Kit Meta Quest 3s è il sistema standalone che offre libertà di movimento totale, per un\'esperienza di realtà virtuale immersiva e immediata.',
							'items' => array( 'Visore Meta Quest 3', '2 Controller Touch Plus' ),
						),
					),
				),
			);
			$immensive_kit_items = array( 'Licenza software Electro VR', 'Controller hand-tracking' );
			$immensive_contain   = array( 'vive-pro-2-full-kit-buy.webp', 'metaQ2.webp' );
			?>

			<?php foreach ( $immensive_kit_versions as $immensive_kit_key => $immensive_kit ) : ?>
				<div class="ih-pdota__panel" data-version-panel="<?php echo esc_attr( $immensive_kit_key ); ?>" <?php echo 'pro' === $immensive_kit_key ? '' : 'hidden'; ?>>

					<div class="ih-pdota__row">
						<div class="ih-pdota__media ih-reveal">
							<img src="<?php echo esc_url( $immensive_img . 'electro-vr-dotazione-base.webp' ); ?>" alt="<?php echo esc_attr( $immensive_kit['alt'] ); ?>" loading="lazy" width="1081" height="1081">
						</div>
						<div class="ih-pdota__content ih-reveal">
							<h3 class="ih-pdota__title"><?php echo esc_html( $immensive_kit['title'] ); ?></h3>
							<p class="ih-pdota__desc"><?php esc_html_e( 'Il simulatore Electro VR prevede un sistema di controller che replica la presenza delle mani all\'interno dell\'ambiente virtuale.', 'immensive' ); ?></p>
							<div class="ih-pdota__list">
								<?php foreach ( $immensive_kit_items as $immensive_kit_item ) : ?>
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

					<div class="ih-pdota__reqopt">
						<?php
						$immensive_blocks = array(
							array( 'heading' => __( 'Requisiti', 'immensive' ), 'cards' => $immensive_kit['requisiti'], 'class' => 'ih-pdota__cards--req' ),
							array( 'heading' => __( 'Opzioni Disponibili', 'immensive' ), 'cards' => $immensive_electro_options, 'class' => 'ih-pdota__cards--opz' ),
						);
						?>
						<?php foreach ( $immensive_blocks as $immensive_block ) : ?>
							<div class="ih-pdota__block">
								<h3 class="ih-pdota__section-heading"><?php echo esc_html( $immensive_block['heading'] ); ?></h3>
								<div class="ih-pdota__cards <?php echo esc_attr( $immensive_block['class'] ); ?>">
									<?php foreach ( $immensive_block['cards'] as $immensive_card ) : ?>
										<article class="ih-pdota__card ih-reveal">
											<div class="ih-pdota__card-media<?php echo in_array( $immensive_card['image'], $immensive_contain, true ) ? ' ih-pdota__card-media--contain' : ''; ?>" aria-hidden="true" style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_card['image'] ); ?>')"></div>
											<div class="ih-pdota__card-body">
												<h4 class="ih-pdota__card-title"><?php echo esc_html( $immensive_card['title'] ); ?></h4>
												<p class="ih-pdota__card-desc"><?php echo esc_html( $immensive_card['desc'] ); ?></p>
												<div class="ih-pdota__card-list">
													<?php foreach ( $immensive_card['items'] as $immensive_card_item ) : ?>
														<div class="ih-pdota__card-item">
															<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
															<span><?php echo esc_html( $immensive_card_item ); ?></span>
														</div>
													<?php endforeach; ?>
												</div>
											</div>
										</article>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-benefici">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Perché fare formazione con Electro VR Simulator', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'I principali benefici per gli Enti di Formazione che scelgono di erogare corsi di formazione integrando il sistema Electro VR Simulator sono:', 'immensive' ); ?></p>

			<?php
			$immensive_benefici = array(
				array(
					'tone'  => 'dark',
					'icon'  => 'electro-vr-icon-sicuro.webp',
					'title' => 'Sicuro ed ecosostenibile',
					'desc'  => 'Nessun rischio per l\'utente che svolge l\'esercizio e per le persone che lo circondano. Zero emissioni di CO2.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'electro-vr-icon-coinvolgimento.webp',
					'title' => 'Maggiore coinvolgimento',
					'desc'  => 'Crea maggiore coinvolgimento ed engagement nei partecipanti al corso, aumentando il grado di apprendimento.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'electro-vr-icon-simulazioni.webp',
					'title' => 'Simulazione di ambienti e situazioni particolari',
					'desc'  => 'Simulazione di ambienti e condizioni particolari, difficilmente riproducibili durante le classiche esercitazioni reali.',
				),
				array(
					'tone'  => 'dark',
					'icon'  => 'electro-vr-icon-grado.webp',
					'title' => 'Maggiore grado di esercitazione',
					'desc'  => 'Elimina i tempi di setup tra gli esercizi, massimizzando il tempo a disposizione che ogni utente può dedicare ai task. Permette di svolgere l\'esercitazione in qualsiasi ambiente.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'electro-vr-icon-efficace.webp',
					'title' => 'Efficace e di veloce apprendimento',
					'desc'  => 'Permette all\'utente di comprendere velocemente le modalità operative e di eseguire più volte i task prima di passare all\'esercitazione reale.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'electro-vr-icon-monitoraggio.webp',
					'title' => 'Monitoraggio dell\'apprendimento',
					'desc'  => 'Monitoraggio di tutte le micro-azioni che portano alla realizzazione dei collegamenti elettrici e dei progressi nell\'apprendimento da parte dell\'utente. Elaborazione report valutativo della performance.',
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

	<section class="ih-pdual" id="ih-contact">
		<div class="ih-container ih-pdual__inner">
			<div class="ih-pdual__col ih-reveal">
				<p class="ih-pdual__label"><?php esc_html_e( 'Voglio una demo', 'immensive' ); ?></p>
				<button type="button" class="ih-btn ih-btn--cyan" data-demo-modal-open><?php esc_html_e( 'Richiedi Demo', 'immensive' ); ?></button>
			</div>
			<div class="ih-pdual__col ih-reveal">
				<p class="ih-pdual__label"><?php esc_html_e( 'Sono un rivenditore', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--pc" style="--pc:#f7971e" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Maggiori informazioni', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Electro VR Simulator' ) ); ?>

	<div class="ih-video-modal" id="ih-video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video Electro VR', 'immensive' ); ?>">
		<div class="ih-video-modal__overlay" data-video-modal-close></div>
		<button type="button" class="ih-video-modal__close" data-video-modal-close aria-label="<?php esc_attr_e( 'Chiudi il video', 'immensive' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>
		<div class="ih-video-modal__box">
			<video controls playsinline></video>
			<iframe hidden title="<?php esc_attr_e( 'Video Electro VR su YouTube', 'immensive' ); ?>" src="" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>

</div>

<?php get_template_part( 'template-parts/popup-8108' ); ?>

<?php
get_footer();
