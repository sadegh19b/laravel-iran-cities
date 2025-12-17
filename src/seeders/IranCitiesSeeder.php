<?php

namespace Sadegh19b\LaravelIranCities\Seeders;

use Sadegh19b\LaravelIranCities\Models\Province;
use Sadegh19b\LaravelIranCities\Models\County;
use Sadegh19b\LaravelIranCities\Models\City;
use Illuminate\Database\Seeder;

class IranCitiesSeeder extends Seeder
{
    public function run(): void
    {
        $provincesPath = __DIR__ . '/../resources/provinces.json';
        $countiesPath = __DIR__ . '/../resources/counties.json';
        $citiesPath = __DIR__ . '/../resources/cities.json';

        $provinces = json_decode(file_get_contents($provincesPath), true);
        $counties = json_decode(file_get_contents($countiesPath), true);
        $cities = json_decode(file_get_contents($citiesPath), true);

        usort($provinces, fn($a, $b) => strcmp($a['name'], $b['name']));
        usort($counties, fn($a, $b) => strcmp($a['name'], $b['name']));
        usort($cities, fn($a, $b) => strcmp($a['name'], $b['name']));

        $cities = array_filter($cities, fn($c) => !preg_match('/\d/', $c['name']));

        foreach ($provinces as $provinceData) {
            $province = Province::firstOrCreate(
                ['name' => $provinceData['name']],
                ['tel_prefix' => $provinceData['tel_prefix']]
            );

            $provinceCounties = array_filter($counties, fn($c): bool => $c['province_id'] === $provinceData['id']);

            foreach ($provinceCounties as $countyData) {
                $county = County::firstOrCreate(
                    ['province_id' => $province->id, 'name' => $countyData['name']]
                );

                $countyCities = array_filter($cities, fn($c): bool => $c['county_id'] === $countyData['id']);

                foreach ($countyCities as $cityData) {
                    City::firstOrCreate(
                        ['county_id' => $county->id, 'name' => $cityData['name']],
                        ['province_id' => $province->id]
                    );
                }
            }
        }
    }
}
