<?php
/**
 * Dashboard experience for the Immensive team.
 *
 * - Removes what the team never uses here: the Comments menu (comments are
 *   closed on this site) and WordPress's news and events panels.
 * - Adds a short "Guida rapida" panel. Each user only sees the steps their
 *   role allows, so an Editor is not offered menus they cannot open.
 * - Shows a "Gruppo" column on the Portfolio list.
 *
 * Permissions are WordPress's own: nothing here grants a capability.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hide the Comments menu for everyone and the Welcome panel on the dashboard.
 */
function immensive_admin_tidy_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'immensive_admin_tidy_menu', 999 );

function immensive_admin_tidy_welcome() {
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}
add_action( 'admin_init', 'immensive_admin_tidy_welcome' );

/**
 * Replace the default dashboard panels with the quick guide.
 */
function immensive_admin_dashboard_setup() {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

	wp_add_dashboard_widget(
		'immensive_quick_guide',
		__( 'Immensive: guida rapida', 'immensive' ),
		'immensive_quick_guide_render'
	);
}
add_action( 'wp_dashboard_setup', 'immensive_admin_dashboard_setup' );

/**
 * The steps available to the current user, based on their capabilities.
 *
 * @return array<int, array{title: string, url: string, text: string}>
 */
function immensive_quick_guide_steps() {
	$steps = array();

	if ( current_user_can( 'edit_pages' ) ) {
		$steps[] = array(
			'title' => __( 'Modifica i testi delle pagine', 'immensive' ),
			'url'   => admin_url( 'edit.php?post_type=page' ),
			'text'  => __( 'Apri la pagina, cambia il testo e premi Aggiorna. Le modifiche sono subito visibili sul sito.', 'immensive' ),
		);
	}

	if ( current_user_can( 'edit_posts' ) && post_type_exists( 'immensive_work' ) ) {
		$steps[] = array(
			'title' => __( 'Gestisci i progetti del Portfolio', 'immensive' ),
			'url'   => admin_url( 'edit.php?post_type=immensive_work' ),
			'text'  => __( 'Per ogni progetto imposta immagine in evidenza, Tipologia e Gruppo nel portfolio. Scegli anche in quali pagine compare.', 'immensive' ),
		);
	}

	if ( current_user_can( 'edit_theme_options' ) ) {
		$steps[] = array(
			'title' => __( 'Menu di navigazione', 'immensive' ),
			'url'   => admin_url( 'nav-menus.php' ),
			'text'  => __( 'Aspetto > Menu. Ogni pagina sceglie quale menu mostrare dal box "Menu di navigazione" nella colonna laterale.', 'immensive' ),
		);
	}

	return $steps;
}

/**
 * Render the quick guide panel.
 */
function immensive_quick_guide_render() {
	$steps = immensive_quick_guide_steps();

	if ( ! $steps ) {
		echo '<p>' . esc_html__( 'Per modifiche al sito contatta l\'amministratore.', 'immensive' ) . '</p>';
		return;
	}

	echo '<ol class="immensive-guide">';
	foreach ( $steps as $step ) {
		echo '<li class="immensive-guide__step">';
		echo '<a class="immensive-guide__link" href="' . esc_url( $step['url'] ) . '"><strong>' . esc_html( $step['title'] ) . '</strong></a>';
		echo '<p class="immensive-guide__text">' . esc_html( $step['text'] ) . '</p>';
		echo '</li>';
	}
	echo '</ol>';
	echo '<p class="description">' . esc_html__( 'Per modifiche al sito contatta l\'amministratore.', 'immensive' ) . '</p>';
}

/**
 * Small admin styles for the quick guide (no effect on the public site).
 */
function immensive_admin_guide_css() {
	echo '<style>
		.immensive-guide { margin: 0 0 .5em 1.2em; list-style: decimal; }
		.immensive-guide__step { margin: 0 0 .9em; }
		.immensive-guide__link { font-size: 14px; text-decoration: none; }
		.immensive-guide__link:hover, .immensive-guide__link:focus { text-decoration: underline; }
		.immensive-guide__text { margin: .25em 0 0; color: #50575e; }
	</style>';
}
add_action( 'admin_head-index.php', 'immensive_admin_guide_css' );

/**
 * "Gruppo" column on the Portfolio list, next to the title.
 */
function immensive_portfolio_group_column( $columns ) {
	$new = array();
	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;
		if ( 'title' === $key ) {
			$new['immensive_group'] = __( 'Gruppo', 'immensive' );
		}
	}
	return $new;
}
add_filter( 'manage_immensive_work_posts_columns', 'immensive_portfolio_group_column' );

function immensive_portfolio_group_column_content( $column, $post_id ) {
	if ( 'immensive_group' !== $column ) {
		return;
	}
	$group       = get_post_meta( $post_id, IMMENSIVE_PORTFOLIO_GROUP_META, true );
	$definitions = immensive_portfolio_group_definitions();
	if ( isset( $definitions[ $group ] ) ) {
		echo esc_html( $definitions[ $group ]['name'] );
	} else {
		echo '<span class="description">' . esc_html__( 'Automatico', 'immensive' ) . '</span>';
	}
}
add_action( 'manage_immensive_work_posts_custom_column', 'immensive_portfolio_group_column_content', 10, 2 );
