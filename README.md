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

## Usage

You would most likely use this package in your `navbar` partial like so:

```php
<li>
    <a href="{{ route('home') }}" class="{{ Ekko::isActiveRoute('home') }}">
        <i class="halflings white home"></i> Home
    </a>
</li>

<li>
    <a href="#" class="{{ Ekko::areActiveRoutes(['murter', 'kornati']) }}">
        <i class="halflings white screenshot"></i> Location
    </a>
    <ul>
        <li>
            <a href="{{ route('murter') }}">Murter</a>
        </li>
        <li>
            <a href="{{ route('kornati') }}">Kornati</a>
        </li>
    </ul>
</li>

<li>
    <a href="{{ route('trips.index') }}" class="{{ Ekko::isActiveMatch('trips') }}">
        <i class="halflings white road"></i> Trips
    </a>
</li>
```

## API

As the second parameter to any method, you can pass the value you want to get returned if there was a match. *By default this is `active` which is Bootstrap default.*

#### `isActiveRoute($routeName, $output = "active")`

Compares given route name with current route name.

```php
{{ Ekko::isActiveRoute('home') }}
```

#### `isActiveURL($url, $output = "active")`

Compares given URL with current URL.

```php
{{ Ekko::isActiveURL('/about') }}
```

#### `isActiveMatch($string, $output = "active")`

Detects if the given string is found in the current URL.

```php
{{ Ekko::isActiveMatch('bout') }}
```

#### `areActiveRoutes(array $routeNames, $output = "active")`

Compares given array of route names with current route name.

```php
{{ Ekko::areActiveRoutes(['product.index', 'product.show']) }}
```

#### `areActiveURLs(array $urls, $output = "active")`

Compares given array of URLs with current URL.

```php
{{ Ekko::areActiveURLs(['/product', '/product/create']) }}
```
