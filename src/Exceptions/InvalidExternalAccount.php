<?php

namespace ConnorFord2\StripeConnect\Exceptions;

use Exception;
use Stripe\ExternalAccount as StripeExternalAccount;

class InvalidExternalAccount extends Exception
{
    /**
     * Create a new InvalidExternalAccount instance.
     *
     * @param  \Stripe\ExternalAccount  $externalAccount
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function invalidOwner(StripeExternalAccount $externalAccount, $owner)
    {
        return new static(
            "The external account `{$externalAccount->id}` does not belong to this account `{$owner->stripeConnectId()}`."
        );
    }
}
