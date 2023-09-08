# Simple plugin to toggle maintenance mode from Filament Panels.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brickx/maintenance-switch.svg?style=flat-square)](https://packagist.org/packages/brickx/maintenance-switch)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/brickx/maintenance-switch/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/brickx/maintenance-switch/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/brickx/maintenance-switch/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/brickx/maintenance-switch/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/brickx/maintenance-switch.svg?style=flat-square)](https://packagist.org/packages/brickx/maintenance-switch)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require brickx/maintenance-switch
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="maintenance-switch-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="maintenance-switch-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="maintenance-switch-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$maintenanceSwitch = new Brickx\MaintenanceSwitch();
echo $maintenanceSwitch->echoPhrase('Hello, Brickx!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Keysaw](https://github.com/Keysaw)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
