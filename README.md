# Ekko

Framework agnostic PHP package for marking navigation items active.

[![Become a Patron](https://img.shields.io/badge/Become%20a-Patron-f96854.svg?style=for-the-badge)](https://www.patreon.com/laravelista)

## New features in v3

- Framework agnostic
- Can be modified for any custom application
- Currently supported frameworks: Laravel (PRs are welcome!)
- Global helper functions disabled by default
- Supports default output value
- Backward compatible with v1 & v2
- Fully tested using table driven testing (data providers in PHPUnit)

## Installation

From the command line:

```bash
composer require laravelista/ekko
```

By default Ekko is initialized with these sensible defaults:

- the default output value is `active`.
- it uses GenericUrlProvider (`$_SERVER['REQUEST_URI']`).
- global helper functions are disabled.

### Laravel

The only dependency for this package is PHP 7.2+, meaning that you can possibly install it on any Laravel version that supports PHP 7.2. The service provider is always going to follow the latest Laravel release and try to be as backward compatible as possible.

Laravel 5.5+ will use the auto-discovery function to register the ServiceProvider and the Facade.

If using 5.4 (or if you are not using auto-discovery) you will need to include the service provider and facade in `config/app.php`:

'providers' => [
    ...,
    Laravelista\Ekko\Frameworks\Laravel\ServiceProvider::class
];

And add a facade alias to the same file at the bottom:

'aliases' => [
    ...,
    'Ekko' => Laravelista\Ekko\Frameworks\Laravel\Facade::class
];

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

With Ekko your code could look like this:

```html
<ul class="nav navbar-nav">
    <li class="{{ is_active('/') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

or like this:

```html
<ul class="nav navbar-nav">
    <li class="{{ Ekko::isActiveRoute('home') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

or this:

```html
<ul class="nav navbar-nav">
    <li class="{{ $ekko->isActive('/') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

### Default output value

What if you are not using Bootstrap, but some other framework or a custom design? Instead of returning `active` CSS class, you can make Ekko return anything you want.

```html
<ul class="nav navbar-nav">
    <li class="{{ isActive('/', 'highlight') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

You can alse set the **default output value** if you don't want to type it everytime:

```php
$ekko = new Ekko;
$ekko->setDefaultValue('highlight');
return $ekko->isActive('/');
```

or in Laravel you can set the default output value in the config `config/ekko.php` file:

```php
<?php

return [
    'default_output' => 'highlight'
];
```

To publish the config for Ekko use this in Laravel:

```
php artisan vendor:publish --provider="Laravelista\Ekko\Frameworks\Laravel\ServiceProvider"
```

Using boolean `true` or `false` is convenient if you need to display some content depending on which page you are in your layout view:

```html
@if(is_active('/about', true))
    <p>Something that is only visible on the `about` page.</p>
@endif
```

### Global helper functions

**Global helper functions** as displayed above are disabled by default. To enable them use `Ekko::enableGlobalHelpers();` or `$ekko->enableGlobalHelpers()`.

In Laravel you can set `global_helpers` value to `true` in the config `config/ekko.php` file.

## Usage

When used outside a framework, this package has only one main method of interest called `isActive`. The function accepts an `input` which can be a string or an array of strings, and an `output` which can be anything. The default output is `active`.

```
<li class="{{ $ekko->isActive('/') }}"><a href="/">Home</a></li>
<li class="{{ $ekko->isActive(['/', '/home]) }}"><a href="/">Home</a></li>
<li class="{{ $ekko->isActive(['/', '/home, '*home*']) }}"><a href="/">Home</a></li>
<li class="{{ $ekko->isActive('/home*') }}"><a href="/">Home</a></li>
<li class="{{ $ekko->isActive('/home*feature=slideshow*') }}"><a href="/">Home</a></li>
<li class="{{ $ekko->isActive('/index.php?page=*') }}"><a href="/">Home</a></li>
```

It supports strings, arrays, wildcards and query parameters.

### Laravel usage

Use the facade `Ekko::`, `resolve(Ekko::class)` or `app(Ekko::class)` to obtain the Laravel bootstraped instance.

Laravel comes with few special methods for named routes and other helper methods. Also, there is a lot of backward compatibility here for v1 of this package.

#### Methods

`Ekko::isActive($input, $output = null)`
This calls the main Ekko method isActive. Described above.

`Ekko::isActiveRoute($input, $output = null)`
For named routes. Supports arrays and wildcards.

`Ekko::areActiveRoutes(array $input, $output = null)`
For arrays of named routes. Supports wildcards.
**Backward compatibility.** Use `isActiveRoute` and pass it the same array.

`Ekko::isActiveURL($input, $output = null)`
The same as `Ekko::isActive`.
**Backward compatibility.** Use `isActive` and pass it the same array.

`Ekko::areActiveURLs(array $input, $output = null)`
The same as `Ekko::isActiveURL`, but accepts only the array of Urls.
**Backward compatibility.** Use `isActive` and pass it the same array.

`Ekko::isActiveMatch($input, $output = null)`
The same as `Ekko::isActive`. This method encloses the input with wildcard `*`. Supports string, array and wildcards as input.
**Backward compatibility.** Use `isActive` and pass it the same input, but with wildcard `*` at the desired place.

`Ekko::areActiveMatches(array $input, $output = null)`
The same as `Ekko::isActiveMatch`, but accepts only the array of strings.
**Backward compatibility.** Use `isActive` and pass it the same array.

## Credits

Many thanks to:

- [@judgej](https://github.com/judgej) for route wildcards.
- [@Jono20201](https://github.com/Jono20201) for helper functions.
- [@JasonMillward](https://github.com/JasonMillward) for improving wildcards in nested route names.
- [@it-can](https://github.com/it-can) for Laravel 5.5+ auto-discovery.
- [@foo99](https://github.com/foo99) for snake_case function names.
- [@Turboveja](https://github.com/Turboveja) for are_active_matches function.