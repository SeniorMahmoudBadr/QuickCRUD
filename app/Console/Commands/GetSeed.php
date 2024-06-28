<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GetSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:get-seed';
    protected $signature = 'get:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call("db:seed --class=PagesTableSeeder");
        Artisan::call("db:seed --class=PermissionsTableSeeder");
        Artisan::call("db:seed --class=RelatedPagesTableSeeder");
        Artisan::call("cache:clear");

        $this->info("Ha Ha Ha done!");
    }
}
