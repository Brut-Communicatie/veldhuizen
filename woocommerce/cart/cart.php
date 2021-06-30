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

?>

<div class="cart__container">
	<div id="my-app">
		<my-component></my-component>
	</div>

	<script type="text/javascript">
      new Vue({
        el: '#my-app',
        components: {
          'my-component': httpVueLoader('<?php echo get_template_directory_uri();?>/woocommerce/components/cart.vue')
        }
      });
    </script>
	<?php
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

		// Show products
		foreach($items as $item => $values){
			$_product =  wc_get_product( $values['data']->get_id() );
	
			$_artikelnummer = get_post_meta( $_product->get_id(), '_artikelnummer', true );

			$getProductDetail = wc_get_product( $values['product_id'] );
			$_image = $getProductDetail->get_image();
			$_price = get_post_meta($values['product_id'] , '_regular_price', true);
			$_name = $_product->get_name();
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
			$woocommerce->cart->set_quantity($item, '5');
			if ( $_product->is_sold_individually() ) {
				$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $item );
			} else {
				$product_quantity = woocommerce_quantity_input( array(
					'input_name'  => "cart[{$item}][qty]",
					'input_value' => $values['quantity'],
					'max_value'   => $_product->get_max_purchase_quantity(),
						'min_value'   => '0',
				), $_product, false );
			}
			
			echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
			echo '</div>';

			if ($hasPrice) {
				// Check if quantity in cart is more than 0
				$quantity = $values['quantity'];
				if ($quantity > 1) {
					$_price = intval($_price) * $quantity;
				}

				echo '<div class="cart__row--item">';
				echo '€' . $_price . ',-';
				echo '</div>';
			}
			
			echo '</div>';
		}
	;?>
	<div class="cart__navigation">
		<div class="cart__navigation--button">Ga verder met bestellen</div>
		<div class="cart__navigation--button">Cart updaten</div>
	</div>

</div>




<!-- 
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="article-name"><?php _e( 'Artikelnummer', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$_artikelnummer   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		
			
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
					</td>

					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail;
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
							}
						?>
					</td>

					<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
							}

							// Backorder notification
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
							}
						?>
					</td>
                    
 
                     <td class="article-name"><?php echo WC()->cart->get_item_data( $cart_item ); ?></td>
                 
					 <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->get_max_purchase_quantity(),
										'min_value'   => '0',
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

				</tr>
				<?php
			}
		}
		?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>
CSklm.
					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
</div>
<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div> -->

<?php do_action( 'woocommerce_after_cart' ); ?>
