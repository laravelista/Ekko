# Ekko

Ekko is a Laravel helper package. It helps you mark currently active menu item in your navbar.

[![Become a Patron](https://img.shields.io/badge/Becoma%20a-Patron-f96854.svg?style=for-the-badge)](https://www.patreon.com/shockmario)

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

There are two ways of using Ekko in your application, by using a facade `Ekko::isActiveURL('/about')` or by using a helper function `isActiveURL('/about')` or `is_active_route('/about')`.

### isActiveRoute, is_active_route

Compares given route name with current route name.

```php
isActiveRoute($routeName, $output = "active")
```

```php
is_active_route($routeName, $output = "active")
```

**Examples:**

If the current route is `home`, function `isActiveRoute('home')` would return *string* `active`.

_The `*` wildcard can be used for resource routes._

Function `isActiveRoute('user.*')` would return *string* `active` for any current route which begins with `user`.

### isActiveURL, is_active_url

Compares given URL path with current URL path.

```php
isActiveURL($url, $output = "active")
```

```php
is_active_url($url, $output = "active")
```

**Examples:**

If the current URL path is `/about`, function `isActiveURL('/about')` would return *string* `active`.

### isActiveMatch, is_active_match

Detects if the given string is found in the current URL.

```php
isActiveMatch($string, $output = "active")
```

```php
is_active_match($string, $output = "active")
```

**Examples:**

If the current URL path is `/about` or `/insideout`, function `isActiveMatch('out')` would return *string* `active`.

### are_active_match

Detects if the given strings in array are found in the current URL

```php
are_active_match($matches, $output = "active")
```

### areActiveRoutes, are_active_routes

Compares given array of route names with current route name.

```php
areActiveRoutes(array $routeNames, $output = "active")
```

```php
are_active_routes(array $routeNames, $output = "active")
```

**Examples:**

If the current route is `product.index` or `product.show`, function `areActiveRoutes(['product.index', 'product.show'])` would return *string* `active`.

_The `*` wildcard can be used for resource routes, including nested routes._

Function `areActiveRoutes(['user.*', 'product.*'])` would return *string* `active` for any current route which begins with `user` or `product`.

### areActiveURLs, are_active_urls

Compares given array of URL paths with current URL path.

```php
areActiveURLs(array $urls, $output = "active")
```

```php
are_active_urls(array $urls, $output = "active")
```

**Examples:**

If the current URL path is `/product` or `/product/create`, function `areActiveURLs(['/product', '/product/create'])` would return *string* `active`.

## Credits

Many thanks to:

- [@Jono20201](https://github.com/Jono20201) for implementing helper functions
- [@judgej](https://github.com/judgej) for implementing route wildcards
