<?php
/**
 * Template Name: Immensive – Altri Servizi
 *
 * /servizi/ — rebuilt from the approved concept (immensive_servizi_concept.html):
 * point-sphere hero, competence ticker, approach, six service cards, sectors,
 * process, technologies, selected projects. Shared site header/footer, contact
 * band and theme buttons are kept. Page styles live in assets/css/servizi.css
 * (everything scoped under .svz) and assets/js/servizi.js, both enqueued only
 * for this template (see immensive_servizi_assets() in functions.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

// Portfolio links: the project's own page when it exists, else the portfolio.
$immensive_portfolio_page = get_page_by_path( 'portfolio' );
$immensive_portfolio_href = $immensive_portfolio_page ? get_permalink( $immensive_portfolio_page ) : get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );
$immensive_work_href      = function ( $slug ) use ( $immensive_portfolio_href ) {
	$immensive_work = get_page_by_path( $slug, OBJECT, IMMENSIVE_PORTFOLIO_POST_TYPE );
	return $immensive_work ? get_permalink( $immensive_work ) : $immensive_portfolio_href;
};

$immensive_competences = array( 'Software custom', 'Extended reality', 'Simulazione 3D', 'Sistemi interattivi', 'Intelligenza artificiale' );

$immensive_services = array(
	array(
		'title' => 'Simulazione e<br>ambienti 3D',
		'desc'  => 'Ambienti virtuali e simulatori per riprodurre scenari, procedure e processi complessi. Dalla formazione tecnica alla visualizzazione interattiva.',
		'tags'  => array( 'Simulatori', '3D real-time', 'Training' ),
		'icon'  => '<path d="m16 3 12 7v12l-12 7L4 22V10zM4 10l12 7 12-7M16 17v12"/>',
	),
	array(
		'title' => 'Applicazioni in<br>realtà estesa',
		'desc'  => 'Esperienze VR, AR e MR per formazione, assistenza, cultura e presentazione dei prodotti. La tecnologia immersiva si adatta al contesto d\'uso.',
		'tags'  => array( 'VR', 'AR', 'Mixed Reality' ),
		'icon'  => '<path d="M5 13 9 8h14l4 5v11H5zM5 15h22M10 20h5M21 20h1M11 8V5h10v3"/>',
	),
	array(
		'title' => 'Software desktop<br>e piattaforme web',
		'desc'  => 'Applicazioni personalizzate, configuratori, dashboard e strumenti operativi, anche collegati a dati e sistemi già presenti in azienda.',
		'tags'  => array( 'Desktop', 'Web app', 'Configuratori' ),
		'icon'  => '<rect x="3" y="5" width="26" height="19" rx="2"/><path d="M12 29h8M16 24v5M8 13l4 4-4 3M16 20h7"/>',
	),
	array(
		'title' => 'Applicazioni<br>mobile',
		'desc'  => 'App per smartphone e tablet, progettate intorno alle persone e alle attività che devono svolgere: strumenti aziendali, esperienze interattive e servizi digitali.',
		'tags'  => array( 'iOS', 'Android', 'Interfacce su misura' ),
		'icon'  => '<rect x="9" y="2" width="14" height="28" rx="3"/><path d="M13 6h6M15 26h2M12 11h8v10h-8z"/>',
	),
	array(
		'title' => 'Prototipazione e<br>sistemi integrati',
		'desc'  => 'Prototipi e soluzioni che fanno dialogare software, sensori, componenti elettronici e dispositivi fisici, per sperimentare e validare nuove applicazioni.',
		'tags'  => array( 'Hardware', 'Sensori', 'Integrazione' ),
		'icon'  => '<rect x="10" y="10" width="12" height="12" rx="2"/><path d="M14 2v8M19 2v8M14 22v8M19 22v8M2 14h8M2 19h8M22 14h8M22 19h8M14 14h4v4h-4z"/>',
	),
	array(
		'title' => 'Soluzioni con<br>intelligenza artificiale',
		'desc'  => 'Integriamo funzionalità AI in applicativi e processi, dall\'analisi delle informazioni alla computer vision e all\'automazione di attività specifiche.',
		'tags'  => array( 'AI integrata', 'Computer vision', 'Automazione' ),
		'icon'  => '<circle cx="16" cy="16" r="4"/><circle cx="7" cy="7" r="3"/><circle cx="25" cy="7" r="3"/><circle cx="7" cy="25" r="3"/><circle cx="25" cy="25" r="3"/><path d="m9 9 4 4m6 0 4-4M9 23l4-4m6 0 4 4"/>',
	),
);

$immensive_sectors = array(
	array( 'title' => 'Industria e manutenzione', 'desc' => 'Simulazione operativa, supporto tecnico, visualizzazione e processi digitali.', 'href' => '' ),
	array( 'title' => 'Formazione e sicurezza', 'desc' => 'Ambienti di apprendimento e simulatori per esercitazioni e addestramento.', 'href' => '' ),
	array( 'title' => 'Medicale e ricerca', 'desc' => 'Applicazioni interattive, simulazione e strumenti per sperimentazione e ricerca.', 'href' => home_url( '/ricerca/' ) ),
	array( 'title' => 'Cultura e patrimonio', 'desc' => 'Esperienze museali, ricostruzioni, storytelling e accessibilità digitale.', 'href' => home_url( '/soluzioni-culturali-creative/' ) ),
	array( 'title' => 'Architettura e prodotto', 'desc' => 'Configuratori, visualizzazioni avanzate e ambienti esplorabili.', 'href' => '' ),
);

$immensive_steps = array(
	array( 'title' => 'Analisi', 'desc' => 'Comprendiamo le esigenze, definiamo gli obiettivi e valutiamo la fattibilità.' ),
	array( 'title' => 'Progettazione', 'desc' => 'Disegniamo l’esperienza, le funzionalità e l’architettura della soluzione.' ),
	array( 'title' => 'Sviluppo', 'desc' => 'Realizziamo il software e integriamo le tecnologie necessarie.' ),
	array( 'title' => 'Validazione', 'desc' => 'Testiamo il sistema, perfezioniamo l’esperienza e prepariamo il rilascio.' ),
);

$immensive_capabilities = array(
	array(
		'label'  => 'Realtà estesa',
		'title'  => 'Esperienze da vivere in prima persona',
		'desc'   => 'Progettiamo modalità di interazione che portano i contenuti dentro lo spazio o le persone dentro un ambiente digitale.',
		'tags'   => array( 'Virtual Reality', 'Augmented Reality', 'Mixed Reality' ),
		'result' => 'Formazione, percorsi culturali e assistenza.',
	),
	array(
		'label'  => '3D e simulazione',
		'title'  => 'Esplorare prima di realizzare',
		'desc'   => 'Ambienti e modelli tridimensionali diventano strumenti per visualizzare prodotti, valutare configurazioni e riprodurre procedure.',
		'tags'   => array( 'Real-time 3D', 'Simulazione', 'Configuratori' ),
		'result' => 'Visualizzazione, training e presentazione del prodotto.',
	),
	array(
		'label'  => 'Web e mobile',
		'title'  => 'La soluzione, dove serve',
		'desc'   => 'Interfacce e applicazioni progettate per i dispositivi e i contesti in cui saranno utilizzate, con collegamenti ai sistemi esistenti.',
		'tags'   => array( 'Web app', 'Desktop', 'iOS / Android' ),
		'result' => 'Strumenti operativi, dashboard e servizi digitali.',
	),
	array(
		'label'  => 'AI e integrazioni',
		'title'  => 'Software che dialoga con i sistemi',
		'desc'   => 'Integriamo funzionalità di intelligenza artificiale, sensori e dispositivi fisici nelle soluzioni sviluppate in base agli obiettivi del progetto.',
		'tags'   => array( 'AI', 'Sensori', 'Hardware integration' ),
		'result' => 'Automazione di attività specifiche e prototipi integrati.',
	),
);

$immensive_projects = array(
	array( 'slug' => 'veins-catheter-simulator', 'title' => 'Veins Catheter Simulator', 'pill' => 'Software desktop', 'img' => 'official-6a05f220-veins-catheter-hero.webp' ),
	array( 'slug' => 'ai4hot', 'title' => 'AI4HOT', 'pill' => 'Piattaforma AI/IoT', 'img' => 'official-797cee52-ai4hot.webp' ),
	array( 'slug' => 'gragnano-experience', 'title' => 'Gragnano Experience', 'pill' => 'VR Storytelling', 'img' => 'official-b3661b8c-gragnano-via-roma-5.webp' ),
	array( 'slug' => 'configuratore-vr', 'title' => 'Configuratore VR', 'pill' => '', 'img' => 'official-d921e01b-configuratore-vr.webp' ),
	array( 'slug' => 'medipass', 'title' => 'Oceania', 'pill' => 'Esperienza VR/Tablet Gamificata', 'img' => 'official-ed8011a2-medipass-hero-relitto.webp' ),
	array( 'slug' => 'museo-digitale-palazzo-serra-di-cassano', 'title' => 'Museo Digitale Palazzo Serra di Cassano', 'pill' => 'Esperienza Museale Interattiva', 'img' => 'official-dac3bdb0-museo-digitale-palazzo-serra-di-cassano.webp' ),
);

$immensive_count = count( $immensive_services );

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<main class="svz" id="contenuto">

		<section class="immersive-hero" id="inizio" data-page="servizi" aria-label="<?php esc_attr_e( 'Servizi Immensive', 'immensive' ); ?>">
			<div class="orb-stage" aria-hidden="true">
				<div class="orb-fallback"></div>
				<canvas></canvas>
				<div class="orb-noise"></div>
				<div class="orb-tags">
					<?php foreach ( $immensive_competences as $immensive_competence ) : ?>
						<span class="orb-tag"><b>↗</b><?php echo esc_html( $immensive_competence ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="shell">
				<p class="ih-new-top"><?php esc_html_e( 'Software · Esperienze immersive · Sistemi interattivi', 'immensive' ); ?></p>
				<h1><?php esc_html_e( 'Le idee prendono forma.', 'immensive' ); ?><br><?php esc_html_e( 'Le soluzioni diventano reali.', 'immensive' ); ?></h1>
				<p class="ih-new-copy"><?php esc_html_e( 'Progettiamo software, esperienze immersive e sistemi interattivi per aziende ed enti. Dall’analisi alla realizzazione, scegliamo la tecnologia giusta per ogni esigenza.', 'immensive' ); ?></p>
				<div class="ih-new-actions">
					<a class="ih-btn ih-btn--solid" href="#servizi"><?php esc_html_e( 'Esplora i servizi', 'immensive' ); ?></a>
					<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>"><?php esc_html_e( 'Parliamo del tuo progetto', 'immensive' ); ?></a>
				</div>
				<div class="ih-hero-base">
					<p><?php esc_html_e( 'Competenze diverse.', 'immensive' ); ?><br><?php esc_html_e( 'Un unico progetto.', 'immensive' ); ?></p>
					<a class="scroll-cue" href="#servizi"><?php esc_html_e( 'Scorri per esplorare', 'immensive' ); ?> <span aria-hidden="true"></span>↓</a>
				</div>
			</div>
		</section>

		<div class="ticker">
			<div class="shell ticker-inner">
				<?php foreach ( $immensive_competences as $immensive_competence ) : ?>
					<span><b>✳</b> <?php echo esc_html( $immensive_competence ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>

		<section class="intro">
			<div class="shell intro-grid reveal">
				<div>
					<div class="eyebrow"><?php esc_html_e( 'Il nostro approccio', 'immensive' ); ?></div>
					<h2><?php esc_html_e( 'Il punto di partenza non è la', 'immensive' ); ?> <em><?php esc_html_e( 'tecnologia.', 'immensive' ); ?></em></h2>
				</div>
				<div class="intro-copy">
					<p class="lead"><?php esc_html_e( 'È il problema da risolvere, l\'esperienza da migliorare o la nuova possibilità da esplorare.', 'immensive' ); ?></p>
					<p><?php esc_html_e( 'Ascoltiamo le esigenze del cliente, valutiamo la fattibilità del progetto e identifichiamo gli strumenti più adatti. Combiniamo sviluppo software, simulazione, tecnologie immersive e integrazione con sistemi fisici per dare vita a soluzioni progettate per essere utilizzate davvero.', 'immensive' ); ?></p>
				</div>
			</div>
		</section>

		<section class="services" id="servizi">
			<div class="shell">
				<div class="section-head reveal">
					<div>
						<div class="eyebrow"><?php esc_html_e( 'Cosa sviluppiamo', 'immensive' ); ?></div>
						<h2><?php esc_html_e( 'Competenze diverse.', 'immensive' ); ?><br><?php esc_html_e( 'Un unico obiettivo.', 'immensive' ); ?></h2>
					</div>
					<p><?php esc_html_e( 'Sei aree di sviluppo che possono operare singolarmente o integrarsi in progetti più complessi.', 'immensive' ); ?></p>
				</div>
				<div class="service-grid">
					<?php foreach ( $immensive_services as $immensive_i => $immensive_service ) : ?>
						<article class="service-card reveal">
							<div class="service-top">
								<span class="service-num"><?php echo esc_html( sprintf( '%02d / %02d', $immensive_i + 1, $immensive_count ) ); ?></span>
								<span class="service-icon"><svg viewBox="0 0 32 32" aria-hidden="true"><?php echo $immensive_service['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG. ?></svg></span>
							</div>
							<h3><?php echo wp_kses( $immensive_service['title'], array( 'br' => array() ) ); ?></h3>
							<p><?php echo esc_html( $immensive_service['desc'] ); ?></p>
							<div class="service-tags">
								<?php foreach ( $immensive_service['tags'] as $immensive_tag ) : ?>
									<span><?php echo esc_html( $immensive_tag ); ?></span>
								<?php endforeach; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="industries" id="settori">
			<div class="shell">
				<div class="section-head reveal">
					<div>
						<div class="eyebrow"><?php esc_html_e( 'Ambiti di applicazione', 'immensive' ); ?></div>
						<h2><?php esc_html_e( 'Una tecnologia.', 'immensive' ); ?><br><?php esc_html_e( 'Molti contesti.', 'immensive' ); ?></h2>
					</div>
					<p><?php esc_html_e( 'Esperienze e competenze applicabili a settori diversi, ciascuno con esigenze e obiettivi specifici.', 'immensive' ); ?></p>
				</div>
				<div class="sector-list reveal">
					<?php foreach ( $immensive_sectors as $immensive_i => $immensive_sector ) : ?>
						<div class="sector-row">
							<span class="number"><?php echo esc_html( sprintf( '%02d', $immensive_i + 1 ) ); ?></span>
							<h3>
								<?php if ( $immensive_sector['href'] ) : ?>
									<a href="<?php echo esc_url( $immensive_sector['href'] ); ?>"><?php echo esc_html( $immensive_sector['title'] ); ?> ↗</a>
								<?php else : ?>
									<?php echo esc_html( $immensive_sector['title'] ); ?>
								<?php endif; ?>
							</h3>
							<p><?php echo esc_html( $immensive_sector['desc'] ); ?></p>
							<span class="up" aria-hidden="true">↗</span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="method journey-section" id="metodo">
			<div class="shell">
				<div class="eyebrow"><?php esc_html_e( 'Dall’idea al risultato', 'immensive' ); ?></div>
				<h2><?php esc_html_e( 'Un processo chiaro.', 'immensive' ); ?><br><?php esc_html_e( 'Un progetto condiviso.', 'immensive' ); ?></h2>
				<p class="journey-intro"><?php esc_html_e( 'Seguiamo il percorso di sviluppo mantenendo al centro obiettivi, funzionalità e utilizzo reale.', 'immensive' ); ?></p>
				<ol class="process-track">
					<?php foreach ( $immensive_steps as $immensive_i => $immensive_step ) : ?>
						<li class="process-step">
							<span class="process-phase"><?php echo esc_html( sprintf( 'Fase %02d', $immensive_i + 1 ) ); ?></span>
							<span class="process-dot" aria-hidden="true"></span>
							<h3><?php echo esc_html( $immensive_step['title'] ); ?></h3>
							<p><?php echo esc_html( $immensive_step['desc'] ); ?></p>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</section>

		<section class="tech capability-section" id="tecnologie" aria-labelledby="tech-title">
			<div class="shell">
				<div class="eyebrow"><?php esc_html_e( 'Competenze che si combinano', 'immensive' ); ?></div>
				<h2 id="tech-title"><?php esc_html_e( 'Le tecnologie sono strumenti.', 'immensive' ); ?><br><?php esc_html_e( 'La soluzione viene prima.', 'immensive' ); ?></h2>
				<p class="capability-intro"><?php esc_html_e( 'Ogni progetto richiede una combinazione diversa. Scegliamo gli strumenti in funzione dell’esperienza e dell’utilizzo previsto.', 'immensive' ); ?></p>
				<div class="capability-grid">
					<?php foreach ( $immensive_capabilities as $immensive_i => $immensive_cap ) : ?>
						<article class="capability-card capability-card--<?php echo (int) ( $immensive_i + 1 ); ?>">
							<span class="capability-index" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $immensive_i + 1 ) ); ?></span>
							<div class="capability-copy">
								<span class="tech-open-label"><?php echo esc_html( $immensive_cap['label'] ); ?></span>
								<h3><?php echo esc_html( $immensive_cap['title'] ); ?></h3>
								<p><?php echo esc_html( $immensive_cap['desc'] ); ?></p>
								<div class="tech-labels">
									<?php foreach ( $immensive_cap['tags'] as $immensive_tag ) : ?>
										<span><?php echo esc_html( $immensive_tag ); ?></span>
									<?php endforeach; ?>
								</div>
								<p class="tech-result"><strong><?php esc_html_e( 'Applicazioni', 'immensive' ); ?></strong><br><?php echo esc_html( $immensive_cap['result'] ); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
				<p class="capability-note"><?php esc_html_e( 'L’analisi del contesto guida la scelta delle tecnologie e delle integrazioni.', 'immensive' ); ?></p>
			</div>
		</section>

		<section class="project-gallery home-selection" id="progetti">
			<div class="shell">
				<div class="eyebrow"><?php esc_html_e( 'Progetti selezionati', 'immensive' ); ?></div>
				<h2><?php esc_html_e( 'Le competenze,', 'immensive' ); ?><br><?php esc_html_e( 'messe in pratica.', 'immensive' ); ?></h2>
				<p class="gallery-intro"><?php esc_html_e( 'Ogni progetto è una conversazione tra idea e risultato.', 'immensive' ); ?></p>
				<div class="project-tiles">
					<?php foreach ( $immensive_projects as $immensive_project ) : ?>
						<a class="ih-sccp" href="<?php echo esc_url( $immensive_work_href( $immensive_project['slug'] ) ); ?>">
							<span class="ih-sccp__media" aria-hidden="true">
								<img src="<?php echo esc_url( $immensive_img . 'servizi/' . $immensive_project['img'] ); ?>" alt="" loading="lazy" decoding="async">
							</span>
							<span class="ih-sccp__bar">
								<span class="ih-sccp__title"><?php echo esc_html( $immensive_project['title'] ); ?></span>
								<?php if ( $immensive_project['pill'] ) : ?>
									<span class="ih-sccp__pill"><?php echo esc_html( $immensive_project['pill'] ); ?></span>
								<?php endif; ?>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
				<p class="svz-cta"><a class="ih-btn ih-btn--outline" href="<?php echo esc_url( $immensive_portfolio_href ); ?>"><?php esc_html_e( 'Esplora il portfolio', 'immensive' ); ?></a></p>
			</div>
		</section>

	</main>

	<?php
	get_template_part(
		'template-parts/contact-cta',
		null,
		array(
			'eyebrow' => __( 'Hai un progetto in mente ?', 'immensive' ),
			'heading' => 'INIZIAMO',
			'label'   => __( 'Contattaci', 'immensive' ),
			'href'    => home_url( '/contatti/' ),
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
