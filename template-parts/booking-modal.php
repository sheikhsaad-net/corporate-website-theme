<?php
/**
 * "Prenota una call" popup — UI only (no sending yet).
 *
 * Flow: 1) pick a date (today or later) in the calendar, 2) pick one of the free
 * 30-minute slots, 3) fill in the short booking form, 4) confirmation.
 * Opened by any element carrying [data-booking-open]. Styles: assets/css/booking.css,
 * script: assets/js/booking.js (both enqueued on Piani and Rivenditori only).
 *
 * @param string   $args['eyebrow'] Small pill above the title.
 * @param string   $args['title']   Display title (left panel).
 * @param string   $args['sub']     Intro paragraph (left panel).
 * @param string[] $args['points']  "Cosa vedremo" bullets.
 * @param array    $args['extra']   Optional select field: label + options[].
 * @param string   $args['topic']   Short topic name shown in the confirmation.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_bk = wp_parse_args(
	isset( $args ) && is_array( $args ) ? $args : array(),
	array(
		'eyebrow' => __( 'Prenota online', 'immensive' ),
		'title'   => __( 'Prenota una call di 30 minuti', 'immensive' ),
		'sub'     => __( 'Scegli giorno e orario: ti confermiamo l’appuntamento via email.', 'immensive' ),
		'points'  => array(),
		'extra'   => array(),
		'topic'   => __( 'Call con il team Immensive', 'immensive' ),
	)
);
?>
<div class="ih-bk" id="ih-booking" aria-hidden="true" data-topic="<?php echo esc_attr( $immensive_bk['topic'] ); ?>">
	<div class="ih-bk__overlay" data-bk-close></div>

	<div class="ih-bk__dialog" role="dialog" aria-modal="true" aria-labelledby="ih-bk-title">
		<span class="ih-bk__glow" aria-hidden="true"></span>
		<button type="button" class="ih-bk__close" data-bk-close aria-label="<?php esc_attr_e( 'Chiudi', 'immensive' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>

		<!-- ============ Left: context + graphic ============ -->
		<aside class="ih-bk__aside">
			<div class="ih-bk__art" aria-hidden="true">
				<span class="ih-bk__aurora ih-bk__aurora--a"></span>
				<span class="ih-bk__aurora ih-bk__aurora--b"></span>
				<span class="ih-bk__dots"></span>
				<span class="ih-bk__rings">
					<i></i><i></i><i></i>
					<span class="ih-bk__orbit"><b></b></span>
					<span class="ih-bk__orbit ih-bk__orbit--2"><b></b></span>
				</span>
			</div>

			<div class="ih-bk__aside-body">
				<p class="ih-bk__eyebrow"><span></span><?php echo esc_html( $immensive_bk['eyebrow'] ); ?></p>
				<h2 class="ih-bk__title" id="ih-bk-title"><?php echo esc_html( $immensive_bk['title'] ); ?></h2>
				<p class="ih-bk__sub"><?php echo esc_html( $immensive_bk['sub'] ); ?></p>

				<ul class="ih-bk__meta">
					<li>
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.6"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<?php esc_html_e( '30 minuti', 'immensive' ); ?>
					</li>
					<li>
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="6.5" width="12" height="11" rx="2.5" stroke="currentColor" stroke-width="1.6"/><path d="m15 11 6-3.5v9L15 13" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
						<?php esc_html_e( 'Videochiamata · link via email', 'immensive' ); ?>
					</li>
					<li class="ih-bk__meta-tz">
						<button type="button" class="ih-bk__tzlink" data-bk-tz-open aria-haspopup="dialog" aria-expanded="false" title="<?php esc_attr_e( 'Cambia fuso orario', 'immensive' ); ?>">
							<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 12h17M12 3.5c2.4 2.4 3.6 5.2 3.6 8.5s-1.2 6.1-3.6 8.5c-2.4-2.4-3.6-5.2-3.6-8.5S9.6 5.9 12 3.5Z" stroke="currentColor" stroke-width="1.6"/></svg>
							<span class="ih-bk__tzname" data-bk-tz-name>Europe/Rome</span>
							<span class="ih-bk__tznow" data-bk-tz-now></span>
							<svg class="ih-bk__tzcaret" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6.5 9.5 5.5 5.5 5.5-5.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
					</li>
				</ul>

				<?php if ( ! empty( $immensive_bk['points'] ) ) : ?>
					<div class="ih-bk__points">
						<p class="ih-bk__points-title"><?php esc_html_e( 'Cosa vedremo insieme', 'immensive' ); ?></p>
						<ul>
							<?php foreach ( $immensive_bk['points'] as $immensive_bk_point ) : ?>
								<li><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m5 12.5 4.2 4.2L19 7" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg><?php echo esc_html( $immensive_bk_point ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="ih-bk__host">
					<span class="ih-bk__avatar" aria-hidden="true"><span>im</span></span>
					<p><strong><?php esc_html_e( 'Team Immensive', 'immensive' ); ?></strong><br><?php esc_html_e( 'Rispondiamo entro un giorno lavorativo', 'immensive' ); ?></p>
				</div>
			</div>
		</aside>

		<!-- ============ Right: steps ============ -->
		<section class="ih-bk__main">
			<ol class="ih-bk__steps" aria-label="<?php esc_attr_e( 'Avanzamento prenotazione', 'immensive' ); ?>">
				<li class="is-current" data-step="1"><span>1</span><em><?php esc_html_e( 'Data', 'immensive' ); ?></em></li>
				<li data-step="2"><span>2</span><em><?php esc_html_e( 'Orario', 'immensive' ); ?></em></li>
				<li data-step="3"><span>3</span><em><?php esc_html_e( 'I tuoi dati', 'immensive' ); ?></em></li>
				<li class="ih-bk__steps-bar" aria-hidden="true"><i></i></li>
			</ol>

			<div class="ih-bk__stage">

				<!-- 1 · Calendar -->
				<div class="ih-bk__view is-active" data-view="date">
					<header class="ih-bk__head">
						<h3><?php esc_html_e( 'Scegli la data', 'immensive' ); ?></h3>
						<p><?php esc_html_e( 'Seleziona un giorno dal calendario: puoi prenotare da oggi in poi. Dopo la data sceglierai l’orario.', 'immensive' ); ?></p>
					</header>

					<div class="ih-bk__cal">
						<div class="ih-bk__cal-bar">
							<button type="button" class="ih-bk__nav" data-bk-prev aria-label="<?php esc_attr_e( 'Mese precedente', 'immensive' ); ?>"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m14.5 6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
							<p class="ih-bk__month" data-bk-month aria-live="polite"></p>
							<button type="button" class="ih-bk__nav" data-bk-next aria-label="<?php esc_attr_e( 'Mese successivo', 'immensive' ); ?>"><svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9.5 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
						</div>
						<div class="ih-bk__dow" aria-hidden="true">
							<span><?php esc_html_e( 'Lun', 'immensive' ); ?></span><span><?php esc_html_e( 'Mar', 'immensive' ); ?></span><span><?php esc_html_e( 'Mer', 'immensive' ); ?></span><span><?php esc_html_e( 'Gio', 'immensive' ); ?></span><span><?php esc_html_e( 'Ven', 'immensive' ); ?></span><span><?php esc_html_e( 'Sab', 'immensive' ); ?></span><span><?php esc_html_e( 'Dom', 'immensive' ); ?></span>
						</div>
						<div class="ih-bk__days" data-bk-days role="grid"></div>
					</div>

					<ul class="ih-bk__legend" aria-hidden="true">
						<li><i class="is-today"></i><?php esc_html_e( 'Oggi', 'immensive' ); ?></li>
						<li><i class="is-free"></i><?php esc_html_e( 'Disponibile', 'immensive' ); ?></li>
						<li><i class="is-past"></i><?php esc_html_e( 'Non prenotabile', 'immensive' ); ?></li>
					</ul>
				</div>

				<!-- 2 · Time slots -->
				<div class="ih-bk__view" data-view="time">
					<button type="button" class="ih-bk__back" data-bk-to="date">
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m14.5 6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<?php esc_html_e( 'Cambia data', 'immensive' ); ?>
					</button>
					<header class="ih-bk__head">
						<h3><?php esc_html_e( 'Scegli l’orario', 'immensive' ); ?></h3>
						<p class="ih-bk__picked-date" data-bk-date-label></p>
						<p class="ih-bk__count" data-bk-count></p>
					</header>
					<div class="ih-bk__slots" data-bk-slots></div>
					<div class="ih-bk__empty" data-bk-empty hidden>
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.5"/><path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<p><?php esc_html_e( 'Per oggi gli orari sono terminati.', 'immensive' ); ?></p>
						<button type="button" class="ih-bk__link" data-bk-next-day><?php esc_html_e( 'Vedi il giorno successivo', 'immensive' ); ?> →</button>
					</div>
				</div>

				<!-- 3 · Form -->
				<div class="ih-bk__view" data-view="form">
					<button type="button" class="ih-bk__back" data-bk-to="time">
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m14.5 6-6 6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
						<?php esc_html_e( 'Cambia orario', 'immensive' ); ?>
					</button>

					<div class="ih-bk__summary">
						<span class="ih-bk__summary-ico" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none"><rect x="3.5" y="5" width="17" height="15.5" rx="3" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 10h17M8 3v4M16 3v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
						</span>
						<p><strong data-bk-sum-date></strong><span data-bk-sum-time></span></p>
					</div>

					<header class="ih-bk__head ih-bk__head--tight">
						<h3><?php esc_html_e( 'Ultimi dettagli', 'immensive' ); ?></h3>
						<p><?php esc_html_e( 'Ti servono pochi secondi: useremo questi dati per inviarti la conferma.', 'immensive' ); ?></p>
					</header>

					<form class="ih-bk__form" data-bk-form novalidate>
						<div class="ih-bk__row">
							<div class="ih-bk__field">
								<input type="text" id="bk-nome" name="nome" placeholder=" " autocomplete="name" required>
								<label for="bk-nome"><?php esc_html_e( 'Nome e cognome*', 'immensive' ); ?></label>
							</div>
							<div class="ih-bk__field">
								<input type="email" id="bk-email" name="email" placeholder=" " autocomplete="email" required>
								<label for="bk-email"><?php esc_html_e( 'Email*', 'immensive' ); ?></label>
							</div>
						</div>
						<div class="ih-bk__row">
							<div class="ih-bk__field">
								<input type="tel" id="bk-tel" name="telefono" placeholder=" " autocomplete="tel" required>
								<label for="bk-tel"><?php esc_html_e( 'Telefono*', 'immensive' ); ?></label>
							</div>
							<div class="ih-bk__field">
								<input type="text" id="bk-azienda" name="azienda" placeholder=" " autocomplete="organization">
								<label for="bk-azienda"><?php esc_html_e( 'Azienda o istituto', 'immensive' ); ?></label>
							</div>
						</div>
						<?php if ( ! empty( $immensive_bk['extra']['options'] ) ) : ?>
							<div class="ih-bk__field ih-bk__field--select">
								<select id="bk-extra" name="extra">
									<option value="" selected></option>
									<?php foreach ( $immensive_bk['extra']['options'] as $immensive_bk_opt ) : ?>
										<option value="<?php echo esc_attr( $immensive_bk_opt ); ?>"><?php echo esc_html( $immensive_bk_opt ); ?></option>
									<?php endforeach; ?>
								</select>
								<label for="bk-extra"><?php echo esc_html( $immensive_bk['extra']['label'] ); ?></label>
								<svg class="ih-bk__caret" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6.5 9.5 5.5 5.5 5.5-5.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
							</div>
						<?php endif; ?>
						<div class="ih-bk__field ih-bk__field--area">
							<textarea id="bk-msg" name="messaggio" rows="3" placeholder=" "></textarea>
							<label for="bk-msg"><?php esc_html_e( 'Vuoi anticiparci qualcosa? (facoltativo)', 'immensive' ); ?></label>
						</div>

						<label class="ih-bk__privacy">
							<input type="checkbox" name="privacy" required>
							<span class="ih-bk__check" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12.5 4.2 4.2L19 7" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
							<span><?php esc_html_e( 'Autorizzo il trattamento dei miei dati personali ai sensi del Regolamento UE 2016/679 (GDPR).', 'immensive' ); ?></span>
						</label>

						<p class="ih-bk__error" data-bk-error role="alert" hidden><?php esc_html_e( 'Controlla i campi evidenziati per completare la prenotazione.', 'immensive' ); ?></p>

						<button type="submit" class="ih-btn ih-btn--solid ih-bk__submit"><?php esc_html_e( 'Conferma prenotazione', 'immensive' ); ?></button>
					</form>
				</div>

				<!-- 4 · Done -->
				<div class="ih-bk__view ih-bk__view--done" data-view="done">
					<div class="ih-bk__burst" data-bk-burst aria-hidden="true"></div>
					<div class="ih-bk__done-mark" aria-hidden="true">
						<svg viewBox="0 0 80 80" fill="none"><circle class="c" cx="40" cy="40" r="34" stroke="currentColor" stroke-width="2.4"/><path class="t" d="m25 41 10.5 10.5L56 29.5" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</div>
					<h3><?php esc_html_e( 'Prenotazione ricevuta!', 'immensive' ); ?></h3>
					<p class="ih-bk__done-sub"><?php esc_html_e( 'Ti abbiamo riservato questo appuntamento. Riceverai a breve una email di conferma con il link alla videochiamata.', 'immensive' ); ?></p>
					<div class="ih-bk__ticket">
						<p class="ih-bk__ticket-topic" data-bk-done-topic></p>
						<p class="ih-bk__ticket-when"><strong data-bk-done-date></strong><span data-bk-done-time></span></p>
						<p class="ih-bk__ticket-who" data-bk-done-who></p>
					</div>
					<button type="button" class="ih-btn ih-btn--outline" data-bk-close><?php esc_html_e( 'Chiudi', 'immensive' ); ?></button>
				</div>

			</div>

		</section>
		<!-- Time zone dropdown (opens from the link in the left panel) -->
		<div class="ih-bk__tzpanel" data-bk-tz-panel role="dialog" aria-label="<?php esc_attr_e( 'Scegli il fuso orario', 'immensive' ); ?>" hidden>
			<div class="ih-bk__tzsearch">
				<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="1.8"/><path d="m16 16 4.5 4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
				<input type="search" data-bk-tz-search placeholder="<?php esc_attr_e( 'Cerca città o paese…', 'immensive' ); ?>" autocomplete="off" spellcheck="false" aria-label="<?php esc_attr_e( 'Cerca fuso orario', 'immensive' ); ?>">
			</div>
			<div class="ih-bk__tzhead">
				<span><?php esc_html_e( 'Fuso orario', 'immensive' ); ?></span>
				<label class="ih-bk__tzswitch">
					<em>am/pm</em>
					<input type="checkbox" data-bk-h24 checked>
					<i aria-hidden="true"></i>
					<em>24h</em>
				</label>
			</div>
			<button type="button" class="ih-bk__tzdetect" data-bk-tz-detect>
				<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="3.2" stroke="currentColor" stroke-width="1.8"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
				<span><?php esc_html_e( 'Usa il mio dispositivo', 'immensive' ); ?> <em data-bk-tz-detected></em></span>
			</button>
			<ul class="ih-bk__tzlist" data-bk-tz-list role="listbox" aria-label="<?php esc_attr_e( 'Fusi orari', 'immensive' ); ?>"></ul>
			<p class="ih-bk__tzempty" data-bk-tz-empty hidden><?php esc_html_e( 'Nessun fuso trovato.', 'immensive' ); ?></p>
		</div>
	</div>
</div>
