<?php

namespace ConnorFord2\StripeConnect\Traits;

use ConnorFord2\StripeConnect\Exceptions\InvalidAccount;

trait ManagesConnectAccount
{

    /**
     * Retrieve the Stripe account ID.
     *
     * @return string|null
     */
    public function stripeConnectId()
    {
        return $this->stripe_connect_id;
    }

    /**
     * Determine if the customer has a Stripe account ID.
     *
     * @return bool
     */
    public function hasStripeConnectId()
    {
        return !is_null($this->stripeConnectId());
    }

    /**
     * Determine if the customer has a Stripe Connect account ID and throw an exception if not.
     *
     * @return void
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function assertAccountExists()
    {
        if (! $this->hasStripeId()) {
            throw InvalidAccount::notYetCreated($this);
        }
    }

}