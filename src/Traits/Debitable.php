<?php

namespace ConnorFord2\StripeConnect\Traits;

use ConnorFord2\StripeConnect\StripeConnect;
use ConnorFord2\StripeConnect\Transfer;

trait Debitable
{

    /**
     *
     *
     * @return Transfer
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    public function debitConnectAccount($parameters = [])
    {
        $this->assertAccountExists();

        return StripeConnect::stripeClientInstance()->charges->create(array_merge([
            'source' => $this->stripeConnectId()
        ], $parameters));
    }

}