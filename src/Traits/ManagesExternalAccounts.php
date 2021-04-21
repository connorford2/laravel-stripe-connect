<?php

namespace ConnorFord2\StripeConnect\Traits;

use ConnorFord2\StripeConnect\ExternalAccount;
use ConnorFord2\StripeConnect\StripeConnect;
use Stripe\ExternalAccount as StripeExternalAccount;

trait ManagesExternalAccounts
{

    /**
     * Get a collection of the customer's payment methods.
     *
     * @param  array  $parameters
     * @return \Illuminate\Support\Collection|\ConnorFord2\StripeConnect\ExternalAccount[]
     */
    public function externalAccounts($parameters = [])
    {
        if (! $this->hasStripeConnectId()) {
            return collect();
        }

        $externalAccounts = StripeConnect::stripeClientInstance()->accounts->allExternalAccounts(
            $this->stripeConnectId(),
            array_merge(['limit' => 24], $parameters)
        );

        return collect($externalAccounts->data)->map(function ($externalAccount) {
            return new ExternalAccount($this, $externalAccount);
        });
    }

    /**
     * Find an ExternalAccount by ID.
     *
     * @param  string  $externalAccountID
     * @return \ConnorFord2\StripeConnect\ExternalAccount|null
     */
    public function findExternalAccount($externalAccountID)
    {
        $stripeExternalAccount = null;

        try {
            $stripeExternalAccount = StripeConnect::stripeClientInstance()->accounts->retrieveExternalAccount($this->stripeConnectId(), $externalAccountID, []);
        } catch (Exception $exception) {
            //
        }

        return $stripeExternalAccount ? new ExternalAccount($this, $stripeExternalAccount) : null;
    }

    /**
     * Add an external account to the customer.
     *
     * @param  string  $externalAccountID
     * @return \ConnorFord2\StripeConnect\ExternalAccount
     */
    public function addExternalAccount($externalAccountID)
    {
        $this->assertAccountExists();

        $stripeExternalAccount = StripeConnect::stripeClientInstance()->accounts->createExternalAccount(
            $this->stripeConnectId(),
            ['external_account' => $externalAccountID,]
        );

        return new ExternalAccount($this, $stripeExternalAccount);
    }

    /**
     * Remove an external account from the connect account.
     *
     * @param  \Stripe\ExternalAccount|string  $externalAccount
     * @return void
     */
    public function removeExternalAccount($externalAccount)
    {
        $this->assertAccountExists();

        StripeConnect::stripeClientInstance()->accounts->deleteExternalAccount(
            $this->stripeConnectId(),
            $this->resolveStripeExternalAccountID($externalAccount)
        );
    }

    /**
     * Resolve a ExternalAccount an ID.
     *
     * @param  \Stripe\ExternalAccount|string  $externalAccount
     * @return string
     */
    protected function resolveStripeExternalAccountID($externalAccount)
    {
        if ($externalAccount instanceof StripeExternalAccount) {
            return $externalAccount->id;
        }

        return $externalAccount;
    }

}
