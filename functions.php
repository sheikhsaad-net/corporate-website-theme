<?php
/**
 * Immensive theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function immensive_setup() {
	load_theme_textdomain( 'immensive', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary'          => __( 'Primary Menu', 'immensive' ),
			'primary-services' => __( 'Primary Menu (No Products)', 'immensive' ),
			'primary-extra'    => __( 'Primary Menu (Extra)', 'immensive' ),
			'academy'          => __( 'Academy Menu', 'immensive' ),
			'footer'           => __( 'Footer Menu', 'immensive' ),
		)
	);
}
add_action( 'after_setup_theme', 'immensive_setup' );

// "Selected works" portfolio post type (see inc/portfolio.php).
require_once get_template_directory() . '/inc/portfolio.php';

/**
 * All page templates that share the "ih" design system (dark header/footer,
 * homepage.css/js, no default site-header/site-footer markup).
 */
function immensive_ih_templates() {
	return array(
		'template-home.php',
		'template-prodotti.php',
		'template-piani.php',
		'template-rivenditori.php',
		'template-altri-servizi.php',
		'template-contatti.php',
		'template-chi-siamo.php',
		'template-weld-vr.php',
		'template-firefighter-vr.php',
		'template-forklift-vr.php',
		'template-electro-vr.php',
		'template-portfolio.php',
		'template-soluzioni-culturali.php',
		'template-ricerca-sviluppo.php',
		'template-innovazione.php',
		'template-academy.php',
	);
}

/**
 * Whether the current page is using one of the "ih" templates above.
 */
function immensive_is_ih_template() {
	return is_page_template( immensive_ih_templates() );
}

/**
 * Whether the current request should get the "ih" shell (dark site-header /
 * site-footer template parts + homepage.css/js) instead of the theme's
 * generic fallback header/footer.
 *
 * Covers the ih page templates above, plus 404.php — the 404 template isn't
 * a page template (is_page_template() only applies to the `page` post type,
 * and a 404 has no post at all), so it needs its own check here.
 *
 * Every other unconnected page (no ih template assigned, e.g. the default
 * blog index or a plain page) intentionally falls through to the generic
 * header/footer in header.php / footer.php.
 */
function immensive_is_ih_page() {
	// The portfolio archive and single project use the ih shell too, but they
	// are not page templates — is_page_template() only answers for the `page`
	// post type — so they need naming here or they render unstyled.
	$immensive_is_portfolio = function_exists( 'immensive_register_portfolio_post_type' )
		&& ( is_post_type_archive( IMMENSIVE_PORTFOLIO_POST_TYPE )
			|| is_singular( IMMENSIVE_PORTFOLIO_POST_TYPE )
			|| is_tax( array( IMMENSIVE_TAX_SETTORE, IMMENSIVE_TAX_TECNOLOGIA ) ) );

	return immensive_is_ih_template() || is_404() || $immensive_is_portfolio;
}

/**
 * Stamps an "ih-page" class on <body> for ih templates and the 404 page.
 *
 * style.css (the generic fallback shell) is enqueued unconditionally on
 * every request, ih pages included — there's no separate stylesheet per
 * shell. Bare/low-specificity selectors in it (e.g. `a`, `article + article`)
 * would otherwise silently apply inside the ih markup too, since nothing
 * stops them at the CSS level. Generic-shell rules that aren't already
 * scoped to #site-header/#site-footer/.widget/etc. should be written against
 * `body:not(.ih-page)` so they can't leak.
 */
function immensive_body_class( $classes ) {
	if ( immensive_is_ih_page() ) {
		$classes[] = 'ih-page';
	}
	return $classes;
}
add_filter( 'body_class', 'immensive_body_class' );

function immensive_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'immensive' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'immensive' ),
			'id'            => 'footer-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'immensive_widgets_init' );

