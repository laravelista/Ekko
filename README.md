# Ekko

[![Latest Stable Version](https://poser.pugx.org/laravelista/ekko/v/stable)](https://packagist.org/packages/laravelista/ekko) [![Total Downloads](https://poser.pugx.org/laravelista/ekko/downloads)](https://packagist.org/packages/laravelista/ekko) [![Latest Unstable Version](https://poser.pugx.org/laravelista/ekko/v/unstable)](https://packagist.org/packages/laravelista/ekko) [![License](https://poser.pugx.org/laravelista/ekko/license)](https://packagist.org/packages/laravelista/ekko)

![Ekko](./ekko.jpg)

Laravel helper that detects active navigation menu items and applies bootstrap classes.

> I reuse this code across many projects so I wanted a central place for it.

*I will add the API very soon.*

## Installation

First, pull in the package through Composer.

```js
"require": {
    "laravelista/ekko": "~1.0"
}
```

And then, if using Laravel 5 or 4, include the service provider within `app/config/app.php`.

```php
'providers' => [
    'Laravelista\Ekko\EkkoServiceProvider'
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Ekko' => 'Laravelista\Ekko\Facades\Ekko'
];
```
