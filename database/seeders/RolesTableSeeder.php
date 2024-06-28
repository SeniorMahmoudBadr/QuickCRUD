<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('roles')->delete();

        DB::table('roles')->insert([[
            'id' => 1,
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'created_at' => '2023-03-14 16:27:58',
            'updated_at' => '2023-03-17 22:47:25',
        ]]);


    }
}
