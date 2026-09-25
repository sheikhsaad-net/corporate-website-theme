<?php
/**
 * Template Name: Immensive – Contatti
 *
 * Uses the shared "ih" header/footer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--altri ih-phero--contatti">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-container ih-cont-hero" id="ih-hero">
			<div class="ih-cont-hero__main">
				<a class="ih-backlink" href="<?php echo esc_url( home_url( '/' ) ); ?>" data-history-back>
					<svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
					<?php esc_html_e( 'Torna indietro', 'immensive' ); ?>
				</a>
				<h1 class="ih-phero__title">GET IN<br>TOUCH</h1>
			</div>

			<div class="ih-cont-actions">
				<a class="ih-cont-btn" href="mailto:info@immensive.it">
					<span class="ih-cont-btn__ico">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					</span>
					<span class="ih-cont-btn__label"><?php esc_html_e( 'Scrivi una mail', 'immensive' ); ?></span>
				</a>
				<a class="ih-cont-btn" href="tel:+390813358542">
					<span class="ih-cont-btn__ico">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.1-2.1c.3-.3.7-.4 1-.3 1.1.4 2.4.6 3.7.6.6 0 1 .5 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.4c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.7.1.4 0 .8-.3 1l-2.1 2.1z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					</span>
					<span class="ih-cont-btn__label"><?php esc_html_e( 'Parla con noi', 'immensive' ); ?></span>
				</a>
				<a class="ih-cont-btn" href="#ih-cont-form">
					<span class="ih-cont-btn__ico">
						<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 4H4a1 1 0 0 0-1 1v14l3.5-3H20a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
					</span>
					<span class="ih-cont-btn__label"><?php esc_html_e( 'Live chat', 'immensive' ); ?></span>
				</a>
			</div>
		</div>

		<div class="ih-container ih-cont__grid" id="ih-cont">

			<div class="ih-cont__info ih-reveal">
				<h2 class="ih-cont__eyebrow"><?php esc_html_e( 'Dove siamo', 'immensive' ); ?></h2>

				<div class="ih-cont__place">
					<span class="ih-cont__place-dot" aria-hidden="true"></span>
					<div>
						<span class="ih-cont__place-title"><?php esc_html_e( 'Sede legale', 'immensive' ); ?></span>
						<p class="ih-cont__place-text">Via Firenze 3, 81030 Parete (CE), Italia<br>P.iva 04188380614</p>
					</div>
				</div>

				<div class="ih-cont__place">
					<span class="ih-cont__place-dot" aria-hidden="true"></span>
					<div>
						<span class="ih-cont__place-title"><?php esc_html_e( 'Sede operativa', 'immensive' ); ?></span>
						<p class="ih-cont__place-text">Via Giuseppe Savoia 191, 81030 Casaluce (CE), Italia<br><a href="tel:+390813358542">081 3358542</a></p>
					</div>
				</div>

				<div class="ih-cont__map">
					<iframe
						src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3011.846066937972!2d14.194813976568456!3d40.9848514208662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133b0475f88abd17%3A0x66a1109dd87f648f!2sImmensive!5e0!3m2!1sen!2sus!4v1784636454588!5m2!1sen!2sus"
						title="<?php esc_attr_e( 'Mappa sede Immensive', 'immensive' ); ?>"
						loading="lazy"
						referrerpolicy="strict-origin-when-cross-origin"
						allowfullscreen></iframe>
				</div>
			</div>

			<div class="ih-cont__form-col ih-reveal">
				<h2 class="ih-cont__heading">COMPILA IL FORM PER<br>CONTATTARCI</h2>

				<form class="ih-cont-form" id="ih-cont-form" novalidate>
					<?php wp_nonce_field( 'immensive_contact_form', 'cf-nonce', false ); ?>
					<div class="ih-field ih-field--hp" aria-hidden="true">
						<label for="cf-website">Sito web</label>
						<input class="ih-field__input" type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
					</div>

					<div class="ih-cont-form__row">
						<div class="ih-field">
							<input class="ih-field__input" type="text" id="cf-nome" name="nome" placeholder=" " required>
							<label class="ih-field__label" for="cf-nome">Nome*</label>
						</div>
						<div class="ih-field">
							<input class="ih-field__input" type="text" id="cf-cognome" name="cognome" placeholder=" " required>
							<label class="ih-field__label" for="cf-cognome">Cognome*</label>
						</div>
					</div>

					<div class="ih-cont-form__row">
						<div class="ih-field">
							<input class="ih-field__input" type="email" id="cf-email" name="email" placeholder=" " required>
							<label class="ih-field__label" for="cf-email">Email*</label>
						</div>
						<div class="ih-field">
							<input class="ih-field__input" type="tel" id="cf-tel" name="telefono" placeholder=" ">
							<label class="ih-field__label" for="cf-tel">Telefono</label>
						</div>
					</div>

					<div class="ih-cont-form__row">
						<div class="ih-field">
							<input class="ih-field__input" type="text" id="cf-societa" name="societa" placeholder=" ">
							<label class="ih-field__label" for="cf-societa">Società</label>
						</div>
						<div class="ih-field">
							<input class="ih-field__input" type="text" id="cf-settore" name="settore" placeholder=" ">
							<label class="ih-field__label" for="cf-settore">Settore</label>
						</div>
					</div>

					<div class="ih-field ih-field--area">
						<textarea class="ih-field__input" id="cf-msg" name="messaggio" rows="4" placeholder=" " required></textarea>
						<label class="ih-field__label" for="cf-msg"><?php esc_html_e( 'Messaggio', 'immensive' ); ?></label>
					</div>

					<label class="ih-cont-form__privacy">
						<input type="checkbox" name="privacy" required>
						<span><?php esc_html_e( 'Autorizzo il trattamento dei miei dati personali ai sensi del Decreto Legislativo 30 giugno 2003, n. 196 "Codice in materia di protezione dei dati personali" e del Regolamento UE 2016/679.', 'immensive' ); ?></span>
					</label>

					<p class="ih-cont-form__status" id="ih-cont-form-status" role="status" aria-live="polite" hidden></p>

					<button type="submit" class="ih-btn ih-btn--solid ih-cont-form__submit"><?php esc_html_e( 'Invia Richiesta', 'immensive' ); ?></button>
				</form>
			</div>

		</div>
	</section>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

</div>

<?php
get_footer();
