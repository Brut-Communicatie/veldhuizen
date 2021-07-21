<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}



echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
    
    <?php 
    $post_title = ($product->name);
    echo '<div class="top__banner"><div class="top__content"><h1>' . $post_title . '</h1></div></div>';
    
    $size = 'woocommerce_single';
    $img = $product->get_image($size);
    $cat_ids_related_prods = $product->category_ids;
    
    echo '<div class="veldhuizen__container">';
    echo '<section>';
    echo $img;
    ?>


	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
       
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><i class="fas fa-shopping-cart"> </i><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>
    </section>

    <section class="related-products-flex">
        <h3>Gerelateerde producten</h3>
        <?php
             foreach ($cat_ids_related_prods as $cat_id) {
                $name = get_the_category_by_ID($cat_id);
                $link = get_category_link($cat_id);
                echo '<a href="' . $link . '">';  
                echo '<article>';
                echo '<h5>' . $name . '</h5>'; 
                echo '<p>Producten bekijken</p>';
                echo '</article>';
                echo '</a>';
            }
        ?>
    </section>
    </div>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>