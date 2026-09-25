<?php
/**
 * Reusable "Richiedi maggiori informazioni" demo request popup.
 *
 * Included on the four product pages (Weld/Electro/Forklift/Firefighter VR)
 * in place of the old mailto: link on the "Richiedi Demo" CTA. Submits via
 * AJAX to immensive_handle_demo_form() in functions.php, which always mails
 * info@immensive.it regardless of the site's admin_email setting.
 *
 * @param string $args['product'] Product name shown in the modal's intro line.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_demo_product = isset( $args['product'] ) ? $args['product'] : '';
?>
<div class="ih-modal" id="ih-demo-modal" aria-hidden="true">
	<div class="ih-modal__overlay" data-modal-close></div>
	<div class="ih-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="ih-demo-modal-title">
		<button type="button" class="ih-modal__close" data-modal-close aria-label="<?php esc_attr_e( 'Chiudi', 'immensive' ); ?>">
			<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
		</button>

		<h2 class="ih-modal__title" id="ih-demo-modal-title"><?php esc_html_e( 'Richiedi maggiori informazioni', 'immensive' ); ?></h2>
		<p class="ih-modal__sub">
			<?php
			/* translators: %s: product name, e.g. "Weld VR Simulator". */
			echo esc_html( sprintf( __( 'Sei interessato a %s? Compila il form per avere maggiori informazioni.', 'immensive' ), $immensive_demo_product ) );
			?>
		</p>

		<form class="ih-cont-form ih-modal__form" id="ih-demo-form" novalidate>
			<?php wp_nonce_field( 'immensive_demo_form', 'df-nonce', false ); ?>
			<input type="hidden" name="prodotto" value="<?php echo esc_attr( $immensive_demo_product ); ?>">

			<div class="ih-field ih-field--hp" aria-hidden="true">
				<label for="df-website">Sito web</label>
				<input class="ih-field__input" type="text" id="df-website" name="website" tabindex="-1" autocomplete="off">
			</div>

			<div class="ih-field">
				<input class="ih-field__input" type="text" id="df-nome" name="nome" placeholder=" " required>
				<label class="ih-field__label" for="df-nome"><?php esc_html_e( 'Nome e cognome*', 'immensive' ); ?></label>
			</div>

			<div class="ih-field">
				<input class="ih-field__input" type="email" id="df-email" name="email" placeholder=" " required>
				<label class="ih-field__label" for="df-email"><?php esc_html_e( 'Email*', 'immensive' ); ?></label>
			</div>

			<div class="ih-field">
				<input class="ih-field__input" type="tel" id="df-tel" name="telefono" placeholder=" " required>
				<label class="ih-field__label" for="df-tel"><?php esc_html_e( 'Numero di telefono*', 'immensive' ); ?></label>
			</div>

			<div class="ih-field">
				<input class="ih-field__input" type="text" id="df-citta" name="citta" placeholder=" ">
				<label class="ih-field__label" for="df-citta"><?php esc_html_e( 'Città', 'immensive' ); ?></label>
			</div>

			<div class="ih-field">
				<input class="ih-field__input" type="text" id="df-azienda" name="azienda" placeholder=" ">
				<label class="ih-field__label" for="df-azienda"><?php esc_html_e( 'Istituto o Azienda', 'immensive' ); ?></label>
			</div>

			<div class="ih-field ih-field--area">
				<textarea class="ih-field__input" id="df-msg" name="messaggio" rows="4" placeholder=" "></textarea>
				<label class="ih-field__label" for="df-msg"><?php esc_html_e( 'Messaggio', 'immensive' ); ?></label>
			</div>

			<label class="ih-cont-form__privacy">
				<input type="checkbox" name="privacy" required>
				<span><?php esc_html_e( 'Autorizzo il trattamento dei miei dati personali ai sensi del Decreto Legislativo 30 giugno 2003, n. 196 "Codice in materia di protezione dei dati personali" e del Regolamento UE 2016/679.', 'immensive' ); ?></span>
			</label>

			<p class="ih-cont-form__status" id="ih-demo-form-status" role="status" aria-live="polite" hidden></p>

			<button type="submit" class="ih-btn ih-btn--cyan ih-cont-form__submit"><?php esc_html_e( 'Invia Richiesta', 'immensive' ); ?></button>
		</form>
	</div>
</div>
