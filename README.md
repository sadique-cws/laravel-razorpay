# Laravel Razorpay

An easy-to-use Razorpay integration package for Laravel 11/13 applications. It abstracts the Razorpay PHP SDK behind a simple Laravel Service and Facade so you can quickly create orders and verify payment signatures without boilerplate code.

## Installation

Install the package via Composer:

```bash
composer require comestro/laravel-razorpay
```

## Configuration

First, publish the configuration file to your `config/` directory:

```bash
php artisan vendor:publish --tag=razorpay-config
```

Then, add your Razorpay credentials to your `.env` file:

```env
RAZORPAY_KEY=your_key_id_here
RAZORPAY_SECRET=your_key_secret_here
```

## Usage

You can use the `Razorpay` facade to interact with the API anywhere in your controllers.

### 1. Creating an Order

When a user initiates checkout, you must create a Razorpay order on the server. The package converts basic amounts (like INR 500) into paise automatically.

```php
use Comestro\Razorpay\Facades\Razorpay;

// Create an order for ₹500
$order = Razorpay::createOrder(500, 'receipt_1234');

// Get the Order ID to pass to your frontend frontend JS
$orderId = $order->id; 
```

### 2. Verifying a Payment Signature

After the user completes the payment on your frontend, Razorpay will submit a `razorpay_signature` to your success route. Always verify it to ensure the payload is authentic!

```php
use Illuminate\Http\Request;
use Comestro\Razorpay\Facades\Razorpay;

public function verify(Request $request)
{
    $isValid = Razorpay::verifySignature(
        $request->input('razorpay_order_id'),
        $request->input('razorpay_payment_id'),
        $request->input('razorpay_signature')
    );

    if ($isValid) {
        return "Payment successful and verified!";
    }

    return "Signature verification failed.";
}
```

### 3. Accessing the Complete Razorpay API

This package officially wraps the full Razorpay REST SDK. You don't need to manually instantiate an `Api` object. Every Razorpay resource is available as a method directly on the `Razorpay` Facade!

```php
use Comestro\Razorpay\Facades\Razorpay;

// Create a new Customer
$customer = Razorpay::customer()->create([
    'name'  => 'Gaurav Kumar',
    'email' => 'gaurav.kumar@example.com',
    'contact' => '9123456780',
]);

// Fetch a specific Payment
$payment = Razorpay::payment()->fetch('pay_29QQoUBi66xm2f');

// Refund a Payment
$refund = Razorpay::refund()->create([
    'payment_id' => 'pay_29QQoUBi66xm2f',
    'amount'     => 1000 // 1000 paise
]);

// Fetch all Orders
$orders = Razorpay::order()->all();

// Create a Subscription
$subscription = Razorpay::subscription()->create([
    'plan_id'     => 'plan_7wAosPWtrkjx6G',
    'customer_id' => 'cust_4t1YmEwb757Lw5',
    'total_count' => 6,
]);
```

#### Supported Endpoints:

The Facade natively exposes all these Razorpay endpoints:
`payment()`, `order()`, `customer()`, `refund()`, `token()`, `card()`, `transfer()`, `virtualAccount()`, `addon()`, `plan()`, `subscription()`, `invoice()`, `item()`, `qrCode()`, `paymentLink()`, `settlement()`, `webhook()`, and `fundAccount()`.

### Accessing the Native SDK Configuration

If you ever need the raw bare-metal client instance for any reason:

```php
$client = Razorpay::client();
```

## License

The MIT License (MIT).
