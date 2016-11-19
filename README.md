# Ekko

[![Latest Stable Version](https://poser.pugx.org/laravelista/ekko/v/stable)](https://packagist.org/packages/laravelista/ekko) [![Total Downloads](https://poser.pugx.org/laravelista/ekko/downloads)](https://packagist.org/packages/laravelista/ekko) [![Build Status](https://travis-ci.org/laravelista/Ekko.svg?branch=master)](https://travis-ci.org/laravelista/Ekko)

Ekko is a Laravel helper package. It helps you mark currently active menu item in your navbar.

To mark a menu item active in [Bootstrap](http://getbootstrap.com/components/#navbar), you need to add a `active` CSS class to the `<li>` tag:

```html
<ul class="nav navbar-nav">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

You could do it manually with Laravel, but you will end up with a sausage:

```html
<ul class="nav navbar-nav">
    <li class="@if(URL::current() == URL::to('/')) active @endif"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

With Ekko your code will look like this:

```html
<ul class="nav navbar-nav">
    <li class="{{ isActiveURL('/') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

What if you are not using Bootstrap, but some other framework or a custom design? Instead of returning `active` CSS class, you can make Ekko return anything you want including boolean `true` or `false`:

```html
<ul class="nav navbar-nav">
    <li class="{{ isActiveURL('/', 'highlight') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

Using boolean `true` or `false` is convenient if you need to display some content depending on which page you are in your layout view:

```php
@if(isActiveRoute('home', true))
    <p>Something that is only visible on the `home` route.</p>
@endif
```

## Installation

From the command line:

```bash
composer require laravelista/ekko
```

Include the service provider in `config/app.php`:

```php
'providers' => [
    ...,
    Laravelista\Ekko\EkkoServiceProvider::class
];
```

And add a facade alias to the same file at the bottom:

```php
'aliases' => [
    ...,
    'Ekko' => Laravelista\Ekko\Facades\Ekko::class
];
```

## API

There are two ways of using Ekko in your application, by using a facade `Ekko::isActiveURL('/about')` or by using a helper function `isActiveURL('/about')`.

### `isActiveRoute($routeName, $output = "active")`

Compares given route name with current route name.

```php
{{ Ekko::isActiveRoute('home') }}
```

The `*` wildcard can be used for resource routes.

```php
{{ Ekko::isActiveRoute('user.*') }}
```

### `isActiveURL($url, $output = "active")`

Compares given URL with current URL.

```php
{{ Ekko::isActiveURL('/about') }}
```

### `isActiveMatch($string, $output = "active")`

Detects if the given string is found in the current URL.

```php
{{ Ekko::isActiveMatch('bout') }}
```

### `areActiveRoutes(array $routeNames, $output = "active")`

Compares given array of route names with current route name.

```php
{{ Ekko::areActiveRoutes(['product.index', 'product.show']) }}
```

The `*` wildcard can be used for resource routes, including nested routes.

```php
{{ Ekko::areActiveRoutes(['user.*', 'user.comments.*']) }}
```

### `areActiveURLs(array $urls, $output = "active")`

Compares given array of URLs with current URL.

```php
{{ Ekko::areActiveURLs(['/product', '/product/create']) }}
```

## Credits

Many thanks to:

- [@Jono20201](https://github.com/Jono20201) for implementing helper functions
- [@judgej](https://github.com/judgej) for implementing route wildcards
