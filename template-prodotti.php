<?php
/**
 * Template Name: Immensive – Prodotti
 *
 * Landing page template matching the Immensive Figma design.
 * Originally built as the site's homepage template; now assigned to the
 * Prodotti page at /prodotti-per-la-formazione/. Content/markup unchanged —
 * only the page it's assigned to and this file's name/label changed.
 * Assign it to any page via Page Attributes > Template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-hero" id="ih-hero">
		<div class="ih-hero__glow" aria-hidden="true"></div>

		<div class="ih-hero__inner">
			<div class="ih-hero__head">
				<h1 class="ih-hero__title">
					SIMULATORI VR<br>
					PER LA <em id="ih-hero-accent">FORMAZIONE</em>
				</h1>
				<div class="ih-hero__counter" aria-hidden="true">
					<span class="ih-hero__counter-num" id="ih-hero-num">01</span>
					<span class="ih-hero__counter-bar"></span>
					<span class="ih-hero__counter-total">04</span>
				</div>
			</div>

			<div class="ih-slider" id="ih-slider">
				<?php
				$immensive_slides = array(
					array(
						'img'   => 'hero-weld-vr.webp',
						'name'  => 'Weld VR',
						'tag'   => 'Formazione professionale alla saldatura in VR',
						'color' => '#69ceeb',
					),
					array(
						'img'   => 'hero-forklift-vr.webp',
						'name'  => 'Forklift VR',
						'tag'   => 'Addestramento immersivo per carrellisti',
						'color' => '#f2b90d',
					),
					array(
						'img'   => 'hero-firefighter-vr.webp',
						'name'  => 'Firefighter VR',
						'tag'   => 'Simulazione avanzata per emergenze antincendio',
						'color' => '#e8503a',
					),
					array(
						'img'   => 'hero-electro-vr.webp',
						'name'  => 'Electro VR',
						'tag'   => 'Training VR per operatori su impianti elettrici',
						'color' => '#f7971e',
					),
				);
				foreach ( $immensive_slides as $i => $slide ) :
					?>
					<article
						class="ih-slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
						data-index="<?php echo (int) $i; ?>"
						data-color="<?php echo esc_attr( $slide['color'] ); ?>"
						style="--c:<?php echo esc_attr( $slide['color'] ); ?>"
						tabindex="0"
						role="button"
						aria-label="<?php echo esc_attr( $slide['name'] ); ?>"
					>
						<img class="ih-slide__bg" src="<?php echo esc_url( $immensive_img . $slide['img'] ); ?>" alt="<?php echo esc_attr( $slide['name'] ); ?>" <?php echo 0 === $i ? '' : 'loading="lazy"'; ?> width="700" height="500">
						<div class="ih-slide__shade" aria-hidden="true"></div>
						<div class="ih-slide__body">
							<h3 class="ih-slide__name"><?php echo esc_html( $slide['name'] ); ?></h3>
							<p class="ih-slide__tag"><?php echo esc_html( $slide['tag'] ); ?></p>
							<div class="ih-slide__details">
								<a class="ih-slide__cta" href="#ih-contact">
									<?php esc_html_e( 'Scopri il Prodotto', 'immensive' ); ?>
									<span class="ih-slide__cta-arrow" aria-hidden="true">&rarr;</span>
								</a>
							</div>
						</div>
						<div class="ih-slide__progress" aria-hidden="true"></div>
					</article>
					<?php
				endforeach;
				?>
			</div>
		</div>

		<div class="ih-hero__footer">
			<div class="ih-hero__actions">
				<a class="ih-btn ih-btn--outline" href="#ih-contact"><?php esc_html_e( 'Richiedi una Demo', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--outline ih-btn--tint" href="<?php echo esc_url( home_url( '/piani/' ) ); ?>"><?php esc_html_e( 'Scopri i Piani', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--outline" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Diventa Distributore', 'immensive' ); ?></a>
			</div>

			<div class="ih-hero__badges">
				<div class="ih-hero__badges-inner">
					<div class="ih-hero__badge">
						<span class="ih-hero__badge-num" aria-hidden="true">260<sup>+</sup></span>
						<div class="ih-hero__badge-text">
							<span class="ih-hero__badge-title"><?php esc_html_e( 'Licenze installate', 'immensive' ); ?></span>
							<p class="ih-hero__badge-sub"><?php esc_html_e( 'In azienda, scuole ed enti di formazione', 'immensive' ); ?></p>
						</div>
					</div>

					<div class="ih-hero__badge">
						<img src="<?php echo esc_url( $immensive_img . 'badge-top-pid-2024.webp' ); ?>" alt="<?php esc_attr_e( 'Top of the PID 2024', 'immensive' ); ?>" loading="lazy" width="120" height="120">
						<div class="ih-hero__badge-text">
							<span class="ih-hero__badge-title"><?php esc_html_e( 'Top of the PID 2024', 'immensive' ); ?></span>
							<p class="ih-hero__badge-sub"><?php esc_html_e( 'Premio per l&rsquo;innovazione digitale', 'immensive' ); ?></p>
						</div>
					</div>

					<div class="ih-hero__badge">
						<img src="<?php echo esc_url( $immensive_img . 'badge-unreal-training-center.webp' ); ?>" alt="<?php esc_attr_e( 'Unreal Authorized Training Center', 'immensive' ); ?>" loading="lazy" width="120" height="120">
						<div class="ih-hero__badge-text">
							<span class="ih-hero__badge-title"><?php esc_html_e( 'Unreal Authorized Training Center', 'immensive' ); ?></span>
							<p class="ih-hero__badge-sub"><?php esc_html_e( 'Centro ufficiale di formazione Unreal Engine', 'immensive' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="ih-flow">

	<section class="ih-realities" id="ih-realities">
		<div class="ih-realities__sticky">
			<h2 class="ih-realities__heading">PENSATI PER<br>OGNI REALTÀ</h2>
		</div>

		<div class="ih-container ih-realities__cards">
			<div class="ih-reality-grid">
				<?php
				$immensive_realities = array(
					array(
						'img'   => 'usecase-aziende.webp',
						'alt'   => 'Aziende manifatturiere',
						'title' => 'Aziende<br>Manifatturiere',
						'cat'   => 'HR, Training, RSPP',
						'desc'  => 'Riduci sprechi e infortuni.<br>Misura ogni competenza.',
					),
					array(
						'img'   => 'usecase-scuola.webp',
						'alt'   => 'Ambiente scuola',
						'title' => 'Ambiente<br>Scuola',
						'cat'   => 'CFP, ITS, APL',
						'desc'  => 'Laboratori più sicuri,<br>costi minori,<br>studenti più preparati.',
					),
					array(
						'img'   => 'usecase-formazione.webp',
						'alt'   => 'Enti di formazione',
						'title' => 'Enti di<br>Formazione',
						'cat'   => 'CFP, ITS, APL',
						'desc'  => 'Più ore-allievo,<br>meno costi per ora.',
					),
				);
				foreach ( $immensive_realities as $i => $card ) :
					?>
					<article class="ih-reality-card ih-reveal" style="--ih-card-i:<?php echo (int) $i; ?>">
						<img src="<?php echo esc_url( $immensive_img . $card['img'] ); ?>" alt="<?php echo esc_attr( $card['alt'] ); ?>" loading="lazy" width="900" height="1280">
						<div class="ih-reality-card__grad" aria-hidden="true"></div>
						<div class="ih-reality-card__top">
							<h3><?php echo wp_kses( $card['title'], array( 'br' => array() ) ); ?></h3>
							<p class="ih-reality-card__cat"><?php echo esc_html( $card['cat'] ); ?></p>
						</div>
						<div class="ih-reality-card__bottom">
							<p class="ih-reality-card__desc"><?php echo wp_kses( $card['desc'], array( 'br' => array() ) ); ?></p>
							<a class="ih-reality-card__scopri" href="#ih-contact">
								<?php esc_html_e( 'Scopri', 'immensive' ); ?>
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</a>
						</div>
					</article>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</section>

	<section class="ih-why" id="ih-why">
		<div class="ih-why__sticky">
			<div class="ih-why__intro">
				<h2 class="ih-why__title">PERCHÉ FARE FORMAZIONE<br>CON LA REALTÀ VIRTUALE</h2>
				<p class="ih-why__sub"><?php esc_html_e( 'I principali benefici per le Aziende, le scuole e gli enti formativi che scelgono di erogare percorsi formativi integrando soluzioni in realtà virtuale sono:', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-why__cards">
			<div class="ih-why-grid">
				<?php
				$immensive_why = array(
					array(
						'n'     => '01',
						'title' => 'Rischi Zero per il Discente',
						'desc'  => 'L\'allievo si esercita in totale sicurezza: nessun rischio di infortunio in fase di apprendimento. Risposta concreta agli obblighi del D.Lgs. 81/08.',
						'tone'  => 'dark',
						'icon'  => 'icons/icon-eco.webp',
					),
					array(
						'n'     => '02',
						'title' => 'Materiale di Consumo Azzerato',
						'desc'  => 'Ogni esercitazione si ripete tutte le volte che serve senza consumare materiali reali. Nessuno spreco, nessuna ricarica, nessun limite alla pratica.',
						'tone'  => 'gradient',
						'icon'  => '',
					),
					array(
						'n'     => '03',
						'title' => 'Costi Formativi Abbattuti',
						'desc'  => 'Niente cabine dedicate, niente attrezzature in dotazione, nessun tempo macchina sottratto alla produzione: il costo per allievo formato si abbassa in modo strutturale.',
						'tone'  => 'gray',
						'icon'  => 'icons/icon-costi.webp',
					),
					array(
						'n'     => '04',
						'title' => 'Impatto Ambientale Ridotto',
						'desc'  => 'Zero emissioni di gas e fumi, zero rifiuti speciali, consumi energetici minimi. Una formazione sostenibile e allineata ai criteri ESG sempre più richiesti.',
						'tone'  => 'gray',
						'icon'  => '',
					),
					array(
						'n'     => '05',
						'title' => 'Learning by Doing Reale',
						'desc'  => 'L\'allievo impara facendo: ripete il gesto, sbaglia in sicurezza, corregge subito. I tempi di apprendimento si riducono fino a 1/3.',
						'tone'  => 'white',
						'icon'  => 'icons/icon-efficace.webp',
					),
					array(
						'n'     => '06',
						'title' => 'Performance Misurata e Certificabile',
						'desc'  => 'Ogni esercizio genera un report oggettivo: parametri tecnici, errori, tempi, progressi. Uno strumento concreto per HR, formatori e rendicontazione bandi (Formazione 4.0, FSE+, Fondimpresa).',
						'tone'  => 'green',
						'icon'  => '',
					),
				);
				foreach ( $immensive_why as $card ) :
					?>
					<div class="ih-why-card ih-why-card--<?php echo esc_attr( $card['tone'] ); ?> ih-reveal">
						<div class="ih-why-card__head">
							<span class="ih-why-card__icon" aria-hidden="true">
								<?php if ( $card['icon'] ) : ?>
									<img src="<?php echo esc_url( $immensive_img . $card['icon'] ); ?>" alt="" width="46" height="46" loading="lazy" decoding="async">
								<?php endif; ?>
							</span>
							<span class="ih-why-card__number"><?php echo esc_html( $card['n'] ); ?></span>
						</div>
						<h3 class="ih-why-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="ih-why-card__desc"><?php echo esc_html( $card['desc'] ); ?></p>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
	</section>

	<section class="ih-banner" style="background-image: url( '<?php echo esc_url( $immensive_img . 'formazione-bg.webp' ); ?>' );">
		<div class="ih-banner__content ih-reveal">
			<p class="ih-banner__eyebrow"><?php esc_html_e( 'I simulatori Immensive rientrano nel piano', 'immensive' ); ?></p>
			<h2 class="ih-banner__title">FORMAZIONE 4.0</h2>
			<span class="ih-banner__rule" aria-hidden="true"></span>
			<p class="ih-banner__sub"><?php echo wp_kses_post( __( 'Accedi al <strong>credito d\'imposta</strong> per la formazione professionale.', 'immensive' ) ); ?></p>
		</div>
	</section>

	<section class="ih-stats">
		<div class="ih-container">
			<h2 class="ih-stats__title ih-reveal">I NUMERI PARLANO<br>PER NOI</h2>
			<div class="ih-stats__grid">
				<div class="ih-stat ih-stat--dark ih-reveal">
					<span class="ih-stat__number" data-count="350">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Licenze vendute', 'immensive' ); ?></p>
				</div>
				<div class="ih-stat ih-stat--green ih-reveal">
					<span class="ih-stat__number" data-count="200">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Clienti in Italia', 'immensive' ); ?></p>
				</div>
				<div class="ih-stat ih-stat--muted ih-reveal">
					<span class="ih-stat__number" data-count="10">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Premi vinti dai prodotti', 'immensive' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-leader">
		<div class="ih-container ih-leader__grid">
			<div class="ih-leader__intro ih-reveal">
				<p class="ih-leader__eyebrow"><?php esc_html_e( 'Chi siamo', 'immensive' ); ?></p>
				<h2 class="ih-leader__title">LEADER IN ITALIA NEI<br>SIMULATORI VR PER<br>LA FORMAZIONE TECNICA</h2>
				<p class="ih-leader__text"><?php esc_html_e( 'Siamo una PMI innovativa premiata a livello nazionale per l\'innovazione applicata alla didattica immersiva.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--solid ih-leader__cta" href="#ih-contact"><?php esc_html_e( 'Conosci il Team', 'immensive' ); ?> <span aria-hidden="true">&rarr;</span></a>
			</div>

			<div class="ih-leader__bento ih-reveal">
				<div class="ih-leader__card ih-leader__loc">
					<span class="ih-leader__dot" aria-hidden="true"></span>
					<span><?php esc_html_e( 'Caserta, Italia · dal 2016', 'immensive' ); ?></span>
				</div>

				<div class="ih-leader__card">
					<span class="ih-leader__num"><span class="ih-stat__number" data-count="60">0</span><span class="ih-leader__plus">+</span></span>
					<span class="ih-leader__label"><?php esc_html_e( 'Progetti', 'immensive' ); ?></span>
				</div>

				<div class="ih-leader__card">
					<span class="ih-leader__num"><span class="ih-stat__number" data-count="20000" data-suffix="K">0</span><span class="ih-leader__plus">+</span></span>
					<span class="ih-leader__label"><?php esc_html_e( 'Ore di sviluppo', 'immensive' ); ?></span>
				</div>

				<div class="ih-leader__card ih-leader__card--wide">
					<p class="ih-leader__num"><span class="ih-stat__number" data-count="11">0</span> <span class="ih-accent"><?php esc_html_e( 'Premi Nazionali', 'immensive' ); ?></span></p>
					<span class="ih-leader__label"><?php esc_html_e( 'Innovazione e Didattica', 'immensive' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/contact-cta' ); ?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
