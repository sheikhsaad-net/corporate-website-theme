<?php
/**
 * Template Name: Immensive – Progetti di Innovazione
 *
 * Third of the services landing pages, after Soluzioni Culturali Creative and
 * Progetti di Ricerca & Sviluppo. Shares their hero (.ih-rshero, minus the
 * topic chips) and their project grid.
 *
 * "Cosa realizziamo" reuses the theme's sticky-stacking card deck rather than
 * a new mechanic: the section keeps the #ih-showcase / #ih-showcase-stack ids
 * the showcase block in homepage.js binds to. Those ids are shared with the
 * Altri Servizi mission deck on purpose — the two live on different templates
 * and never collide (see template-altri-servizi.php).
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

/* The three stacked banner cards. */
$immensive_in_cards = array(
	array(
		'label' => "Soluzioni per l'AEC",
		'desc'  => '',
		'img'   => 'innovazione/immensive_innovazione_aec.webp',
	),
	array(
		'label' => 'Configuratori 3D',
		'desc'  => '',
		'img'   => 'innovazione/immensive_innovazione_configuratori-3d.webp',
	),
	array(
		'label' => 'Applicazioni AR',
		'desc'  => "App di visualizzazione in realtà aumentata per mostrare prodotti nel proprio spazio prima dell'acquisto.",
		'img'   => 'innovazione/immensive_innovazione_ar.webp',
	),
);

/* "Dall'idea al prodotto" — the six process steps. */
$immensive_in_steps = array(
	array( 'title' => 'Analisi esigenze', 'desc' => 'Ascoltiamo il cliente e definiamo obiettivi e requisiti del progetto' ),
	array( 'title' => 'Valutazione di fattibilità', 'desc' => 'Verifichiamo le soluzioni tecniche più adatte' ),
	array( 'title' => 'Progettazione', 'desc' => 'Definiamo interfaccia, contenuti ed esperienza' ),
	array( 'title' => 'Sviluppo', 'desc' => 'Realizziamo la soluzione (configuratore, app AR, ecc.)' ),
	array( 'title' => 'Prototipo e test', 'desc' => 'Verifichiamo il funzionamento con il cliente' ),
	array( 'title' => 'Consegna', 'desc' => "Rilasciamo la soluzione pronta per l'uso reale" ),
);

get_header();
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-rshero" id="ih-hero">
		<span class="ih-rshero__blooms" aria-hidden="true"></span>

		<div class="ih-container ih-rshero__inner">
			<h1 class="ih-rshero__title"><?php esc_html_e( 'Progetti di', 'immensive' ); ?><br><?php esc_html_e( 'Innovazione', 'immensive' ); ?></h1>

			<p class="ih-rshero__text"><?php esc_html_e( "Accanto ai progetti di ricerca, sviluppiamo soluzioni digitali custom per aziende che vogliono innovare il modo in cui i propri prodotti e spazi vengono presentati, configurati e vissuti dai clienti. Dall'AEC, con simulazioni ingegneristiche e visualizzazioni architettoniche avanzate, alla configurazione di ambienti e prodotti in AR e 3D, ogni soluzione è progettata su misura per le esigenze specifiche di chi ci commissiona il progetto.", 'immensive' ); ?></p>

			<a class="ih-rshero__scroll" href="#ih-showcase" aria-label="<?php esc_attr_e( 'Vai al contenuto', 'immensive' ); ?>">
				<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</a>
		</div>
	</section>

	<section class="ih-sccwhat ih-sccwhat--innov" id="ih-showcase">
		<div class="ih-container">
			<h2 class="ih-sccwhat__heading ih-reveal"><?php esc_html_e( 'Cosa realizziamo', 'immensive' ); ?></h2>

			<span class="ih-sccwhat__mark" aria-hidden="true">
				<span class="ih-sccwhat__mark-dot"></span>
				<span class="ih-sccwhat__mark-stem"></span>
			</span>

			<div class="ih-showcase__stack ih-inwhat__stack" id="ih-showcase-stack">
				<?php foreach ( $immensive_in_cards as $immensive_in_card ) : ?>
					<article class="ih-acc ih-acc--innov" style="--acc-img:url('<?php echo esc_url( $immensive_img . $immensive_in_card['img'] ); ?>')">
						<span class="ih-mcard__label"><?php echo esc_html( $immensive_in_card['label'] ); ?></span>
						<?php if ( $immensive_in_card['desc'] ) : ?>
							<p class="ih-mcard__desc"><?php echo esc_html( $immensive_in_card['desc'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-inflow" id="ih-dall-idea-al-prodotto">
		<div class="ih-container">
			<h2 class="ih-inflow__heading ih-reveal"><?php esc_html_e( "Dall'idea al", 'immensive' ); ?><br><?php esc_html_e( 'prodotto', 'immensive' ); ?></h2>

			<ol class="ih-inflow__grid">
				<?php foreach ( $immensive_in_steps as $immensive_in_i => $immensive_in_step ) : ?>
					<li class="ih-instep ih-reveal">
						<span class="ih-instep__num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $immensive_in_i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<h3 class="ih-instep__title"><?php echo esc_html( $immensive_in_step['title'] ); ?></h3>
						<p class="ih-instep__desc"><?php echo esc_html( $immensive_in_step['desc'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="ih-sccprog" id="ih-progetti-realizzati">
		<div class="ih-container">
			<h2 class="ih-sccprog__heading ih-reveal"><?php esc_html_e( 'I progetti che', 'immensive' ); ?><br><?php esc_html_e( 'abbiamo reso realtà', 'immensive' ); ?></h2>
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

<?php
get_footer();
