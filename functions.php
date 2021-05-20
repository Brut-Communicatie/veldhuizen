<?php
/**
 * Veldhuizen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Veldhuizen
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'veldhuizen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function veldhuizen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Veldhuizen, use a find and replace
		 * to change 'veldhuizen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'veldhuizen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'veldhuizen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'veldhuizen_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'veldhuizen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function veldhuizen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'veldhuizen_content_width', 640 );
}
add_action( 'after_setup_theme', 'veldhuizen_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function veldhuizen_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'veldhuizen' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'veldhuizen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'veldhuizen_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function veldhuizen_scripts() {
	wp_enqueue_style( 'veldhuizen-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'veldhuizen-style', 'rtl', 'replace' );

	wp_enqueue_script( 'veldhuizen-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'veldhuizen_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function veldhuizen_products_register_template() {
    $post_type_object = get_post_type_object( 'producten' );
    $post_type_object->template = array(
		array('cgb/veldhuizen-banner'),
		array('cgb/block-veldhuizen-container-block')
	);
}

function veldhuizen_verhuur_register_template() {
	$verhuur_object = get_post_type_object('verhuur');
	$verhuur_object->template = array(
		array('cgb/veldhuizen-banner'),
		array('cgb/block-veldhuizen-verhuur-container')
	);
}

function veldhuizen_post_type() {
    $labels = array(
        'name'                  => _x( 'Producten', 'Post type general name', 'product' ),
        'singular_name'         => _x( 'Product', 'Post type singular name', 'product' ),
        'menu_name'             => _x( 'Producten', 'Admin Menu text', 'product' ),
        'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'product' ),
        'add_new'               => __( 'Nieuw product', 'product' ),
        'add_new_item'          => __( 'Nieuw product', 'product' ),
        'new_item'              => __( 'Nieuw product', 'product' ),
        'edit_item'             => __( 'Edit product', 'product' ),
        'view_item'             => __( 'Bekijk product', 'product' ),
        'all_items'             => __( 'Bekijk alle producten', 'product' ),
        'search_items'          => __( 'Zoek product', 'product' ),
        'parent_item_colon'     => __( 'Hoofdproduct:', 'product' ),
        'not_found'             => __( 'Geen producten gevonden.', 'product' ),
        'not_found_in_trash'    => __( 'Geen producten gevonden in de prullenbak.', 'product' ),
        'featured_image'        => _x( 'Product cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'product' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'product' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'product' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'product' ),
        'archives'              => _x( 'Producten archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'product' ),
        'insert_into_item'      => _x( 'Insert into product', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'product' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this product', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'product' ),
        'filter_items_list'     => _x( 'Filter producten list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'product' ),
        'items_list_navigation' => _x( 'Producten list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'product' ),
        'items_list'            => _x( 'Producten list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'product' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Producten post type',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'producten' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 20,
		'menu_icon'			 => 'dashicons-cart',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Producten', $args );
}

function veldhuizen_verhuur_post_type() {
    $labels = array(
        'name'                  => _x( 'Verhuur', 'Post type general name', 'verhuur product' ),
        'singular_name'         => _x( 'verhuur', 'Post type singular name', 'verhuur product' ),
        'menu_name'             => _x( 'Verhuur', 'Admin Menu text', 'verhuur product' ),
        'name_admin_bar'        => _x( 'Verhuur', 'Add New on Toolbar', 'verhuur product' ),
        'add_new'               => __( 'Nieuw verhuur product', 'verhuur product' ),
        'add_new_item'          => __( 'Nieuw verhuur product', 'verhuur product' ),
        'new_item'              => __( 'Nieuw verhuur product', 'verhuur product' ),
        'edit_item'             => __( 'Edit verhuur product', 'verhuur product' ),
        'view_item'             => __( 'Bekijk verhuur product', 'verhuur product' ),
        'all_items'             => __( 'Bekijk alle vehruur producten', 'verhuur product' ),
        'search_items'          => __( 'Zoek verhuur product', 'verhuur product' ),
        'parent_item_colon'     => __( 'Hoofd verhuur product:', 'verhuur product' ),
        'not_found'             => __( ' Geen verhuur producten gevonden.', 'verhuur product' ),
        'not_found_in_trash'    => __( 'Geen verhuur producten gevonden in de prullenbak.', 'vehruur product' ),
        'featured_image'        => _x( 'Verhuur product cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'verhuur product' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'verhuur product' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'verhuur product' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'verhuur product' ),
        'archives'              => _x( 'Verhuur producten archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'verhuur product' ),
        'insert_into_item'      => _x( 'Insert into verhuur product', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'verhuur product' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this verhuur product', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'verhuur product' ),
        'filter_items_list'     => _x( 'Filter verhuur producten list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'verhuur product' ),
        'items_list_navigation' => _x( 'Verhuur producten list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'verhuur product' ),
        'items_list'            => _x( 'Verhuur producten list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'verhuur product' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Verhuur producten post type',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'verhuur' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 20,
		'menu_icon'			 => 'dashicons-pressthis',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'Verhuur', $args );
}

add_action( 'init', 'veldhuizen_post_type' );
add_action( 'init', 'veldhuizen_products_register_template' );

add_action( 'init', 'veldhuizen_post_type' );
add_action( 'init', 'veldhuizen_verhuur_post_type' );
add_action ( 'init', 'veldhuizen_verhuur_register_template' );

require get_template_directory() . '/inc/footer/footer-functions.php';
