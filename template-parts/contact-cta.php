<?php
/**
 * Shared CTA band (dark, centred heading + green button).
 *
 * Accepts overrides via get_template_part() $args:
 * - 'eyebrow' small uppercase line above the heading (optional)
 * - 'heading' big display heading
 * - 'label'   button text
 * - 'href'    button link
 * - 'actions' optional list of buttons (label, href, class) shown instead of the single button
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$immensive_cta = wp_parse_args(
	isset( $args ) && is_array( $args ) ? $args : array(),
	array(
		'eyebrow' => '',
		'heading' => 'CONTATTACI',
		'label'   => __( 'Compila il Form', 'immensive' ),
		'href'    => home_url( '/contatti/' ),
		'actions' => array(),
	)
);
?>
	<section class="ih-contact" id="ih-contact">
		<div class="ih-contact__glow" aria-hidden="true"></div>
		<div class="ih-container ih-contact__content ih-reveal">
			<?php if ( $immensive_cta['eyebrow'] ) : ?>
				<p class="ih-contact__eyebrow"><?php echo esc_html( $immensive_cta['eyebrow'] ); ?></p>
			<?php endif; ?>
			<h2 class="ih-heading ih-heading--center"><?php echo esc_html( $immensive_cta['heading'] ); ?></h2>
			<?php if ( ! empty( $immensive_cta['actions'] ) ) : ?>
				<div class="ih-contact__actions">
					<?php foreach ( $immensive_cta['actions'] as $immensive_cta_action ) : ?>
						<a class="ih-btn <?php echo esc_attr( $immensive_cta_action['class'] ); ?>" href="<?php echo esc_url( $immensive_cta_action['href'] ); ?>"><?php echo esc_html( $immensive_cta_action['label'] ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<a class="ih-btn ih-btn--solid" href="<?php echo esc_url( $immensive_cta['href'] ); ?>">
					<?php echo esc_html( $immensive_cta['label'] ); ?>
				</a>
			<?php endif; ?>
		</div>
	</section>
