<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {


        DB::table('pages')->delete();

        DB::table('pages')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name_en' => 'Routes',
                'name_ar' => 'Routes',
                'route' => 'Permission',
                'controller' => 'Permission',
                'blade' => 'Permission',
                'javascript' => 'Permission',
                'parent_id' => 0,
                'position' => 'left',
                'display' => 'hide',
                'role_id' => NULL,
                'related_page' => NULL,
                'role_editable' => 1,
                'sort' => 0,
                'created_at' => '2023-03-16 22:19:09',
                'updated_at' => '2023-03-20 08:59:46',
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Pages',
                'name_ar' => 'Pages',
                'route' => 'Page',
                'controller' => 'Page',
                'blade' => 'Page',
                'javascript' => 'Page',
                'parent_id' => 0,
                'position' => 'left',
                'display' => 'show',
                'role_id' => NULL,
                'related_page' => NULL,
                'role_editable' => 0,
                'sort' => 5,
                'created_at' => '2023-03-14 15:40:23',
                'updated_at' => '2023-12-15 02:48:29',
            ),
            3 =>
            array (
                'id' => 3,
                'name_en' => 'Roles',
                'name_ar' => 'الوظائف والصلاحيات',
                'route' => 'Role',
                'controller' => 'Role',
                'blade' => 'Role',
                'javascript' => 'Role',
                'parent_id' => 0,
                'position' => 'left',
                'display' => 'show',
                'role_id' => NULL,
                'related_page' => NULL,
                'role_editable' => 1,
                'sort' => 15,
                'created_at' => '2023-03-14 13:44:30',
                'updated_at' => '2023-12-18 04:23:37',
            ),
            4 =>
            array (
                'id' => 4,
                'name_en' => 'Super Admins',
                'name_ar' => 'مشرفين النظام',
                'route' => 'Admin',
                'controller' => 'Admin',
                'blade' => 'Admin',
                'javascript' => 'Admin',
                'parent_id' => 0,
                'position' => 'left',
                'display' => 'show',
                'role_id' => 1,
                'related_page' => NULL,
                'role_editable' => 1,
                'sort' => 20,
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2024-06-13 10:52:02',
            )
        ));


    }
}
