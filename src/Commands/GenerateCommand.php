<?php

namespace Sadegh19b\LaravelIranCities\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iran-cities:generate
                            {--models : Generate Province and City models}
                            {--migrations : Generate migrations for provinces and cities tables}
                            {--seeder : Generate Iran Provinces and Cities seeder}
                            {--all : Generate all files (models, migrations, and seeders)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Iran Provinces and Cities models, migrations, and seeders';

    private $modelNamespace = 'App\\Models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->makeModels();
            $this->makeMigrations();
            $this->makeSeeder();
            
            $this->info('All Province City files have been generated.');
            return;
        }

        if ($this->option('models')) {
            $this->makeModels();
        }

        if ($this->option('migrations')) {
            $this->makeMigrations();
        }

        if ($this->option('seeder')) {
            $this->makeSeeder();
        }

        if (!$this->option('models') && !$this->option('migrations') && !$this->option('seeder')) {
            $this->error('Please specify what to generate (--model, --migration, --seeder, or --all)');
        }
    }

    /**
     * Generate models from stubs.
     *
     * @return void
     */
    protected function makeModels(): void
    {
        $this->info('Generating Province and City models...');

        // Generate Province model
        $this->generateFromStub(
            $this->findStub('models/Province.stub'),
            app_path('Models/Province.php'),
            ['{{ namespace }}' => $this->modelNamespace]
        );
        
        // Generate City model
        $this->generateFromStub(
            $this->findStub('models/City.stub'),
            app_path('Models/City.php'),
            ['{{ namespace }}' => $this->modelNamespace]
        );

        $this->info('Models generated successfully.');
    }

    /**
     * Generate migrations from stubs.
     *
     * @return void
     */
    protected function makeMigrations(): void
    {
        $this->info('Generating migrations...');
        
        // Generate provinces migration
        $provincesTimestamp = date('Y_m_d_His');
        $this->generateFromStub(
            $this->findStub('migrations/create_provinces_table.stub'),
            database_path("migrations/{$provincesTimestamp}_create_provinces_table.php"),
            ['{{ model_namespace }}' => $this->modelNamespace]
        );
        
        // Generate cities migration with a timestamp 1 second later
        sleep(1);
        $citiesTimestamp = date('Y_m_d_His');
        $this->generateFromStub(
            $this->findStub('migrations/create_cities_table.stub'),
            database_path("migrations/{$citiesTimestamp}_create_cities_table.php"),
            ['{{ model_namespace }}' => $this->modelNamespace]
        );

        $this->info('Migrations generated successfully.');
    }

    /**
     * Generate seeder from stub.
     *
     * @return void
     */
    protected function makeSeeder(): void
    {
        $this->info('Generating IranProvincesAndCitiesSeeder...');

        $this->generateFromStub(
            $this->findStub('seeders/IranProvincesAndCitiesSeeder.stub'),
            database_path('seeders/IranProvincesAndCitiesSeeder.php'),
            [
                '{{ model_namespace }}' => $this->modelNamespace
            ]
        );

        $this->info('Seeder generated successfully.');
    }

    /**
     * Find the stub file path.
     *
     * @param string $stubName
     * @return string
     */
    protected function findStub(string $stubName): string
    {
        $customPath = base_path("stubs/vendor/sadegh19b/laravel-iran-cities/src/stubs/{$stubName}");
        
        if (File::exists($customPath)) {
            return $customPath;
        }
        
        return __DIR__ . "/../stubs/{$stubName}";
    }

    /**
     * Generate a file from a stub.
     *
     * @param string $stubPath
     * @param string $targetPath
     * @param array $replacements
     * @return void
     */
    protected function generateFromStub(string $stubPath, string $targetPath, array $replacements): void
    {
        $content = File::get($stubPath);
        
        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }
        
        File::put($targetPath, $content);
        
        $this->line("Created: " . $targetPath);
    }
} 