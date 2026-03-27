<?php

namespace Comestro\Razorpay\Tests;

use Comestro\Razorpay\Facades\Razorpay;
use Razorpay\Api\Api;
use Razorpay\Api\Payment;
use Razorpay\Api\Order;
use Razorpay\Api\Customer;
use Razorpay\Api\Refund;
use Razorpay\Api\Token;
use Razorpay\Api\Card;
use Razorpay\Api\Transfer;
use Razorpay\Api\VirtualAccount;
use Razorpay\Api\Addon;
use Razorpay\Api\Plan;
use Razorpay\Api\Subscription;
use Razorpay\Api\Invoice;
use Razorpay\Api\Item;
use Razorpay\Api\QrCode;
use Razorpay\Api\PaymentLink;
use Razorpay\Api\Settlement;
use Razorpay\Api\Webhook;
use Razorpay\Api\FundAccount;

class RazorpayServiceTest extends TestCase
{
    public function test_facade_resolves_base_client()
    {
        $this->assertInstanceOf(Api::class, Razorpay::client());
    }

    public function test_all_api_entities_resolve_from_facade()
    {
        $this->assertInstanceOf(Payment::class, Razorpay::payment());
        $this->assertInstanceOf(Order::class, Razorpay::order());
        $this->assertInstanceOf(Customer::class, Razorpay::customer());
        $this->assertInstanceOf(Refund::class, Razorpay::refund());
        $this->assertInstanceOf(Token::class, Razorpay::token());
        $this->assertInstanceOf(Card::class, Razorpay::card());
        $this->assertInstanceOf(Transfer::class, Razorpay::transfer());
        $this->assertInstanceOf(VirtualAccount::class, Razorpay::virtualAccount());
        $this->assertInstanceOf(Addon::class, Razorpay::addon());
        $this->assertInstanceOf(Plan::class, Razorpay::plan());
        $this->assertInstanceOf(Subscription::class, Razorpay::subscription());
        $this->assertInstanceOf(Invoice::class, Razorpay::invoice());
        $this->assertInstanceOf(Item::class, Razorpay::item());
        $this->assertInstanceOf(QrCode::class, Razorpay::qrCode());
        $this->assertInstanceOf(PaymentLink::class, Razorpay::paymentLink());
        $this->assertInstanceOf(Settlement::class, Razorpay::settlement());
        $this->assertInstanceOf(Webhook::class, Razorpay::webhook());
        $this->assertInstanceOf(FundAccount::class, Razorpay::fundAccount());
    }

    public function test_signature_verification_returns_false_on_invalid_signature()
    {
        // Without valid secret matching signature, the SDK throws exception, caught and returns false
        $result = Razorpay::verifySignature('test_order', 'test_pay', 'invalid_signature');
        $this->assertFalse($result);
    }
}
