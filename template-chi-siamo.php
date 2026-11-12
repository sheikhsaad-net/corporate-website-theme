<?php
/**
 * Template Name: Immensive – Chi Siamo
 *
 * Rebuilt from the approved concept (chi-siamo.html): team hero with the four
 * key-figure boxes, mission with the conceptual image, "Perché sceglierci",
 * clients & partners, awards (cards + full list) and testimonials. Shared site
 * header/footer, contact band and theme buttons are kept. Styles:
 * assets/css/chi-siamo.css (scoped under .svz); scripts: assets/js/chi-siamo.js
 * — both enqueued only here (immensive_chi_siamo_assets() in functions.php).
 *
 * Client logos are still read from /assets/images/chi-siamo/clienti/.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<main class="svz" id="contenuto">

	<section class="about-hero" id="inizio">
		<div class="shell">
			<div class="eyebrow"><?php esc_html_e( 'Immensive / Chi siamo', 'immensive' ); ?></div>
			<h1><?php esc_html_e( 'Il team', 'immensive' ); ?><br><?php esc_html_e( 'dietro ogni', 'immensive' ); ?><br><span><?php esc_html_e( 'progetto.', 'immensive' ); ?></span></h1>
			<p class="about-lead"><?php esc_html_e( 'Progettisti, sviluppatori e formatori che lavorano fianco a fianco. Dalla prima idea al collaudo finale, seguiamo internamente lo sviluppo di software, simulatori ed esperienze immersive.', 'immensive' ); ?></p>
			<div class="stats-original">
				<div class="ih-team__grid">
					<?php
					// data-count drives the count-up animation (see homepage.js);
					// 'sep' switches the running value to Italian thousands (20.000).
					$immensive_team_stats = array(
						array( 'tone' => 'dark', 'count' => 40, 'sep' => false, 'plus' => true, 'label' => 'Progetti sviluppati con successo' ),
						array( 'tone' => 'green', 'count' => 20000, 'sep' => true, 'plus' => true, 'label' => 'Ore di sviluppo' ),
						array( 'tone' => 'light', 'count' => 10, 'sep' => false, 'plus' => true, 'label' => 'Premi vinti dai prodotti' ),
						array( 'tone' => 'green', 'count' => 10, 'sep' => false, 'plus' => false, 'label' => 'Anni di esperienza' ),
					);
					foreach ( $immensive_team_stats as $immensive_stat ) :
						?>
						<div class="ih-team-card ih-team-card--<?php echo esc_attr( $immensive_stat['tone'] ); ?> ih-reveal">
							<p class="ih-team-card__num">
								<span class="ih-stat__number" data-count="<?php echo esc_attr( (string) $immensive_stat['count'] ); ?>"<?php echo $immensive_stat['sep'] ? ' data-format="it"' : ''; ?>><?php echo esc_html( $immensive_stat['sep'] ? number_format( $immensive_stat['count'], 0, ',', '.' ) : (string) $immensive_stat['count'] ); ?></span><?php if ( $immensive_stat['plus'] ) : ?><span class="ih-team-card__plus">+</span><?php endif; ?>
							</p>
							<p class="ih-team-card__label"><?php echo esc_html( $immensive_stat['label'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="about-mission" id="missione">
		<div class="shell">
			<div class="eyebrow"><?php esc_html_e( 'La nostra missione', 'immensive' ); ?></div>
			<h2><?php esc_html_e( 'Dalle idee', 'immensive' ); ?><br><?php esc_html_e( 'all’esperienza.', 'immensive' ); ?></h2>
			<div class="mission-stage">
				<figure class="about-photo">
					<img src="<?php echo esc_url( $immensive_img . 'chi-siamo/missione.webp' ); ?>" alt="<?php esc_attr_e( 'Un nastro scultoreo in vetro fumé prende forma da filamenti digitali, illuminato da accenti verdi', 'immensive' ); ?>" loading="lazy" width="1122" height="1402">
				</figure>
				<div class="about-copy">
					<span class="mission-kicker"><?php esc_html_e( 'Tecnologia, nella pratica.', 'immensive' ); ?></span>
					<h3><?php esc_html_e( 'Creare strumenti.', 'immensive' ); ?><br><?php esc_html_e( 'Aprire possibilità.', 'immensive' ); ?></h3>
					<p><?php esc_html_e( 'Trasformiamo le idee in esperienze e strumenti digitali che le persone possano usare: per imparare, lavorare, esplorare un luogo o scoprire una storia.', 'immensive' ); ?></p>
					<p><?php esc_html_e( 'Ascoltiamo le esigenze, progettiamo l’esperienza e sviluppiamo la soluzione. Realtà estesa, software e intelligenza artificiale entrano in gioco quando servono a raggiungere l’obiettivo.', 'immensive' ); ?></p>
					<p class="svz-cta svz-cta--left"><a class="ih-btn ih-btn--outline" href="<?php echo esc_url( home_url( '/servizi/#servizi' ) ); ?>"><?php esc_html_e( 'Scopri cosa sviluppiamo', 'immensive' ); ?></a></p>
				</div>
			</div>
		</div>
	</section>

	<section class="about-method">
		<div class="shell">
			<div class="eyebrow"><?php esc_html_e( 'Perché sceglierci', 'immensive' ); ?></div>
			<h2><?php esc_html_e( 'Competenze diverse.', 'immensive' ); ?><br><?php esc_html_e( 'Un unico partner.', 'immensive' ); ?></h2>
			<p><?php esc_html_e( 'Qualità degli ambienti digitali, interazioni naturali e attenzione all’esperienza d’uso accompagnano tutto il percorso, dall’analisi al collaudo.', 'immensive' ); ?></p>
			<?php
			$immensive_method = array(
				array( 'Esperienze immersive', 'Applicazioni XR e simulatori che mettono le persone al centro dell’esperienza.' ),
				array( 'Interazione e UX', 'Interfacce e modalità di utilizzo progettate intorno alle attività da svolgere.' ),
				array( 'Competenze trasversali', 'Software, 3D, hardware e AI si combinano in funzione del progetto.' ),
				array( 'Soluzioni personalizzate', 'Ogni soluzione nasce dalle esigenze e dal contesto del cliente.' ),
				array( 'Approccio consulenziale', 'Analisi, confronto e progettazione accompagnano le scelte tecniche.' ),
				array( 'Esperienza pluripremiata', 'I riconoscimenti ricevuti raccontano il percorso dei nostri prodotti.' ),
			);
			?>
			<div class="about-method-grid">
				<?php foreach ( $immensive_method as $immensive_i => $immensive_point ) : ?>
					<article class="about-method-card">
						<span><?php echo esc_html( sprintf( '%02d', $immensive_i + 1 ) ); ?></span>
						<h3><?php echo esc_html( $immensive_point[0] ); ?></h3>
						<p><?php echo esc_html( $immensive_point[1] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
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
					'year'  => '2025',
					'title' => 'Premio Nazionale Adriano Olivetti – Concorso per le Imprese, I edizione',
					'desc'  => 'Premio conferito al prodotto Forklift-VR Simulator, simulatore di realtà virtuale per la movimentazione del carrello elevatore',
				),
				array(
					'year'  => '2025',
					'title' => 'X Premio Eccellenza Formazione',
					'desc'  => 'Menzione Area Digitale e nuovi strumenti "Training aumentato" per la soluzione Electro-VR Simulator, premio promosso dall\'AIF Associazione Italiana Formatori',
				),
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

	<section class="about-testimonials">
		<div class="shell">
			<div class="eyebrow"><?php esc_html_e( 'Relazioni che durano', 'immensive' ); ?></div>
			<h2><?php esc_html_e( 'Testimonianze', 'immensive' ); ?></h2>
			<?php
			$immensive_testimonials = array(
				array(
					'quote' => '“Seri, professionali ed efficienti, ecco perché la squadra Immensive è leader in Italia nel settore di sviluppo applicativi di realtà virtuale immersiva. Collaboriamo da diversi anni e siamo molto soddisfatti del rapporto di fiducia e stima che si è creato.”',
					'name'  => 'Roberto Dentale',
					'role'  => 'IG Students',
				),
				array(
					'quote' => '“Siamo molto soddisfatti della collaborazione con Immensive. Abbiamo apprezzato la capacità di comprendere le nostre esigenze specifiche e di lavorare al nostro fianco: il team è stato professionale e disponibile durante tutto il progetto.”',
					'name'  => 'Mauro Spolzino',
					'role'  => 'Spolzino Termoidraulica',
				),
			);
			?>
			<ul class="named-testimonials">
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
			'href'    => home_url( '/contatti/' ),
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
