<?php
/**
 * Template Name: Immensive – Progetti di Ricerca & Sviluppo
 *
 * Rebuilt from the approved concept (ricerca-e-sviluppo.html): network hero,
 * funded-projects archive (expandable cards), "Con chi collaboriamo" and the
 * project tiles. Shared site header/footer, contact band and theme buttons are
 * kept. Styles: assets/css/ricerca.css (scoped under .svz); scripts:
 * assets/js/ricerca.js — both enqueued only here (immensive_ricerca_assets()
 * in functions.php).
 *
 * The project tiles still list the projects placed on this page from the
 * "Mostra nelle pagine" box on each project (see inc/portfolio.php).
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

$immensive_img = get_template_directory_uri() . '/assets/images/';

// "Esplora il portfolio": the Portfolio page, else the projects archive.
$immensive_portfolio_page = get_page_by_path( 'portfolio' );
$immensive_portfolio_href = $immensive_portfolio_page ? get_permalink( $immensive_portfolio_page ) : get_post_type_archive_link( IMMENSIVE_PORTFOLIO_POST_TYPE );

/*
 * Funded projects archive (expandable cards). Text exactly as in the approved
 * concept; entries marked 'missing' are still to be completed from the official
 * funding documents. Add another project by appending an array here.
 */
$immensive_rs_funded = array(
	array(
		'kicker'    => 'Ricerca & Sviluppo · VR + AR',
		'title'     => 'SMAV',
		'subtitle'  => 'Supporto alla Manutenzione Aumentata e Virtuale',
		'program'   => array( 'POR Campania FESR 2014–2020', 'CUP B78I19000400007', 'Unione Europea · Stato Italiano · Regione Campania' ),
		'copy'      => array(
			'Il progetto'                      => 'Un prototipo hardware e software che combina training immersivo in realtà virtuale e manutenzione assistita in realtà aumentata in un dispositivo indossabile.',
			'Obiettivo e soluzione descritta' => 'Supportare le attività operative e manutentive in ambito aerospaziale e industriale. La scheda ufficiale descrive uno Smart Glass che permette di passare tra modalità VR e AR.',
		),
		'cofunding' => "Unione Europea, Stato Italiano e Regione Campania, nell'ambito del POR Campania FESR 2014–2020.",
		'meta'      => array(
			array( 'label' => 'Programma', 'value' => 'POR Campania FESR 2014–2020' ),
			array( 'label' => 'Asse / Obiettivo specifico', 'value' => array( 'Asse 1 · Ricerca e Innovazione', 'OS 1.1 · Innovazione delle imprese' ) ),
			array( 'label' => 'Azione', 'value' => "1.1.3 · Valorizzazione economica dell'innovazione" ),
			array( 'label' => 'CUP', 'value' => 'B78I19000400007' ),
			array( 'label' => 'Investimento / contributo', 'value' => 'Importi da integrare da documentazione ufficiale', 'missing' => true ),
			array( 'label' => 'Periodo / stato / partner', 'value' => 'Da verificare e integrare', 'missing' => true ),
			array( 'label' => 'Bando / atto di concessione', 'value' => 'Estremi e collegamenti da integrare', 'missing' => true ),
			array( 'label' => 'Risultati e documentazione', 'value' => 'Descrizione e risultati sul sito ufficiale ↗', 'href' => 'https://www.immensive.it/portfolio-item/smav/' ),
			array( 'label' => 'Allegati / sito del programma', 'value' => 'Documenti e URL istituzionali da integrare', 'missing' => true ),
		),
		'logos'     => array(
			'Unione Europea'  => 'logo-unione-europea.webp',
			'Stato Italiano'  => 'logo-repubblica-italiana.webp',
			'Regione Campania' => 'logo-regione-campania.webp',
		),
		'link'      => 'https://www.immensive.it/portfolio-item/smav/',
	),
);

