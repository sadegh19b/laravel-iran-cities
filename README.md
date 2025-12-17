# Iran Cities for Laravel

A Laravel package for Iran provinces, counties and cities seeder and models.

This package uses this [repo](https://github.com/sajaddp/list-of-cities-in-Iran) for list of cities (Thanks to [@sajaddp](https://github.com/sajaddp)).

_Supports Laravel 8 to 12._

## Installation

You can install the package via composer:

```bash
composer require sadegh19b/laravel-iran-cities
```

## Quick Start

1. Publish migrations (optional):
```bash
php artisan vendor:publish --tag=iran-cities-migrations
```

2. Run migrations:
```bash
php artisan migrate
```

3. Run the seeder:
```bash
php artisan db:seed --class="Sadegh19b\LaravelIranCities\Seeders\IranCitiesSeeder"
```

4. Use the models:
```php
use Sadegh19b\LaravelIranCities\Models\Province;
use Sadegh19b\LaravelIranCities\Models\County;
use Sadegh19b\LaravelIranCities\Models\City;

// Get all provinces
$provinces = Province::all();

// Get counties of a province
$province = Province::find(1);
$counties = $province->counties;

// Get cities of a province
$province = Province::find(1);
$cities = $province->cities;

// Get cities of a county
$county = County::find(1);
$cities = $county->cities;
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
