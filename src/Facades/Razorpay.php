<?php

namespace Comestro\Razorpay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Comestro\Razorpay\RazorpayService client()
 * @method static \Razorpay\Api\Order createOrder(int|float $amount, string $receipt, string $currency = 'INR', array $notes = [])
 * @method static bool verifySignature(string $orderId, string $paymentId, string $signature)
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
