<?php

namespace ConnorFord2\StripeConnect;

use Stripe\StripeClient;

class StripeConnect
{

    /**
     * Get an Instance of the Stripe SDK.
     *
     * @return \Stripe\StripeClient|null
     */
    public static function stripeClientInstance()
    {
        return new StripeClient(config('services.stripe.secret'));
    }

}
