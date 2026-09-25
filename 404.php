<?php
/**
 * The template for displaying 404 pages in the Immensive theme.
 *
 * Uses the shared "ih" header/footer, same as the page templates — see
 * immensive_is_ih_page() in functions.php, which treats is_404() as part of
 * the ih shell even though it isn't a page template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="ih">

	<?php get_template_part( 'template-parts/site-header' ); ?>

	<section class="ih-phero ih-phero--altri ih-phero--404" id="ih-hero">
		<div class="ih-phero__bg" aria-hidden="true"></div>

		<div class="ih-phero__inner ih-404__inner">
			<p class="ih-404__code">404</p>
			<h1 class="ih-phero__title"><?php esc_html_e( 'PAGINA NON TROVATA', 'immensive' ); ?></h1>
			<p class="ih-phero__sub"><?php esc_html_e( 'La pagina che stai cercando non esiste più, è stata spostata oppure l\'indirizzo contiene un errore.', 'immensive' ); ?></p>

			<div class="ih-phero__actions ih-404__actions">
				<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Torna alla Home', 'immensive' ); ?></a>
				<a class="ih-btn ih-btn--ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Scopri i Prodotti', 'immensive' ); ?></a>
			</div>

			<?php
			$immensive_404_links = array(
				array( 'label' => __( 'Piani', 'immensive' ), 'url' => home_url( '/piani/' ) ),
				array( 'label' => __( 'Rivenditori', 'immensive' ), 'url' => home_url( '/rivenditori/' ) ),
				array( 'label' => __( 'Chi Siamo', 'immensive' ), 'url' => home_url( '/chi-siamo/' ) ),
				array( 'label' => __( 'Contatti', 'immensive' ), 'url' => home_url( '/contatti/' ) ),
			);
			?>
			<nav class="ih-404__links" aria-label="<?php esc_attr_e( 'Pagine principali', 'immensive' ); ?>">
				<?php foreach ( $immensive_404_links as $immensive_404_link ) : ?>
					<a href="<?php echo esc_url( $immensive_404_link['url'] ); ?>"><?php echo esc_html( $immensive_404_link['label'] ); ?></a>
				<?php endforeach; ?>
			</nav>
		</div>
	</section>

	<div class="ih-flow">

	<?php get_template_part( 'template-parts/site-footer' ); ?>

	</div><!-- .ih-flow -->

</div>

<?php
get_footer();
