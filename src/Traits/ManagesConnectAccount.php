<?php

namespace ConnorFord2\StripeConnect\Traits;

use ConnorFord2\StripeConnect\ConnectAccount;
use ConnorFord2\StripeConnect\Exceptions\InvalidAccount;
use ConnorFord2\StripeConnect\StripeConnect;

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
     * Retrieve the Stripe account ID.
     *
     * @return string|null
     */
    public function setStripeConnectId($stripe_connect_id)
    {
        $this->stripe_connect_id = $stripe_connect_id;
        $this->save();
    }

    /**
     * Determine if the owner has a Stripe account ID.
     *
     * @return bool
     */
    public function hasStripeConnectId()
    {
        return !is_null($this->stripeConnectId());
    }

    /**
     * Determine if the owner has a Stripe Connect account ID and throw an exception if not.
     *
     * @return void
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function assertAccountExists()
    {
        if (! $this->hasStripeConnectId()) {
            throw InvalidAccount::notYetCreated($this);
        }
    }

    /**
     * Determine if the owner has a Stripe Connect account ID and then create or get the account.
     *
     * @return void
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function createOrGetConnectAccount()
    {
        if ($this->hasStripeConnectId()) {
            return $this->getConnectAccount();
        } else {
            return $this->createConnectAccount();
        }
    }

    /**
     * Determine if the owner has a Stripe Connect account ID and throw an exception if not.
     *
     * @return ConnectAccount
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function createConnectAccount($parameters)
    {
        $connectAccount = StripeConnect::stripeClientInstance()->accounts->create($parameters);
        $this->setStripeConnectId($connectAccount->id);
        return new ConnectAccount($this, $connectAccount);
    }

    /**
     * Retrieve the owner's Stripe Connect Account
     *
     * @return void
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function getConnectAccount()
    {
        return StripeConnect::stripeClientInstance()->accounts->retrieve($this->stripeConnectId(), []);
    }

    /**
     * Delete the owner's Stripe Connect Account
     *
     * @return void
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    protected function removeConnectAccount()
    {
        if (! $this->hasStripeConnectId()) {
            throw InvalidAccount::notYetCreated($this);
        }
    }

}