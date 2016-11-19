# Ekko

[![Latest Stable Version](https://poser.pugx.org/laravelista/ekko/v/stable)](https://packagist.org/packages/laravelista/ekko) [![Total Downloads](https://poser.pugx.org/laravelista/ekko/downloads)](https://packagist.org/packages/laravelista/ekko) [![License](https://poser.pugx.org/laravelista/ekko/license)](https://packagist.org/packages/laravelista/ekko)
[![Build Status](https://travis-ci.org/laravelista/Ekko.svg?branch=master)](https://travis-ci.org/laravelista/Ekko)

Laravel package for marking navigation menu items active.

![Ekko](ekko.jpg)

## Sample Usage

There are two ways of using this package in your application, by using a facade `Ekko::isActiveURL('/about')` or using a helper function `isActiveURL('/about')`.

Most of the time you will use this package in your navigation partial like so:

```html
<ul>
<li>
    <a class="{{ isActiveRoute('home') }}" href="{{ route('home') }}">
        Home
    </a>
</li>
<li>
    <a class="{{ isActiveURL('/about') }}" href="{{ url('/about') }}">
        About
    </a>
</li>
<li>
    <a class="{{ isActiveRoute('destinations.*') }}" href="{{ route('destinations.index') }}">
        Destinations
    </a>
</li>
<li>
    <a href="#" class="{{ areActiveRoutes(['terms', 'privacy']) }}">
        Info
    </a>
    <ul>
        <li>
            <a href="{{ route('terms') }}">Terms and Conditions</a>
        </li>
        <li>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
        </li>
    </ul>
</li>
</ul>
```

## Installation

From the command line:

```bash
composer require laravelista/ekko
```

### Laravel 5.* specifics

Include the service provider in `config/app.php`:

```php
'providers' => [
    ...,
    Laravelista\Ekko\EkkoServiceProvider::class
];
```

And add a facade alias to this same file at the bottom:

```php
'aliases' => [
    ...,
    'Ekko' => Laravelista\Ekko\Facades\Ekko::class
];
```

### Laravel 4.* specifics

Include the service provider in `app/config/app.php`:

```php
'providers' => [
    ...,
    Laravelista\Ekko\EkkoServiceProvider::class
];
```

And add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'Ekko' => Laravelista\Ekko\Facades\Ekko::class
];
```

## API

As the second parameter to any method, you can pass the value you want to get returned if there was a match. *By default this is `active` which is Bootstrap default, but you can replace it with `true` or `false` depending on your needs.*

#### `isActiveRoute($routeName, $output = "active")`

Compares given route name with current route name.

```php
{{ Ekko::isActiveRoute('home') }}
```

The `*` wildcard can be used for resource routes.

```php
{{ Ekko::isActiveRoute('user.*') }}
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

The `*` wildcard can be used for resource routes, including nested routes.

```php
{{ Ekko::areActiveRoutes(['user.*', 'user.comments.*']) }}
```

#### `areActiveURLs(array $urls, $output = "active")`

Compares given array of URLs with current URL.

```php
{{ Ekko::areActiveURLs(['/product', '/product/create']) }}
```

## Helpers

Helper functions are available for all methods. Example:

```php
{{ isActiveRoute('user.*') }}
```
