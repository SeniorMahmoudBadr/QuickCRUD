<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Permission;
use Illuminate\Console\Command;

class RefreshPermissionSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:permission-seed';

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
        Permission::get()->each(function ($permission) {
            $name=\Str::before($permission->name, '-');
            $PageExists = Page::where('route',$name)->exists();
            if(!$PageExists){
                //delete
                $permission->delete();
            }
        });
    }
}
