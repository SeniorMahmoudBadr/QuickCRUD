<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelatedPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {


        DB::table('related_pages')->delete();

        DB::table('related_pages')->insert(array (
            0 =>
            array (
                'parent_id' => 2,
                'child_id' => 1,
                'type' => 'route',
                'btn_color' => 'primary',
                'into_btn_action' => 0,
                'created_at' => '2023-12-15 02:48:29',
                'updated_at' => '2023-12-15 02:48:29',
            )
        ));


    }
}
