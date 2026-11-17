<?php
/**
 * Template Name: Immensive – Crane VR
 *
 * Single-product page, structured the same way as template-forklift-vr.php
 * (same section classes/markup, single-accent color trick — see the
 * body.page-template-template-crane-vr rule in homepage.css) and laid out
 * after the Figma "Crane" frame (accent #F89520, white text on the accent).
 *
 * Differences from the other product pages, all taken from the Figma design:
 * - one kit only (radiocomando + licenza, usable in VR or desktop mode), so
 *   the "Dotazione" block has no Pro/Lite switch;
 * - one Requisiti card (Workstation) and one Opzioni card (Versione Meta);
 * - no "Scoprilo nel Dettaglio" accordion and no "Casi Reali" carousel;
 * - 8 Caratteristiche Principali (4 x 2) and 6 benefici.
 *
 * The "Come Funziona" cover opens the YouTube video in the shared video
 * modal (<button class="ih-pfunziona__video" data-video-src>, same as
 * template-forklift-vr.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-pprod-hero" id="ih-hero" style="background-image: url( '<?php echo esc_url( $immensive_img . 'hero-crane-vr.webp' ); ?>' );">
		<div class="ih-pprod-hero__scrim" aria-hidden="true"></div>
		<div class="ih-pprod-hero__inner">
			<h1 class="ih-pprod-hero__logo">
				<img src="<?php echo esc_url( $immensive_img . 'crane-vr-logo.webp' ); ?>" alt="Crane VR Simulator" width="971" height="302">
			</h1>
			<p class="ih-pprod-hero__sub"><?php esc_html_e( 'Simulatore di gru', 'immensive' ); ?></p>
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
				<li><a href="#ih-soluzioni" aria-label="Piani"><span class="ih-pnav__label"><?php esc_html_e( 'Piani', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-benefici" aria-label="Benefici"><span class="ih-pnav__label"><?php esc_html_e( 'Benefici', 'immensive' ); ?></span></a></li>
				<li><a href="#ih-contact" aria-label="Contattaci"><span class="ih-pnav__label"><?php esc_html_e( 'Contattaci', 'immensive' ); ?></span></a></li>
			</ul>
		</nav>

	<div class="ih-flow">

	<section class="ih-psys" id="ih-sistema">
		<div class="ih-psys__grid">
			<div class="ih-psys__text ih-reveal">
				<h2 class="ih-psys__title">CRANE VR<br>SIMULATOR</h2>
				<p class="ih-psys__desc"><?php esc_html_e( 'Il sistema Crane VR Simulator rappresenta un innovativo strumento di formazione che consente di effettuare l\'addestramento alla movimentazione dei carichi con apparecchi di sollevamento in Realtà Virtuale Immersiva.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--cyan" href="#ih-come-funziona"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></a>
			</div>
			<div class="ih-psys__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'crane-vr-radiocomando.webp' ); ?>" alt="Radiocomando a doppio joystick di Crane VR Simulator" loading="lazy" width="1448" height="1086">
			</div>
		</div>
	</section>

	<section class="ih-pteach ih-pteach--flow" style="--pc: #f89520; background-image: linear-gradient(160deg, #f89520 0%, #e07f0c 60%, #c96d06 100%);">
		<?php // No dark scrim here: the Figma band is a bright #F89520 with white text. ?>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Innova il tuo modo di insegnare la movimentazione dei carichi', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Introduci il sistema Crane VR Simulator nei tuoi corsi di formazione ed offri ai tuoi studenti un\'esperienza efficace, coinvolgente e sicura.', 'immensive' ); ?></p>
		</div>
	</section>

	<section class="ih-pfunziona" id="ih-come-funziona">
		<div class="ih-pfunziona__sticky">
			<div class="ih-pfunziona__head">
				<h2 class="ih-pfunziona__heading"><?php esc_html_e( 'Come Funziona', 'immensive' ); ?></h2>
				<p class="ih-pfunziona__desc"><?php esc_html_e( 'Grazie al visore Meta Quest 3 e al radiocomando reale a doppio joystick, l\'allievo può esercitarsi all\'interno di un cantiere virtuale maneggiando una strumentazione identica a quella usata sul campo. Il simulatore Crane VR ricrea in maniera estremamente fedele l\'attività di movimentazione dei carichi con tre diverse gru (a torre, carroponte e a cavalletto), monitorando con precisione le azioni e le manovre eseguite dall\'utente ed elaborando a fine esercizio un report valutativo della performance.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-pfunziona__media-wrap">
			<div class="ih-pfunziona__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_img . 'crane-vr-video-cover.webp' ); ?>" alt="Operatore con visore e radiocomando in un cantiere virtuale con gru a torre" loading="lazy" width="1434" height="807">
				<button type="button" class="ih-pfunziona__video" data-video-src="https://www.youtube.com/watch?v=7PgOWLJFPS4" aria-label="<?php esc_attr_e( 'Riproduci il video Crane VR', 'immensive' ); ?>"><span class="ih-pfunziona__play-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M9 6v12l9-6z" fill="currentColor"/></svg></span></button>
			</div>
		</div>
	</section>

	<section class="ih-pfeat" id="ih-caratteristiche">
		<div class="ih-container">
			<h2 class="ih-pfeat__heading"><?php esc_html_e( 'Caratteristiche Principali', 'immensive' ); ?></h2>

			<?php
			$immensive_features = array(
				array(
					'icon' => 'crane-vr-feat-scenari.webp',
					'desc' => '3 scenari e 3 gru: gru a torre in cantiere, carroponte in capannone, gru a cavalletto in porto.',
				),
				array(
					'icon' => 'crane-vr-feat-radiocomando.webp',
					'desc' => 'Radiocomando reale a doppio joystick con display: si comanda la gru come in cantiere.',
				),
				array(
					'icon' => 'crane-vr-feat-task.webp',
					'desc' => 'Task di sistema pronti all\'uso, in 4 fasi: dai controlli pre-operativi ai carichi speciali.',
				),
				array(
					'icon' => 'crane-vr-feat-carichi.webp',
					'desc' => 'Oltre 40 carichi reali, dal pallet al container, con peso configurabile.',
				),
				array(
					'icon' => 'crane-vr-feat-esercizi.webp',
					'desc' => 'Esercizi personalizzati illimitati: l\'istruttore crea i propri task scegliendo scenario, carichi, ostacoli e attività.',
				),
				array(
					'icon' => 'crane-vr-feat-segnali.webp',
					'desc' => 'Operatore a terra con i segnali gestuali previsti dal D.Lgs. 81/08.',
				),
				array(
					'icon' => 'crane-vr-feat-vento.webp',
					'desc' => 'Vento, linee elettriche e guasti nascosti per allenarsi alle situazioni di rischio.',
				),
				array(
					'icon' => 'crane-vr-feat-report.webp',
					'desc' => 'Report istantaneo con punteggio per task, errori commessi e storico dell\'allievo.',
				),
			);
			?>
			<div class="ih-pfeat__grid">
				<?php foreach ( $immensive_features as $immensive_feat ) : ?>
					<div class="ih-pfeat__item ih-reveal">
						<span class="ih-pfeat__icon"><img src="<?php echo esc_url( $immensive_img . $immensive_feat['icon'] ); ?>" alt="" width="48" height="48" loading="lazy" decoding="async"></span>
						<p class="ih-pfeat__desc"><?php echo esc_html( $immensive_feat['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pdota" id="ih-dotazione">
		<div class="ih-container">
			<h2 class="ih-pdota__heading"><?php esc_html_e( 'Scopri le Versioni', 'immensive' ); ?></h2>

			<div class="ih-pdota__panel">
				<div class="ih-pdota__row">
					<div class="ih-pdota__media ih-reveal">
						<img src="<?php echo esc_url( $immensive_img . 'crane-vr-kit.webp' ); ?>" alt="Kit Crane VR Simulator: radiocomando a doppio joystick e postazione PC" loading="lazy" width="1447" height="1087">
					</div>
					<div class="ih-pdota__content ih-reveal">
						<h3 class="ih-pdota__title"><?php esc_html_e( 'Dotazione Kit', 'immensive' ); ?></h3>
						<p class="ih-pdota__desc">Il kit in dotazione include tutto il necessario per addestrarsi alla movimentazione dei carichi in totale sicurezza. Il simulatore può essere utilizzato sia in <strong>modalità VR</strong>, con il visore Meta Quest 3 per immergersi nel cantiere virtuale, sia in <strong>modalità desktop</strong>, direttamente dallo schermo del PC. In entrambi i casi la gru si comanda con il radiocomando reale a doppio joystick incluso nella dotazione, identico per forma e funzioni a quelli usati in cantiere. L'istruttore, dal PC, prepara gli esercizi, avvia le sessioni e consulta i risultati, trasformando qualsiasi aula in un vero campo di addestramento.</p>
						<div class="ih-pdota__list">
							<?php foreach ( array( 'Radiocomando a doppio joystick con display', 'Licenza Software Crane VR' ) as $immensive_kit_item ) : ?>
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
		</div>
	</section>

	<section class="ih-pdota" id="ih-requisiti">
		<div class="ih-container">
			<div class="ih-pdota__reqopt">
			<div class="ih-pdota__block ih-pdota__block--req">
				<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Requisiti', 'immensive' ); ?></h3>
				<div class="ih-pdota__panel ih-pdota__panel--req">
					<div class="ih-pdota__cards ih-pdota__cards--req">
						<article class="ih-pdota__card ih-reveal">
							<div class="ih-pdota__card-media" aria-hidden="true" style="background-image:url('<?php echo esc_url( $immensive_img . 'weld-vr-workstation.webp' ); ?>')"></div>
							<div class="ih-pdota__card-body">
								<h4 class="ih-pdota__card-title"><?php esc_html_e( 'Workstation', 'immensive' ); ?></h4>
								<p class="ih-pdota__card-desc"><?php esc_html_e( 'PC VR Ready ad elevate prestazioni grafiche necessario per offrire un\'esperienza fluida e di qualità.', 'immensive' ); ?></p>
								<div class="ih-pdota__card-list">
									<div class="ih-pdota__card-item">
										<svg class="ih-pdota__card-check" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
										<span><?php esc_html_e( '1 Notebook', 'immensive' ); ?></span>
									</div>
								</div>
							</div>
						</article>
					</div>
				</div>
			</div>

			<div class="ih-pdota__block ih-pdota__block--req" id="ih-opzioni">
				<h3 class="ih-pdota__section-heading"><?php esc_html_e( 'Opzioni Disponibili', 'immensive' ); ?></h3>
				<div class="ih-pdota__cards ih-pdota__cards--req">
					<?php
					$immensive_opzioni = array(
						array(
							'title' => 'Versione Meta',
							'image' => 'metaQ2.webp',
							'desc'  => 'Kit Meta Quest 3s è il sistema standalone che offre libertà di movimento totale, senza necessità di PC o cavi, per un\'esperienza di realtà virtuale immersiva e immediata.',
							'items' => array( 'Visore Meta Quest 3', '2 Controller Touch Plus' ),
						),
						array(
							'title' => 'Kit HTC Vive Pro Room-Scale VR',
							'image' => 'vive-pro-2-full-kit-buy.webp',
							'desc'  => 'Vive Pro – Full Kit è il sistema progettato da HTC per vivere un\'esperienza di realtà virtuale professionale. Si compone di:',
							'items' => array( 'Visore HTC Vive Pro 2', '2 Stazioni di Base', '2 Supporti per camere', '2 Controller HTC Vive' ),
						),
					);
					?>
					<?php foreach ( $immensive_opzioni as $immensive_opz ) : ?>
						<article class="ih-pdota__card ih-reveal">
							<div class="ih-pdota__card-media ih-pdota__card-media--contain" aria-hidden="true" style="background-image:url('<?php echo esc_url( $immensive_img . $immensive_opz['image'] ); ?>')"></div>
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
		</div>
	</section>

	<section class="ih-psol" id="ih-soluzioni" style="--pcr: 248, 149, 32; --pct: #ffffff;">
		<div class="ih-container">
			<p class="ih-psol__eyebrow"><?php esc_html_e( 'Scegli come comprare Crane VR.', 'immensive' ); ?></p>

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
				<a class="ih-btn ih-btn--cyan" href="<?php echo esc_url( home_url( '/piani/' ) ); ?>"><?php esc_html_e( 'Confronta i 4 Modelli', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-benefici">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Perché fare formazione con Crane VR Simulator', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'I principali benefici per gli Enti di Formazione che scelgono di erogare corsi di formazione integrando il sistema Crane VR Simulator sono:', 'immensive' ); ?></p>

			<?php
			$immensive_benefici = array(
				array(
					'tone'  => 'dark',
					'icon'  => 'crane-vr-icon-sicuro.webp',
					'title' => 'Sicuro ed ecosostenibile',
					'desc'  => 'Nessun rischio per l\'utente che svolge l\'esercizio e per le persone che lo circondano, nemmeno durante la movimentazione di carichi pesanti. Zero emissioni di CO2.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'crane-vr-icon-coinvolgimento.webp',
					'title' => 'Maggiore coinvolgimento',
					'desc'  => 'Crea maggiore coinvolgimento nei partecipanti al corso, grazie a un radiocomando reale e a un cantiere virtuale immersivo, aumentando il grado di apprendimento.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'crane-vr-icon-simulazione.webp',
					'title' => 'Simulazione di ambienti e situazioni particolari',
					'desc'  => 'Simulazione di ambienti e condizioni particolari, come vento, carichi speciali, passaggi stretti e linee elettriche aeree, difficilmente riproducibili durante le classiche esercitazioni reali.',
				),
				array(
					'tone'  => 'dark',
					'icon'  => 'crane-vr-icon-grado.webp',
					'title' => 'Maggiore grado di esercitazione',
					'desc'  => 'Elimina i tempi di setup tra gli esercizi, massimizzando il tempo a disposizione che ogni utente può dedicare ai task. Permette di svolgere l\'esercitazione in spazi ridotti.',
				),
				array(
					'tone'  => 'light',
					'icon'  => 'crane-vr-icon-gap.webp',
					'title' => 'Colma il gap tra teoria e pratica',
					'desc'  => 'Permette all\'utente di comprendere velocemente la modalità di guida e di eseguire più volte i task prima di passare all\'esercitazione reale, con tre gru diverse in tre scenari.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => 'crane-vr-icon-monitoraggio.webp',
					'title' => 'Monitoraggio dell\'apprendimento',
					'desc'  => 'Monitora le azioni di guida e i progressi di apprendimento dell\'utente. Elabora un report valutativo della performance, con punteggio ed errori per ogni task.',
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
				<a class="ih-btn ih-btn--pc" style="--pc:#f89520" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Maggiori informazioni', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

	<?php get_template_part( 'template-parts/demo-modal', null, array( 'product' => 'Crane VR Simulator' ) ); ?>
	<div class="ih-video-modal" id="ih-video-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video Crane VR', 'immensive' ); ?>">
		<div class="ih-video-modal__overlay" data-video-modal-close></div>
		<button type="button" class="ih-video-modal__close" data-video-modal-close aria-label="<?php esc_attr_e( 'Chiudi il video', 'immensive' ); ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></button>
		<div class="ih-video-modal__box"><video controls playsinline></video><iframe hidden title="<?php esc_attr_e( 'Video Crane VR su YouTube', 'immensive' ); ?>" src="" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>
	</div>

</div>

<?php get_template_part( 'template-parts/popup-8108' ); ?>

<?php
get_footer();
