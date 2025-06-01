# Iran Provinces and Cities for Laravel

A Laravel package for Iran provinces and cities seeder and models.

_Supports Laravel 8 to 12._

## Installation

You can install the package via composer:

```bash
composer require sadegh19b/laravel-iran-cities
```

## Quick Start

1. Generate models, migrations, and seeder:
```bash
php artisan iran-cities:generate --all
```

2. Run migrations:
```bash
php artisan migrate
```

3. Run the seeder:
```bash
php artisan db:seed --class="Database\Seeders\IranProvincesAndCitiesSeeder"
```

4. Use the models:
```php
use App\Models\Province;
use App\Models\City;

// Get all provinces
$provinces = Province::all();

// Get cities of a province
$province = Province::find(1);
$cities = $province->cities;
```

## Generate Stubs

### Generate All

To generate models, migrations, and seeder:

```bash
php artisan iran-cities:generate --all
```

### Generate Specific

You can also generate specific files:

```bash
php artisan iran-cities:generate --models
php artisan iran-cities:generate --migrations
php artisan iran-cities:generate --seeder
```

## Usage

### Get All Provinces or Cities

```php
use App\Models\Province;

$provinces = Province::all();
$cities = City::all();
```

### Get Cities of a Province

```php
use App\Models\Province;

$province = Province::find(1);
$cities = $province->cities;
```

### Get Province of a City

```php
use App\Models\City;

$city = City::find(1);
$province = $city->province;
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
