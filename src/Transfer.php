<?php

namespace ConnorFord2\StripeConnect;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stripe\Transfer as StripeTransfer;
use JsonSerializable;

class Transfer implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * The Stripe model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $owner;

    /**
     * The Stripe Transfer instance.
     *
     * @var \Stripe\Transfer
     */
    protected $transfer;

    /**
     * Create a new Transfer instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner
     * @param  \Stripe\Transfer $transfer
     * @return void
     *
     */
    public function __construct($owner, \Stripe\Transfer $transfer)
    {
        $this->owner = $owner;
        $this->transfer = $transfer;
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
     * @return \Stripe\Transfer
     */
    public function asStripeTransfer()
    {
        return $this->transfer;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->asStripeTransfer()->toArray();
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
        return $this->transfer->{$key};
    }
}
