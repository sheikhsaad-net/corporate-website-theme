<?php
/**
 * Template Name: Immensive – Rivenditori
 *
 * Uses the shared "ih" header/footer. Body content to follow.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_img = get_template_directory_uri() . '/assets/images/';

// Reseller inquiry CTAs all route to the Contatti page (see the same
// get_page_by_path() fallback pattern in template-innovazione.php etc.) —
// this page has no dedicated form/booking flow of its own.
$immensive_contatti     = get_page_by_path( 'contatti' );
$immensive_contatti_url = $immensive_contatti ? get_permalink( $immensive_contatti ) : 'mailto:info@immensive.it';

get_header();
?>

<div class="ih ih--light-hero">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--light ih-phero--riv" id="ih-hero">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-phero__inner">
			<h1 class="ih-phero__title">
				DIVENTA RIVENDITORE<br>AUTORIZZATO IMMENSIVE<br>IN EUROPA
			</h1>
			<div class="ih-phero__actions">
				<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Richiedi informazioni', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--ghost" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Prenota una call di 30 minuti', 'immensive' ); ?></a>
			</div>
			<div class="ih-phero__scroll" aria-hidden="true">
				<span class="ih-phero__scroll-dot"></span>
			</div>
		</div>
	</section>

	<div class="ih-flow">

	<section class="ih-wr" id="ih-wr">
		<div class="ih-wr__sticky">
			<div class="ih-wr__headwrap">
				<h2 class="ih-wr__heading">PERCHÉ RIVENDERE<br>CON IMMENSIVE</h2>
				<span class="ih-wr__badge" aria-hidden="true"></span>
			</div>
		</div>

		<div class="ih-container ih-wr__cards">
			<?php
			$immensive_wr_rows = array(
				array(
					'slug'  => 'why-01',
					'fall'  => 'rivenditori/partners_3flussi_unico_contratto.webp',
					'num'   => '01',
					'title' => 'Tre flussi di ricavo in un unico contratto.',
					'desc'  => 'Guadagni tre volte. Un margine sulla vendita — sul listino cliente finale e sull\'hardware mass-market che gestisci in autonomia — e una fee ricorrente sui ricavi da abbonamento che ogni tuo cliente genera nel tempo. In più, ogni lead che arriva a Immensive dal tuo paese te lo giriamo con commissione referral riconosciuta sulla vendita: la nostra pipeline diventa la tua, senza costo di acquisizione da parte tua.',
				),
				array(
					'slug'  => 'why-02',
					'fall'  => 'rivenditori/partners_professional_simulators.webp',
					'num'   => '02',
					'title' => 'Simulatori altamente professionali',
					'desc'  => 'Simulatori VR verticali costruiti specificamente per la formazione tecnica industriale: saldatura, sollevamento, antincendio, impianti elettrici. Non una piattaforma VR generalista, ma strumenti professionali che combinano software proprietario e kit hardware fisici — torce, estintori, controller dedicati — che riproducono il gesto vero. Prodotti Made in Italy con base installata comprovata (circa 300 licenze già attive), Unreal Authorized Training Center, Premio TOPofthePID 2024 e procedure allineate agli standard ISO.',
				),
				array(
					'slug'  => 'why-03',
					'fall'  => 'rivenditori/partners_full_sales_kit.webp',
					'num'   => '03',
					'title' => 'Un ecosistema commerciale a tua disposizione.',
					'desc'  => 'Non ti mandiamo un prodotto lasciandoti solo davanti al cliente. Trovi un arsenale commerciale pronto all\'uso — brochure, video demo, schede tecniche, calcolatore ROI, hardware compatibility list, template di proposta — tutto in inglese e localizzabile nella tua lingua. Ti accompagniamo con un onboarding strutturato di formazione tecnica e commerciale, e ti diamo accesso al portale distributori (soluzioni.immensive.it) dove gestisci lead, licenze e commissioni: in modo trasparente e protetto da conflitti con altri partner della rete.',
				),
				array(
					'slug'  => 'why-04',
					'fall'  => 'rivenditori/partners_mature_demand.webp',
					'num'   => '04',
					'title' => 'Domanda matura, offerta frammentata.',
					'desc'  => 'La formazione VR non è più una scommessa: è un mercato in accelerazione. In Italia oltre 300 licenze sono già attive tra scuola tecnica e manifatturiero, spinte dagli obblighi di formazione preventiva (D.Lgs. 81/08, che discende dalla Direttiva Quadro 89/391/CEE valida in tutta l\'UE) e dagli incentivi fiscali alla trasformazione digitale della formazione. Nei tuoi paesi la domanda è pronta ma l\'offerta ancora frammentata: essere il primo partner Immensive nel tuo mercato è un vantaggio che si trasforma velocemente in pipeline.',
				),
			);
			foreach ( $immensive_wr_rows as $immensive_row ) :
				$immensive_row_img = 'rivenditori/' . $immensive_row['slug'] . '.webp';
				if ( ! file_exists( get_template_directory() . '/assets/images/' . $immensive_row_img ) ) {
					$immensive_row_img = $immensive_row['fall'];
				}
				?>
				<article class="ih-wr__row ih-reveal">
					<div class="ih-wr__media">
						<img src="<?php echo esc_url( $immensive_img . $immensive_row_img ); ?>" alt="" loading="lazy">
						<span class="ih-wr__num"><?php echo esc_html( $immensive_row['num'] ); ?></span>
					</div>
					<div class="ih-wr__text">
						<h3 class="ih-wr__title"><?php echo esc_html( $immensive_row['title'] ); ?></h3>
						<p class="ih-wr__desc"><?php echo esc_html( $immensive_row['desc'] ); ?></p>
					</div>
				</article>
				<?php if ( '02' === $immensive_row['num'] ) : ?>
					<?php
					// Award/partner logo marquee. Drop files into
					// /assets/images/rivenditori/loghi/ to replace the placeholders.
					$immensive_logo_files = glob( get_template_directory() . '/assets/images/rivenditori/loghi/*.{webp,png,svg,jpg}', GLOB_BRACE );
					?>
					<div class="ih-wr__logos" aria-hidden="true">
						<div class="ih-wr__logos-track">
							<?php for ( $immensive_g = 0; $immensive_g < 2; $immensive_g++ ) : ?>
								<div class="ih-wr__logos-group">
									<?php if ( $immensive_logo_files ) : ?>
										<?php foreach ( $immensive_logo_files as $immensive_logo_file ) : ?>
											<img class="ih-wr__logo" src="<?php echo esc_url( $immensive_img . 'rivenditori/loghi/' . basename( $immensive_logo_file ) ); ?>" alt="" loading="lazy">
										<?php endforeach; ?>
									<?php else : ?>
										<?php for ( $immensive_l = 1; $immensive_l <= 8; $immensive_l++ ) : ?>
											<span class="ih-wr__logo-ph">LOGO <?php echo esc_html( str_pad( (string) $immensive_l, 2, '0', STR_PAD_LEFT ) ); ?></span>
										<?php endfor; ?>
									<?php endif; ?>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="ih-stats">
		<div class="ih-container">
			<h2 class="ih-stats__title ih-reveal">LASCIAMO PARLARE<br>I NUMERI</h2>
			<p class="ih-stats__sub ih-reveal"><?php esc_html_e( 'I simulatori Immensive sono il riferimento per la formazione professionale nella scuola italiana. Porta i nostri prodotti nel tuo paese.', 'immensive' ); ?></p>
			<div class="ih-stats__cta ih-reveal">
				<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( $immensive_contatti_url ); ?>"><?php esc_html_e( 'Diventa rivenditore', 'immensive' ); ?></a>
			</div>
			<div class="ih-stats__grid">
				<div class="ih-stat ih-stat--dark ih-reveal">
					<span class="ih-stat__number" data-count="350">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Licenze vendute', 'immensive' ); ?></p>
				</div>
				<div class="ih-stat ih-stat--green ih-reveal">
					<span class="ih-stat__number" data-count="200">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Clienti in Italia', 'immensive' ); ?></p>
				</div>
				<div class="ih-stat ih-stat--muted ih-reveal">
					<span class="ih-stat__number" data-count="10">0</span><span class="ih-stat__plus">+</span>
					<p><?php esc_html_e( 'Premi ai prodotti', 'immensive' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<?php
	get_template_part(
		'template-parts/contact-cta',
		null,
		array(
			'eyebrow' => __( 'Vuoi collaborare?', 'immensive' ),
			'heading' => "PARLIAMONE",
			'label'   => 'partners@immensive.it',
			'href'    => 'mailto:partners@immensive.it',
		)
	);
	?>

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
