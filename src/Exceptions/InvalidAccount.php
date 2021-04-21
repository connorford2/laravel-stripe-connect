<?php

namespace ConnorFord2\StripeConnect\Exceptions;

use Exception;

class InvalidAccount extends Exception
{
    /**
     * Create a new InvalidAccount instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @return static
     */
    public static function notYetCreated($owner)
    {
        return new static(class_basename($owner).' does not have a Stripe Connect account yet.');
    }
}
