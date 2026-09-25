<?php
/**
 * Template Name: Immensive – Progetti di Ricerca & Sviluppo
 *
 * The research-and-innovation counterpart to template-soluzioni-culturali.php.
 *
 * Differs from that page in two ways: the hero is a light canvas with green
 * blooms rather than a photo (so it is NOT the pinned .ih-phero — it scrolls
 * normally, matching the design), and the projects grid opens with a pair and
 * closes on the wide card instead of the other way round.
 *
 * "I progetti che abbiamo reso realtà" lists the projects placed on this page
 * from the "Mostra nelle pagine" box on each project (see inc/portfolio.php).
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

/* The four topic chips under the hero copy. */
$immensive_rs_chips = array(
	'Diagnostica medica',
	'Manutenzione assistita',
	'Ricerca applicata',
	'Intelligenza artificiale',
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

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-rshero" id="ih-hero">
		<span class="ih-rshero__blooms" aria-hidden="true"></span>

		<div class="ih-container ih-rshero__inner">
			<h1 class="ih-rshero__title"><?php esc_html_e( 'Progetti di', 'immensive' ); ?><br><?php esc_html_e( 'Ricerca &amp; Sviluppo', 'immensive' ); ?></h1>

			<p class="ih-rshero__text"><?php esc_html_e( "Da oltre 10 anni Immensive realizza progetti di ricerca e sviluppo in collaborazione con aziende, enti di ricerca e università, spesso nell'ambito di bandi regionali, nazionali ed europei. Seguiamo tutte le fasi del progetto: dall'analisi delle esigenze e la valutazione di fattibilità, allo sviluppo, fino alla realizzazione di prototipi funzionanti — dalla diagnostica medica alla manutenzione assistita di apparati complessi.", 'immensive' ); ?></p>

			<a class="ih-rshero__scroll" href="#ih-con-chi-collaboriamo" aria-label="<?php esc_attr_e( 'Vai al contenuto', 'immensive' ); ?>">
				<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</a>

			<ul class="ih-rschips">
				<?php foreach ( $immensive_rs_chips as $immensive_rs_chip ) : ?>
					<li class="ih-rschips__item"><?php echo esc_html( $immensive_rs_chip ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="ih-sccwho" id="ih-con-chi-collaboriamo">
		<div class="ih-container">
			<h2 class="ih-sccwho__heading ih-reveal"><?php esc_html_e( 'Con chi', 'immensive' ); ?><br><?php esc_html_e( 'collaboriamo', 'immensive' ); ?></h2>
			<p class="ih-sccwho__sub ih-reveal"><?php esc_html_e( "Collaboriamo con aziende, enti di ricerca e università su progetti finanziati e non, come partner tecnologico o come capofila, portando competenze di realtà estesa, simulazione e intelligenza artificiale dall'idea al prototipo funzionante.", 'immensive' ); ?></p>

			<ul class="ih-sccwho__grid ih-sccwho__grid--four">
				<?php foreach ( $immensive_rs_who as $immensive_rs_aud ) : ?>
					<li class="ih-sccaud ih-reveal">
						<span class="ih-sccaud__icon" aria-hidden="true"><?php echo $immensive_rs_aud['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?></span>
						<span class="ih-sccaud__label"><?php echo wp_kses( $immensive_rs_aud['label'], array( 'br' => array() ) ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
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
					'wide_first' => false,
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
