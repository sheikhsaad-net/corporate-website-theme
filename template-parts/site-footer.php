<?php
/**
 * Shared site footer for all "ih" (Immensive) page templates.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';
?>
	<footer class="ih-footer">
		<div class="ih-container ih-footer__inner">
			<div class="ih-footer__brand">
				<p class="ih-footer__desc"><?php esc_html_e( 'Immensive è specializzata nello sviluppo di progetti customizzati in realtà estesa (VR, AR, MR). Partendo dall\'idea aziendale, studiamo il progetto, individuiamo la migliore tecnologia da impiegare e sviluppiamo l\'applicativo.', 'immensive' ); ?></p>

				<p class="ih-footer__email">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
					<a href="mailto:info@immensive.it">info@immensive.it</a>
				</p>

				<div class="ih-footer__follow">
					<span class="ih-footer__title"><?php esc_html_e( 'Seguici', 'immensive' ); ?></span>
					<div class="ih-footer__social">
						<a href="https://it-it.facebook.com/immensivevr/" target="_blank" rel="noopener" aria-label="Facebook">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 8.5h2V5h-2c-2.2 0-4 1.8-4 4v2H9v3.5h2V21h3.5v-6.5H17l.5-3.5h-3V9c0-.6.4-1 1-1z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/></svg>
						</a>
						<a href="https://twitter.com/immensivevr" target="_blank" rel="noopener" aria-label="Twitter">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 5.9c-.7.3-1.5.6-2.3.7.8-.5 1.5-1.3 1.8-2.2-.8.5-1.6.8-2.5 1a3.9 3.9 0 0 0-6.7 3.6A11.2 11.2 0 0 1 4 4.9a3.9 3.9 0 0 0 1.2 5.3c-.6 0-1.2-.2-1.7-.5v.1c0 1.9 1.4 3.5 3.2 3.9-.5.1-1.1.2-1.7.1.5 1.6 2 2.7 3.7 2.8A7.9 7.9 0 0 1 2 18.6a11.2 11.2 0 0 0 6.1 1.8c7.3 0 11.3-6.1 11.3-11.3v-.5c.8-.6 1.5-1.3 2-2.1" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round" stroke-linecap="round"/></svg>
						</a>
						<a href="https://www.youtube.com/channel/UC-aZsNHlurbF7lDNuwMvK-Q" target="_blank" rel="noopener" aria-label="YouTube">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="6" width="18" height="12" rx="4" stroke="currentColor" stroke-width="1.5"/><path d="M10.3 9.6v4.8l4.4-2.4-4.4-2.4z" fill="currentColor"/></svg>
						</a>
						<a href="https://www.linkedin.com/company/immensive/" target="_blank" rel="noopener" aria-label="LinkedIn">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.94 5a1.94 1.94 0 1 1-3.88 0 1.94 1.94 0 0 1 3.88 0ZM3.4 8.6h3.1V21H3.4V8.6Zm5.06 0h2.97v1.7h.04c.41-.78 1.42-1.6 2.93-1.6 3.13 0 3.71 2.06 3.71 4.74V21h-3.1v-5.5c0-1.31-.02-3-1.83-3-1.83 0-2.11 1.43-2.11 2.9V21h-3.1V8.6Z"/></svg>
						</a>
						<a href="https://www.instagram.com/immensivevr/" target="_blank" rel="noopener" aria-label="Instagram">
							<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor"/></svg>
						</a>
					</div>
				</div>
			</div>

			<div class="ih-footer__col">
				<h3 class="ih-footer__title"><?php esc_html_e( 'Prodotti', 'immensive' ); ?></h3>
				<ul class="ih-footer__links">
					<li><a href="<?php echo esc_url( home_url( '/weld-vr/' ) ); ?>">Weld VR Simulator</a></li>
					<li><a href="<?php echo esc_url( home_url( '/forklift-vr/' ) ); ?>">Forklift VR Simulator</a></li>
					<li><a href="<?php echo esc_url( home_url( '/firefighter-vr/' ) ); ?>">Firefighter VR Simulator</a></li>
					<li><a href="<?php echo esc_url( home_url( '/electro-vr/' ) ); ?>">Electro VR Simulator</a></li>
				</ul>
				<a class="ih-footer__title ih-footer__title--link" href="<?php echo esc_url( home_url( '/piani/' ) ); ?>"><?php esc_html_e( 'Piani', 'immensive' ); ?></a>
				<a class="ih-footer__title ih-footer__title--link" href="<?php echo esc_url( home_url( '/rivenditori/' ) ); ?>"><?php esc_html_e( 'Rivenditori EU', 'immensive' ); ?></a>
			</div>

			<div class="ih-footer__col">
				<h3 class="ih-footer__title"><?php esc_html_e( 'Altri Servizi', 'immensive' ); ?></h3>
				<ul class="ih-footer__links">
					<li><a href="<?php echo esc_url( home_url( '/soluzioni-culturali-creative/' ) ); ?>"><?php esc_html_e( 'Soluzioni Culturali Creative', 'immensive' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/ricerca/' ) ); ?>"><?php esc_html_e( 'Ricerca', 'immensive' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/innovazione/' ) ); ?>"><?php esc_html_e( 'Innovazione', 'immensive' ); ?></a></li>
				</ul>
				<a class="ih-footer__title ih-footer__title--link" href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'immensive' ); ?></a>
				<a class="ih-footer__title ih-footer__title--link" href="<?php echo esc_url( home_url( '/contatti/' ) ); ?>"><?php esc_html_e( 'Contatti', 'immensive' ); ?></a>
			</div>
		</div>

		<div class="ih-footer__watermark" aria-hidden="true">
			<img src="<?php echo esc_url( $immensive_img . 'logo-immensive-white.webp' ); ?>" alt="" loading="lazy">
		</div>

		<div class="ih-container">
			<p class="ih-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> immensive s.r.l. | Sede legale Via Firenze 3, 81030 Parete (CE), Italia . P.iva: 04188380614 | Capitale sociale: &euro; 215.000,00 .
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a> . <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>">Cookie Policy</a>
			</p>
		</div>
	</footer>
