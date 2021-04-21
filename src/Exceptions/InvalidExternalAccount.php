<?php

namespace ConnorFord2\StripeConnect\Exceptions;

use Exception;

class InvalidExternalAccount extends Exception
{
    /**
     * Create a new InvalidExternalAccount instance.
     *
     * @param  \Stripe\BankAccount | \Stripe\Card  $externalAccount
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function invalidOwner($externalAccount, $owner)
    {
        return new static(
            "The external account `{$externalAccount->id}` does not belong to this account `{$owner->stripeConnectId()}`."
        );
    }
}
