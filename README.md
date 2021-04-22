#laravel-stripe-connect

[![Downloads](https://img.shields.io/packagist/dt/connorford2/laravel-stripe-connect)](https://packagist.org/packages/connorford2/laravel-stripe-connect)
[![Latest Version](https://img.shields.io/packagist/v/connorford2/laravel-stripe-connect)](https://packagist.org/packages/connorford2/laravel-stripe-connect)
[![License](https://img.shields.io/github/license/connorford2/laravel-stripe-connect)](https://github.com/connorford2/laravel-stripe-connect/blob/master/LICENSE.md)

Adding [Stripe Connect](https://github.com/stripe/stripe-php) support to [Laravel](https://laravel.com), inspired by [Laravel Cashier](https://laravel.com/docs/8.x/billing).

#⚠️ THIS LIBRARY IS STILL UNDER DEVELOPMENT. IT WORKS BUT ISN'T FULLY FLESHED OUT.

## Dependencies
* PHP >= 5.6.3
* Laravel >= 6.0
* Stripe >= 7.39

## Installation via Composer
To install run:
```
composer require connorford2/laravel-stripe-connect
```
or if you'd prefer, add this to your ```composer.json``` file:
```
{
    "require": {
        "connorford2/laravel-stripe-connect": "^0.1.0"
    }
}
```

## Configuration

### HasConnectAccount Trait
Add the ```HasConnectAccount``` trait to your model which has the connect account.
This is most likely ```\App\Models\User```.

```
use ConnorFord2\StripeConnect\HasConnectAccount;

class User extends Model
{
    use HasConnectAccount;
}

```


### API Keys
Set your Stripe secret (pk_xxxxxxxxxxxxxxxx) in ```config/services.php```. (Set it as an environment variable. You shouldn't commit the API Key directly to code.)
```
'stripe' => [
    'secret' => env('STRIPE_SECRET'),
],
```

## Basic Use


##Contributing
Contributions are welcome! Just create a pull request.

##License
laravel-stripe-connect is licensed under the [MIT License](https://github.com/connorford2/laravel-stripe-connect/blob/master/LICENSE.md). 