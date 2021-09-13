<?php

Class CouponNotification {
    public function setCustomAccountNotification() {
        $user = wp_get_current_user(); // Returns string of current user
        $user = $user->display_name;
		// if (get_current_user_id() === 4) { (Old scenario where we look for ID)
        if ($user === __KLANTACCOUNT__) {
            global $woocommerce;
            $coupon = new WC_Coupon(__COUPONACCOUNT__);
            $html .= "<div class='WC__discountnotification'>";
            $html .= 'Je bekijkt de winkel momenteel met een kortingsaccount, op alle producten is er een korting van <strong>' . $coupon->amount .'%</strong> actief!';
            $html .= "</div>";
            return $html;
        }
        return;
    }
}