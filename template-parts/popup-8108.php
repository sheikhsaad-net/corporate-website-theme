<?php
/**
 * D.Lgs. 81/08 information popup.
 *
 * Shown once per browser session (see the "81/08 popup" block in
 * homepage.js) on the Prodotti home and the product pages.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';
?>
<div class="ih-popup" id="ih-popup-8108" role="dialog" aria-modal="true" aria-labelledby="ih-popup-8108-title" hidden>
	<div class="ih-popup__backdrop" data-popup-close></div>
	<div class="ih-popup__box">
		<button type="button" class="ih-popup__close" data-popup-close aria-label="<?php esc_attr_e( 'Chiudi', 'immensive' ); ?>">&times;</button>
		<p class="ih-popup__eyebrow"><?php esc_html_e( 'Sicurezza sul lavoro', 'immensive' ); ?></p>
		<h2 class="ih-popup__title" id="ih-popup-8108-title"><?php esc_html_e( 'D.Lgs. 81/08: formare è un obbligo', 'immensive' ); ?></h2>
		<p class="ih-popup__text"><?php esc_html_e( 'Il Testo Unico sulla salute e sicurezza sul lavoro impone al datore di lavoro di garantire a ogni lavoratore una formazione sufficiente e adeguata, compreso l\'addestramento pratico per attrezzature e procedure a rischio (artt. 36, 37 e 73).', 'immensive' ); ?></p>
		<p class="ih-popup__text"><?php esc_html_e( 'I simulatori VR Immensive permettono di esercitarsi su saldatura, carrelli elevatori, antincendio e impianti elettrici in totale sicurezza, con report oggettivi per documentare l\'addestramento svolto.', 'immensive' ); ?></p>
		<div class="ih-popup__actions">
			<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Richiedi informazioni', 'immensive' ); ?></a>
			<button type="button" class="ih-btn ih-btn--ghost-dark" data-popup-close><?php esc_html_e( 'Chiudi', 'immensive' ); ?></button>
		</div>
	</div>
</div>
