<?php

namespace ConnorFord2\StripeConnect;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stripe\Account;
use JsonSerializable;

class ConnectAccount implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * The Stripe model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $owner;

    /**
     * The Stripe ConnectAccount instance.
     *
     * @var \Stripe\Account
     */
    protected $connectAccount;

    /**
     * Create a new ConnectAccount instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @param  \Stripe\ConnectAccount $connectAccount
     * @return void
     *
     */
    public function __construct($owner, \Stripe\Account $connectAccount)
    {
        $this->owner = $owner;
        $this->connectAccount = $connectAccount;
    }

    /**
     * Delete the connet account.
     *
     * @return \Stripe\Account
     */
    public function delete()
    {
        return $this->owner->removeExternalAccount($this->externalAccount);
    }

    /**
     * Get the Stripe model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function owner()
    {
        return $this->owner;
    }

    /**
     * Get the Stripe ExternalAccount instance.
     *
     * @return \Stripe\Account
     */
    public function asStripeConnectAccount()
    {
        return $this->connectAccount;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->asStripeConnectAccount()->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Dynamically get values from the Stripe PaymentMethod.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->connectAccount->{$key};
    }
}
