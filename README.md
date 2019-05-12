# Ekko

PHP function for marking navigation items active. The default output value is for [Bootstrap](http://getbootstrap.com), but it can be changed to anything.

[![Become a Patron](https://img.shields.io/badge/Becoma%20a-Patron-f96854.svg?style=for-the-badge)](https://www.patreon.com/laravelista)

> Starting with version `2.0.0`, there is no backward compatibility with the previous releases.

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

With Ekko your code will look like this:

```html
<ul class="nav navbar-nav">
    <li class="{{ is_active('/') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

What if you are not using Bootstrap, but some other framework or a custom design? Instead of returning `active` CSS class, you can make Ekko return anything you want including boolean `true` or `false`:

```html
<ul class="nav navbar-nav">
    <li class="{{ is_active('/', 'highlight') }}"><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
</ul>
```

Using boolean `true` or `false` is convenient if you need to display some content depending on which page you are in your layout view:

```html
@if(is_active('/about', true))
    <p>Something that is only visible on the `about` page.</p>
@endif
```

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
- [@Turboveja](https://github.com/Turboveja) for a PR that I did not merge. Sry.

I know that this new version includes very little of your contributions, but you will not be forgotten. Thank you.