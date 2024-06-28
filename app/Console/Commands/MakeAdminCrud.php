<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MakeAdminCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:adminCrud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make CRUD Files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $examplesPath = resource_path().'/examples/';

        // Create Controller
        $path = app_path().'/Http/Controllers/Backend/';
        $data = file_get_contents($examplesPath.'__Controller__.example');
        $data = str_replace('___Name___', $name, $data);
        file_put_contents($path.$name.'Controller.php', $data);

        // Create Resource
        $path = app_path().'/Http/Resources/';
        $data = file_get_contents($examplesPath.'__Resource__.example');
        $data = str_replace('___Name___', $name, $data);
        file_put_contents($path.$name.'Resource.php', $data);

        // Create JS
        $path = public_path().'/Backend/';
        $data = file_get_contents($examplesPath.'__JS__.example');
        $data = str_replace('___Name___', $name, $data);
        file_put_contents($path.$name.'.js', $data);

        // Create View
        $path = resource_path().'/views/backend/';
        $data = file_get_contents($examplesPath.'__Blade__.example');
        $data = str_replace('___Name___', $name, $data);
        file_put_contents($path.$name.'.blade.php', $data);

        // Make model and migration
        Artisan::call('make:model', [ 'name' => $name, '-m' => true ]);
        $path = app_path().'/Models/';
        $data = file_get_contents($examplesPath.'__Model__.example');
        $data = str_replace('___Name___', $name, $data);
        file_put_contents($path.$name.'.php', $data);

        // Make Request
        Artisan::call('make:request', [ 'name' => $name.'Request']);

        $this->info("Files Are Ready!");
    }
}
