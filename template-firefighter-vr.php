<?php
/**
 * Template Name: Immensive – Firefighter VR
 *
 * Single-product page, structured the same way as template-weld-vr.php
 * (same section classes/markup, single-accent color trick — see the
 * body.page-template-template-firefighter-vr rule in homepage.css).
 *
 * Content is adapted from https://www.immensive.it/firefighter-vr/. That
 * page has no Lite/Pro tiers, no Confronta i Modelli comparison table, no
 * Soluzioni di Acquisto pricing, and no Requisiti/Opzioni cards — those
 * sections are dropped here rather than filled with invented copy. Its
 * "Dotazione" equivalent is a Versione Vive / Versione Meta split instead of
 * Lite/Pro; the Versione Meta content is a "coming soon" placeholder because
 * that is literally what the source page shows (FF_Standalone_comingsoon
 * label asset, and the FAQ there states the system is HTC Vive-only today).
 *
 * No hero/section photography exists on the source page (its images are all
 * small icons/logos), so the two banner sections below use a color gradient
 * instead of a pinned photo — the one deliberate visual departure from the
 * Weld VR template, forced by what source material actually exists.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-pprod-hero" id="ih-hero" style="background-image: url( '<?php echo esc_url( $immensive_img . 'hero-firefighter-vr.webp' ); ?>' );">
		<div class="ih-pprod-hero__scrim" aria-hidden="true"></div>
		<div class="ih-pprod-hero__inner">
			<h1 class="ih-pprod-hero__logo">
				<img src="<?php echo esc_url( $immensive_img . 'firefighter-vr-logo.webp' ); ?>" alt="Firefighter VR Simulator" width="768" height="192">
			</h1>
			<p class="ih-pprod-hero__sub"><?php esc_html_e( 'Simulatore Antincendio in Realtà Virtuale Immersiva', 'immensive' ); ?></p>
		</div>
	</section>

	<nav class="ih-pnav" id="ih-pnav" aria-label="<?php esc_attr_e( 'Sezioni del prodotto', 'immensive' ); ?>">
		<div class="ih-container ih-pnav__inner">
			<a class="ih-pnav__brand" href="#ih-hero">
				<img src="<?php echo esc_url( $immensive_img . 'firefighter-vr-logo.webp' ); ?>" alt="Firefighter VR Simulator" width="768" height="192">
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
				<h2 class="ih-psys__title">FIREFIGHTER VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Firefighter VR Simulator rappresenta un innovativo strumento di formazione, che consente di effettuare pratiche di estinzione del fuoco in Realtà Virtuale Immersiva, riproducendo in maniera realistica la fase di spegnimento di un incendio mediante estintore.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'hero-firefighter-vr.webp' ); ?>" alt="Kit Firefighter VR Simulator" loading="lazy" width="748" height="695">
			</div>
		</div>
	</section>

	<section class="ih-pteach" style="background-image: linear-gradient(160deg, #2b0f0e 0%, #7a2c2a 60%, #973735 100%);">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<p class="ih-pteach__eyebrow">Firefighter VR Simulator</p>
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Innova il tuo modo di svolgere i corsi antincendio', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Introduci il sistema Firefighter VR Simulator nei tuoi corsi antincendio ed offri ai partecipanti un\'esperienza coinvolgente, efficace e sicura.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfunziona" id="ih-come-funziona">
		<div class="ih-pfunziona__sticky">
			<div class="ih-pfunziona__head">
				<h2 class="ih-pfunziona__heading"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></h2>
				<p class="ih-pfunziona__desc"><?php esc_html_e( 'Grazie ai tracciatori montati su un vero estintore, l\'utente può esercitarsi all\'interno dell\'ambiente virtuale ma maneggiando uno strumento reale. Il simulatore ricrea in maniera estremamente fedele l\'attività di spegnimento del fuoco, monitorando con precisione parametri fondamentali per la valutazione come distanza estintore/fuoco, tempo totale di estinzione, tempo di startup.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-pfunziona__media-wrap">
			<div class="ih-pfunziona__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'firefighter-vr-kit-case.webp' ); ?>" alt="Kit Firefighter VR Simulator" loading="lazy" width="748" height="695">
			</div>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-benefici">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Perché fare formazione con Firefighter VR Simulator', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'I principali benefici per gli Enti Formativi che scelgono di erogare corsi di formazione antincendio integrando il sistema Firefighter VR Simulator sono:', 'immensive' ); ?></p>

			<?php
			$immensive_benefici = array(
				array(
					'tone'  => 'dark',
					'icon'  => 'firefighter-vr-icon-sicuro.webp',
					'title' => 'Sicuro ed ecosostenibile',
					'desc'  => 'Riduce sensibilmente il rischio per chi svolge l\'esercizio e per chi gli è intorno. Zero emissioni di CO2 e spreco di composito.',
				),
				array(
					'tone'     => 'light',
					'icon_svg' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/><path d="M9.5 9.2c0-1.3 1.1-2.2 2.6-2.2s2.6.9 2.6 2.1c0 1.7-2.6 1.7-2.6 3.4M12 16.2h.01" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'title'    => 'Riduzione dei costi',
					'desc'     => 'Abbatte in maniera importante i costi di materiale per le esercitazioni (estintori e vaschette antincendio).',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'firefighter-vr-icon-apprendimento.webp',
					'title' => 'Apprendimento completo ed efficace',
					'desc'  => 'Permette di sperimentare in maniera più completa ed efficace la situazione di emergenza e crea maggiore coinvolgimento nei partecipanti.',
				),
				array(
					'tone'  => 'dark',
					'icon'  => 'firefighter-vr-icon-grado.webp',
					'title' => 'Maggiore grado di esercitazione',
					'desc'  => 'Elimina i tempi di setup tra gli esercizi, massimizzando il tempo a disposizione che ogni utente può dedicare ai task. Permette di svolgere l\'esercitazione in spazi ridotti (3 mq).',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'firefighter-vr-icon-simulazioni.webp',
					'title' => 'Simulazione di ambienti e situazioni particolari',
					'desc'  => 'Simulazione di condizioni particolari difficilmente riproducibili, es. estinzione incendio in luoghi chiusi o con presenza di vento.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'firefighter-vr-icon-gap.webp',
					'title' => 'Colma il gap tra la fase di teoria e pratica',
					'desc'  => 'Permette all\'utente di comprendere velocemente le modalità di estinzione di un incendio e di eseguire più volte i task prima di passare all\'esercitazione reale.',
				),
			);
			?>
			<div class="ih-pbenefici__grid">
				<?php foreach ( $immensive_benefici as $immensive_ben ) : ?>
					<article class="ih-pbenefici__card ih-pbenefici__card--<?php echo esc_attr( $immensive_ben['tone'] ); ?> ih-reveal">
						<span class="ih-pbenefici__icon">
							<?php if ( ! empty( $immensive_ben['icon_svg'] ) ) : ?>
								<?php echo $immensive_ben['icon_svg']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG. ?>
							<?php else : ?>
								<img src="<?php echo esc_url( $immensive_img . $immensive_ben['icon'] ); ?>" alt="" width="64" height="64" loading="lazy" decoding="async">
							<?php endif; ?>
						</span>
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
						<span class="ih-pgap__logo">FIREFIGHTER<span class="ih-pgap__logo-vr">VR</span><br><span class="ih-pgap__logo-sub">SIMULATOR</span></span>
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

			<p class="ih-pgap__desc"><?php esc_html_e( 'L\'introduzione del sistema Firefighter VR Simulator all\'interno di un corso antincendio permette di fare esercitare in piena sicurezza e in maggior misura i partecipanti, che possono ripetere le prove di spegnimento finché non acquisiscono la sicurezza necessaria per passare alla prova reale.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfeat" id="ih-caratteristiche">
		<div class="ih-container">
			<h2 class="ih-pfeat__heading"><?php esc_html_e( 'Caratteristiche Principali', 'immensive' ); ?></h2>

			<?php
			$immensive_features = array(
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 21V9l8-5 8 5v12" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M9 21v-6h6v6" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M4 9h16" stroke="currentColor" stroke-width="1.4"/></svg>',
					'desc' => 'Simulazioni in ambienti interni ed esterni con opzioni settabili per ogni task.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 20V9c0-1.5.5-2.5 1.5-3.5L12 4l1.5 1.5C14.5 6.5 15 7.5 15 9v11" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 13h6M8 20h8" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => 'Dotazione di estintore reale e Vive tracker per restituire la maggior fedeltà possibile.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M8 20c-3.5-2-5-9 0-15 2 3 1 5 3 6 1-2 0-4 1-6 5 4 6 12 0 15" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>',
					'desc' => 'Tipologie diverse di incendi e contenitori, sia per interni che per esterni.',
				),
				array(
					'icon' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="13" r="8" stroke="currentColor" stroke-width="1.4"/><path d="M12 13l4-3M12 5V3M4.5 8.5l-1-1M19.5 8.5l1-1" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'desc' => 'Monitoraggio parametri: Tempo di Estinzione, Distanza di Intervento, Allineamento con il vento.',
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
			<div class="ih-pfeat__grid ih-pfeat__grid--3col">
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

			<div class="ih-pdota__switch" role="tablist" aria-label="<?php esc_attr_e( 'Versione del sistema', 'immensive' ); ?>">
				<span class="ih-pdota__switch-thumb" aria-hidden="true"></span>
				<button type="button" class="ih-pdota__switch-opt is-active" data-version="pro" role="tab" aria-selected="true"><?php esc_html_e( 'Vive', 'immensive' ); ?></button>
				<button type="button" class="ih-pdota__switch-opt" data-version="lite" role="tab" aria-selected="false"><?php esc_html_e( 'Meta', 'immensive' ); ?></button>
			</div>

			<?php
			// Only two versions exist on the source page (Versione Vive /
			// Versione Meta) and neither has the Funzionalità/Requisiti/
			// Opzioni breakdown Weld VR's kit versions carry — those sections
			// are dropped here rather than invented. Versione Meta's content
			// is a "coming soon" placeholder because that's what the source
			// page itself shows (FF_Standalone_comingsoon label asset), and
			// its FAQ states the system is HTC Vive-only today.
			$immensive_kit_versions = array(
				'pro'  => array(
					'image' => 'firefighter-vr-kit-case.webp',
					'alt'   => 'Kit Firefighter VR Simulator versione Vive',
					'title' => 'Versione Vive',
					'desc'  => 'Il sistema è compatibile con HTC Vive e HTC Vive Pro. Il kit include l\'estintore reale con tracker, la licenza software Firefighter VR e il Kit Base pronto per l\'installazione.',
					'items' => array(
						'PC VR Ready (Notebook)',
						'Visore HTC Vive / HTC Vive Pro',
						'Estintore reale con tracker (Kit Base)',
						'Licenza software Firefighter VR',
					),
				),
				'lite' => array(
					'image' => 'firefighter-vr-meta-comingsoon.webp',
					'alt'   => 'Versione Meta Firefighter VR Simulator — coming soon',
					'title' => 'Versione Meta',
					'desc'  => 'La versione standalone per visori Meta Quest è in arrivo.',
					'items' => array(
						'Coming Soon',
					),
				),
			);
			?>

			<?php foreach ( $immensive_kit_versions as $immensive_kit_key => $immensive_kit ) : ?>
				<div class="ih-pdota__panel" data-version-panel="<?php echo esc_attr( $immensive_kit_key ); ?>" <?php echo 'pro' === $immensive_kit_key ? '' : 'hidden'; ?>>

					<div class="ih-pdota__row">
						<div class="ih-pdota__media ih-reveal">
							<img src="<?php echo esc_url( $immensive_img . $immensive_kit['image'] ); ?>" alt="<?php echo esc_attr( $immensive_kit['alt'] ); ?>" loading="lazy" width="748" height="695">
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

	<section class="ih-casi" id="ih-casi">
		<div class="ih-container">
			<h2 class="ih-casi__heading"><?php esc_html_e( 'Casi', 'immensive' ); ?><br><?php esc_html_e( 'Reali', 'immensive' ); ?></h2>
		</div>

		<?php
		$immensive_casi = array(
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-01.webp', 'alt' => 'Allievo alle prese con il Firefighter VR Simulator alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-02.webp', 'alt' => 'Postazione Firefighter VR Simulator allestita alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-03.webp', 'alt' => 'Partecipante con visore HTC Vive durante la prova antincendio in VR alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-04.webp', 'alt' => 'Dimostrazione del Firefighter VR Simulator alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-05.webp', 'alt' => 'Formatore assiste un allievo sul Firefighter VR Simulator alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-06.webp', 'alt' => 'Visitatori in coda per provare il Firefighter VR Simulator alla fiera Sicura' ),
			array( 'file' => 'casi-reali/firefighter-vr/firefighter-vr-caso-sicura-07.webp', 'alt' => 'Prova con estintore virtuale sul Firefighter VR Simulator alla fiera Sicura' ),
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

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Firefighter VR Simulator' ) ); ?>

</div>

<?php
get_footer();
