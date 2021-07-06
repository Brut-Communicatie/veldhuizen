<?php
/**
 * Grouped product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/grouped.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;


do_action( 'woocommerce_before_add_to_cart_form' ); 

// TEXT VARIABLES FOR DIFFERENT PAGES
$verlichting_intro 		= '<p>Hier kunt u alle verlichting onderdelen en toebehoren zoals stekkers en kabelverbindingsdoos vinden.<br><br>Selecteer een categorie waarin u wilt zoeken en u krijgt een overzicht waarin de onderdelen afgebeeld zijn. Als het onderdeel wat u zoekt niet op deze site staat, kunt u altijd contact opnemen met onze magazijnmedewerker door het volgende telefoonnummer te bellen 088-6259600.</p>'; 
$assen_intro 			= '<p>Voor het vinden van de juiste onderdelen van een as heeft u het chassisnummer nodig van de oplegger of aanhangwagen waarvoor u onderdelen zoekt. Het 6e karakter in het chassisnummer geeft aan welk type as er gemonteerd is. Hieronder staan de verschillende typen assen weergegeven. Als u op een type klikt, krijgt u een tekening of afbeelding te zien met het daarbij behorende overzicht met artikelnummers.<br><br> <strong>Voorbeeld:</strong> <br> Een oplegger heeft het volgende chassisnummer -XL9LS<strong>H</strong>12345070001, de assen onder deze oplegger zijn van het type <strong>H</strong>.</p>';
$trekkerombouw_intro 	= '<p>Hier kunt u alle onderdelen en toebehoren van verschillende merken vinden.<br><br>Selecteer een categorie waarin u wilt zoeken en u krijgt een overzicht waarin de onderdelen afgebeeld zijn. Als het onderdeel wat u zoekt niet op deze site staat, kunt u altijd contact opnemen met onze magazijnmedewerker door het volgende telefoonnummer te bellen 088-6259600.</p>';
$carrosserie_intro 		= '<p>Voer het aantal onderdelen in en plaats deze in het winkelmandje (groene knop). Uw bestelling kunt u plaatsen via het winkelmandje rechtsbovenaan de pagina.<br><br>Onderdelen zoals sluitingen en scharnieren die op uw aanhangwagen of oplegger gemonteerd zijn, vindt u in deze categorie. U kunt heel eenvoudig bestellen door het aantal wat u wenst bij het betreffende onderdeel te plaatsen en de bestelling te verzenden. Als het onderdeel wat u zoekt niet op deze site staat, kunt u altijd contact opnemen met onze magazijnmedewerker door het volgende telefoonnummer te bellen 088-6259600.</p>';
?>

<?php
// Banner title
$post_title = ($post->post_name);
echo '<div class="top__banner"><div class="top__content"><h1>' . $post_title . '</h1></div></div>';

// Make selection to create product cat overview pages
if ($post_title === 'trekkerombouw' or $post_title === 'verlichting' or $post_title === 'assen') {

	// Intro text selection based on page
	echo '<div class="veldhuizen__container one-col">';
	if ($post_title === 'trekkerombouw') {
		echo $trekkerombouw_intro;
	} else if ($post_title === 'verlichting') {
		echo $verlichting_intro;
	} else if ($post_title === 'assen') {
		echo $assen_intro;
	} else if ($post_title === 'carrosserie') {
		echo $carrosserie_intro;
	}
	echo '<hr class="divider-shop">';
	echo '</div>';

	// show prod categories from ONDERDELEN
	echo '<div class="veldhuizen__container">';
	foreach( $grouped_products as $grouped_product_child) {
		$childLink = ($grouped_product_child->get_permalink());
		$childImageID = ($grouped_product_child->get_image_id());
		$childImage = wp_get_attachment_url($childImageID);
		$childTitle = ($grouped_product_child->name);

		echo '<a class="block" href="'. $childLink .'">';
        echo '<img src="'. $childImage .'" />';
        echo '<div class="block__info">';
        echo '<div class="block__square"></div>';
        echo '<h5>';
        echo $childTitle;
        echo '</h5>';
        echo '</div>';
        echo '</a>'; 
	}
	echo '</div>';		// close veldhuizen__container

} else  {
	?>
	<div class="veldhuizen__container one-col small">
	<p class="bold center">Voer het aantal onderdelen in en plaats deze in het winkelmandje (groene knop). Uw bestelling kunt u plaatsen via het winkelmandje rechtsbovenaan de pagina.</p>
	<p class="center">Hieronder vindt u een overzicht van de verschillende “<?php echo $post_title; ?>” onderdelen. Bekijk een grotere afbeelding door op de afbeelding te klikken.</p>
	</div>
	

	<div class="veldhuizen__container one-col">
	<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
			<tbody>
				<tr>
					<td></td>
					<td class="cell-names">Hoeveelheid</td>
					<td class="cell-names">Naam product</td>
					<td class="cell-names">Prijs</td>
				</tr>
					
				<?php
				$quantites_required      = false;
				$previous_post           = $post;
				$grouped_product_columns = apply_filters(
					'woocommerce_grouped_product_columns',
					array(
						'image',
						'quantity',
						'label',
						'price',
						
					),
					$product
				);
				$show_add_to_cart_button = true;

				do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );
				
				foreach ( $grouped_products as $grouped_product_child ) {
					$post_object        = get_post( $grouped_product_child->get_id() );
					$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
					$post               = $post_object; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					setup_postdata( $post );

					if ( $grouped_product_child->is_in_stock() ) {
						$show_add_to_cart_button = true;
					}

					echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

					// Output columns for each product.
					foreach ( $grouped_product_columns as $column_id ) {
						do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

						switch ( $column_id ) {
							case 'image':
								$size = 'shop_thumbnail';
								$value = $grouped_product_child->get_image($size);
								break;
							case 'quantity':
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

								$value = ob_get_clean();
								break;
							case 'label':
								$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
								$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
								$value .= '</label>';
								break;
							case 'price':
								$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
								break;
							
							default:
								$value = '';
								break;
						}

					echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

						do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
					}

					echo '</tr>';
				}
				$post = $previous_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				setup_postdata( $post );

				do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
				?>
			</tbody>
		</table>

		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

		<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

		<?php endif; ?>
	</form>
	</div>

<?php
// CLOSING TAG FROM IF ELSE CHECK FOR LOCATION PAGE USER
}
?>


<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>