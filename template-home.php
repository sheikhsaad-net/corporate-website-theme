<?php
/**
 * Template Name: Immensive – Home
 *
 * Split-screen "choose your path" homepage hero: Simulatori VR (Prodotti) on
 * the left, Ricerca & Soluzioni Digitali (Altri Servizi) on the right. Only
 * the hero is custom here — everything else reuses the shared "ih" pieces.
 *
 * Both halves use the real hero photography exported from the Figma file
 * ("Immensive new website" → hero_split2). Hover/focus grows the active half
 * to 62% and reveals its paragraph + CTA; see .ih-splithero in homepage.css
 * for the full state model, and the splitHero block in homepage.js for the
 * .is-active / .is-dim classes that drive it.
 *
 * Neither photo is loading="lazy": both halves are above the fold on
 * every viewport (side by side on desktop, stacked in the first 100vh on
 * mobile), so lazy-loading only delays the LCP here.
 *
 * Deliberately no .ih-flow / contact-cta / footer below the hero — this page
 * is only the split-screen picker, nothing to scroll to. Uses .ih--no-hero
 * so the header keeps its solid dark backdrop instead of the usual
 * transparent-until-scroll state: the header sits over photography on both
 * halves and the nav links are always white.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

$immensive_split_sides = array(
	array(
		'tone'  => 'dark',
		'href'  => home_url( '/prodotti-per-la-formazione/' ),
		'title' => 'SIMULATORI VR<br>PER LA FORMAZIONE',
		'text'  => 'Sviluppiamo soluzioni in Realtà Virtuale per il settore della formazione professionale in ambito aziendale e scolastico, e per la formazione sulla sicurezza nei luoghi di lavoro.',
		'cta'   => 'Vai ai prodotti',
		'img'   => $immensive_img . 'hero-split-simulatori.webp',
		'alt'   => 'Simulatori VR Immensive per la formazione professionale',
	),
	array(
		'tone'  => 'light',
		'href'  => home_url( '/servizi/' ),
		'title' => 'RICERCA &amp;<br>SOLUZIONI DIGITALI',
		'text'  => 'Progettiamo sistemi integrati basati sulle tecnologie immersive e digitali più avanzate. Ogni progetto nasce da un\'analisi attenta delle esigenze del cliente e si trasforma in una soluzione su misura, pensata per funzionare nel mondo reale.',
		'cta'   => 'Scopri le nostre soluzioni',
		'img'   => $immensive_img . 'hero-split-digitale.webp',
		'alt'   => 'Soluzioni digitali e immersive Immensive su desktop, tablet, mobile e visore VR',
	),
);

get_header();
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-splithero" id="ih-hero">
		<?php foreach ( $immensive_split_sides as $immensive_i => $immensive_side ) : ?>
			<?php if ( 1 === $immensive_i ) : ?>
				<span class="ih-splithero__divider" aria-hidden="true">
					<span class="ih-splithero__badge"><span>i</span></span>
				</span>
			<?php endif; ?>

			<a class="ih-splithero__side ih-splithero__side--<?php echo esc_attr( $immensive_side['tone'] ); ?>" href="<?php echo esc_url( $immensive_side['href'] ); ?>">
				<span class="ih-splithero__media" aria-hidden="true">
					<img src="<?php echo esc_url( $immensive_side['img'] ); ?>" alt="<?php echo esc_attr( $immensive_side['alt'] ); ?>" decoding="async" fetchpriority="high">
				</span>
				<span class="ih-splithero__shade" aria-hidden="true"></span>

				<span class="ih-splithero__inner">
					<h2 class="ih-splithero__title"><?php echo wp_kses( $immensive_side['title'], array( 'br' => array() ) ); ?></h2>
					<span class="ih-splithero__reveal">
						<span class="ih-splithero__text"><?php echo esc_html( $immensive_side['text'] ); ?></span>
						<span class="ih-splithero__cta"><?php echo esc_html( $immensive_side['cta'] ); ?> <span aria-hidden="true">&rarr;</span></span>
					</span>
				</span>
			</a>
		<?php endforeach; ?>
	</section>

</div>

<?php
get_footer();
