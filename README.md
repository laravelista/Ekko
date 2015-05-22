# Ekko

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_BardFloating.png)

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
