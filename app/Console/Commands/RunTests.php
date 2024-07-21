<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class RunTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:tests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for running unit test and fix code style';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Inform the user that code style fixing is starting
            $this->info('Fixing code style...');
            // Execute the code style fixer
            exec('./vendor/bin/pint', $outputOptimize, $returnVarOptimize);
            // Output the result of the code style fixing
            $this->output->writeln(implode("\n", $outputOptimize));

            // Inform the user that cache clearing and optimization are starting
            $this->info("\nClearing cache and optimizing...");
            // Clear and optimize the application cache
            exec('php artisan optimize:clear', $outputOptimize, $returnVarOptimize);
            // Output the result of cache clearing and optimization
            $this->output->writeln(implode("\n", $outputOptimize));

            // Clear the configuration cache
            exec('php artisan config:clear', $outputConfigClear, $returnVarConfigClear);
            // Output the result of clearing the configuration cache
            $this->output->writeln(implode("\n", $outputConfigClear));

            // Clear the route cache
            exec('php artisan route:clear', $outputRouteClear, $returnVarRouteClear);
            // Output the result of clearing the route cache
            $this->output->writeln(implode("\n", $outputRouteClear));

            // Clear the view cache
            exec('php artisan view:clear', $outputViewClear, $returnVarViewClear);
            // Output the result of clearing the view cache
            $this->output->writeln(implode("\n", $outputViewClear));

            // Clear the application cache
            exec('php artisan cache:clear', $outputCacheClear, $returnVarCacheClear);
            // Output the result of clearing the application cache
            $this->output->writeln(implode("\n", $outputCacheClear));

            // Inform the user that the database is being refreshed for testing
            $this->info("\n\nRefreshing database for testing environment...");
            // Refresh the database for the testing environment
            exec('php artisan migrate:fresh --env=testing', $outputMigrate, $returnVarMigrate);
            // Output the result of refreshing the database
            $this->output->write(implode("\n", $outputMigrate));

            // Check if the database migration was successful
            if ($returnVarMigrate !== 0) {
                throw new Exception('Failed to run migrations.');
            }

            // Inform the user that the seeder is being run
            $this->info("\n\nRun Seeder...");
            // Run the database seeder for the testing environment
            exec('php artisan db:seed --env=testing', $outputSeed, $returnVarSeed);
            // Output the result of running the seeder
            $this->output->write(implode("\n", $outputSeed));
            // Inform the user that the seeder was added successfully
            $this->info("\n\nSeeder Successfully Added...");

            // Check if the database seeding was successful
            if ($returnVarSeed !== 0) {
                throw new Exception('Failed to run seeders.');
            }

            // Inform the user that unit tests are being run
            $this->info("\n\nRunning unit tests...");
            // Run the unit tests in the testing environment
            exec('php artisan test --stop-on-failure --stop-on-risky --env=testing', $outputTests, $returnVarTests);
            // Output the result of running the unit tests
            $this->output->write(implode("\n", $outputTests));

            // Check if the unit tests were successful
            if ($returnVarTests !== 0) {
                throw new Exception('Tests failed.');
            }

            // Inform the user that all tasks were completed successfully
            $this->info('All tasks completed successfully.');

            return 0;
        } catch (Exception $e) {
            // Output the error message if an exception occurs
            $this->error($e->getMessage());

            return 1;
        }
    }
}
