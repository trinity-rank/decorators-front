# This is package decorator

## Installation

You can install the package via composer:

```bash
composer require trinity-rank/decorators-front
```

You can publish view components classes:

```bash
php artisan vendor:publish --tag="decorator-components"
```

## Usage

```php
use Trinityrank\DecoratorsFront\Models\Decorator;
Decorator::parse($page);
```
## App must include

```php
use App\Articles\Types\Blog;
use App\Categories\Types\MoneyPageCategory;
use App\Categories\Types\ReviewPageCategory;
use App\Models\Operater;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use TOC\MarkupFixer;
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
