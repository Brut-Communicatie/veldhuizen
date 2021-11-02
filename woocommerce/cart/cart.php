<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); 
do_action( 'woocommerce_before_cart_contents' );
?>

<div class="cart__container">
	<?php

		function setQuantity($cartItem, $quantity){
			global $woocommerce;
			$woocommerce->cart->set_quantity($cartItem, intval($quantity));
		}

		// do_shortcode( '[vueapp]' );
		$hasPrice = false; // Defaults to false

		// Headings for the table
		$cartHeadings = [' ', 'Product', 'Artikelnummer', 'Aantal']; 

		global $woocommerce;
		$items = $woocommerce->cart->get_cart();

		// Check if a product has a price that is bigger than 0 to show the header "Prijs"
		foreach($items as $item => $values){
			$_price = get_post_meta($values['product_id'] , '_regular_price', true);
			if (intval($_price) > 0) {
				$hasPrice = true;
			}
		}

		echo '<div class="cart__heading">';

		foreach($cartHeadings as $heading) {
		echo '<div class="cart__heading--item">';
		echo '<p>' . $heading . '</p>';
		echo '</div>';
		}

		if ($hasPrice) {
			echo '<div class="cart__heading--item"><p>Prijs</p></div>';
		}

		echo '</div>';
		echo '<form action="'. esc_url( wc_get_cart_url() ) .'"  method="post">';
		// Show products
		foreach($items as $item => $values){
			$_product =  wc_get_product( $values['data']->get_id() );
			$_artikelnummer = get_post_meta( $_product->get_id(), '_artikelnummer', true );
			$getProductDetail = wc_get_product( $values['product_id'] );
			$_image = $getProductDetail->get_image();
			$_price = get_post_meta($values['product_id'] , '_regular_price', true);
			$_name = $_product->get_name();

			if(isset($_POST['cart'])){
				$quantity = $_POST['cart'][$item];
				setQuantity($item, $quantity['qty']);
			}

			// var_dump($values);
			echo '<div class="cart__row">';

			echo '<div class="cart__row--item">';

			echo '<div class="cart__remove">';
			echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
				'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
				esc_url( WC()->cart->get_remove_url( $item ) ),
				__( 'Remove this item', 'woocommerce' ),
				esc_attr( $product_id ),
				esc_attr( $_product->get_sku() )
			), $cart_item_key );
			echo '</div>';

			echo $_image;
			echo '</div>';

			echo '<div class="cart__row--item">';
			echo $_name;
			echo '</div>';

			echo '<div class="cart__row--item">';
			echo $_artikelnummer;
			echo '</div>';

			echo '<div class="cart__row--item">';
			if ( $_product->is_sold_individually() ) {
				$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $item );
			} else {
				$product_quantity = woocommerce_quantity_input( array(
					'input_name'  => "cart[{$item}][qty]",
					'input_value' => ($quantity ? $quantity['qty'] : $values['quantity']),
					'max_value'   => $_product->get_max_purchase_quantity(),
						'min_value'   => '0',
				), $_product, false );
			}
			
			echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $item, $values );
			echo '</div>';

			if ($hasPrice) {
				// Check if quantity in cart is more than 0
				if ($quantity) {
					$itemQuantity = $quantity['qty'];
				} else {
					$itemQuantity = $values['quantity'];
				}
		
				if ($itemQuantity > 1) {
					$_price = intval($_price) * $itemQuantity;
				}

				// Check for discount code.
		
				$user = wp_get_current_user(); 
				$user = $user->display_name; // Returns string of current user
			
				
				echo '<div class="cart__row--item">';

				if ($user === __KLANTACCOUNT__) {
					if ($_price != 0) {
						global $woocommerce;
						$coupon = new WC_Coupon(__COUPONACCOUNT__);
						$_originalPrice = $_price;
						$percentage = $coupon->amount; // Get discount %
						$discount = $percentage / 100 * $_price; // Get discount amount
						$_price = $_price - $discount; // Remove from price
						
						// Show original price
						echo '<span class="WC__discount--item">€' . $_originalPrice . ',-</span>';
					}
				}

				echo '€' . $_price . ',-';
				echo '</div>';
			}
			
			echo '</div>';
		}
	;?>

	<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	<div class="cart__navigation">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"class="cart__navigation--button">Ga verder met bestellen</a>
		<a class="cart__navigation--button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>?empty-cart"><?php _e( 'Empty Cart', 'woocommerce' ); ?></a>
		<button name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" class="cart__navigation--button">Cart updaten</button>
		<?php do_action( 'woocommerce_cart_actions' ); ?>
	</div>
	</form>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>



