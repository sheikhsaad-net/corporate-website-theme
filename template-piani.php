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

$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

/* Same four purchase plans as the product pages' "Soluzioni di acquisto". */
$immensive_soluzioni = array(
array(
	'title'    => 'Lifetime',
	'sub'      => 'Paghi una volta, usi per sempre',
	'featured' => false,
	'items'    => array(
		'Pagamento una tantum',
		'Nessun canone ricorrente',
		'Solo aggiornamenti critici',
		'Supporto base a ticket',
	),
),
array(
	'title'    => 'Lifetime + Manutenzione',
	'sub'      => 'Proprietà a vita con assistenza continua',
	'featured' => false,
	'items'    => array(
		'Pagamento una tantum + canone',
		'Aggiornamenti software inclusi',
		'Supporto prioritario',
		'Sostituzione kit consumabili inclusa',
	),
),
array(
	'title'    => 'Abbonamento Annuale',
	'sub'      => 'Il massimo servizio con flessibilità media',
	'featured' => true,
	'badge'    => 'Più scelto',
	'items'    => array(
		'Canone annuale',
		'Aggiornamenti software inclusi',
		'Supporto prioritario + onboarding',
		'Sostituzione kit consumabili inclusa',
	),
),
array(
	'title'    => 'Abbonamento Mensile',
	'sub'      => 'Massima flessibilità, zero vincoli',
	'featured' => false,
	'items'    => array(
		'Canone mensile',
		'Aggiornamenti software inclusi',
		'Supporto standard',
		'Sostituzione kit consumabili inclusa',
	),
),
			);

get_header();
?>

<div class="ih ih--no-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-psol ih-psol--hero" id="ih-hero">
		<div class="ih-container" id="ih-piani">
			<p class="ih-psol__eyebrow"><?php esc_html_e( 'Scegli come comprare i simulatori Immensive', 'immensive' ); ?></p>

			<h1 class="ih-psol__heading">
				<?php esc_html_e( 'Soluzioni di', 'immensive' ); ?><br>
				<span class="ih-psol__heading-line">
					<?php esc_html_e( 'Acquisto', 'immensive' ); ?>
					<span class="ih-psol__price">
						<span class="ih-psol__price-label"><?php esc_html_e( 'A partire da', 'immensive' ); ?></span>
						<span class="ih-psol__price-value">&euro;40,00<span class="ih-psol__price-unit">/mo</span></span>
					</span>
				</span>
			</h1>

			<div class="ih-psol__grid">
				<?php foreach ( $immensive_soluzioni as $immensive_sol ) : ?>
					<article class="ih-psol__card<?php echo $immensive_sol['featured'] ? ' is-featured' : ''; ?> ih-reveal">
						<span class="ih-psol__glare" aria-hidden="true"></span>
						<div class="ih-psol__card-head">
							<h3 class="ih-psol__card-title"><?php echo esc_html( $immensive_sol['title'] ); ?></h3>
							<?php if ( ! empty( $immensive_sol['badge'] ) ) : ?>
								<span class="ih-psol__card-badge"><?php echo esc_html( $immensive_sol['badge'] ); ?></span>
							<?php endif; ?>
						</div>
						<div class="ih-psol__card-body">
							<p class="ih-psol__card-sub"><?php echo esc_html( $immensive_sol['sub'] ); ?></p>
							<ul class="ih-psol__list">
								<?php foreach ( $immensive_sol['items'] as $immensive_sol_item ) : ?>
									<li>
										<span class="ih-psol__check" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none"><path d="M5 13l4.5 4.5L19 7.5" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
										</span>
										<span><?php echo esc_html( $immensive_sol_item ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="ih-psol__footer ih-psol__footer--ctas">
				<p class="ih-psol__tagline">
					<span><?php esc_html_e( 'Quattro modelli,', 'immensive' ); ?></span><br>
					<strong><?php esc_html_e( 'un solo prodotto.', 'immensive' ); ?></strong>
				</p>
				<div class="ih-psol__ctas">
					<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Richiedi un Preventivo', 'immensive' ); ?></a>
					<a class="ih-btn ih-btn--ghost" href="tel:+390813358542"><?php esc_html_e( 'Parla con un Consulente', 'immensive' ); ?></a>
				</div>
			</div>
		</div>
	</section>

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
						'title' => 'Kit Hardware<br>Immensive*',
						'desc'  => 'Componenti proprietari che rendono realistica l\'interazione VR: torce, estintori, controller dedicati. Sviluppati e venduti esclusivamente da Immensive.',
						'note'  => '*Richiesto solo per i simulatori che lo prevedono.',
						'cta'   => false,
					),
					array(
						'slug'  => 'licenza_software',
						'title' => 'Licenza<br>Software',
						'desc'  => 'Il software che dà vita al simulatore. Quattro piani a scelta: Lifetime o abbonamento, per adattarsi a ogni esigenza e strategia aziendale.',
						'note'  => '',
						'cta'   => false,
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

	<section class="ih-tco" id="ih-tco">
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
								<option value="elettrico"><?php esc_html_e( 'Simulatore VR Impianti Elettrici', 'immensive' ); ?></option>
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

</div>

<?php
get_footer();
