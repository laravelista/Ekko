# Ekko

Framework agnostic PHP package for marking navigation items active.

[![Become a Patron](https://img.shields.io/badge/Become%20a-Patron-f96854.svg?style=for-the-badge)](https://www.patreon.com/laravelista)

## Installation

From the command line:

```bash
composer require laravelista/ekko
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

What if you are not using Bootstrap, but some other framework or a custom design? Instead of returning `active` CSS class, you can make Ekko return anything you want.

```html
<ul class="nav navbar-nav">
    <li class="{{ isActive('/', 'highlight') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

You can alse set the default output value if you don't want to type it everytime:

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

Using boolean `true` or `false` is convenient if you need to display some content depending on which page you are in your layout view:

```html
@if(is_active('/about', true))
    <p>Something that is only visible on the `about` page.</p>
@endif
```

Global helper functions as displayed above are disabled by default. To enable them use:

```php
Ekko::enableGlobalHelpers();
```

In Laravel you can add the above line of code to the `boot` method of your `AppServiceProvider` class.

## Usage

This package consists of only one function `is_active`. The function accepts an `input` which can be a string or an array of strings, and an `output` which can be anything. The default output is `active`.

### Static URLs

You will use this for your static (non changing) pages.

```
<li class="{{ is_active('/') }}"><a href="/">Home</a></li>
<li class="{{ is_active('/about') }}"><a href="/">About</a></li>
<li class="{{ is_active('/contact') }}"><a href="/">Contact</a></li>
```

### Dynamic URLs

Most useful when dealing with resources that contain either slugs or IDs. Useful for blogs, portfolio, model CRUD...

```
<li class="{{ is_active('/user/*') }}"><a href="/">User Management</a></li>
<li class="{{ is_active('/portfolio/*') }}"><a href="/">Project</a></li>
<li class="{{ is_active('/user/*/edit') }}"><a href="/">Edit User X</a></li>
```

### Array

You can combine "Static" and "Dynamic" in an array.

```
<li class="{{ is_active(['/home', '/']) }}"><a href="/">Home</a></li>
<li class="{{ is_active(['/blog/*', '/a-super-cool-post-slug']) }}"><a href="/">Blog</a></li>
```

## Credits

Many thanks to:

- [@judgej](https://github.com/judgej) for route wildcards.
- [@Jono20201](https://github.com/Jono20201) for helper functions.
- [@JasonMillward](https://github.com/JasonMillward) for improving wildcards in nested route names.
- [@it-can](https://github.com/it-can) for Laravel 5.5+ auto-discovery.
- [@foo99](https://github.com/foo99) for snake_case function names.
- [@Turboveja](https://github.com/Turboveja) for are_active_matches function.