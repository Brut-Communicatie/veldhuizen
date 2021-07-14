<?php
// Dit zijn toevoegingen op de oude site van Veldhuizen. Nog op te schonen

// create the custom field on product admin tab
add_action( 'woocommerce_product_options_general_product_data', 'create_warranty_custom_field' );
function create_warranty_custom_field() {
	global $woocommerce, $post;
	
    // Create a custom text field
    woocommerce_wp_text_input( array(
        'id'            => '_artikelnummer',
        'type'          => 'text',
        'label'         => __('Artikelnummer', 'woocommerce' ),
        'description'   => '',
        'desc_tip'      => 'true',
        'placeholder'   =>  __('', 'woocommerce' ),
    ) );
}

// save the data value from this custom field on product admin tab
add_action( 'woocommerce_process_product_meta', 'save_warranty_custom_field' );
function save_warranty_custom_field( $post_id ) {
    $wc_text_field = $_POST['_artikelnummer'];
    if ( !empty($wc_text_field) ) {
        update_post_meta( $post_id, '_artikelnummer', esc_attr( $wc_text_field ) );
    }
}

// Store custom field in Cart
add_action( 'woocommerce_add_cart_item_data', 'store_warranty_custom_field', 10, 2 );

function store_warranty_custom_field( $cart_item_data, $product_id ) {
    $warranty_item = get_post_meta( $product_id , '_artikelnummer', true );
    if( !empty($warranty_item) ) {
        $cart_item_data[ '_artikelnummer' ] = $warranty_item;

        // below statement make sure every add to cart action as unique line item
        $cart_item_data['unique_key'] = md5( microtime().rand() );
        WC()->session->set( 'days_manufacture', $warranty_item );
    }
    return $cart_item_data;
}


// Render meta on cart and checkout
add_filter( 'woocommerce_get_item_data', 'rendering_meta_field_on_cart_and_checkout', 10, 2 );

function rendering_meta_field_on_cart_and_checkout( $cart_data, $cart_item ) {
    $custom_items = array();
    // Woo 2.4.2 updates
    if( !empty( $cart_data ) ) {
        $custom_items = $cart_data;
    }
    if( isset( $cart_item['_artikelnummer'] ) ) {
        $custom_items[] = array( "name" => __( "Artikelnummer", "woocommerce" ), "value" => $cart_item['_artikelnummer'] );
    }
    return $custom_items;
}

// Add the information in the order as meta data
add_action('woocommerce_new_order_item','add_waranty_to_order_item_meta', 1, 3 );
function add_waranty_to_order_item_meta( $item_id, $values, $cart_item_key ) {
    // Retrieving the product id for the order $item_id
    $prod_id = wc_get_order_item_meta( $item_id, '_product_id', true );
    // Getting the warranty value for this product Id
    $warranty = get_post_meta( $product_id, '_artikelnummer', true );
    // Add the meta data to the order
    wc_add_order_item_meta($item_id, 'Artikelnummer', $warranty, true);
}


add_action('woocommerce_checkout_update_order_meta',function( $order_id, $posted ){
    update_post_meta( $order_id, '_artikelnummer', 'my data' );
} , 10, 2);

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

	global $woocommerce, $post;


// Text Field
woocommerce_wp_text_input( 
	array( 
		'id'          => '_iveco', 
		'label'       => __( 'Artikelnummer Iveco', 'woocommerce' ), 
		'placeholder' => '',
		'desc_tip'    => 'true',
		'description' => __( 'Unieke Iveco artikel nummer', 'woocommerce' ) 
	)
);


// Text Field
woocommerce_wp_text_input( 
	array( 
		'id'          => '_peras', 
		'label'       => __( 'Aantal per as', 'woocommerce' ), 
		'placeholder' => '',
		'desc_tip'    => 'true',
		'description' => __( 'Het aantal stuks per as', 'woocommerce' ) 
	)
);

// Text Field
woocommerce_wp_text_input( 
	array( 
		'id'          => '_positie', 
		'label'       => __( 'Positie t.o.v. tekening', 'woocommerce' ), 
		'placeholder' => '',
		'desc_tip'    => 'true',
		'description' => __( 'Positie t.o.v. tekening', 'woocommerce' ) 
	)
);

// Text Field
woocommerce_wp_text_input( 
	array( 
		'id'          => '_fabrieksnummer', 
		'label'       => __( 'Fabrieks nr.', 'woocommerce' ), 
		'placeholder' => '',
		'desc_tip'    => 'true',
		'description' => __( 'Fabrieks nr.', 'woocommerce' ) 
	)
);


}
function woo_add_custom_general_fields_save( $post_id ){

		// Text Field
	$woocommerce_text_field = $_POST['_iveco'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_iveco', esc_attr( $woocommerce_text_field ) );
		
		// Text Field
	$woocommerce_text_field = $_POST['_peras'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_peras', esc_attr( $woocommerce_text_field ) );
		
		// Text Field
	$woocommerce_text_field = $_POST['_positie'];
	//if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_positie', esc_attr( $woocommerce_text_field ) );
		
		// Text Field
	$woocommerce_text_field = $_POST['_fabrieksnummer'];
	//if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_fabrieksnummer', esc_attr( $woocommerce_text_field ) );
		


}

