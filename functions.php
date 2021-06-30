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
	define( '_S_VERSION', '1.0.2' );
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
	wp_enqueue_script( 'veldhuizen-filters', get_template_directory_uri() . '/js/filters.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'veldhuizen-header', get_template_directory_uri() . '/js/header.js', array(), _S_VERSION, true );
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

//  REGISTERING TEMPLATES
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

// REGISTERING CUSTOM POST TYPES
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
        'all_items'             => __( 'Bekijk alle verhuur producten', 'verhuur product' ),
        'search_items'          => __( 'Zoek verhuur product', 'verhuur product' ),
        'parent_item_colon'     => __( 'Hoofd verhuur product:', 'verhuur product' ),
        'not_found'             => __( ' Geen verhuur producten gevonden.', 'verhuur product' ),
        'not_found_in_trash'    => __( 'Geen verhuur producten gevonden in de prullenbak.', 'verhuur product' ),
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

// CUSTOM FUNCTIONS 
function veldhuizen_home_c2a($c2a) {
	$types = array( 'Producten', 'Verhuur', 'page', 'post' );
	$page = get_page_by_path($c2a, $output, $types);
	$image = get_the_post_thumbnail_url($page->ID);
	$title = ($page->post_title);
	$link = get_the_permalink($page->ID);
	echo '<a class="block " href="' . $link . '" >';
	echo '<img src="'. $image . '"/>';
	echo '<div class="block__info">';
    echo '<div class="block__square"></div>';
	echo '<h5>' . $title . '</h5>';
    // echo '<p>lees meer <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"></path></svg></p>';
    echo '</div>';
	echo '</a>';
}

// Used for the Vacatures block in the home page
function veldhuizen_home_vacatures() {
	echo  '<h3>Vacatures</h3>';
	echo '<p>Veldhuizen b.v. is fabrikant van aanhangwagens en opleggers voor BE-rijbewijs. Onze productrange bestaat verder uit oprij vrachtwagens en diverse Hovertrack varianten. Om aan de groeiende vraag uit de markt te voldoen, zijn wij op zoek naar:</p>';
	$vacature_page = get_page_by_path('vacatures');
	
	$vacatures = get_children($vacature_page->ID);
	echo '<ul>';
	foreach($vacatures as $child) {
		$vacatureTitle = get_the_title ( $child->ID );
		$vacatureLink = get_the_permalink( $child->ID );
		echo '<a href="' . $vacatureLink . '">';
		echo '<li>' . $vacatureTitle . '</li>';
		echo '</a>';
	}
	echo '</ul>';
}

// Used for the news block in the home page
function veldhuizen_home_news() {
	echo  '<h3>Nieuws</h3>';
	$args = array(
        'post_type'     => 'post',
        'post_status'   => 'published',
        'category_name' => 'nieuws',
        'orderby'       => 'date',
        'order'         => 'DESC',
		'numberposts'	=> '3'
    );
	$news = get_posts($args);
	
	echo '<div class="articles-wrapper">';
	foreach($news as $newsArticle) {
		$removeTags = array('<br>', '<br><br>', '<br />', '<br/>', '<br   >');
		$thumb = get_the_post_thumbnail_url($newsArticle);
        $parsedContent = parse_blocks($newsArticle->post_content);
		$link = get_the_permalink($newsArticle);
		$excerptRaw = $parsedContent[2]['attrs']['content'];
		$excerptRaw = substr($excerptRaw, 0, 300);
		$excerptClean = strip_tags($excerptRaw, $removeTags);


        echo '<a class="article-links" href="' . $link . '" />';
        echo '<article class="news-article">';
        echo '<img src="' . $thumb . '" alt="Afbeelding van ' . ($newsArticle->post_name) . '" />';
        echo '<div class="article-text-wrapper">';
        echo '<h4>' . ($newsArticle->post_title) . '</h4>';
        echo '<p class="article-excerpt">' . $excerptClean . '...</p>';
        echo '</div>';
        echo '</article>';
		echo '<button>Lees meer</button>';
        echo '</a>';
    }
	echo '</div>';
}

// function get_new_articles() {

// }

add_action( 'init', 'veldhuizen_post_type' );
add_action( 'init', 'veldhuizen_products_register_template' );

add_action( 'init', 'veldhuizen_post_type' );
add_action( 'init', 'veldhuizen_verhuur_post_type' );
add_action ( 'init', 'veldhuizen_verhuur_register_template' );

require get_template_directory() . '/inc/footer/footer-functions.php';

add_filter('wpcf7_autop_or_not', '__return_false'); // Remove all BR's and P in Contact Form 7 


