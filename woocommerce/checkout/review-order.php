
<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

		<div class="checkout__product--top">
			<div class="checkout__product--heading"><?php esc_html_e( 'Product', 'woocommerce' ); ?></div>
			<div class="checkout__product--heading"><?php esc_html_e( 'Artikelnummer', 'woocommerce' ); ?></div>
			<div class="checkout__product--price"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
		</div>
		<?php
		do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$_artikelnummer = get_post_meta( $_product->get_id(), '_artikelnummer', true );
			?>
	
				<div class="checkout__product">
					<div class="checkout__product--item">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>

					<div class="checkout__product--item">
					<?php echo $_artikelnummer ;?>
					</div>

					<div class="checkout__product--price">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_review_order_after_cart_contents' );
		?>

	<div class="checkout__product--bottom">

		<div class="checkout__product--subtotal">
			<p>
				<i><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</i>
				<?php wc_cart_totals_subtotal_html(); ?>
			</p>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="checkout__product--subtotal">
				<p>
					<i>Klantkorting:</i> <?php wc_cart_totals_coupon_html( $coupon ); ?>
				</p>
			</div>
		<?php endforeach; ?>



		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
					<tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="checkout__product--total">
			<p>
				<i><?php esc_html_e( 'Total', 'woocommerce' ); ?>:</i>
				<?php wc_cart_totals_order_total_html(); ?>
			</p>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

<?php wc_cart_totals_shipping_html(); ?>

<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

<?php endif; ?>
	</div>
<!-- </table> -->

