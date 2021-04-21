<?php

namespace ConnorFord2\StripeConnect;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stripe\BankAccount;
use Stripe\Card;
use JsonSerializable;

class ExternalAccount implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * The Stripe model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $owner;

    /**
     * The Stripe PaymentMethod instance.
     *
     * @var \Stripe\ExternalAccount
     */
    protected $externalAccount;

    /**
     * Create a new ExternalAccount instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @param  \Stripe\BankAccount|\Stripe\Card  $externalAccount
     * @return void
     *
     * @throws \ConnorFord2\StripeConnect\Exceptions\InvalidExternalAccount
     */
    public function __construct($owner, $externalAccount)
    {
        $this->owner = $owner;
        $this->externalAccount = $externalAccount;
    }

    /**
     * Delete the external account.
     *
     * @return \Stripe\BankAccount | \Stripe\Card
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
     * @return \Stripe\BankAccount | \Stripe\Card
     */
    public function asStripeExternalAccount()
    {
        return $this->externalAccount;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->asStripeExternalAccount()->toArray();
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
        return $this->externalAccount->{$key};
    }
}
