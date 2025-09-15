# Maintenance Mode

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/klxf/flarum-maintenance.svg)](https://packagist.org/packages/klxf/flarum-maintenance) [![Total Downloads](https://img.shields.io/packagist/dt/klxf/flarum-maintenance.svg)](https://packagist.org/packages/klxf/flarum-maintenance)

A [Flarum](https://flarum.org) extension. Highly customizable maintenance mode.

## Features

- Enable/disable maintenance mode.
- Customizable maintenance page with HTML support.
- Only administrators can access the forum when maintenance mode is enabled.

## Installation

Install with composer:

```sh
composer require klxf/flarum-maintenance:"*"
```

## Updating

```sh
composer update klxf/flarum-maintenance:"*"
php flarum migrate
php flarum cache:clear
```

## Placeholders

You can use the following placeholders in the maintenance page:

- `$forumStyle` - The forum's CSS styles.
- `$settings` - The forum's settings.
  - Example: `$settings->get('forum_title')` for the forum title.
- `$url` - Flarum URL Generator.
  - Example: `$url->to('forum')->base()` for the forum base URL.

## Links

- [Packagist](https://packagist.org/packages/klxf/flarum-maintenance)
- [GitHub](https://github.com/klxf/flarum-maintenance)