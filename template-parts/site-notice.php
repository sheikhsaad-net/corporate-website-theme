<?php
/**
 * Consent notice (bottom left) + preferences panel.
 *
 * Categories follow the Cookie Policy page: Necessari (always on),
 * Funzionalità, Esperienza, Misurazione, Marketing. Logic and storage live in
 * assets/js/site-notice.js; styles in assets/css/site-notice.css.
 * Printed from wp_footer on every front-end page (see functions.php).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_cookie_url  = home_url( '/cookie-policy/' );
$immensive_cookie_cats = array(
	'functionality' => array( __( 'Funzionalità', 'immensive' ), __( 'Moduli di contatto, chat e registrazione.', 'immensive' ) ),
	'experience'    => array( __( 'Esperienza', 'immensive' ), __( 'Video YouTube, mappe e altri contenuti incorporati.', 'immensive' ) ),
	'measurement'   => array( __( 'Misurazione', 'immensive' ), __( "Statistiche anonime sull'uso del sito.", 'immensive' ) ),
	'marketing'     => array( __( 'Marketing', 'immensive' ), __( 'Annunci personalizzati e remarketing.', 'immensive' ) ),
);
?>
<div class="ck" id="ck-bar" role="dialog" aria-modal="false" aria-labelledby="ck-title" hidden>
	<p class="ck__title" id="ck-title"><?php esc_html_e( 'Usiamo i cookie', 'immensive' ); ?></p>
	<p class="ck__text">
		<?php esc_html_e( 'Usiamo cookie necessari e, con il tuo consenso, strumenti per funzionalità, esperienza, misurazione e marketing.', 'immensive' ); ?>
		<a href="<?php echo esc_url( $immensive_cookie_url ); ?>"><?php esc_html_e( 'Cookie Policy', 'immensive' ); ?></a>
	</p>

	<div class="ck__prefs" id="ck-prefs" hidden>
		<div class="ck__row">
			<span><strong><?php esc_html_e( 'Necessari', 'immensive' ); ?></strong><small><?php esc_html_e( 'Sempre attivi: servono al funzionamento del sito.', 'immensive' ); ?></small></span>
			<input type="checkbox" checked disabled aria-label="<?php esc_attr_e( 'Necessari', 'immensive' ); ?>">
		</div>
		<?php foreach ( $immensive_cookie_cats as $immensive_ck_key => $immensive_ck ) : ?>
			<label class="ck__row">
				<span><strong><?php echo esc_html( $immensive_ck[0] ); ?></strong><small><?php echo esc_html( $immensive_ck[1] ); ?></small></span>
				<input type="checkbox" data-ck-cat="<?php echo esc_attr( $immensive_ck_key ); ?>">
			</label>
		<?php endforeach; ?>
	</div>

	<div class="ck__actions">
		<button type="button" class="ck__btn ck__btn--ghost" data-ck="reject"><?php esc_html_e( 'Rifiuta', 'immensive' ); ?></button>
		<button type="button" class="ck__btn ck__btn--ghost" data-ck="customize" aria-expanded="false" aria-controls="ck-prefs"><?php esc_html_e( 'Personalizza', 'immensive' ); ?></button>
		<button type="button" class="ck__btn ck__btn--solid" data-ck="accept"><?php esc_html_e( 'Accetta', 'immensive' ); ?></button>
		<button type="button" class="ck__btn ck__btn--solid" data-ck="save" hidden><?php esc_html_e( 'Salva', 'immensive' ); ?></button>
	</div>
</div>