/* Who we collaborate with. Inline SVGs — no extra image requests. */
$immensive_rs_who = array(
	array(
		'label' => 'Aziende',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3 21V3h11v5h7v13H3Zm2-2h7V5H5v14Zm9 0h5v-9h-5v9ZM6.5 7h4v2h-4V7Zm0 4h4v2h-4v-2Zm0 4h4v2h-4v-2Zm9-1h2v2h-2v-2Z"/></svg>',
	),
	array(
		'label' => 'Enti di<br>ricerca',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 2h6v2h-1v5.2l5.4 9.3A2 2 0 0 1 17.7 22H6.3a2 2 0 0 1-1.7-3.5L10 9.2V4H9V2Zm3 9.6-3.1 5.4h6.2L12 11.6Z"/></svg>',
	),
	array(
		'label' => 'Università',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 5.5C10 4 7 3.5 3 4v14c4-.5 7 0 9 1.5 2-1.5 5-2 9-1.5V4c-4-.5-7 0-9 1.5Zm0 2.2c1.7-1 4-1.4 7-1.2v10c-3-.2-5.3.2-7 1.1V7.7Z"/></svg>',
	),
	array(
		'label' => 'Capofila di<br>progetto',
		'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 3a2.6 2.6 0 1 1 0 5.2A2.6 2.6 0 0 1 12 3ZM5 7a2.2 2.2 0 1 1 0 4.4A2.2 2.2 0 0 1 5 7Zm14 0a2.2 2.2 0 1 1 0 4.4A2.2 2.2 0 0 1 19 7ZM12 9.8c2.4 0 4.3 1.5 4.3 3.4V17H7.7v-3.8c0-1.9 1.9-3.4 4.3-3.4ZM5 12.4c.7 0 1.4.1 1.9.4-.7.8-1.1 1.7-1.1 2.7V18H1.5v-2.6c0-1.7 1.6-3 3.5-3Zm14 0c1.9 0 3.5 1.3 3.5 3V18h-4.3v-2.5c0-1-.4-1.9-1.1-2.7.5-.3 1.2-.4 1.9-.4Z"/></svg>',
	),
);

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<main class="svz" id="contenuto">

		<section class="immersive-hero" id="inizio" data-page="ricerca" aria-label="<?php esc_attr_e( 'Ricerca e Sviluppo', 'immensive' ); ?>">
			<div class="research-stage" aria-hidden="true">
				<canvas></canvas>
			</div>
			<div class="shell">
				<p class="ih-new-top"><?php esc_html_e( 'Immensive / Ricerca e Sviluppo', 'immensive' ); ?></p>
				<h1><?php esc_html_e( 'Ricerca.', 'immensive' ); ?><br><?php esc_html_e( 'Sviluppo.', 'immensive' ); ?><br><span class="hero-outline"><?php esc_html_e( 'Possibilità.', 'immensive' ); ?></span></h1>
				<p class="ih-new-copy"><?php esc_html_e( 'Uno spazio dedicato alla ricerca applicata e alla visibilità istituzionale dei progetti finanziati. Obiettivi, programmi, finanziatori e documentazione in schede consultabili.', 'immensive' ); ?></p>
				<div class="ih-new-actions">
					<a class="ih-btn ih-btn--solid" href="#archivio-ricerca"><?php esc_html_e( 'Esplora la ricerca', 'immensive' ); ?></a>
					<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Parliamo del tuo progetto', 'immensive' ); ?></a>
				</div>
				<div class="ih-hero-base">
					<p><?php esc_html_e( 'Dalla sperimentazione', 'immensive' ); ?><br><?php esc_html_e( 'alle applicazioni reali.', 'immensive' ); ?></p>
					<a class="scroll-cue" href="#archivio-ricerca"><?php esc_html_e( 'Scorri per esplorare', 'immensive' ); ?> <span aria-hidden="true"></span>↓</a>
				</div>
			</div>
		</section>

		<section class="funding-archive" id="archivio-ricerca">
			<div class="shell">
				<div class="section-head">
					<div>
						<div class="eyebrow"><?php esc_html_e( 'Visibilità istituzionale', 'immensive' ); ?></div>
						<h2><?php esc_html_e( 'Progetti finanziati.', 'immensive' ); ?><br><?php esc_html_e( 'Informazioni accessibili.', 'immensive' ); ?></h2>
					</div>
					<p><?php esc_html_e( 'Programmi, sostegno ricevuto e documentazione dei progetti di ricerca.', 'immensive' ); ?></p>
				</div>
				<div class="funding-grid">
					<?php foreach ( $immensive_rs_funded as $immensive_fund ) : ?>
						<details class="funding-card">
							<summary>
								<div>
									<span class="funding-kicker"><?php echo esc_html( $immensive_fund['kicker'] ); ?></span>
									<h3><?php echo esc_html( $immensive_fund['title'] ); ?></h3>
									<p><?php echo esc_html( $immensive_fund['subtitle'] ); ?></p>
									<div class="funding-program"><?php echo wp_kses( implode( '<br>', array_map( 'esc_html', $immensive_fund['program'] ) ), array( 'br' => array() ) ); ?></div>
									<span class="funding-open"><?php esc_html_e( 'Finanziamento e documentazione', 'immensive' ); ?> <i aria-hidden="true">+</i></span>
								</div>
							</summary>
							<div class="funding-body">
								<div class="project-copy">
									<?php foreach ( $immensive_fund['copy'] as $immensive_copy_title => $immensive_copy_text ) : ?>
										<div>
											<h4><?php echo esc_html( $immensive_copy_title ); ?></h4>
											<p><?php echo esc_html( $immensive_copy_text ); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="funding">
									<p><strong><?php esc_html_e( 'Cofinanziamento', 'immensive' ); ?></strong><br><?php echo esc_html( $immensive_fund['cofunding'] ); ?></p>
								</div>
								<dl class="project-meta">
									<?php foreach ( $immensive_fund['meta'] as $immensive_meta ) : ?>
										<div>
											<dt><?php echo esc_html( $immensive_meta['label'] ); ?></dt>
											<?php if ( ! empty( $immensive_meta['href'] ) ) : ?>
												<dd><a href="<?php echo esc_url( $immensive_meta['href'] ); ?>"><?php echo esc_html( $immensive_meta['value'] ); ?></a></dd>
											<?php elseif ( ! empty( $immensive_meta['missing'] ) ) : ?>
												<dd class="missing"><?php echo esc_html( $immensive_meta['value'] ); ?></dd>
											<?php else : ?>
												<dd><?php echo wp_kses( implode( '<br>', array_map( 'esc_html', (array) $immensive_meta['value'] ) ), array( 'br' => array() ) ); ?></dd>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</dl>
								<div class="logos" aria-label="<?php esc_attr_e( 'Loghi dei soggetti finanziatori', 'immensive' ); ?>">
									<?php foreach ( $immensive_fund['logos'] as $immensive_logo => $immensive_logo_file ) : ?>
										<div class="logo-slot"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/ricerca/' . $immensive_logo_file ); ?>" alt="<?php echo esc_attr( $immensive_logo ); ?>" loading="lazy" decoding="async"></div>
									<?php endforeach; ?>
								</div>
								<p class="svz-cta svz-cta--left"><a class="ih-btn ih-btn--outline" href="<?php echo esc_url( $immensive_fund['link'] ); ?>"><?php esc_html_e( 'Scheda ufficiale del progetto', 'immensive' ); ?></a></p>
							</div>
						</details>
					<?php endforeach; ?>
				</div>
				<p class="funding-note"><?php esc_html_e( 'L’archivio raccoglie i dati documentati. Gli importi, gli atti e i loghi non disponibili sono indicati nelle singole schede come da integrare.', 'immensive' ); ?></p>
			</div>
		</section>

		<section class="ih-sccwho research-collaborators" id="ih-con-chi-collaboriamo">
			<div class="ih-container">
				<h2 class="ih-sccwho__heading"><?php esc_html_e( 'Con chi', 'immensive' ); ?><br><?php esc_html_e( 'collaboriamo', 'immensive' ); ?></h2>
				<p class="ih-sccwho__sub"><?php esc_html_e( "Collaboriamo con aziende, enti di ricerca e università su progetti finanziati e non, come partner tecnologico o come capofila, portando competenze di realtà estesa, simulazione e intelligenza artificiale dall'idea al prototipo funzionante.", 'immensive' ); ?></p>
				<ul class="ih-sccwho__grid ih-sccwho__grid--four">
					<?php foreach ( $immensive_rs_who as $immensive_aud ) : ?>
						<li class="ih-sccaud">
							<span class="ih-sccaud__icon" aria-hidden="true"><?php echo $immensive_aud['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG. ?></span>
							<span class="ih-sccaud__label"><?php echo wp_kses( $immensive_aud['label'], array( 'br' => array() ) ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>

		<section class="project-gallery" id="progetti-ricerca">
			<div class="shell">
				<div class="eyebrow"><?php esc_html_e( 'Progetti realizzati', 'immensive' ); ?></div>
				<h2><?php esc_html_e( 'I progetti che', 'immensive' ); ?><br><?php esc_html_e( 'abbiamo reso realtà.', 'immensive' ); ?></h2>
				<p class="gallery-intro"><?php esc_html_e( 'Dalle esigenze dei nostri clienti a soluzioni reali.', 'immensive' ); ?></p>
				<?php get_template_part( 'template-parts/projects-grid', null, array( 'tiles' => true ) ); ?>
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
