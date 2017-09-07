# Ekko

[![Latest Stable Version](https://poser.pugx.org/laravelista/ekko/v/stable)](https://packagist.org/packages/laravelista/ekko)
[![Total Downloads](https://poser.pugx.org/laravelista/ekko/downloads)](https://packagist.org/packages/laravelista/ekko)
[![License](https://poser.pugx.org/laravelista/ekko/license)](https://packagist.org/packages/laravelista/ekko)
[![Build Status](https://travis-ci.org/laravelista/Ekko.svg?branch=master)](https://travis-ci.org/laravelista/Ekko)

[![forthebadge](http://forthebadge.com/images/badges/gluten-free.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/makes-people-smile.svg)](http://forthebadge.com)

Ekko is a Laravel helper package. It helps you mark currently active menu item in your navbar.

## Installation

From the command line:

```bash
composer require laravelista/ekko
```

Laravel 5.5+ will use the auto-discovery function.

If using 5.4 (or if you are not using auto-discovery) you will need to include the service providers / facade in `config/app.php`:

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

## Overview

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

```html
@if(isActiveRoute('home', true))
    <p>Something that is only visible on the `home` route.</p>
@endif
```

## API

There are two ways of using Ekko in your application, by using a facade `Ekko::isActiveURL('/about')` or by using a helper function `isActiveURL('/about')`.

### isActiveRoute

Compares given route name with current route name.

```php
isActiveRoute($routeName, $output = "active")
```

**Examples:**

If the current route is `home`, function `isActiveRoute('home')` would return *string* `active`.

_The `*` wildcard can be used for resource routes._

Function `isActiveRoute('user.*')` would return *string* `active` for any current route which begins with `user`.

### isActiveURL

Compares given URL path with current URL path.

```php
isActiveURL($url, $output = "active")
```

**Examples:**

If the current URL path is `/about`, function `isActiveURL('/about')` would return *string* `active`.

### isActiveMatch

Detects if the given string is found in the current URL.

```php
isActiveMatch($string, $output = "active")
```

**Examples:**

If the current URL path is `/about` or `/insideout`, function `isActiveMatch('out')` would return *string* `active`.

### areActiveRoutes

Compares given array of route names with current route name.

```php
areActiveRoutes(array $routeNames, $output = "active")
```

**Examples:**

If the current route is `product.index` or `product.show`, function `areActiveRoutes(['product.index', 'product.show'])` would return *string* `active`.

_The `*` wildcard can be used for resource routes, including nested routes._

Function `areActiveRoutes(['user.*', 'product.*'])` would return *string* `active` for any current route which begins with `user` or `product`.

### areActiveURLs

Compares given array of URL paths with current URL path.

```php
areActiveURLs(array $urls, $output = "active")
```

**Examples:**

If the current URL path is `/product` or `/product/create`, function `areActiveURLs(['/product', '/product/create'])` would return *string* `active`.

## Credits

Many thanks to:

- [@Jono20201](https://github.com/Jono20201) for implementing helper functions
- [@judgej](https://github.com/judgej) for implementing route wildcards
