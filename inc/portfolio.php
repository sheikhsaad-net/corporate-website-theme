<?php
/**
 * "Selected works" portfolio post type.
 *
 * A lightweight CPT behind the Selected Works grid on the Altri Servizi page
 * (see .ih-works). Each project is one post:
 *
 *   - title            -> the card label
 *   - featured image   -> the card artwork
 *   - "Tipologia" meta -> the small pill on the right of the card bar
 *   - "In evidenza"    -> whether it appears in the Selected Works grid
 *   - menu_order       -> the order it appears in (lower first)
 *
 * Curation is a per-post checkbox rather than a taxonomy: there is exactly
 * one curated list on the site, so a term would be indirection with no payoff.
 * Order is menu_order so the grid can be arranged without touching dates.
 *
 * @package Immensive
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const IMMENSIVE_PORTFOLIO_POST_TYPE  = 'immensive_work';
const IMMENSIVE_PORTFOLIO_TAG_META   = '_immensive_work_tag';
const IMMENSIVE_PORTFOLIO_FEAT_META  = '_immensive_work_featured';

/**
 * Placement meta key prefix.
 *
 * One meta row per page a project appears on:
 *
 *   _immensive_work_place_96  =  "20"
 *
 * The row EXISTING is what puts the project on page 96; its value is the
 * position within that page's grid (lower first). One row per page rather
 * than a single serialised array so the query can order on meta_value_num in
 * SQL instead of sorting every project in PHP.
 */
const IMMENSIVE_PORTFOLIO_PLACE_PREFIX = '_immensive_work_place_';

/**
 * Page templates that render a portfolio grid.
 *
 * Any published page using one of these is offered as a placement checkbox on
 * the project editor — add a page on one of these templates and it shows up in
 * the list on its own, no code change. The portfolio archive and the Portfolio
 * page are deliberately absent: those always list everything.
 */
function immensive_portfolio_placement_templates() {
	return array(
		'template-altri-servizi.php',
		'template-soluzioni-culturali.php',
		'template-ricerca-sviluppo.php',
		'template-innovazione.php',
	);
}

/**
 * Every page that can host projects, as [ page_id => page title ].
 *
 * @return string[]
 */
function immensive_portfolio_placements() {
	$immensive_pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'     => '_wp_page_template',
					'value'   => immensive_portfolio_placement_templates(),
					'compare' => 'IN',
				),
			),
		)
	);

	$immensive_out = array();
	foreach ( $immensive_pages as $immensive_page ) {
		$immensive_out[ $immensive_page->ID ] = $immensive_page->post_title;
	}
	return $immensive_out;
}

/**
 * Meta key holding a project's position on a given page.
 *
 * @param int $page_id Host page ID.
 * @return string
 */
function immensive_portfolio_place_key( $page_id ) {
	return IMMENSIVE_PORTFOLIO_PLACE_PREFIX . (int) $page_id;
}

/**
 * The projects placed on a page, in the order set on each project.
 *
 * @param int $page_id Host page ID. Defaults to the page being viewed.
 * @param int $limit   Max projects. 0 for all.
 * @return WP_Post[]
 */
function immensive_portfolio_for_page( $page_id = 0, $limit = 0 ) {
	if ( ! $page_id ) {
		$page_id = get_queried_object_id();
	}
	if ( ! $page_id ) {
		return array();
	}

	return get_posts(
		array(
			'post_type'      => IMMENSIVE_PORTFOLIO_POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => $limit > 0 ? $limit : -1,
			'meta_key'       => immensive_portfolio_place_key( $page_id ),
			'orderby'        => array(
				'meta_value_num' => 'ASC',
				'menu_order'     => 'ASC',
				'date'           => 'DESC',
			),
		)
	);
}

/**
 * Register the post type.
 *
 * `page-attributes` is what exposes the Order field, which the grid sorts by.
 */
