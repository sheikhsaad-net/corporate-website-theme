<?php
/**
 * D.Lgs. 81/08 information popup.
 *
 * Opens as soon as the page loads on the Prodotti home and the product pages
 * (see the "81/08 popup" block in homepage.js) until the visitor picks
 * "Non mostrare più per qualche giorno".
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_prodotti     = get_page_by_path( 'prodotti-per-la-formazione' );
$immensive_prodotti_url = $immensive_prodotti ? get_permalink( $immensive_prodotti ) : home_url( '/' );
?>
<div class="ih-popup" id="ih-popup-8108" role="dialog" aria-modal="true" aria-labelledby="ih-popup-8108-title" hidden>
	<div class="ih-popup__backdrop" data-popup-close></div>
	<div class="ih-popup__box">
		<span class="ih-popup__arc" aria-hidden="true"></span>

		<span class="ih-popup__badge"><?php esc_html_e( 'Novità normativa', 'immensive' ); ?></span>

		<h2 class="ih-popup__title" id="ih-popup-8108-title"><?php esc_html_e( 'Addestramento', 'immensive' ); ?><br><?php esc_html_e( 'sulla sicurezza', 'immensive' ); ?></h2>
		<p class="ih-popup__lead"><?php esc_html_e( 'Ora anche con la simulazione in', 'immensive' ); ?><br><span><?php esc_html_e( 'ambiente virtuale', 'immensive' ); ?></span></p>

		<p class="ih-popup__ref"><strong><?php esc_html_e( 'Art. 37, comma 5 – D.Lgs. 81/2008 (Testo Unico sulla Sicurezza)', 'immensive' ); ?></strong><br><?php esc_html_e( 'Legge n. 34 dell\'11 marzo 2026 · in vigore dal 7 aprile 2026', 'immensive' ); ?></p>

		<blockquote class="ih-popup__quote"><?php esc_html_e( 'Gli interventi di addestramento possono essere effettuati anche mediante l\'uso di moderne tecnologie di simulazione in ambiente reale o virtuale e devono essere tracciati in apposito registro, anche informatizzato.', 'immensive' ); ?></blockquote>

		<p class="ih-popup__text"><?php esc_html_e( 'La realtà virtuale entra a pieno titolo nell\'addestramento alla sicurezza sul lavoro. Con le soluzioni Immensive addestri i tuoi lavoratori in scenari immersivi e sicuri, e tieni traccia di ogni sessione.', 'immensive' ); ?></p>

		<div class="ih-popup__actions">
			<button type="button" class="ih-popup__snooze" data-popup-snooze><?php esc_html_e( 'Non mostrare più per qualche giorno', 'immensive' ); ?></button>
			<a class="ih-popup__cta" href="#" role="button" data-popup-close><?php esc_html_e( 'Scopri le soluzioni VR', 'immensive' ); ?></a>
		</div>
	</div>
</div>
