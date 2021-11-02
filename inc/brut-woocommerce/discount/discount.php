<?php
namespace BrutCommunicatie;

class CustomerDiscount {
	private $coupon_code = __COUPONACCOUNT__;

	public function __construct () {
		add_action('woocommerce_before_cart', [$this, 'addDiscount']);
		add_action('woocommerce_before_checkout_form', [$this, 'addDiscount']);
	}
	public function addDiscount() {
		if (is_admin() && !defined('DOING_AJAX')) {
			return;
		}

		// What if user ID is different? Can we show the discount while shopping or only when viewing the cart? 
		// Where do we apply the discount? Total amount or per item?
		// Might be better to do a get current user and base it on the login-name? Going to be a hassle to 1:1 develop staging & live with IDs

        $user = wp_get_current_user(); 
        $user = $user->display_name; // Returns string of current user

		// if (get_current_user_id() === 4) { (Old scenario where we look for ID)
        if ($user === __KLANTACCOUNT__) {
			// add discount if not added already
			if (!in_array($this->coupon_code, WC()->cart->get_applied_coupons())) {
				WC()->cart->apply_coupon($this->coupon_code);
			}
		} else {
			// remove discount if it was previously added
			WC()->cart->remove_coupon($this->coupon_code);
		}
	}
}