function immensive_register_portfolio_post_type() {
	register_post_type(
		IMMENSIVE_PORTFOLIO_POST_TYPE,
		array(
			'labels'       => array(
				'name'               => __( 'Portfolio', 'immensive' ),
				'singular_name'      => __( 'Progetto', 'immensive' ),
				'add_new'            => __( 'Aggiungi progetto', 'immensive' ),
				'add_new_item'       => __( 'Aggiungi nuovo progetto', 'immensive' ),
				'edit_item'          => __( 'Modifica progetto', 'immensive' ),
				'new_item'           => __( 'Nuovo progetto', 'immensive' ),
				'view_item'          => __( 'Vedi progetto', 'immensive' ),
				'search_items'       => __( 'Cerca progetti', 'immensive' ),
				'not_found'          => __( 'Nessun progetto trovato', 'immensive' ),
				'all_items'          => __( 'Tutti i progetti', 'immensive' ),
				'menu_name'          => __( 'Portfolio', 'immensive' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'progetti' ),
			'menu_icon'    => 'dashicons-portfolio',
			'menu_position'=> 21,
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'immensive_register_portfolio_post_type' );

/**
 * Flush rewrite rules once, the first time the CPT exists, so /progetti/
 * resolves without the user having to re-save permalinks.
 */
function immensive_portfolio_maybe_flush_rewrites() {
	if ( get_option( 'immensive_portfolio_rewrites_flushed' ) ) {
		return;
	}
	flush_rewrite_rules();
	update_option( 'immensive_portfolio_rewrites_flushed', 1 );
}
add_action( 'init', 'immensive_portfolio_maybe_flush_rewrites', 20 );

function immensive_portfolio_meta_box() {
	add_meta_box(
		'immensive-work-options',
		__( 'Opzioni progetto', 'immensive' ),
		'immensive_render_portfolio_meta_box',
		IMMENSIVE_PORTFOLIO_POST_TYPE,
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'immensive_portfolio_meta_box' );

function immensive_render_portfolio_meta_box( $post ) {
	wp_nonce_field( 'immensive_save_work', 'immensive_work_nonce' );
	$immensive_tag  = get_post_meta( $post->ID, IMMENSIVE_PORTFOLIO_TAG_META, true );
	$immensive_feat = get_post_meta( $post->ID, IMMENSIVE_PORTFOLIO_FEAT_META, true );
	?>
	<p>
		<label for="immensive_work_tag"><strong><?php esc_html_e( 'Tipologia', 'immensive' ); ?></strong></label><br>
		<input type="text" id="immensive_work_tag" name="immensive_work_tag" class="widefat"
			value="<?php echo esc_attr( $immensive_tag ); ?>"
			placeholder="<?php esc_attr_e( 'Es. Esperienza Museale Interattiva', 'immensive' ); ?>">
		<span class="description"><?php esc_html_e( 'Testo della pillola in basso a destra sulla card.', 'immensive' ); ?></span>
	</p>
	<p>
		<strong><?php esc_html_e( 'Mostra nelle pagine', 'immensive' ); ?></strong><br>
		<span class="description"><?php esc_html_e( 'Spunta le pagine in cui questo progetto deve comparire e indica la posizione (numero piu\' basso = piu\' in alto).', 'immensive' ); ?></span>
	</p>
	<?php
	$immensive_places = immensive_portfolio_placements();
	if ( ! $immensive_places ) :
		?>
		<p class="description"><?php esc_html_e( 'Nessuna pagina disponibile.', 'immensive' ); ?></p>
		<?php
	else :
		foreach ( $immensive_places as $immensive_pid => $immensive_ptitle ) :
			$immensive_pos     = get_post_meta( $post->ID, immensive_portfolio_place_key( $immensive_pid ), true );
			$immensive_checked = ( '' !== $immensive_pos );
			?>
			<p style="margin:.35em 0;display:flex;align-items:center;gap:.4em">
				<label style="flex:1">
					<input type="checkbox" name="immensive_work_place[<?php echo (int) $immensive_pid; ?>]" value="1" <?php checked( $immensive_checked ); ?>>
					<?php echo esc_html( $immensive_ptitle ); ?>
				</label>
				<input type="number" style="width:5em" min="0" step="1"
					name="immensive_work_place_pos[<?php echo (int) $immensive_pid; ?>]"
					value="<?php echo esc_attr( $immensive_checked ? $immensive_pos : '' ); ?>"
					aria-label="<?php echo esc_attr( sprintf( __( 'Posizione in %s', 'immensive' ), $immensive_ptitle ) ); ?>"
					placeholder="0">
			</p>
			<?php
		endforeach;
	endif;
}

function immensive_save_portfolio_meta( $post_id ) {
	if ( ! isset( $_POST['immensive_work_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['immensive_work_nonce'] ) ), 'immensive_save_work' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['immensive_work_tag'] ) ) {
		$immensive_tag = sanitize_text_field( wp_unslash( $_POST['immensive_work_tag'] ) );
		if ( '' === $immensive_tag ) {
			delete_post_meta( $post_id, IMMENSIVE_PORTFOLIO_TAG_META );
		} else {
			update_post_meta( $post_id, IMMENSIVE_PORTFOLIO_TAG_META, $immensive_tag );
		}
	}

	/*
	 * Placements. The checkbox array only contains the ticked boxes, so every
	 * available page is walked and the unticked ones have their row deleted —
	 * otherwise unchecking a page would silently leave the project on it.
	 */
	$immensive_checked_places = isset( $_POST['immensive_work_place'] ) && is_array( $_POST['immensive_work_place'] )
		? array_map( 'absint', array_keys( wp_unslash( $_POST['immensive_work_place'] ) ) )
		: array();
	$immensive_positions      = isset( $_POST['immensive_work_place_pos'] ) && is_array( $_POST['immensive_work_place_pos'] )
		? wp_unslash( $_POST['immensive_work_place_pos'] )
		: array();

	foreach ( array_keys( immensive_portfolio_placements() ) as $immensive_pid ) {
		$immensive_key = immensive_portfolio_place_key( $immensive_pid );
		if ( in_array( (int) $immensive_pid, $immensive_checked_places, true ) ) {
			$immensive_pos = isset( $immensive_positions[ $immensive_pid ] ) ? absint( $immensive_positions[ $immensive_pid ] ) : 0;
			update_post_meta( $post_id, $immensive_key, (string) $immensive_pos );
		} else {
			delete_post_meta( $post_id, $immensive_key );
		}
	}
}
add_action( 'save_post_' . IMMENSIVE_PORTFOLIO_POST_TYPE, 'immensive_save_portfolio_meta' );

/**
 * Admin list columns: show at a glance which projects are curated and in
 * what order, so the grid can be arranged without opening each post.
 */
function immensive_portfolio_columns( $columns ) {
	$immensive_new = array();
	foreach ( $columns as $immensive_key => $immensive_label ) {
		$immensive_new[ $immensive_key ] = $immensive_label;
		if ( 'title' === $immensive_key ) {
			$immensive_new['immensive_places'] = __( 'Pagine', 'immensive' );
			$immensive_new['immensive_tag']    = __( 'Tipologia', 'immensive' );
		}
	}
	return $immensive_new;
}
add_filter( 'manage_' . IMMENSIVE_PORTFOLIO_POST_TYPE . '_posts_columns', 'immensive_portfolio_columns' );

function immensive_portfolio_column_content( $column, $post_id ) {
	if ( 'immensive_places' === $column ) {
		$immensive_labels = array();
		foreach ( immensive_portfolio_placements() as $immensive_pid => $immensive_ptitle ) {
			$immensive_pos = get_post_meta( $post_id, immensive_portfolio_place_key( $immensive_pid ), true );
			if ( '' !== $immensive_pos ) {
				$immensive_labels[] = $immensive_ptitle . ' (' . (int) $immensive_pos . ')';
			}
		}
		echo esc_html( $immensive_labels ? implode( ', ', $immensive_labels ) : '—' );
	} elseif ( 'immensive_tag' === $column ) {
		echo esc_html( get_post_meta( $post_id, IMMENSIVE_PORTFOLIO_TAG_META, true ) ?: '—' );
	}
}
add_action( 'manage_' . IMMENSIVE_PORTFOLIO_POST_TYPE . '_posts_custom_column', 'immensive_portfolio_column_content', 10, 2 );

/**
 * The projects placed on the page being viewed, in grid order.
 *
 * Kept under its original name because template-altri-servizi.php calls it;
 * it now resolves through the placement meta rather than the old
 * "Mostra in Selected Works" boolean.
 *
 * @param int $limit Max projects to return. 0 for all.
 * @return WP_Post[]
 */
function immensive_get_featured_works( $limit = 0 ) {
	return immensive_portfolio_for_page( 0, $limit );
}

/* -------------------------------------------------------------------------
 * Taxonomies
 *
 * Two independent axes on a project:
 *
 *   Settori     — the client's sector (Medicale, Industriale, ...). Used as
 *                 the first filter group in the portfolio sidebar.
 *   Tecnologie  — what the project was built with (Virtual Reality, Software
 *                 Desktop, ...). Doubles as the GROUPING on the portfolio
 *                 archive: one collapsible panel per term, in term order.
 *
 * Both are hierarchical so the editor gets the checkbox + "add new" box
 * rather than a free-text tag field — the user asked to be able to pick an
 * existing one or create one from inside the project.
 *
 * Term description is shown as the panel's blurb on the archive, so it is
 * worth filling in for Tecnologie.
 * ---------------------------------------------------------------------- */

const IMMENSIVE_TAX_SETTORE    = 'immensive_settore';
const IMMENSIVE_TAX_TECNOLOGIA = 'immensive_tecnologia';

function immensive_register_portfolio_taxonomies() {
	register_taxonomy(
		IMMENSIVE_TAX_SETTORE,
		IMMENSIVE_PORTFOLIO_POST_TYPE,
		array(
			'labels'            => array(
				'name'          => __( 'Settori', 'immensive' ),
				'singular_name' => __( 'Settore', 'immensive' ),
				'add_new_item'  => __( 'Aggiungi settore', 'immensive' ),
				'all_items'     => __( 'Tutti i settori', 'immensive' ),
				'edit_item'     => __( 'Modifica settore', 'immensive' ),
				'search_items'  => __( 'Cerca settori', 'immensive' ),
				'menu_name'     => __( 'Settori', 'immensive' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'settore' ),
		)
	);

	register_taxonomy(
		IMMENSIVE_TAX_TECNOLOGIA,
		IMMENSIVE_PORTFOLIO_POST_TYPE,
		array(
			'labels'            => array(
				'name'          => __( 'Tecnologie', 'immensive' ),
				'singular_name' => __( 'Tecnologia', 'immensive' ),
				'add_new_item'  => __( 'Aggiungi tecnologia', 'immensive' ),
				'all_items'     => __( 'Tutte le tecnologie', 'immensive' ),
				'edit_item'     => __( 'Modifica tecnologia', 'immensive' ),
				'search_items'  => __( 'Cerca tecnologie', 'immensive' ),
				'menu_name'     => __( 'Tecnologie', 'immensive' ),
			),
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array( 'slug' => 'tecnologia' ),
		)
	);
}
add_action( 'init', 'immensive_register_portfolio_taxonomies', 5 );

/**
 * Terms that actually have published projects, in name order.
 *
 * hide_empty is on so the archive never renders a panel or a filter that
 * would match nothing.
 *
 * @param string $taxonomy Taxonomy name.
 * @return WP_Term[]
 */
function immensive_portfolio_terms( $taxonomy ) {
	// Settori read best alphabetically. Tecnologie drive the panel order on
	// the archive, which should follow the order they were created in (the
	// design's VR -> AR -> MR -> Software Desktop), not the alphabet.
	$immensive_orderby = ( IMMENSIVE_TAX_TECNOLOGIA === $taxonomy ) ? 'term_id' : 'name';

	$immensive_terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => true,
			'orderby'    => $immensive_orderby,
			'order'      => 'ASC',
		)
	);

	return is_wp_error( $immensive_terms ) ? array() : $immensive_terms;
}

/**
 * All published projects carrying a given term, newest first.
 *
 * @param string $taxonomy Taxonomy name.
 * @param int    $term_id  Term ID.
 * @return WP_Post[]
 */
function immensive_portfolio_by_term( $taxonomy, $term_id ) {
	return get_posts(
		array(
			'post_type'      => IMMENSIVE_PORTFOLIO_POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'tax_query'      => array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_id,
				),
			),
		)
	);
}

/**
 * The sector slugs on a project, as a space-separated string for the
 * client-side filter's data attribute.
 *
 * @param int $post_id Project ID.
 * @return string
 */
function immensive_portfolio_settore_slugs( $post_id ) {
	$immensive_terms = get_the_terms( $post_id, IMMENSIVE_TAX_SETTORE );
	if ( ! $immensive_terms || is_wp_error( $immensive_terms ) ) {
		return '';
	}
	return implode( ' ', wp_list_pluck( $immensive_terms, 'slug' ) );
}

/**
 * Inline icon for a Tecnologia, keyed on term slug.
 *
 * Inline SVG rather than icon files: these are a handful of flat glyphs that
 * inherit currentColor, so they recolour with the theme and cost no request.
 * Unknown slugs get a neutral mark instead of nothing, so a technology added
 * later still renders sensibly.
 *
 * @param string $slug Term slug.
 * @return string SVG markup.
 */
function immensive_portfolio_tech_icon( $slug ) {
	$immensive_icons = array(

		// VR headset.
		'virtual-reality' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 6h17A2.5 2.5 0 0 1 23 8.5v5a4.5 4.5 0 0 1-4.5 4.5h-2.2a2.5 2.5 0 0 1-2.05-1.07l-1.02-1.46a1.5 1.5 0 0 0-2.46 0L9.75 16.93A2.5 2.5 0 0 1 7.7 18H5.5A4.5 4.5 0 0 1 1 13.5v-5A2.5 2.5 0 0 1 3.5 6Zm2.2 3.6a1.9 1.9 0 1 0 0 3.8h1.6a1.9 1.9 0 1 0 0-3.8H5.7Zm11 0a1.9 1.9 0 1 0 0 3.8h1.6a1.9 1.9 0 1 0 0-3.8h-1.6Z"/>',

		// Phone with a cube lifting off it.
		'augmented-reality' => '<path d="M6.5 2H13a2 2 0 0 1 2 2v2.6l-2 1.15V4.5H7v15h6v-2.25l2 1.15V20a2 2 0 0 1-2 2H6.5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2Z"/><path d="m18 6.6 4.5 2.6v5.2L18 17l-4.5-2.6V9.2L18 6.6Z"/>',

		// Overlapping circle + square: the real and the virtual, blended.
		'mixed-reality' => '<path opacity=".5" d="M9 3.5a6 6 0 1 0 0 12 6 6 0 0 0 0-12Z"/><path d="M13.2 9H20a2.2 2.2 0 0 1 2.2 2.2V18A2.2 2.2 0 0 1 20 20.2h-6.8A2.2 2.2 0 0 1 11 18v-6.8A2.2 2.2 0 0 1 13.2 9Z"/>',

		// Desktop monitor.
		'software-desktop' => '<path d="M3 3.5h18a2 2 0 0 1 2 2v9.2a2 2 0 0 1-2 2h-6.35l.55 2.3H17a1 1 0 1 1 0 2H7a1 1 0 1 1 0-2h1.8l.55-2.3H3a2 2 0 0 1-2-2V5.5a2 2 0 0 1 2-2Z"/>',

		// Handset.
		'app-mobile' => '<path d="M7.5 1.5h9A2.5 2.5 0 0 1 19 4v16a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 5 20V4a2.5 2.5 0 0 1 2.5-2.5Zm2 2.7a.9.9 0 0 0 0 1.8h5a.9.9 0 1 0 0-1.8h-5ZM12 18a1.4 1.4 0 1 0 0 2.8A1.4 1.4 0 0 0 12 18Z"/>',

		// Browser window.
		'sviluppo-web' => '<path fill-rule="evenodd" clip-rule="evenodd" d="M3 3.5h18a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-13a2 2 0 0 1 2-2Zm0 5.2v9.8h18V8.7H3ZM4.6 5.2a.9.9 0 1 0 0 1.8.9.9 0 0 0 0-1.8Zm2.8 0a.9.9 0 1 0 0 1.8.9.9 0 0 0 0-1.8Z"/>',
	);

	$immensive_default = '<path d="M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/>';
	$immensive_path    = isset( $immensive_icons[ $slug ] ) ? $immensive_icons[ $slug ] : $immensive_default;

	return '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">' . $immensive_path . '</svg>';
}

/**
 * Project galleries are built with core Gallery/Image blocks, which always
 * serialize an ABSOLUTE image URL straight into post_content (that's how
 * Gutenberg blocks work — there's no "relative" or dynamic placeholder
 * form). Whatever environment a gallery was authored on (local, staging,
 * production) is baked in permanently, so moving the same content to a
 * different environment/domain leaves every image pointing at a host that
 * doesn't exist there — exactly what broke the portfolio galleries here.
 *
 * Rather than hand-editing stored HTML on every migration, rewrite any such
 * URL's scheme+host+path prefix down to THIS site's own current uploads
 * base URL at render time. wp_upload_dir()['baseurl'] resolves from the
 * live siteurl/home options (and any UPLOADS/upload_url_path overrides),
 * so this self-corrects on any environment with zero code or content edits.
 */
function immensive_fix_stale_upload_urls( $content ) {
	static $immensive_uploads_base = null;

	if ( null === $immensive_uploads_base ) {
		$immensive_uploads     = wp_upload_dir();
		$immensive_uploads_base = trailingslashit( $immensive_uploads['baseurl'] );
	}

	return preg_replace( '#https?://[^"\'\s]+?/wp-content/uploads/#i', $immensive_uploads_base, $content );
}
add_filter( 'the_content', 'immensive_fix_stale_upload_urls' );
