<?php
/**
 * Template Name: Immensive – Chi Siamo
 *
 * Uses the shared "ih" header/footer. Opens on the light hero (same canvas as
 * Rivenditori) carrying the team headline and the four key-figure cards.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih ih--light-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--light ih-phero--team" id="ih-hero">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-phero__inner">
			<h1 class="ih-phero__title ih-team__title">IL TEAM<br>DIETRO OGNI PROGETTO.</h1>
			<p class="ih-team__sub"><?php esc_html_e( 'Progettisti, sviluppatori e formatori che lavorano fianco a fianco su ogni simulatore.', 'immensive' ); ?><br><?php esc_html_e( 'Dalla prima idea al collaudo finale, seguiamo tutto internamente.', 'immensive' ); ?></p>

			<div class="ih-team__grid">
				<?php
				// data-count drives the count-up animation (see homepage.js);
				// 'sep' switches the running value to Italian thousands (20.000).
				$immensive_team_stats = array(
					array(
						'tone'  => 'dark',
						'count' => 40,
						'sep'   => false,
						'plus'  => true,
						'label' => 'Progetti sviluppati con successo',
					),
					array(
						'tone'  => 'green',
						'count' => 20000,
						'sep'   => true,
						'plus'  => true,
						'label' => 'Ore di sviluppo',
					),
					array(
						'tone'  => 'light',
						'count' => 10,
						'sep'   => false,
						'plus'  => true,
						'label' => 'Premi vinti dai prodotti',
					),
					array(
						'tone'  => 'green',
						'count' => 10,
						'sep'   => false,
						'plus'  => false,
						'label' => 'Anni di esperienza',
					),
				);
				foreach ( $immensive_team_stats as $immensive_stat ) :
					?>
					<div class="ih-team-card ih-team-card--<?php echo esc_attr( $immensive_stat['tone'] ); ?> ih-reveal">
						<p class="ih-team-card__num">
							<span class="ih-stat__number" data-count="<?php echo esc_attr( (string) $immensive_stat['count'] ); ?>"<?php echo $immensive_stat['sep'] ? ' data-format="it"' : ''; ?>>0</span><?php if ( $immensive_stat['plus'] ) : ?><span class="ih-team-card__plus">+</span><?php endif; ?>
						</p>
						<p class="ih-team-card__label"><?php echo esc_html( $immensive_stat['label'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<div class="ih-flow">

	<section class="ih-mission" id="ih-missione">
		<div class="ih-mission__sticky">
			<div class="ih-mission__headwrap">
				<h2 class="ih-mission__heading">LA NOSTRA MISSIONE</h2>
				<p class="ih-mission__intro"><?php esc_html_e( 'Progettare e sviluppare soluzioni digitali su misura — dalla realtà estesa al software, dall\'AI al mobile — con un unico obiettivo: creare esperienze che lascino il segno.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-mission__content">
			<div class="ih-mission__grid">
				<?php
				$immensive_mission_img = 'cosa_facciamo_img_Tavola-disegno-1-1024x1024.webp';
				$immensive_mission_has = file_exists( get_template_directory() . '/assets/images/' . $immensive_mission_img );
				?>
				<div class="ih-mission__media ih-reveal">
					<?php if ( $immensive_mission_has ) : ?>
						<img src="<?php echo esc_url( $immensive_img . $immensive_mission_img ); ?>" alt="" loading="lazy">
					<?php else : ?>
						<span class="ih-mission__media-ph" aria-hidden="true"></span>
					<?php endif; ?>
				</div>

				<div class="ih-mission__text ih-reveal">
					<h3 class="ih-mission__subheading">COSA<br>FACCIAMO</h3>
					<p class="ih-mission__body"><?php esc_html_e( 'Progettiamo sistemi integrati basati sulle tecnologie immersive e digitali più avanzate: applicazioni XR (VR, AR, MR), simulatori per la formazione, app mobile, software desktop, piattaforme web gestionali, prodotti hardware e integrazioni AI. Ogni progetto nasce da un\'analisi attenta delle esigenze del cliente e si trasforma in una soluzione su misura, pensata per funzionare nel mondo reale.', 'immensive' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-choose" id="ih-perche">
		<div class="ih-container ih-choose__grid">
			<div class="ih-choose__intro ih-reveal">
				<h2 class="ih-choose__heading">PERCHÈ<br>SCEGLIERCI</h2>
				<p class="ih-choose__text"><?php esc_html_e( 'Le nostre soluzioni si caratterizzano per un alto grado di immersività e qualità grafica degli ambienti e dei prodotti. Ogni interazione è fluida e naturale, la User Experience è sempre al centro. Affianchiamo a questo competenze trasversali, un approccio consulenziale e un\'esperienza pluripremiata: un unico partner per ogni esigenza digitale.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--solid ih-choose__cta" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Scopri cosa sviluppiamo', 'immensive' ); ?></a>
			</div>

			<?php
			// Numbers are drawn from a CSS counter on the <li>, so the ordinal
			// isn't duplicated in the markup for screen readers.
			$immensive_choose = array(
				'Alto grado di Immersività',
				'Interazione e UX',
				'Competenze trasversali',
				'Soluzioni 100% personalizzate',
				'Approccio consulenziale',
				'Esperienza pluripremiata',
			);
			?>
			<ol class="ih-choose__list">
				<?php foreach ( $immensive_choose as $immensive_point ) : ?>
					<li class="ih-choose__item ih-reveal"><?php echo esc_html( $immensive_point ); ?></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="ih-clienti" id="ih-clienti">
		<div class="ih-container">
			<p class="ih-clienti__eyebrow ih-reveal"><?php esc_html_e( 'Alcuni dei nostri', 'immensive' ); ?></p>
			<h2 class="ih-clienti__heading ih-reveal">CLIENTI &amp; PARTNERS</h2>

			<?php
			// Drop logo files into /assets/images/chi-siamo/clienti/ — they are
			// picked up automatically, in filename order. Until then the grid
			// renders numbered placeholder tiles so the layout is reviewable.
			$immensive_client_dir   = get_template_directory() . '/assets/images/chi-siamo/clienti/';
			$immensive_client_files = glob( $immensive_client_dir . '*.{webp,png,svg,jpg,jpeg}', GLOB_BRACE );
			?>
			<div class="ih-clienti__grid">
				<?php if ( $immensive_client_files ) : ?>
					<?php foreach ( $immensive_client_files as $immensive_client_file ) : ?>
						<div class="ih-clienti__tile ih-reveal">
							<img src="<?php echo esc_url( $immensive_img . 'chi-siamo/clienti/' . basename( $immensive_client_file ) ); ?>" alt="" loading="lazy">
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<?php for ( $immensive_c = 1; $immensive_c <= 24; $immensive_c++ ) : ?>
						<div class="ih-clienti__tile ih-reveal">
							<span class="ih-clienti__ph" aria-hidden="true">LOGO <?php echo esc_html( str_pad( (string) $immensive_c, 2, '0', STR_PAD_LEFT ) ); ?></span>
						</div>
					<?php endfor; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="ih-successi" id="ih-successi">
		<div class="ih-successi__headwrap ih-reveal">
			<h2 class="ih-successi__heading">I NOSTRI<br>SUCCESSI</h2>
			<span class="ih-successi__trophy" aria-hidden="true">
				<img src="<?php echo esc_url( $immensive_img . 'cup.webp' ); ?>" alt="" width="216" height="216">
			</span>
		</div>

		<div class="ih-container ih-successi__content">
			<p class="ih-successi__sub ih-reveal"><?php esc_html_e( 'Riconosciuti dai leader del settore per l\'eccellenza creativa e la solidità tecnica.', 'immensive' ); ?></p>

			<?php
			$immensive_premi_cards = array(
				array(
					'tone'  => 'dark',
					'file'  => 'vincitore_epic_megagrants_2021.webp',
					'label' => 'Premio Epic Mega Grants 2021',
				),
				array(
					'tone'  => 'light',
					'file'  => 'badge-top-pid-2024.webp',
					'label' => 'Premio Top of the PID 2024 nella categoria Education',
				),
			);
			?>
			<div class="ih-successi__cards">
				<?php
				foreach ( $immensive_premi_cards as $immensive_premio ) :
					$immensive_premio_rel = $immensive_premio['file'];
					$immensive_premio_has = file_exists( get_template_directory() . '/assets/images/' . $immensive_premio_rel );
					?>
					<article class="ih-successi__card ih-successi__card--<?php echo esc_attr( $immensive_premio['tone'] ); ?> ih-reveal">
						<div class="ih-successi__card-media">
							<?php if ( $immensive_premio_has ) : ?>
								<img src="<?php echo esc_url( $immensive_img . $immensive_premio_rel ); ?>" alt="" loading="lazy">
							<?php else : ?>
								<span class="ih-successi__card-ph" aria-hidden="true">LOGO</span>
							<?php endif; ?>
						</div>
						<p class="ih-successi__card-label"><?php echo esc_html( $immensive_premio['label'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<h3 class="ih-successi__subheading ih-reveal"><?php esc_html_e( 'Tutti i nostri premi', 'immensive' ); ?></h3>

			<?php
			// Rendered as a centre-line timeline: entries alternate sides, with
			// the year opposite the award detail (see .ih-awards in the CSS).
			$immensive_awards = array(
				array(
					'year'  => '2024',
					'title' => 'Premio Top of the PID nella categoria Education',
					'desc'  => '',
				),
				array(
					'year'  => '2024',
					'title' => 'IX Premio Eccellenza Formazione',
					'desc'  => 'Vincitori del IX Premio Eccellenza Formazione promosso dall\'AIF Associazione Italiana Formatori per l\'area digitale e nuove tecnologie',
				),
				array(
					'year'  => '2023',
					'title' => 'VIII Premio Eccellenza Formazione',
					'desc'  => 'Vincitori del VIII Premio Eccellenza Formazione promosso dall\'AIF Associazione Italiana Formatori per l\'area digitale e nuove tecnologie',
				),
				array(
					'year'  => '2022',
					'title' => 'Premio Campioni d\'InnovAzioni PMI',
					'desc'  => 'Vincitori del premio nazionale "Campioni d\'InnovAzioni" della Sezione Servizi Innovativi di Confindustria Chieti Pescara conferito al progetto UniVRsafe',
				),
				array(
					'year'  => '2022',
					'title' => 'XVI Premio Best Practices per l\'innovazione',
					'desc'  => '',
				),
				array(
					'year'  => '2021',
					'title' => 'Premio innovazione Smau Napoli',
					'desc'  => 'Firefighter VR Simulator',
				),
				array(
					'year'  => '2021',
					'title' => 'Premio EPIC Mega Grants',
					'desc'  => '',
				),
				array(
					'year'  => '2021',
					'title' => 'Premio Top of The PID',
					'desc'  => '',
				),
				array(
					'year'  => '2020',
					'title' => 'Premio innovazione Smau Milano',
					'desc'  => 'Weld VR Simulator',
				),
				array(
					'year'  => '2019',
					'title' => 'Premio innovazione Smau Napoli',
					'desc'  => 'progetto Gragnano Experience, uno storytelling immersivo e multisensoriale.',
				),
				array(
					'year'  => '2017',
					'title' => 'GGI CONFINDUSTRIA – SMAU',
					'desc'  => 'Vincitori del premio Lamarck, riconoscimento conferito alle start-up più promettenti dell\'evento.',
				),
			);
			?>
			<ol class="ih-awards">
				<?php foreach ( $immensive_awards as $immensive_award ) : ?>
					<li class="ih-awards__item ih-reveal">
						<span class="ih-awards__year"><?php echo esc_html( $immensive_award['year'] ); ?></span>
						<div class="ih-awards__detail">
							<h4 class="ih-awards__title"><?php echo esc_html( $immensive_award['title'] ); ?></h4>
							<?php if ( $immensive_award['desc'] ) : ?>
								<p class="ih-awards__desc"><?php echo esc_html( $immensive_award['desc'] ); ?></p>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="ih-pbanner">
		<div class="ih-container">
			<?php // Same artwork as the homepage "Formazione 4.0" banner. ?>
			<div class="ih-pbanner__inner ih-reveal" style="background-image: url( '<?php echo esc_url( $immensive_img . 'formazione-bg.webp' ); ?>' );">
				<p class="ih-pbanner__text"><?php esc_html_e( 'Scopri i nostri ultimi lavori', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--solid ih-pbanner__cta" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Guarda il portfolio', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ih-testi" id="ih-testimonianze">
		<h2 class="ih-testi__heading ih-reveal">TESTIMONIANZE</h2>

		<?php
		$immensive_testimonials = array(
			array(
				'quote'  => '“Seri, professionali ed efficienti, ecco perché la squadra Immensive è leader in Italia nel settore di sviluppo applicativi di realtà virtuale immersiva. Collaboriamo da diversi anni e siamo molto soddisfatti del rapporto di fiducia e stima che si è creato.”',
				'name'   => 'Roberto Dentale',
				'role'   => 'IG Students',
			),
			array(
				'quote'  => '“Siamo molto soddisfatti della collaborazione con Immensive. Abbiamo apprezzato la capacità di comprendere le nostre esigenze specifiche e di lavorare al nostro fianco: il team è stato professionale e disponibile durante tutto il progetto.”',
				'name'   => 'Mauro Spolzino',
				'role'   => 'Spolzino Termoidraulica',
			),
			array(
				'quote'  => '“Un partner tecnologico affidabile, capace di tradurre esigenze formative complesse in strumenti concreti e semplici da usare in aula.”',
				'name'   => 'Nome Cognome',
				'role'   => 'Azienda',
			),
			array(
				'quote'  => '“La qualità grafica e il realismo delle simulazioni hanno superato le nostre aspettative, con un impatto immediato sul coinvolgimento dei corsisti.”',
				'name'   => 'Nome Cognome',
				'role'   => 'Azienda',
			),
		);
		?>
		<div class="ih-testi__viewport" id="ih-testi-viewport">
			<ul class="ih-testi__track">
				<?php foreach ( $immensive_testimonials as $immensive_t ) : ?>
					<li class="ih-testi__card">
						<p class="ih-testi__quote"><?php echo esc_html( $immensive_t['quote'] ); ?></p>
						<p class="ih-testi__author">
							<span class="ih-testi__name"><?php echo esc_html( $immensive_t['name'] ); ?></span>
							<span class="ih-testi__role"><?php echo esc_html( $immensive_t['role'] ); ?></span>
						</p>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="ih-testi__controls">
			<button type="button" class="ih-testi__nav" data-dir="-1" aria-label="<?php esc_attr_e( 'Testimonianza precedente', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
			<div class="ih-testi__progress"><span class="ih-testi__progress-bar" id="ih-testi-bar"></span></div>
			<button type="button" class="ih-testi__nav" data-dir="1" aria-label="<?php esc_attr_e( 'Testimonianza successiva', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
		</div>
	</section>

	<?php get_template_part( 'template-parts/contact-cta' ); ?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
