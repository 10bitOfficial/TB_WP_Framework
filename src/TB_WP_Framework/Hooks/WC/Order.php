<?php

namespace TB_WP_Framework\Hooks\WC;
if(!defined('ABSPATH')){exit;}
use WC_Order;

/**
 * Class Order
 * @package TB_WP_Framework\Hooks\WC
 * @since 1.0.0
 * @author Eyal Borgman <www.linkedin.com/in/eyalborgman>
 */
class Order
{

	/**
	 *
	 */
	const ACTION_noteAddedByAdmin = 'TB_WP_Framework_noteAddedByAdmin';
	/**
	 *
	 */
	const ACTION_paymentComplete = 'TB_WP_Framework_paymentComplete';
	/**
	 *
	 */
	const ACTION_orderStatusChange = 'TB_WP_Framework_orderStatusChange';

	/**
	 * @return array
	 * @since 1.0.0
	 */
	public static function getOptionalData(): array {
	    return array(
		    'total'                => 'get_total',
		    // Order props.
		    'user'          => 'get_user',
		    'id'            => 'get_id',
		    'billing'              => array(
			    'first_name' => 'get_billing_first_name',
			    'last_name'  => 'get_billing_last_name',
			    'company'    => 'get_billing_company',
			    'address_1'  => 'get_billing_address_1',
			    'address_2'  => 'get_billing_address_2',
			    'city'       => 'get_billing_city',
			    'state'      => 'get_billing_state',
			    'postcode'   => 'get_billing_postcode',
			    'country'    => 'get_billing_country',
			    'email'      => 'get_billing_email',
			    'phone'      => 'get_billing_phone',
		    ),
		    'shipping'             => array(
			    'first_name' => 'get_shipping_first_name',
			    'last_name'  => 'get_shipping_last_name',
			    'company'    => 'get_shipping_company',
			    'address_1'  => 'get_shipping_address_1',
			    'address_2'  => 'get_shipping_address_2',
			    'city'       => 'get_shipping_city',
			    'state'      => 'get_shipping_state',
			    'postcode'   => 'get_shipping_postcode',
			    'country'    => 'get_shipping_country',
		    ),
		    'customer_note'        => 'get_customer_note',
	    );
    }

	/**
	 * @since 1.0.0
	 */
	public static function noteAddedByAdmin()
    {
        add_action('woocommerce_order_note_added', function (int $comment_id, WC_Order $order) {
            $comment = wc_get_order_note($comment_id);
            if (is_ajax() && $comment->added_by != 'system' && $comment->customer_note) {
                self::noteAddedByAdminAction($comment, $order);
            }
        }, 10, 2);
    }

	/**
	 * @param object $comment
	 * @param \WC_Order $order
	 *
	 * @since 1.0.0
	 */
	public static function noteAddedByAdminAction(object $comment, WC_Order $order)
    {
        do_action(self::ACTION_noteAddedByAdmin,$comment,$order);
    }

	/**
	 * @since 1.0.0
	 */
	public static function paymentComplete(){
    	add_action('woocommerce_payment_complete',function (int $orderID){
    		$order = new WC_Order($orderID);
    		self::paymentCompleteAction($order);
	    });
    }

	/**
	 * @param \WC_Order $order
	 *
	 * @since 1.0.0
	 */
	public static function paymentCompleteAction( WC_Order $order)
	{
		do_action(self::ACTION_paymentComplete,$order);
	}

	/**
	 * @since 1.0.0
	 */
	public static function orderStatusChange(){
		add_action('woocommerce_order_status_changed',function (int $orderID,string $from,string $to, WC_Order $order){
			self::orderStatusChangeAction($from,$to,$order);
		},10,4);
	}

	/**
	 * @param string $from
	 * @param string $to
	 * @param \WC_Order $order
	 *
	 * @since 1.0.0
	 */
	public static function orderStatusChangeAction(string $from,string $to, WC_Order $order)
	{
		do_action(self::ACTION_orderStatusChange,$from,$to,$order);
	}

}