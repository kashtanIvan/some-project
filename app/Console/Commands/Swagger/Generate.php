<?php

namespace App\Console\Commands\Swagger;

use Illuminate\Console\Command;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Swagger Docs and put them in /public';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $swagger = \Swagger\scan(app_path());
        $swagger->saveAs(public_path('swagger.json'));
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
