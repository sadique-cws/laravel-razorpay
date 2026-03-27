<?php

namespace Comestro\Razorpay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Comestro\Razorpay\RazorpayService client()
 * @method static \Razorpay\Api\Order createOrder(int|float $amount, string $receipt, string $currency = 'INR', array $notes = [])
 * @method static bool verifySignature(string $orderId, string $paymentId, string $signature)
 * 
 * @method static \Razorpay\Api\Payment payment()
 * @method static \Razorpay\Api\Order order()
 * @method static \Razorpay\Api\Customer customer()
 * @method static \Razorpay\Api\Refund refund()
 * @method static \Razorpay\Api\Token token()
 * @method static \Razorpay\Api\Card card()
 * @method static \Razorpay\Api\Transfer transfer()
 * @method static \Razorpay\Api\VirtualAccount virtualAccount()
 * @method static \Razorpay\Api\Addon addon()
 * @method static \Razorpay\Api\Plan plan()
 * @method static \Razorpay\Api\Subscription subscription()
 * @method static \Razorpay\Api\Invoice invoice()
 * @method static \Razorpay\Api\Item item()
 * @method static \Razorpay\Api\QrCode qrCode()
 * @method static \Razorpay\Api\PaymentLink paymentLink()
 * @method static \Razorpay\Api\Settlement settlement()
 * @method static \Razorpay\Api\Webhook webhook()
 * @method static \Razorpay\Api\FundAccount fundAccount()
 *
 * @see \Comestro\Razorpay\RazorpayService
 */
class Razorpay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'razorpay-service';
    }
}
