<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );


/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php

if (is_shop()) {
    $onderdelen = wc_get_products(array(
        'category' => array('onderdelen'),
    ));

    global $post;
    $page_title = get_the_title();
    var_dump($page_title);

    veldhuizen_wc_top_banner();

    
    echo '<div class="veldhuizen__container">';
    foreach ($onderdelen as $onderdeel){
        $prod_title = $onderdeel->name;
        $prod_image = wp_get_attachment_url($onderdeel->get_image_id());
        $prod_link = $onderdeel->get_permalink();
        echo '<a class="block" href="' . $prod_link . '">';
        echo '<img src="' . $prod_image . '"/>';
        echo '<div class="block__info">';
        echo '<div class="block__square"></div>';
        echo '<h5>' . $prod_title . '</h5>';
        echo '</div>';
	    echo '</a>';
    }
    echo '</div>';

    echo '<div class="veldhuizen__container two-col">';
    echo '<div class="--onderdelen-intro">';
    echo '<h1>Onderdelen</h1>';
    echo '<p>Bestellingen die voor 15:00 uur geplaatst zijn worden de volgende werkdag voor 17:00 uur afgeleverd, mits de onderdelen bij ons in voorraad zijn.
    Bij de bestellingen moet duidelijk en volledig het afleveradres (geen postbus adres) vermeld worden. Het is belangrijk dat u een adres opgeeft waar altijd iemand aanwezig is om de bestelling in ontvangst te nemen. Dit omdat er getekend moet worden voor ontvangst.
    Naast uw vestigingsadres (waar de factuur naartoe gestuurd wordt) kunt u ook een apart verzendadres invoeren.
    Het is tevens mogelijk bestellingen af te halen. Gebruik bij bestellingen altijd onze artikelnummers.
    U kunt natuurlijk ook even bellen om uw bestelling door te geven.
    Ontvangt u liever eerst een prijsopgave? Klik dan de optie ‘Ik ontvang graag een prijsopgave’ in het bestelformulier aan.</p>';
    echo '</div>';
    echo '</div>';

    var_dump($onderdelen);

} else if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
    

	do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
            // Check functions.php for shop_filter_cat()

            wp_reset_query();
			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );