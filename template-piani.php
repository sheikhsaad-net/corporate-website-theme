<?php
/**
 * Template Name: Immensive – Piani
 *
 * Uses the shared "ih" header/footer. Body content to follow.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--piani" id="ih-hero">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-phero__inner">
			<h1 class="ih-phero__title">
				COME COMPRARE<br>I SIMULATORI VR<br><span class="ih-phero__accent">IMMENSIVE</span>
			</h1>
			<p class="ih-phero__sub"><?php esc_html_e( '4 modelli, una sola qualità. Attivazione in 7 giorni. Compatibile Formazione 4.0.', 'immensive' ); ?></p>
			<div class="ih-phero__actions">
				<a class="ih-btn ih-btn--solid" href="#ih-tco-form"><?php esc_html_e( 'Richiedi un Preventivo', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--ghost" href="tel:+390813358542"><?php esc_html_e( 'Parla con un Consulente', 'immensive' ); ?></a>
			</div>
		</div>
	</section>

	<div class="ih-flow">

	<section class="ih-sistema" id="ih-sistema">
		<div class="ih-sistema__sticky">
			<div class="ih-sistema__head">
				<h2 class="ih-sistema__heading">IN COSA CONSISTE IL<br>NOSTRO SISTEMA</h2>
				<p class="ih-sistema__sub"><?php esc_html_e( 'La nostra soluzione combina hardware standard, componenti proprietari e software professionale in un ecosistema unico, progettato per essere flessibile, scalabile e semplice da implementare.', 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-sistema__cards">
			<div class="ih-sistema-grid">
				<?php
				$immensive_sistema_cards = array(
					array(
						'slug'  => 'immensive_mass_market_hardware',
						'title' => 'Hardware<br>Mass Market',
						'desc'  => 'Visori, PC e periferiche standard. Puoi acquistarli da noi, da un tuo fornitore di fiducia o usare quelli che hai già in azienda. Nessun vincolo, massima flessibilità.',
						'note'  => '',
						'cta'   => false,
					),
					array(
						'slug'  => 'immensive_Kit_hardware',
						'title' => 'Kit Hardware<br>Immensive',
						'desc'  => 'Componenti proprietari che rendono realistica l\'interazione VR: torce, estintori, controller dedicati. Sviluppati e venduti esclusivamente da Immensive.',
						'note'  => 'Richiesto solo per i simulatori che lo prevedono.',
						'cta'   => false,
					),
					array(
						'slug'  => 'licenza_software',
						'title' => 'Licenza<br>Software',
						'desc'  => 'Il software che dà vita al simulatore. Quattro piani a scelta: Lifetime o abbonamento, per adattarsi a ogni esigenza e strategia aziendale.',
						'note'  => '',
						'cta'   => true,
					),
				);
				foreach ( $immensive_sistema_cards as $immensive_card ) :
					$immensive_card_img = get_template_directory() . '/assets/images/piani/' . $immensive_card['slug'] . '.webp';
					?>
					<article class="ih-sistema-card ih-reveal">
						<div class="ih-sistema-card__media">
							<?php if ( file_exists( $immensive_card_img ) ) : ?>
								<img src="<?php echo esc_url( $immensive_img . 'piani/' . $immensive_card['slug'] . '.webp' ); ?>" alt="" loading="lazy">
							<?php else : ?>
								<span class="ih-sistema-card__media-ph" aria-hidden="true"></span>
							<?php endif; ?>
							<span class="ih-sistema-card__grad" aria-hidden="true"></span>
							<h3 class="ih-sistema-card__title"><?php echo wp_kses( $immensive_card['title'], array( 'br' => array() ) ); ?></h3>
						</div>
						<p class="ih-sistema-card__desc"><?php echo esc_html( $immensive_card['desc'] ); ?></p>
						<?php if ( $immensive_card['note'] ) : ?>
							<p class="ih-sistema-card__note"><?php echo esc_html( $immensive_card['note'] ); ?></p>
						<?php endif; ?>
						<?php if ( $immensive_card['cta'] ) : ?>
							<a class="ih-btn ih-btn--ghost ih-sistema-card__cta" href="#ih-piani"><?php esc_html_e( 'Scopri i Piani', 'immensive' ); ?></a>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-pianitab" id="ih-piani">
		<h2 class="ih-pianitab__heading">PIANI</h2>

		<div class="ih-container">
			<div class="ih-pianitab__panel ih-reveal" id="ih-pianitab-panel">
				<div class="ih-pianitab__glare" aria-hidden="true"></div>

				<div class="ih-pianitab__labels">
					<span class="ih-pianitab__corner" aria-hidden="true"></span>
					<span class="ih-pianitab__label"><?php esc_html_e( 'Costo licenza', 'immensive' ); ?></span>
					<span class="ih-pianitab__label"><?php esc_html_e( 'Aggiornamenti software', 'immensive' ); ?></span>
					<span class="ih-pianitab__label"><?php esc_html_e( 'Supporto', 'immensive' ); ?></span>
					<span class="ih-pianitab__label"><?php esc_html_e( 'Sostituzione kit consumabili', 'immensive' ); ?></span>
				</div>

				<?php
				$immensive_piani_plans = array(
					array(
						'name'   => 'Lifetime',
						'badge'  => '',
						'hl'     => false,
						'values' => array(
							array( 'Una tantum', false ),
							array( 'Solo critici', false ),
							array( 'Base, a ticket', false ),
							array( 'A pagamento', false ),
						),
					),
					array(
						'name'   => 'Lifetime +<br>Manutenzione',
						'badge'  => '',
						'hl'     => false,
						'values' => array(
							array( 'Una tantum + canone', false ),
							array( 'Inclusi', true ),
							array( 'Continuo', false ),
							array( 'Inclusa', true ),
						),
					),
					array(
						'name'   => 'Abbonamento<br>Annuale',
						'badge'  => 'Più scelto',
						'hl'     => true,
						'values' => array(
							array( 'Canone annuale', false ),
							array( 'Inclusi', true ),
							array( 'Continuo', false ),
							array( 'Inclusa', true ),
						),
					),
					array(
						'name'   => 'Abbonamento<br>Mensile',
						'badge'  => '',
						'hl'     => false,
						'values' => array(
							array( 'Canone mensile', false ),
							array( 'Inclusi', true ),
							array( 'Continuo', false ),
							array( 'Inclusa', true ),
						),
					),
				);
				foreach ( $immensive_piani_plans as $immensive_plan ) :
					?>
					<div class="ih-pianitab__col<?php echo $immensive_plan['hl'] ? ' ih-pianitab__col--hl' : ''; ?>">
						<h3 class="ih-pianitab__plan">
							<?php echo wp_kses( $immensive_plan['name'], array( 'br' => array() ) ); ?>
							<?php if ( $immensive_plan['badge'] ) : ?>
								<span class="ih-pianitab__badge"><?php echo esc_html( $immensive_plan['badge'] ); ?></span>
							<?php endif; ?>
						</h3>
						<?php foreach ( $immensive_plan['values'] as $immensive_val ) : ?>
							<span class="ih-pianitab__cell<?php echo $immensive_val[1] ? ' ih-pianitab__cell--ok' : ''; ?>"><?php echo esc_html( $immensive_val[0] ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ih-tco" id="ih-tco">
		<div class="ih-container">
			<div class="ih-tco__banner ih-reveal">
				<p class="ih-tco__banner-text"><strong><?php esc_html_e( 'Non sei sicuro del modello?', 'immensive' ); ?></strong> <?php esc_html_e( 'Risparmiamo tempo: lascia 3 dati e ti chiamiamo entro 24h.', 'immensive' ); ?></p>
				<a class="ih-btn ih-btn--solid ih-tco__banner-cta" href="#ih-tco-form"><?php esc_html_e( 'Fammi Richiamare', 'immensive' ); ?></a>
			</div>

		</div>

		<div class="ih-tco__sticky">
			<div class="ih-tco__head">
				<p class="ih-tco__eyebrow"><?php esc_html_e( 'Calcolatore TCO', 'immensive' ); ?></p>
				<h2 class="ih-tco__heading"><?php esc_html_e( 'Calcola il tuo risparmio.', 'immensive' ); ?></h2>
				<p class="ih-tco__sub"><?php esc_html_e( "Rispondi a poche domande e ricevi un report personalizzato con hardware consigliato, piano licenza suggerito e stima del ritorno sull'investimento.", 'immensive' ); ?></p>
			</div>
		</div>

		<div class="ih-container ih-tco__body">
			<form class="ih-tco__card ih-reveal" id="ih-tco-form">
				<h3 class="ih-tco__card-title"><?php esc_html_e( 'I Tuoi Dati', 'immensive' ); ?></h3>

				<div class="ih-tco__field">
					<label class="ih-tco__label"><?php esc_html_e( 'Sei un istituto scolastico o un centro di formazione?', 'immensive' ); ?></label>
					<div class="ih-tco__toggle" role="radiogroup">
						<button type="button" class="ih-tco__toggle-opt is-active" data-value="istituto" role="radio" aria-checked="true"><?php esc_html_e( 'Istituto Scolastico', 'immensive' ); ?></button>
						<button type="button" class="ih-tco__toggle-opt" data-value="centro" role="radio" aria-checked="false"><?php esc_html_e( 'Centro di Formazione', 'immensive' ); ?></button>
					</div>
					<input type="hidden" name="tipo_struttura" id="tco-tipo-struttura" value="istituto">
				</div>

				<div class="ih-tco__row ih-tco__row--two" id="tco-row-centro">
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-mesi"><?php esc_html_e( "Per quanti mesi all'anno eroghi corsi?", 'immensive' ); ?></label>
						<input class="ih-tco__input" type="number" id="tco-mesi" name="mesi" min="1" max="12" inputmode="numeric">
					</div>
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-costo"><?php esc_html_e( 'Quanto costa un corso?', 'immensive' ); ?></label>
						<input class="ih-tco__input" type="number" id="tco-costo" name="costo_corso" min="0" inputmode="numeric">
					</div>
				</div>

				<div class="ih-tco__field" id="tco-row-istituto" hidden>
					<label class="ih-tco__label"><?php esc_html_e( 'Possiedi già un laboratorio?', 'immensive' ); ?></label>
					<div class="ih-tco__toggle" role="radiogroup">
						<button type="button" class="ih-tco__toggle-opt is-active" data-value="si" role="radio" aria-checked="true"><?php esc_html_e( 'Sì', 'immensive' ); ?></button>
						<button type="button" class="ih-tco__toggle-opt" data-value="no" role="radio" aria-checked="false"><?php esc_html_e( 'No', 'immensive' ); ?></button>
					</div>
					<input type="hidden" name="ha_laboratorio" id="tco-ha-laboratorio" value="si">
				</div>

				<div class="ih-tco__row ih-tco__row--three">
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-media"><?php esc_html_e( 'Qual è la media di corsisti per corso?', 'immensive' ); ?></label>
						<input class="ih-tco__input" type="number" id="tco-media" name="media_corsisti" min="0" inputmode="numeric">
					</div>
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-prodotto"><?php esc_html_e( 'A quale prodotto sei interessato?', 'immensive' ); ?></label>
						<div class="ih-tco__select-wrap">
							<select class="ih-tco__input ih-tco__select" id="tco-prodotto" name="prodotto">
								<option value="" disabled selected><?php esc_html_e( 'Seleziona un prodotto', 'immensive' ); ?></option>
								<option value="saldatura"><?php esc_html_e( 'Simulatore VR Saldatura', 'immensive' ); ?></option>
								<option value="carrello-elevatore"><?php esc_html_e( 'Simulatore VR Carrello Elevatore', 'immensive' ); ?></option>
								<option value="antincendio"><?php esc_html_e( 'Simulatore VR Antincendio', 'immensive' ); ?></option>
								<option value="elettrico"><?php esc_html_e( 'Simulatore Impianti Elettrici', 'immensive' ); ?></option>
							</select>
						</div>
					</div>
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-hardware"><?php esc_html_e( "Hai già l'hardware compatibile con il sistema?", 'immensive' ); ?></label>
						<div class="ih-tco__select-wrap">
							<select class="ih-tco__input ih-tco__select" id="tco-hardware" name="hardware">
								<option value="" disabled selected><?php esc_html_e( 'Seleziona tra quelli compatibili', 'immensive' ); ?></option>
								<option value="si-completo"><?php esc_html_e( 'Sì, ho già visori e PC compatibili', 'immensive' ); ?></option>
								<option value="si-parziale"><?php esc_html_e( 'Ho solo alcuni componenti', 'immensive' ); ?></option>
								<option value="no"><?php esc_html_e( 'No, devo acquistare tutto', 'immensive' ); ?></option>
							</select>
						</div>
					</div>
				</div>

				<div class="ih-tco__row ih-tco__row--three">
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-nome"><?php esc_html_e( 'Nome', 'immensive' ); ?></label>
						<input class="ih-tco__input" type="text" id="tco-nome" name="nome" placeholder="<?php esc_attr_e( 'Nome', 'immensive' ); ?>" required>
					</div>
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-cognome"><?php esc_html_e( 'Cognome', 'immensive' ); ?></label>
						<input class="ih-tco__input" type="text" id="tco-cognome" name="cognome" placeholder="<?php esc_attr_e( 'Cognome', 'immensive' ); ?>" required>
					</div>
					<div class="ih-tco__field">
						<label class="ih-tco__label" for="tco-telefono"><?php esc_html_e( 'Telefono', 'immensive' ); ?></label>
						<input class="ih-tco__input" type="tel" id="tco-telefono" name="telefono" placeholder="<?php esc_attr_e( 'Telefono', 'immensive' ); ?>" required>
					</div>
				</div>

				<div class="ih-tco__field ih-tco__field--email">
					<label class="ih-tco__label ih-tco__label--body" for="tco-email"><?php esc_html_e( 'Inserisci la tua mail per ricevere gratuitamente il report personalizzato della tua configurazione ideale.', 'immensive' ); ?></label>
					<input class="ih-tco__input" type="email" id="tco-email" name="email" placeholder="<?php esc_attr_e( 'E-mail', 'immensive' ); ?>" required>
				</div>

				<div class="ih-tco__actions">
					<button type="button" class="ih-btn ih-btn--ghost-dark ih-tco__refresh"><?php esc_html_e( 'Aggiorna Risultati', 'immensive' ); ?></button>
					<button type="submit" class="ih-btn ih-btn--solid ih-tco__submit"><?php esc_html_e( 'Genera il mio Report', 'immensive' ); ?></button>
				</div>
			</form>
		</div>
	</section>

	<section class="ih-faq" id="ih-faq">
		<div class="ih-container ih-faq__grid">
			<h2 class="ih-faq__heading ih-reveal">TUTTO QUELLO<br>CHE TI SERVE<br>SAPERE</h2>

			<div class="ih-faq__list">
				<?php
				$immensive_faqs = array(
					array(
						'q' => 'Posso passare da lifetime ad abbonamento (e viceversa)?',
						'a' => 'Sì. Puoi cambiare formula in qualsiasi momento: il valore già versato viene riconosciuto sul nuovo piano, senza interruzioni del servizio.',
					),
					array(
						'q' => 'Cosa succede al kit hardware se chiudo l\'abbonamento?',
						'a' => 'Il kit hardware resta di tua proprietà. Alla chiusura dell\'abbonamento si interrompe solo l\'accesso al software e ai relativi aggiornamenti.',
					),
					array(
						'q' => 'L\'abbonamento è compatibile con Formazione 4.0 e credito d\'imposta?',
						'a' => 'Sì. Tutti i piani sono compatibili con Formazione 4.0 e credito d\'imposta: ti forniamo la documentazione necessaria per la pratica.',
					),
					array(
						'q' => 'Come si attiva, in quanto tempo?',
						'a' => 'L\'attivazione avviene in circa 7 giorni: installazione, configurazione e formazione iniziale del personale sono incluse.',
					),
					array(
						'q' => 'I distributori possono proporre l\'abbonamento?',
						'a' => 'Sì. I distributori autorizzati possono proporre tutti i piani, incluse le formule in abbonamento.',
					),
				);
				foreach ( $immensive_faqs as $immensive_i => $immensive_faq ) :
					$immensive_faq_id = 'ih-faq-a-' . ( $immensive_i + 1 );
					?>
					<div class="ih-faq__item ih-reveal">
						<button class="ih-faq__q" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $immensive_faq_id ); ?>">
							<span><?php echo esc_html( $immensive_faq['q'] ); ?></span>
							<span class="ih-faq__icon" aria-hidden="true">
								<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
							</span>
						</button>
						<div class="ih-faq__a" id="<?php echo esc_attr( $immensive_faq_id ); ?>">
							<div class="ih-faq__a-inner">
								<p><?php echo esc_html( $immensive_faq['a'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/contact-cta' ); ?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