function immensive_scripts() {
	$immensive_style = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style(
		'immensive-style',
		get_stylesheet_uri(),
		array(),
		file_exists( $immensive_style ) ? filemtime( $immensive_style ) : wp_get_theme()->get( 'Version' )
	);

	if ( immensive_is_ih_page() ) {
		$immensive_css = get_template_directory() . '/assets/css/homepage.css';
		$immensive_js  = get_template_directory() . '/assets/js/homepage.js';

		wp_enqueue_style(
			'immensive-homepage',
			get_template_directory_uri() . '/assets/css/homepage.css',
			array( 'immensive-style' ),
			file_exists( $immensive_css ) ? filemtime( $immensive_css ) : wp_get_theme()->get( 'Version' )
		);
		wp_enqueue_script(
			'immensive-homepage',
			get_template_directory_uri() . '/assets/js/homepage.js',
			array(),
			file_exists( $immensive_js ) ? filemtime( $immensive_js ) : wp_get_theme()->get( 'Version' ),
			true
		);

		// Front-end data for the Contatti page's AJAX form submit (see
		// immensive_handle_contact_form() and homepage.js's contact-form block).
		wp_localize_script(
			'immensive-homepage',
			'immensiveContact',
			array(
				'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
				'nonce'     => wp_create_nonce( 'immensive_contact_form' ),
				'demoNonce' => wp_create_nonce( 'immensive_demo_form' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'immensive_scripts' );

/**
 * Contact form handler for template-contatti.php's #ih-cont-form.
 *
 * The form submits via fetch() to admin-ajax.php (see homepage.js) instead
 * of a native POST, so the page doesn't reload and can show inline
 * success/error state. Registered for both logged-in and logged-out
 * requests since every real site visitor is logged out.
 */
function immensive_handle_contact_form() {
	check_ajax_referer( 'immensive_contact_form', 'nonce' );

	// Honeypot: a hidden field real visitors never fill in (see the
	// `.ih-field--hp` markup in template-contatti.php). Bots that fill every
	// field get a fake success so they don't retry.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success();
	}

	$immensive_nome      = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$immensive_cognome   = isset( $_POST['cognome'] ) ? sanitize_text_field( wp_unslash( $_POST['cognome'] ) ) : '';
	$immensive_email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$immensive_telefono  = isset( $_POST['telefono'] ) ? sanitize_text_field( wp_unslash( $_POST['telefono'] ) ) : '';
	$immensive_societa   = isset( $_POST['societa'] ) ? sanitize_text_field( wp_unslash( $_POST['societa'] ) ) : '';
	$immensive_settore   = isset( $_POST['settore'] ) ? sanitize_text_field( wp_unslash( $_POST['settore'] ) ) : '';
	$immensive_messaggio = isset( $_POST['messaggio'] ) ? sanitize_textarea_field( wp_unslash( $_POST['messaggio'] ) ) : '';
	$immensive_privacy   = ! empty( $_POST['privacy'] );

	$immensive_errors = array();
	if ( '' === $immensive_nome ) {
		$immensive_errors[] = 'nome';
	}
	if ( '' === $immensive_cognome ) {
		$immensive_errors[] = 'cognome';
	}
	if ( '' === $immensive_email || ! is_email( $immensive_email ) ) {
		$immensive_errors[] = 'email';
	}
	if ( '' === $immensive_messaggio ) {
		$immensive_errors[] = 'messaggio';
	}
	if ( ! $immensive_privacy ) {
		$immensive_errors[] = 'privacy';
	}

	if ( $immensive_errors ) {
		wp_send_json_error(
			array(
				'message' => __( 'Controlla i campi obbligatori e riprova.', 'immensive' ),
				'fields'  => $immensive_errors,
			)
		);
	}

	// Filterable so a future deploy can point this at a different inbox
	// without touching code (site option stays the fallback).
	$immensive_to = apply_filters( 'immensive_contact_form_recipient', get_option( 'admin_email' ) );

	$immensive_subject = sprintf(
		/* translators: %s: submitter's full name. */
		__( '[Sito Immensive] Nuova richiesta da %s', 'immensive' ),
		trim( $immensive_nome . ' ' . $immensive_cognome )
	);

	$immensive_lines = array(
		'Nome: ' . $immensive_nome . ' ' . $immensive_cognome,
		'Email: ' . $immensive_email,
	);
	if ( $immensive_telefono ) {
		$immensive_lines[] = 'Telefono: ' . $immensive_telefono;
	}
	if ( $immensive_societa ) {
		$immensive_lines[] = 'Società: ' . $immensive_societa;
	}
	if ( $immensive_settore ) {
		$immensive_lines[] = 'Settore: ' . $immensive_settore;
	}
	$immensive_lines[] = '';
	$immensive_lines[] = 'Messaggio:';
	$immensive_lines[] = $immensive_messaggio;

	$immensive_sent = wp_mail(
		$immensive_to,
		$immensive_subject,
		implode( "\n", $immensive_lines ),
		array( 'Reply-To: ' . $immensive_nome . ' ' . $immensive_cognome . ' <' . $immensive_email . '>' )
	);

	if ( ! $immensive_sent ) {
		wp_send_json_error(
			array( 'message' => __( 'Invio non riuscito. Riprova più tardi o scrivici direttamente a info@immensive.it.', 'immensive' ) )
		);
	}

	wp_send_json_success(
		array( 'message' => __( 'Grazie! Ti risponderemo al più presto.', 'immensive' ) )
	);
}
add_action( 'wp_ajax_immensive_contact_form', 'immensive_handle_contact_form' );
add_action( 'wp_ajax_nopriv_immensive_contact_form', 'immensive_handle_contact_form' );

/**
 * "Richiedi maggiori informazioni" demo popup handler (see
 * template-parts/demo-modal.php and homepage.js's demo-modal block).
 *
 * Deliberately mails info@immensive.it directly rather than going through
 * the admin_email-based filter immensive_handle_contact_form() uses — this
 * popup's destination inbox was a specific, explicit requirement, not meant
 * to move if the site's admin email ever changes.
 */
function immensive_handle_demo_form() {
	check_ajax_referer( 'immensive_demo_form', 'nonce' );

	// Honeypot: see immensive_handle_contact_form() for why this isn't
	// display:none in the markup.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success();
	}

	$immensive_nome      = isset( $_POST['nome'] ) ? sanitize_text_field( wp_unslash( $_POST['nome'] ) ) : '';
	$immensive_email     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$immensive_telefono  = isset( $_POST['telefono'] ) ? sanitize_text_field( wp_unslash( $_POST['telefono'] ) ) : '';
	$immensive_citta     = isset( $_POST['citta'] ) ? sanitize_text_field( wp_unslash( $_POST['citta'] ) ) : '';
	$immensive_azienda   = isset( $_POST['azienda'] ) ? sanitize_text_field( wp_unslash( $_POST['azienda'] ) ) : '';
	$immensive_prodotto  = isset( $_POST['prodotto'] ) ? sanitize_text_field( wp_unslash( $_POST['prodotto'] ) ) : '';
	$immensive_messaggio = isset( $_POST['messaggio'] ) ? sanitize_textarea_field( wp_unslash( $_POST['messaggio'] ) ) : '';
	$immensive_privacy   = ! empty( $_POST['privacy'] );

	$immensive_errors = array();
	if ( '' === $immensive_nome ) {
		$immensive_errors[] = 'nome';
	}
	if ( '' === $immensive_email || ! is_email( $immensive_email ) ) {
		$immensive_errors[] = 'email';
	}
	if ( '' === $immensive_telefono ) {
		$immensive_errors[] = 'telefono';
	}
	if ( ! $immensive_privacy ) {
		$immensive_errors[] = 'privacy';
	}

	if ( $immensive_errors ) {
		wp_send_json_error(
			array(
				'message' => __( 'Controlla i campi obbligatori e riprova.', 'immensive' ),
				'fields'  => $immensive_errors,
			)
		);
	}

	$immensive_to = apply_filters( 'immensive_demo_form_recipient', 'info@immensive.it' );

	$immensive_subject = sprintf(
		/* translators: 1: submitter's full name, 2: product name. */
		__( '[Sito Immensive] Richiesta demo %2$s da %1$s', 'immensive' ),
		$immensive_nome,
		$immensive_prodotto ? $immensive_prodotto : __( 'prodotto', 'immensive' )
	);

	$immensive_lines = array(
		'Nome e cognome: ' . $immensive_nome,
		'Email: ' . $immensive_email,
		'Telefono: ' . $immensive_telefono,
	);
	if ( $immensive_citta ) {
		$immensive_lines[] = 'Città: ' . $immensive_citta;
	}
	if ( $immensive_azienda ) {
		$immensive_lines[] = 'Istituto o Azienda: ' . $immensive_azienda;
	}
	if ( $immensive_prodotto ) {
		$immensive_lines[] = 'Prodotto: ' . $immensive_prodotto;
	}
	if ( $immensive_messaggio ) {
		$immensive_lines[] = '';
		$immensive_lines[] = 'Messaggio:';
		$immensive_lines[] = $immensive_messaggio;
	}

	$immensive_sent = wp_mail(
		$immensive_to,
		$immensive_subject,
		implode( "\n", $immensive_lines ),
		array( 'Reply-To: ' . $immensive_nome . ' <' . $immensive_email . '>' )
	);

	if ( ! $immensive_sent ) {
		wp_send_json_error(
			array( 'message' => __( 'Invio non riuscito. Riprova più tardi o scrivici direttamente a info@immensive.it.', 'immensive' ) )
		);
	}

	wp_send_json_success(
		array( 'message' => __( 'Grazie! Ti risponderemo al più presto.', 'immensive' ) )
	);
}
add_action( 'wp_ajax_immensive_demo_form', 'immensive_handle_demo_form' );
add_action( 'wp_ajax_nopriv_immensive_demo_form', 'immensive_handle_demo_form' );

/**
 * Placeholder menu shown on ih pages until a real menu is assigned to the
 * relevant location in Appearance > Menus. Mirrors whichever location was
 * requested — 'primary-services' drops the "Prodotti" item — so the
 * placeholder doesn't advertise products on pages meant to hide them.
 */
function immensive_nav_fallback( $args ) {
	$immensive_items = array(
		__( 'Prodotti', 'immensive' ),
		__( 'Piani', 'immensive' ),
		__( 'Rivenditori', 'immensive' ),
		__( 'Altri servizi', 'immensive' ),
		__( 'Chi siamo', 'immensive' ),
		__( 'Contatti', 'immensive' ),
	);

	// The extra location has no opinion about products — it falls through to
	// the full placeholder list until a real menu is assigned to it.
	if ( isset( $args['theme_location'] ) && 'primary-services' === $args['theme_location'] ) {
		$immensive_items = array_diff( $immensive_items, array( __( 'Prodotti', 'immensive' ) ) );
	}

	echo '<ul id="ih-primary-menu">';
	foreach ( $immensive_items as $immensive_item ) {
		echo '<li><a class="ih-nav__link" href="#">' . esc_html( $immensive_item ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Per-page navigation choice.
 *
 * Each page picks one of three options from the "Menu di navigazione" box in
 * the editor sidebar:
 *
 *   'primary'  the full menu (products + everything else)
 *   'services' the products-free menu, for services-side pages
 *   'extra'    a third, free-form menu ("Primary Menu (Extra)" in
 *              Appearance > Menus) for pages that need their own nav
 *   'none'     no menu at all — logo and Area Clienti only, the way the
 *              home template navigates entirely through its split hero
 *
 * 'none' is the default for a page that has never been given a value, so a
 * newly created page starts clean and the editor opts into a menu. Every page
 * that existed when this was introduced was written an explicit value, so the
 * default only ever applies to new pages.
 *
 * IMMENSIVE_SERVICES_MENU_META_KEY is the previous boolean meta. It is still
 * read as a fallback so a page that missed the migration keeps its menu.
 */
const IMMENSIVE_NAV_CHOICE_META_KEY     = '_immensive_nav_choice';
const IMMENSIVE_SERVICES_MENU_META_KEY  = '_immensive_use_services_menu';

/**
 * Valid choices, keyed by stored value, for the editor UI and validation.
 */
function immensive_nav_choices() {
	return array(
		'primary'  => __( 'Menu principale (con prodotti)', 'immensive' ),
		'services' => __( 'Menu servizi (senza prodotti)', 'immensive' ),
		'extra'    => __( 'Menu extra', 'immensive' ),
		'academy'  => __( 'Menu Academy (sezioni di pagina)', 'immensive' ),
		'none'     => __( 'Nessun menu', 'immensive' ),
	);
}

/**
 * The nav choice for a page: 'primary', 'services' or 'none'.
 *
 * Non-page requests (blog, single posts, the portfolio archive) have no such
 * meta and always get the full menu, except the portfolio single (a project
 * detail page), which has no products of its own to sell and gets the
 * products-free services menu instead.
 */
function immensive_get_nav_choice( $post_id = 0 ) {
	if ( ! $post_id ) {
		if ( is_singular( IMMENSIVE_PORTFOLIO_POST_TYPE ) ) {
			return 'services';
		}
		if ( ! is_singular( 'page' ) ) {
			return 'primary';
		}
		$post_id = get_queried_object_id();
	}

	$immensive_choice = get_post_meta( $post_id, IMMENSIVE_NAV_CHOICE_META_KEY, true );
	if ( array_key_exists( $immensive_choice, immensive_nav_choices() ) ) {
		return $immensive_choice;
	}

	// Legacy boolean, for any page not covered by the migration.
	if ( get_post_meta( $post_id, IMMENSIVE_SERVICES_MENU_META_KEY, true ) ) {
		return 'services';
	}

	return 'none';
}

/**
 * Whether the current request should render a nav menu at all.
 */
function immensive_show_nav() {
	return 'none' !== immensive_get_nav_choice();
}

function immensive_get_nav_theme_location() {
	$immensive_map = array(
		'services' => 'primary-services',
		'extra'    => 'primary-extra',
		'academy'  => 'academy',
	);

	$immensive_choice = immensive_get_nav_choice();

	return isset( $immensive_map[ $immensive_choice ] ) ? $immensive_map[ $immensive_choice ] : 'primary';
}

function immensive_add_services_menu_meta_box() {
	add_meta_box(
		'immensive-nav-menu',
		__( 'Menu di navigazione', 'immensive' ),
		'immensive_render_services_menu_meta_box',
		'page',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'immensive_add_services_menu_meta_box' );

function immensive_render_services_menu_meta_box( $post ) {
	wp_nonce_field( 'immensive_save_services_menu', 'immensive_services_menu_nonce' );
	$immensive_current = immensive_get_nav_choice( $post->ID );
	?>
	<p>
		<?php foreach ( immensive_nav_choices() as $immensive_value => $immensive_label ) : ?>
			<label style="display:block;margin-bottom:.4em">
				<input type="radio" name="immensive_nav_choice" value="<?php echo esc_attr( $immensive_value ); ?>" <?php checked( $immensive_current, $immensive_value ); ?>>
				<?php echo esc_html( $immensive_label ); ?>
			</label>
		<?php endforeach; ?>
	</p>
	<p class="description">
		<?php esc_html_e( 'Sceglie quale menu compare nell\'header di questa pagina. "Menu extra" usa la voce "Primary Menu (Extra)" in Aspetto > Menu. Con "Nessun menu" restano solo il logo e il pulsante Area Clienti.', 'immensive' ); ?>
	</p>
	<?php
}

function immensive_save_services_menu_meta( $post_id ) {
	if ( ! isset( $_POST['immensive_services_menu_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['immensive_services_menu_nonce'] ) ), 'immensive_save_services_menu' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	if ( ! isset( $_POST['immensive_nav_choice'] ) ) {
		return;
	}

	$immensive_choice = sanitize_key( wp_unslash( $_POST['immensive_nav_choice'] ) );
	if ( ! array_key_exists( $immensive_choice, immensive_nav_choices() ) ) {
		return;
	}

	update_post_meta( $post_id, IMMENSIVE_NAV_CHOICE_META_KEY, $immensive_choice );
	// The boolean is now redundant; drop it so there is one source of truth.
	delete_post_meta( $post_id, IMMENSIVE_SERVICES_MENU_META_KEY );
}
add_action( 'save_post_page', 'immensive_save_services_menu_meta' );

/**
 * Primary nav walker.
 *
 * Top-level items with children get a dropdown. If a top-level item also
 * carries the "product" custom CSS class (set in Appearance > Menus), its
 * children render as a horizontal card grid — logo, title, and the menu
 * item's "Description" field (enable it via Screen Options) — instead of a
 * plain list. Every other parent item falls back to a simple dropdown.
 *
 * Card logos are looked up by page slug in
 * /assets/images/prodotti/{slug}.webp — drop a file there named after the
 * product page's slug and it replaces the placeholder automatically.
 */
class Immensive_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Custom CSS class (set per top-level item in Appearance > Menus) that
	 * switches a dropdown to the card-grid "mega" style, mapped to how many
	 * columns that grid should show. 'product' is the original trigger
	 * (Prodotti's 4 items); 'mega-2col' / 'mega-3col' cover other parents
	 * whose children count suits a narrower grid (e.g. Ricerca e
	 * Innovazione's 2, or Altri Servizi's 3 on the Main Menu).
	 */
	const MEGA_TRIGGER_COLS = array(
		'product'   => 4,
		'mega-2col' => 2,
		'mega-3col' => 3,
	);

	/** @var int[]|false[] Stack tracking the open submenu's mega column count, or false for a plain dropdown. */
	private $mega_stack = array();

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$mega_cols = ! empty( $this->mega_stack ) ? end( $this->mega_stack ) : false;
		$output   .= $mega_cols ? '<ul class="ih-mega ih-mega--cols-' . (int) $mega_cols . '">' : '<ul class="ih-dropdown">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= '</ul>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes = array_filter( array_map( 'sanitize_html_class', $classes ) );
		// WP core (_wp_menu_item_classes_by_context()) already stamps this
		// class onto items with children before the walker runs — more
		// reliable here than $args->has_children.
		$has_children = in_array( 'menu-item-has-children', $classes, true );

		$mega_cols = 0;
		foreach ( self::MEGA_TRIGGER_COLS as $trigger_class => $cols ) {
			if ( in_array( $trigger_class, $classes, true ) ) {
				$mega_cols = $cols;
				break;
			}
		}

		if ( 0 === $depth ) {
			$this->mega_stack[] = ( $mega_cols && $has_children ) ? $mega_cols : false;

			$output .= '<li class="' . esc_attr( trim( implode( ' ', $classes ) ) ) . '">';
			$output .= '<a class="ih-nav__link" href="' . esc_url( $item->url ) . '">' . esc_html( $item->title );
			if ( $has_children ) {
				// role="button"/tabindex/aria-expanded: on the mobile accordion
				// (see homepage.js) this caret is the actual tap target that
				// expands/collapses the submenu without following the parent
				// link — display:none on desktop, where the panel still just
				// opens on hover, so none of this is reachable there.
				$output .= '<svg class="ih-nav__caret" width="10" height="6" viewBox="0 0 10 6" fill="none" role="button" tabindex="0" aria-expanded="false" aria-label="' . esc_attr__( 'Apri sottomenu', 'immensive' ) . '"><path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
			}
			$output .= '</a>';
			return;
		}

		$mega_cols = ! empty( $this->mega_stack ) ? end( $this->mega_stack ) : false;

		if ( 4 === $mega_cols ) {
			// Prodotti: small desaturating logo on a white card (unchanged).
			$slug      = ( 'page' === $item->object ) ? get_post_field( 'post_name', $item->object_id ) : sanitize_title( $item->title );
			$logo_file = get_template_directory() . '/assets/images/prodotti/' . $slug . '.webp';
			$logo_uri  = get_template_directory_uri() . '/assets/images/prodotti/' . $slug . '.webp';

			$output .= '<li class="ih-mega__item"><a class="ih-mega__card" href="' . esc_url( $item->url ) . '">';
			$output .= '<span class="ih-mega__logo">';
			if ( file_exists( $logo_file ) ) {
				$output .= '<img src="' . esc_url( $logo_uri ) . '" alt="" loading="lazy">';
			} else {
				$output .= '<span class="ih-mega__logo-fallback">' . esc_html( mb_substr( $item->title, 0, 1 ) ) . '</span>';
			}
			$output .= '</span>';
			$output .= '<span class="ih-mega__title">' . esc_html( $item->title ) . '</span>';
			if ( ! empty( $item->description ) ) {
				$output .= '<span class="ih-mega__desc">' . esc_html( $item->description ) . '</span>';
			}
			$output .= '</a></li>';
		} elseif ( $mega_cols ) {
			// Services-style mega items (Ricerca e Innovazione, Altri Servizi):
			// full background photo with the title centered over it, no icon.
			$slug = ( 'page' === $item->object ) ? get_post_field( 'post_name', $item->object_id ) : sanitize_title( $item->title );
			$bg_uri = '';
			foreach ( array( 'webp', 'png', 'jpg' ) as $ext ) {
				$bg_file = get_template_directory() . '/assets/images/nav-mega/' . $slug . '.' . $ext;
				if ( file_exists( $bg_file ) ) {
					$bg_uri = get_template_directory_uri() . '/assets/images/nav-mega/' . $slug . '.' . $ext;
					break;
				}
			}

			$output .= '<li class="ih-mega__item"><a class="ih-mega__card ih-mega__card--photo" href="' . esc_url( $item->url ) . '"';
			if ( $bg_uri ) {
				$output .= ' style="background-image:url(' . esc_url( $bg_uri ) . ')"';
			}
			$output .= '>';
			$output .= '<span class="ih-mega__title">' . esc_html( $item->title ) . '</span>';
			$output .= '</a></li>';
		} else {
			$output .= '<li class="ih-dropdown__item"><a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a></li>';
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			array_pop( $this->mega_stack );
			$output .= '</li>';
		}
	}
}

/**
 * Trim default <head> output that most sites never use, to cut requests
 * and markup weight.
 */
function immensive_head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
}
add_action( 'init', 'immensive_head_cleanup' );

/**
 * Disable the emoji script/style, saving an extra request and inline CSS
 * on every page load.
 */
function immensive_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'immensive_disable_emojis' );

/**
 * Fix a core Site Health bug on this MySQL/MariaDB config.
 *
 * WP_Site_Health::should_suggest_persistent_object_cache() (wp-admin/includes/class-wp-site-health.php)
 * queries information_schema.TABLES for the exact-case table names (e.g. "Im_posts") and then looks
 * up the results using that same case. On this install `lower_case_table_names = 1` (the default for
 * MySQL/MariaDB on Windows), so information_schema.TABLES always reports lowercased names
 * ("im_posts"), the lookup key never matches, and PHP throws "Undefined array key" / "Attempt to
 * read property on null" warnings on every wp-admin page load.
 *
 * wp-admin/ is core and must not be edited directly, so we use the filter core provides for exactly
 * this purpose to short-circuit the buggy method, redoing the same threshold check with a
 * case-insensitive table lookup so the recommendation itself still works correctly.
 *
 * @param bool|null $short_circuit Whether to short-circuit, or null to run the default (buggy) check.
 * @return bool|null
 */
function immensive_fix_site_health_object_cache_check( $short_circuit ) {
	if ( null !== $short_circuit ) {
		return $short_circuit;
	}

	global $wpdb;

	if ( is_multisite() ) {
		return true;
	}

	$thresholds = apply_filters(
		'site_status_persistent_object_cache_thresholds',
		array(
			'alloptions_count' => 500,
			'alloptions_bytes' => 100000,
			'comments_count'   => 1000,
			'options_count'    => 1000,
			'posts_count'      => 1000,
			'terms_count'      => 1000,
			'users_count'      => 1000,
		)
	);

	$alloptions = wp_load_alloptions();

	if ( $thresholds['alloptions_count'] < count( $alloptions ) ) {
		return true;
	}

	if ( $thresholds['alloptions_bytes'] < strlen( serialize( $alloptions ) ) ) {
		return true;
	}

	$threshold_map = array(
		'comments_count' => $wpdb->comments,
		'options_count'  => $wpdb->options,
		'posts_count'    => $wpdb->posts,
		'terms_count'    => $wpdb->terms,
		'users_count'    => $wpdb->users,
	);

	$table_names = implode( "','", array_map( 'strtolower', $threshold_map ) );

	// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $table_names is built from $wpdb table properties, not user input.
	$results = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT LOWER(TABLE_NAME) AS 'table', TABLE_ROWS AS 'rows' FROM information_schema.TABLES WHERE TABLE_SCHEMA = %s AND LOWER(TABLE_NAME) IN ('$table_names') GROUP BY TABLE_NAME;",
			DB_NAME
		),
		OBJECT_K
	);

	if ( ! is_array( $results ) ) {
		// The diagnostic query itself failed; don't nag about it, just skip the suggestion.
		return false;
	}

	foreach ( $threshold_map as $threshold_key => $table ) {
		$row = $results[ strtolower( $table ) ] ?? null;

		if ( $row && $thresholds[ $threshold_key ] <= (int) $row->rows ) {
			return true;
		}
	}

	return false;
}
add_filter( 'site_status_should_suggest_persistent_object_cache', 'immensive_fix_site_health_object_cache_check' );
