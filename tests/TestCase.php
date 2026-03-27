<?php

namespace Comestro\Razorpay\Tests;

use Comestro\Razorpay\RazorpayServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            RazorpayServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('razorpay.key', 'rzp_test_mockedkey1234');
        $app['config']->set('razorpay.secret', 'mocked_secret_45678');
    }
}
