<?php
/**
 * Template Name: Immensive – Academy
 *
 * Mirrors the live immensive.it/academy/ page (hero, step formativi, perché
 * sceglierci, banner Unreal, modalità di svolgimento, corsi, piattaforma
 * e-learning, tutor, prossime date, come iscriversi, gallery, contact form),
 * rebuilt on this theme's current "ih" design system rather than copying the
 * old page's markup. Reuses existing ih-* components (site-header/footer,
 * the .ih-pgap numbered-step pattern, .ih-pbenefici card grid, .ih-casi
 * carousel, the #ih-cont-form contact form) so it inherits their styling,
 * scroll-reveal and JS wiring instead of duplicating them.
 *
 * The section anchors (Step Formativi, Corsi, Tutor, ...) live in the
 * "Academy Menu" nav_menu assigned to the 'academy' theme location, shown in
 * the main site-header nav only on this page — see immensive_get_nav_choice()
 * / immensive_get_nav_theme_location() in functions.php — rather than in a
 * page-specific sticky sub-nav.
 *
 * Uses the shared "ih" header/footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';
$immensive_aca = $immensive_img . 'academy/';

$immensive_contatti_page = get_page_by_path( 'contatti' );
$immensive_contatti_url  = $immensive_contatti_page ? get_permalink( $immensive_contatti_page ) : home_url( '/contatti/' );

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--altri ih-phero--academy" id="ih-hero">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-acad-hero__inner">
			<img class="ih-acad-hero__logo" src="<?php echo esc_url( $immensive_aca . 'logo-academy.png' ); ?>" alt="Immensive Academy" width="470" height="133">
			<p class="ih-acad-hero__sub"><?php esc_html_e( 'Specializzati nelle nuove arti digitali. Scopri i prossimi corsi in aula e online tenuti da professionisti del settore.', 'immensive' ); ?></p>

			<div class="ih-acad-hero__badge-row">
				<img class="ih-acad-hero__badge" src="<?php echo esc_url( $immensive_aca . 'badge-unreal.png' ); ?>" alt="" width="64" height="64" loading="lazy">
				<p class="ih-acad-hero__badge-text"><?php esc_html_e( 'Centro di Formazione', 'immensive' ); ?><br><?php esc_html_e( 'Autorizzato Unreal', 'immensive' ); ?></p>
			</div>
		</div>
	</section>

	<?php
	/**
	 * No page-specific sticky sub-nav here — the section links (Step
	 * Formativi, Perché Sceglierci, Corsi, Piattaforma, Tutor, Date, Come
	 * Iscriversi, Iscriviti Ora) live in the "Academy Menu" nav_menu instead,
	 * assigned to the 'academy' theme location and shown in the main
	 * site-header nav only on this page (see immensive_get_nav_choice() /
	 * this page's "Menu di navigazione" setting in functions.php).
	 */
	?>

	<div class="ih-flow">

	<section class="ih-acad-intro" id="ih-perche-vr">
		<div class="ih-container ih-acad-intro__grid">
			<div class="ih-acad-intro__media ih-reveal">
				<img src="<?php echo esc_url( $immensive_aca . 'perche-vr.webp' ); ?>" alt="" loading="lazy" width="773" height="1000">
			</div>
			<div class="ih-acad-intro__inner ih-reveal">
				<h2 class="ih-acad-intro__heading"><?php esc_html_e( 'Perché specializzarsi nelle nuove arti digitali e VR', 'immensive' ); ?></h2>
				<p class="ih-acad-intro__text"><?php esc_html_e( 'Il settore della virtualizzazione sta crescendo costantemente. Sempre più aziende scelgono di affidarsi alle nuove tecnologie virtuali di rappresentazione e simulazione. Ad oggi figure professionali in grado di stare al passo con le nuove arti digitali sono sempre più richieste in settori quali Automotive, Architettura, Costruzioni, Arredamenti, Moda.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--ghost-dark ih-acad-intro__cta" href="#ih-step"><?php esc_html_e( 'Step Formativi', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ih-acad-step" id="ih-step">
		<div class="ih-container">
			<h2 class="ih-acad-step__heading"><?php esc_html_e( 'Processo e Step Formativi', 'immensive' ); ?></h2>
			<p class="ih-acad-step__intro"><?php esc_html_e( 'Percorsi di studio creati e condotti da professionisti che operano da anni nel settore della computer grafica e dello sviluppo VR.', 'immensive' ); ?></p>

			<?php
			$immensive_steps = array(
				array(
					'title' => 'Registrazione',
					'desc'  => 'Crea il tuo account',
					'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-4.4 0-9 2.2-9 5v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2c0-2.8-4.6-5-9-5Z"/></svg>',
				),
				array(
					'title' => 'Teoria',
					'desc'  => 'Apprendi nozioni da docenti esperti',
					'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 5.5C10 4 7 3.5 3 4v14c4-.5 7 0 9 1.5 2-1.5 5-2 9-1.5V4c-4-.5-7 0-9 1.5Zm0 2.2c1.7-1 4-1.4 7-1.2v10c-3-.2-5.3.2-7 1.1V7.7Z"/></svg>',
				),
				array(
					'title' => 'Laboratorio',
					'desc'  => "Lavora su un progetto con l'ausilio del docente",
					'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="m3 21 3.6-1.1L18.4 8.1a1.5 1.5 0 0 0 0-2.1l-1.4-1.4a1.5 1.5 0 0 0-2.1 0L3.1 16.4 2 20l1 1Zm4.1-2.6-1.5-1.5 9.6-9.6 1.5 1.5-9.6 9.6ZM19 3l1 2 2 1-2 1-1 2-1-2-2-1 2-1 1-2Z"/></svg>',
				),
				array(
					'title' => 'Esame Finale',
					'desc'  => 'Dimostraci cosa hai imparato',
					'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Zm8 1.5V8h4.5L14 3.5ZM7 12h10v2H7v-2Zm0 4h10v2H7v-2Zm0-8h5v2H7V8Z"/></svg>',
				),
				array(
					'title' => 'Attestato',
					'desc'  => 'Ottieni il tuo certificato tracciabile',
					'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 15.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Zm0-9a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7ZM8.6 16.7 6 22l6-2 6 2-2.6-5.3-1.9.9L12 18.6l-1.5-1-1.9-.9Z"/></svg>',
				),
			);
			$immensive_steps_count = count( $immensive_steps );
			?>
			<div class="ih-acad-step__row">
				<?php foreach ( $immensive_steps as $immensive_i => $immensive_step ) : ?>
					<article class="ih-acad-step__card ih-reveal">
						<span class="ih-acad-step__icon"><?php echo $immensive_step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG, not user input. ?></span>
						<h3 class="ih-acad-step__title"><?php echo esc_html( $immensive_step['title'] ); ?></h3>
						<p class="ih-acad-step__desc"><?php echo esc_html( $immensive_step['desc'] ); ?></p>
					</article>
					<?php if ( $immensive_i < $immensive_steps_count - 1 ) : ?>
						<span class="ih-acad-step__arrow" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none"><path d="M5 12h13M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</span>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pbenefici" id="ih-perche">
		<div class="ih-container">
			<h2 class="ih-pbenefici__heading"><?php esc_html_e( 'Immensive Academy — Perché formarsi con noi', 'immensive' ); ?></h2>
			<p class="ih-pbenefici__sub"><?php esc_html_e( 'Siamo un pool di professionisti che da anni studia e sperimenta sul campo soluzioni innovative di Realtà Virtuale, Aumentata e Mista.', 'immensive' ); ?></p>

			<?php
			$immensive_perche = array(
				array(
					'tone'  => 'dark',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3 2 8l10 5 10-5-10-5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M6 11v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
					'title' => 'Corsi Professionalizzanti',
					'desc'  => 'Che preparano al mondo del lavoro.',
				),
				array(
					'tone'  => 'light',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="4.5" width="18" height="12" rx="1.5" stroke="currentColor" stroke-width="1.4"/><path d="M8 20h8M12 16.5V20" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'title' => 'Lezioni in Aula e Online',
					'desc'  => 'Tenute da esperti del settore.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="8.5" cy="8" r="2.6" stroke="currentColor" stroke-width="1.4"/><circle cx="16" cy="9" r="2.1" stroke="currentColor" stroke-width="1.4"/><path d="M3.5 19c0-3 2.4-5 5-5s5 2 5 5M14.5 14.6c2.3.2 4 1.9 4 4.4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>',
					'title' => 'Classi Piccole',
					'desc'  => 'Solo in aula — per una maggiore interazione tra docenti e studenti.',
				),
				array(
					'tone'  => 'light',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="2.5" y="7" width="19" height="10" rx="3" stroke="currentColor" stroke-width="1.4"/><circle cx="8" cy="12" r="1.6" stroke="currentColor" stroke-width="1.4"/><circle cx="16" cy="12" r="1.6" stroke="currentColor" stroke-width="1.4"/></svg>',
					'title' => 'Virtual Reality Lab',
					'desc'  => 'Solo in aula — in cui testare le ultime tecnologie VR.',
				),
				array(
					'tone'  => 'dark',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17h9a4 4 0 0 0 .5-7.97A5.5 5.5 0 0 0 6.1 10.2 3.5 3.5 0 0 0 7 17Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/></svg>',
					'title' => 'Piattaforma Clouding',
					'desc'  => 'Materiale didattico disponibile in cloud.',
				),
				array(
					'tone'  => 'muted',
					'icon'  => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 8h13v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/><path d="M17 9.5h1.5a2.5 2.5 0 0 1 0 5H17" stroke="currentColor" stroke-width="1.4"/><path d="M8 4.5c-.6.6-.6 1.2 0 1.8M11.5 4.5c-.6.6-.6 1.2 0 1.8" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>',
					'title' => 'Free Coffee',
					'desc'  => 'Solo in aula — area dedicata con free coffee and sweets.',
				),
			);
			?>
			<div class="ih-pbenefici__grid ih-pbenefici__grid--six">
				<?php foreach ( $immensive_perche as $immensive_p ) : ?>
					<article class="ih-pbenefici__card ih-pbenefici__card--<?php echo esc_attr( $immensive_p['tone'] ); ?> ih-reveal">
						<span class="ih-pbenefici__icon"><?php echo $immensive_p['icon']; // phpcs:ignore WordPress.Security.EscapeOutput -- static inline SVG, not user input. ?></span>
						<h3 class="ih-pbenefici__title"><?php echo esc_html( $immensive_p['title'] ); ?></h3>
						<p class="ih-pbenefici__desc"><?php echo esc_html( $immensive_p['desc'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pteach ih-acad-unreal" style="background-image: url( '<?php echo esc_url( $immensive_img . 'formazione-bg.webp' ); ?>' );">
		<div class="ih-pteach__scrim" aria-hidden="true"></div>
		<div class="ih-container ih-pteach__inner ih-reveal">
			<p class="ih-pteach__eyebrow"><?php esc_html_e( 'Primo', 'immensive' ); ?></p>
			<h2 class="ih-pteach__title"><?php esc_html_e( 'Centro di Formazione Autorizzato Unreal presente nel Sud Italia', 'immensive' ); ?></h2>
			<p class="ih-pteach__sub"><?php esc_html_e( 'Immensive Academy è il primo Unreal Authorized Training Center presente in Sud Italia, specializzato in corsi di UE5 per l\'architettura e per lo sviluppo VR.', 'immensive' ); ?></p>
			<a class="ih-btn ih-btn--solid" href="#ih-corsi"><?php esc_html_e( 'Scopri di Più', 'immensive' ); ?></a>
		</div>
	</section>

	<section class="ih-acad-mode" id="ih-modalita">
		<div class="ih-container">
			<h2 class="ih-acad-mode__heading"><?php esc_html_e( 'Modalità di svolgimento', 'immensive' ); ?></h2>
			<p class="ih-acad-mode__sub"><?php esc_html_e( 'Il corso può essere svolto in sede ed online con le seguenti modalità.', 'immensive' ); ?></p>

			<?php
			$immensive_modes = array(
				array(
					'icon'  => 'icon-in-sede.png',
					'title' => 'Corsi in Sede',
					'items' => array(
						'Il corso avrà un numero massimo di 6 partecipanti per una maggiore interazione tra docente e studente.',
						'Le lezioni in aula si svolgono presso la sede Immensive di Aversa, nei pressi del Dipartimento di Architettura.',
						'Durante le lezioni in aula il partecipante potrà ottenere un feedback immediato grazie al tutoraggio.',
					),
				),
				array(
					'icon'  => 'icon-online.png',
					'title' => 'Corsi Online',
					'items' => array(
						'Le lezioni online si svolgono tramite la piattaforma e-learning.',
						'Le lezioni vengono effettuate in FAD sincrona per una efficace interattività tra docenti e studenti.',
					),
				),
			);
			?>
			<div class="ih-acad-mode__grid">
				<?php foreach ( $immensive_modes as $immensive_mode ) : ?>
					<article class="ih-acad-mode__card ih-reveal">
						<img class="ih-acad-mode__icon" src="<?php echo esc_url( $immensive_aca . $immensive_mode['icon'] ); ?>" alt="" width="56" height="56" loading="lazy">
						<h3 class="ih-acad-mode__title"><?php echo esc_html( $immensive_mode['title'] ); ?></h3>
						<ul class="ih-acad-mode__list">
							<?php foreach ( $immensive_mode['items'] as $immensive_item ) : ?>
								<li><?php echo esc_html( $immensive_item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-acad-corsi" id="ih-corsi">
		<div class="ih-container">
			<h2 class="ih-acad-corsi__heading"><?php esc_html_e( 'Tutti i Corsi', 'immensive' ); ?></h2>
			<p class="ih-acad-corsi__sub"><?php esc_html_e( 'Scegli il corso più adatto alle tue esigenze.', 'immensive' ); ?></p>

			<?php
			$immensive_corsi = array(
				array(
					'title' => '3D Studio Max - Modellazione',
					'desc'  => 'Le basi della modellazione 3D professionale con 3ds Max, per costruire asset pronti per rendering e produzione.',
					'image' => '',
				),
				array(
					'title' => 'Blender 3D - Modellazione',
					'desc'  => 'Modellazione, texturing e rendering con Blender, il software open source più usato al mondo per la computer grafica 3D.',
					'image' => 'gallery-blender.jpg',
				),
				array(
					'title' => '3ds Max & V-Ray - Rendering',
					'desc'  => 'Tecniche di rendering fotorealistico con 3ds Max e V-Ray, per architettura, prodotto e visualizzazione.',
					'image' => '',
				),
				array(
					'title' => 'UE5 Base',
					'desc'  => 'Le fondamenta di Unreal Engine 5: blueprint, materiali, luci e primo progetto interattivo.',
					'image' => 'gallery-twinmotion.jpg',
				),
				array(
					'title' => 'UE5 per lo Sviluppo VR',
					'desc'  => 'Sviluppo di applicazioni ed esperienze immersive in Realtà Virtuale con Unreal Engine 5.',
					'image' => 'gallery-ue5vr.jpg',
				),
				array(
					'title' => 'UE5 per l\'Architettura',
					'desc'  => 'Visualizzazione architettonica in tempo reale con Unreal Engine 5: dal modello BIM all\'esperienza immersiva.',
					'image' => 'gallery-uevr-andreal.jpg',
				),
			);
			?>
			<div class="ih-acad-corsi__grid">
				<?php foreach ( $immensive_corsi as $immensive_corso ) : ?>
					<article class="ih-acad-corsi__card ih-reveal">
						<div class="ih-acad-corsi__media">
							<?php if ( $immensive_corso['image'] ) : ?>
								<img src="<?php echo esc_url( $immensive_aca . $immensive_corso['image'] ); ?>" alt="" loading="lazy">
							<?php else : ?>
								<span class="ih-acad-corsi__ph" aria-hidden="true"></span>
							<?php endif; ?>
						</div>
						<h3 class="ih-acad-corsi__title"><?php echo esc_html( $immensive_corso['title'] ); ?></h3>
						<p class="ih-acad-corsi__desc"><?php echo esc_html( $immensive_corso['desc'] ); ?></p>
						<a class="ih-btn ih-btn--ghost-dark ih-acad-corsi__cta" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Richiedi Informazioni', 'immensive' ); ?></a>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-tco ih-acad-piattaforma" id="ih-piattaforma">
		<div class="ih-container">
			<div class="ih-tco__banner ih-reveal">
				<p class="ih-tco__banner-text"><strong><?php esc_html_e( 'Scopri come funziona', 'immensive' ); ?></strong> <?php esc_html_e( 'la Piattaforma e-Learning. Per accedere e iscriverti ai corsi clicca qui sotto.', 'immensive' ); ?></p>
				<div class="ih-acad-piattaforma__actions">
					<a class="ih-btn ih-btn--solid ih-tco__banner-cta" href="https://app.immensive.it/register?type=1" target="_blank" rel="noopener"><?php esc_html_e( 'Iscriviti alla Piattaforma', 'immensive' ); ?></a>
					<a class="ih-btn ih-btn--ghost-dark" href="https://academy.immensive.it/public/documentazione/" target="_blank" rel="noopener"><?php esc_html_e( 'Guida Utente', 'immensive' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="ih-acad-tutor" id="ih-tutor">
		<div class="ih-container">
			<h2 class="ih-acad-tutor__heading"><?php esc_html_e( 'Tutor del Corso', 'immensive' ); ?></h2>
			<p class="ih-acad-tutor__sub"><?php esc_html_e( 'I nostri tutor sono anche professionisti che lavorano nell\'industria dello sviluppo di soluzioni integrate di realtà virtuale e realtà aumentata in svariati ambiti.', 'immensive' ); ?></p>

			<div class="ih-acad-tutor__grid">
				<?php
				$immensive_tutor_count = 4;
				for ( $immensive_t = 1; $immensive_t <= $immensive_tutor_count; $immensive_t++ ) :
					?>
					<article class="ih-acad-tutor__card ih-reveal">
						<span class="ih-acad-tutor__avatar" aria-hidden="true"></span>
						<h3 class="ih-acad-tutor__name"><?php esc_html_e( 'Tutor Immensive', 'immensive' ); ?></h3>
						<p class="ih-acad-tutor__role"><?php esc_html_e( 'Professionista del settore VR / CG', 'immensive' ); ?></p>
					</article>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<section class="ih-pgap ih-acad-iscriversi" id="ih-iscriversi">
		<div class="ih-container">
			<h2 class="ih-pgap__heading"><?php esc_html_e( 'Come Procedere all\'Iscrizione', 'immensive' ); ?></h2>
			<p class="ih-pgap__intro"><?php esc_html_e( 'Per partecipare ai corsi di Immensive Academy, il primo passo da compiere è procedere alla registrazione sulla piattaforma; successivamente è possibile pre-iscriversi al corso desiderato (l\'iscrizione è gratuita e non vincolante). Quando il corso sarà confermato potrai procedere al pagamento e accedere alla lezione.', 'immensive' ); ?></p>

			<?php
			$immensive_iscriv_steps = array(
				'Registrati alla piattaforma',
				'Pre-iscriviti al corso',
				'Attendi conferma del corso',
				'Effettua il pagamento',
				'Avvio lezione online o in aula',
			);
			?>
			<div class="ih-pgap__steps ih-pgap__steps--five">
				<span class="ih-pgap__line ih-pgap__line--edge" aria-hidden="true"></span>
				<?php foreach ( $immensive_iscriv_steps as $immensive_i => $immensive_step ) : ?>
					<div class="ih-pgap__step ih-reveal">
						<span class="ih-pgap__num" aria-hidden="true"><?php echo esc_html( (string) ( $immensive_i + 1 ) ); ?></span>
						<div class="ih-pgap__box ih-pgap__box--tight">
							<span class="ih-pgap__label ih-pgap__label--small"><?php echo esc_html( $immensive_step ); ?></span>
						</div>
					</div>
					<span class="ih-pgap__line<?php echo ( count( $immensive_iscriv_steps ) - 1 === $immensive_i ) ? ' ih-pgap__line--edge' : ''; ?>" aria-hidden="true"></span>
				<?php endforeach; ?>
			</div>

			<div class="ih-acad-iscriversi__actions">
				<a class="ih-btn ih-btn--solid" href="https://academy.immensive.it/register?type=1" target="_blank" rel="noopener"><?php esc_html_e( 'Registrati alla Piattaforma', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--ghost-dark" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Maggiori Informazioni', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<section class="ih-casi ih-acad-gallery" id="ih-gallery">
		<div class="ih-container">
			<h2 class="ih-casi__heading"><?php esc_html_e( 'Gallery', 'immensive' ); ?></h2>
			<p class="ih-acad-gallery__sub"><?php esc_html_e( 'Sfoglia la galleria dei lavori dei nostri studenti.', 'immensive' ); ?></p>
		</div>

		<?php
		$immensive_gallery = array(
			array( 'file' => 'gallery-uevr-andreal.jpg', 'alt' => 'Lavoro studente del corso UE5 per lo Sviluppo VR, Immensive Academy' ),
			array( 'file' => 'gallery-blender.jpg', 'alt' => 'Lavoro studente del corso Blender 3D Modellazione, Immensive Academy' ),
			array( 'file' => 'gallery-twinmotion.jpg', 'alt' => 'Lavoro studente del corso Twinmotion per l\'Architettura, Immensive Academy' ),
			array( 'file' => 'gallery-ue5vr.jpg', 'alt' => 'Lavoro studente del corso UE5 per l\'Architettura, Immensive Academy' ),
		);
		?>
		<div class="ih-casi__viewport" id="ih-casi-viewport">
			<ul class="ih-casi__track">
				<?php foreach ( $immensive_gallery as $immensive_g ) : ?>
					<li class="ih-casi__card">
						<img src="<?php echo esc_url( $immensive_aca . $immensive_g['file'] ); ?>" alt="<?php echo esc_attr( $immensive_g['alt'] ); ?>" loading="lazy">
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="ih-casi__controls">
			<button type="button" class="ih-casi__nav" data-dir="-1" aria-label="<?php esc_attr_e( 'Immagine precedente', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5l-7 7 7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
			<div class="ih-casi__progress"><span class="ih-casi__progress-bar" id="ih-casi-bar"></span></div>
			<button type="button" class="ih-casi__nav" data-dir="1" aria-label="<?php esc_attr_e( 'Immagine successiva', 'immensive' ); ?>">
				<svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
			</button>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/contact-cta',
		null,
		array(
			'eyebrow' => __( 'Richiedi informazioni sui corsi', 'immensive' ),
			'heading' => __( 'PARLIAMO DEL TUO PERCORSO FORMATIVO', 'immensive' ),
			'label'   => __( 'Contattaci', 'immensive' ),
			'href'    => $immensive_contatti_url,
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
