# This is package decorator

## Installation

You can install the package via composer:

```bash
composer require bibesko/decorator
```

You can publish view components classes:

```bash
php artisan vendor:publish --tag="decorator-components"
```

## Usage

```php
use bibesko\Decorator\Models\Decorator;
Decorator::parse($page);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bibesko](https://github.com/Bibesko)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
