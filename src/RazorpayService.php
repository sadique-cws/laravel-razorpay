<?php

namespace Comestro\Razorpay;

use Exception;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayService
{
    /**
     * @var \Razorpay\Api\Api
     */
    protected $api;

    public function __construct()
    {
        $key = config('razorpay.key');
        $secret = config('razorpay.secret');

        if (empty($key) || empty($secret)) {
            throw new Exception("Razorpay API Key and Secret are required. Please set them in your .env file.");
        }

        $this->api = new Api($key, $secret);
    }

    /**
     * Get the native Razorpay API client instance.
     *
     * @return \Razorpay\Api\Api
     */
    public function client()
    {
        return $this->api;
    }

    /**
     * Create a new order in Razorpay.
     *
     * @param int|float $amount    The amount in the base currency (e.g., INR). It is converted to paise automatically.
     * @param string    $currency  The currency code, default is INR.
     * @param string    $receipt   A custom receipt ID.
     * @param array     $notes     Optional key-value notes.
     * @return \Razorpay\Api\Order
     */
    public function createOrder($amount, $receipt, $currency = 'INR', array $notes = [])
    {
        // Convert to smallest currency unit (e.g., paise for INR)
        $amountInSmallestUnit = (int) round($amount * 100);

        $orderData = [
            'receipt'         => $receipt,
            'amount'          => $amountInSmallestUnit,
            'currency'        => $currency,
            'payment_capture' => 1 // Auto capture
        ];

        if (!empty($notes)) {
            $orderData['notes'] = $notes;
        }

        return $this->api->order->create($orderData);
    }

    /**
     * Verify the payment signature returned by Razorpay.
     *
     * @param string $orderId    The razorpay_order_id.
     * @param string $paymentId  The razorpay_payment_id.
     * @param string $signature  The razorpay_signature.
     * @return bool
     * @throws SignatureVerificationError
     */
    public function verifySignature($orderId, $paymentId, $signature)
    {
        $attributes = [
            'razorpay_order_id'   => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature'  => $signature
        ];

        try {
            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (SignatureVerificationError $e) {
            return false;
        }
    }
}
