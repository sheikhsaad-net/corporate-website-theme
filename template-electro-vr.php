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
		</div>
	</section>

	<nav class="ih-pnav" id="ih-pnav" aria-label="<?php esc_attr_e( 'Sezioni del prodotto', 'immensive' ); ?>">
		<div class="ih-container ih-pnav__inner">
			<a class="ih-pnav__brand" href="#ih-hero">
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-logo.webp' ); ?>" alt="Electro VR Simulator" width="1024" height="324">
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
				<h2 class="ih-psys__title">ELECTRO VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Electro VR Simulator rappresenta un innovativo strumento di formazione che consente di effettuare simulazioni di realizzazione collegamenti elettrici in ambito civile mediante l\'utilizzo di visore di realtà virtuale, riproducendo in maniera realistica diverse esercitazioni operative.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-system.webp' ); ?>" alt="Postazione Electro VR Simulator" loading="lazy" width="1024" height="576">
			</div>
		</div>
	</section>

	<section class="ih-pteach" style="background-image: linear-gradient(160deg, #1a1a1a 0%, #8a3c1e 60%, #6b2c15 100%);">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<p class="ih-pteach__eyebrow">Electro VR Simulator</p>
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
				<img src="<?php echo esc_url( $immensive_img . 'electro-vr-kit.webp' ); ?>" alt="Controller Electro VR Simulator" loading="lazy" width="1024" height="749">
			</div>
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
						<span class="ih-pgap__logo">ELECTRO<span class="ih-pgap__logo-vr">VR</span><br><span class="ih-pgap__logo-sub">SIMULATOR</span></span>
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

			<p class="ih-pgap__desc"><?php esc_html_e( 'L\'introduzione del sistema Electro VR Simulator nei corsi di formazione permette ai partecipanti di esercitarsi nella realizzazione di collegamenti elettrici in modo sicuro ed efficace, potendo ripetere gli esercizi diverse volte, in tantissime condizioni operative, finché non acquisiscono la sicurezza necessaria per svolgere le attività nei contesti reali.', 'immensive' ); ?></p>
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
			<h2 class="ih-pdota__heading"><?php esc_html_e( 'Dotazione Kit Base', 'immensive' ); ?></h2>

			<?php
			// Only one kit exists on the source page — no Lite/Pro switch
			// here, just the single panel markup .ih-pdota__panel normally
			// renders inside the switch loop.
			?>
			<div class="ih-pdota__panel" data-version-panel="base">
				<div class="ih-pdota__row">
					<div class="ih-pdota__media ih-reveal">
						<img src="<?php echo esc_url( $immensive_img . 'electro-vr-kit.webp' ); ?>" alt="Kit Electro VR Simulator" loading="lazy" width="1024" height="749">
					</div>
					<div class="ih-pdota__content ih-reveal">
						<h3 class="ih-pdota__title">Kit Base</h3>
						<p class="ih-pdota__desc"><?php esc_html_e( 'Il simulatore Electro VR prevede un sistema di controller che replica la presenza delle mani all\'interno dell\'ambiente virtuale; a differenza della maggioranza dei joystick presenti sul mercato, i controller possono essere indossati senza dover necessariamente tenere le mani chiuse per reggere i dispositivi, in modo da usare l\'interazione di chiusura mano per simulare la prensione degli oggetti virtuali.', 'immensive' ); ?></p>
						<div class="ih-pdota__list">
							<div class="ih-pdota__item">
								<span class="ih-pdota__check" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</span>
								<span><?php esc_html_e( 'Licenza software Electro VR', 'immensive' ); ?></span>
							</div>
							<div class="ih-pdota__item">
								<span class="ih-pdota__check" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
								</span>
								<span><?php esc_html_e( 'Controller hand-tracking', 'immensive' ); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="ih-pdota__block">
				<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Opzioni Disponibili', 'immensive' ); ?></h3>
				<div class="ih-pdota__cards ih-pdota__cards--opz">
					<?php
					// Same 4-card structure/images as Weld VR's Opzioni
					// Disponibili (Postazione Docente, Trolley, Carrello
					// Portautensili, Valigia) — this is the same generic
					// hardware/accessories every Immensive simulator ships
					// with, so it reuses Weld VR's existing assets/copy
					// rather than duplicating them, with wording adapted to
					// Electro VR where the source text was welding-specific.
					$immensive_opzioni = array(
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
						array(
							'title' => 'Carrello Portautensili',
							'image' => 'weld-vr-carrello.webp',
							'desc'  => 'Struttura in acciaio con 3 scaffali per tutti gli accessori e supporti per il kit.',
							'items' => array( 'Carrello con ruote' ),
						),
						array(
							'title' => 'Valigia',
							'image' => 'weld-vr-valigia.webp',
							'desc'  => 'Valigia rigida per la protezione e il trasporto sicuro del kit Electro VR.',
							'items' => array( '1 Notebook' ),
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

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Electro VR Simulator' ) ); ?>

</div>

<?php
get_footer();
