<?php

namespace ConnorFord2\StripeConnect\Traits;

use ConnorFord2\StripeConnect\StripeConnect;
use ConnorFord2\StripeConnect\Transfer;

trait Transferrable
{

    /**
     *
     *
     * @return Transfer
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidAccount
     */
    public function createTransfer($parameters = [])
    {
        $this->assertAccountExists();

        $transfer = StripeConnect::stripeClientInstance()->transfers->create(array_merge([
            'destination' => $this->stripeConnectId(),
        ], $parameters));

        return new Transfer($this, $transfer);
    }

}