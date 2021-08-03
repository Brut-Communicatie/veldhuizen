<?php
// NEED TO LOOK LATER AT THIS, OR TRY TO SORT THE PRODUCTS

$prod_array = array();
class product_object {
    public $positie;
    public $omschrijving;
    public $aantal;
    public $veldhuizen_nr;
    public $fabrieks_nr;
    public $iveco_nr;
    public $per_as;
    public $id;
}
$show_add_to_cart_button = true;
do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

foreach ($grouped_products as $grouped_product_child) {
    $post_object        = get_post( $grouped_product_child->get_id() );
    $post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    setup_postdata( $post );

    $wc_prod = new Product_object();
    $wc_prod->positie = get_post_meta($grouped_product_child->get_id(), '_positie', true );
    $wc_prod->omschrijving = $grouped_product_child->name;
    // Maximum bs for the input field, cba for putting this in a function or w/e for readability
    ob_start();
    if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
        woocommerce_template_loop_add_to_cart();
    } elseif ( $grouped_product_child->is_sold_individually() ) {
        echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
    } else {
        do_action( 'woocommerce_before_add_to_cart_quantity' );
        woocommerce_quantity_input(
            array(
                'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
                'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.NonceVerification.Missing
                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
                'placeholder' => '0',
            )
        );
        do_action( 'woocommerce_after_add_to_cart_quantity' );
    }
    $wc_prod->aantal = ob_get_clean(); 	// end of bs
    $wc_prod->veldhuizen_nr = get_post_meta($grouped_product_child->get_id(), '_artikelnummer', true );
    $wc_prod->fabrieks_nr = get_post_meta($grouped_product_child->get_id(), '_fabrieksnummer', true );
    $wc_prod->iveco_nr = get_post_meta($grouped_product_child->get_id(), '_iveco', true );
    $wc_prod->per_as = get_post_meta($grouped_product_child->get_id(), '_peras', true );
    $wc_prod->id = $grouped_product_child->get_id();
    $prod_array[] = $wc_prod;

}
asort($prod_array);
var_dump($prod_array);

foreach ($prod_array as $products_sorted) {
    echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';
    echo '<td>' . $products_sorted->positie . '</td>';
    echo '<td>' . $products_sorted->omschrijving . '</td>';
    echo '<td>' . $products_sorted->aantal . '</td>';
    echo '<td>' . $products_sorted->veldhuizen_nr . '</td>';
    echo '<td>' . $products_sorted->fabrieks_nr . '</td>';
    echo '<td>' . $products_sorted->iveco_nr . '</td>';
    echo '<td>' . $products_sorted->per_as . '</td>';
    echo '</td>';
}
var_dump($grouped_products->_positie);