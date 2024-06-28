<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {


        DB::table('permissions')->delete();

        DB::table('permissions')->insert(array (
            0 =>
            array (
                'name' => 'Role-list',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'index',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-14 12:43:46',
                'updated_at' => '2023-03-14 12:43:46',
            ),
            1 =>
            array (
                'name' => 'Role-create',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'store',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-14 12:43:46',
                'updated_at' => '2023-03-14 12:43:46',
            ),
            2 =>
            array (
                'name' => 'Role-edit',
                'guard_name' => 'web',
                'type' => 'put',
                'method' => 'update',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-14 12:43:46',
                'updated_at' => '2023-03-19 20:20:21',
            ),
            3 =>
            array (
                'name' => 'Role-delete',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'destroy',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-14 12:43:46',
                'updated_at' => '2023-03-19 20:20:34',
            ),
            4 =>
            array (
                'name' => 'Page-list',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'index',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-14 22:27:12',
                'updated_at' => '2023-03-16 22:33:08',
            ),
            5 =>
            array (
                'name' => 'Page-create',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'store',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-14 22:27:33',
                'updated_at' => '2023-03-16 22:33:35',
            ),
            6 =>
            array (
                'name' => 'Page-edit',
                'guard_name' => 'web',
                'type' => 'put',
                'method' => 'update',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-14 22:27:43',
                'updated_at' => '2023-03-16 22:33:15',
            ),
            7 =>
            array (
                'name' => 'Page-delete',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'destroy',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-14 22:27:49',
                'updated_at' => '2023-03-16 22:33:22',
            ),
            8 =>
            array (
                'name' => 'Permission-list',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'index',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-17 15:30:16',
                'updated_at' => '2023-03-17 15:30:16',
            ),
            9 =>
            array (
                'name' => 'Permission-create',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'store',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-17 15:30:16',
                'updated_at' => '2023-03-17 15:30:16',
            ),
            10 =>
            array (
                'name' => 'Permission-edit',
                'guard_name' => 'web',
                'type' => 'put',
                'method' => 'update',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-17 23:23:49',
                'updated_at' => '2023-03-17 23:23:49',
            ),
            11 =>
            array (
                'name' => 'Permission-delete',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'destroy',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-17 23:24:18',
                'updated_at' => '2023-03-17 23:24:18',
            ),
            12 =>
            array (
                'name' => 'Permission-show',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'show',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-17 23:23:49',
                'updated_at' => '2023-03-17 23:23:49',
            ),
            13 =>
            array (
                'name' => 'Role-show',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'show',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-19 20:21:23',
                'updated_at' => '2023-03-19 20:21:23',
            ),
            14 =>
            array (
                'name' => 'Page-show',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'show',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-19 20:37:47',
                'updated_at' => '2023-03-19 20:37:47',
            ),
            15 =>
            array (
                'name' => 'Admin-list',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'index',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            16 =>
            array (
                'name' => 'Admin-create',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'store',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            17 =>
            array (
                'name' => 'Admin-show',
                'guard_name' => 'web',
                'type' => 'get',
                'method' => 'show',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-22 11:25:56',
            ),
            18 =>
            array (
                'name' => 'Admin-edit',
                'guard_name' => 'web',
                'type' => 'put',
                'method' => 'update',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            19 =>
            array (
                'name' => 'Admin-delete',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'destroy',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            20 =>
            array (
                'name' => 'Admin-status',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'status',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-04-13 12:22:13',
            ),
            21 =>
            array (
                'name' => 'Admin-bulk delete',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'destroyBulk',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            22 =>
            array (
                'name' => 'Admin-bulk status',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'statusBulk',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-03-21 11:43:58',
                'updated_at' => '2023-03-21 11:43:58',
            ),
            27 =>
            array (
                'name' => 'Role-bulk delete',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'destroyBulk',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-12-29 20:05:54',
                'updated_at' => '2024-01-24 09:55:52',
            ),
            28 =>
            array (
                'name' => 'Permission-bulk delete',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'destroyBulk',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-12-29 20:28:07',
                'updated_at' => '2023-12-29 20:28:07',
            ),
            29 =>
            array (
                'name' => 'Permission-status',
                'guard_name' => 'web',
                'type' => 'delete',
                'method' => 'status',
                'has_params' => 1,
                'status' => 'approved',
                'created_at' => '2023-12-29 20:30:20',
                'updated_at' => '2023-12-29 20:30:20',
            ),
            30 =>
            array (
                'name' => 'Permission-bulk status',
                'guard_name' => 'web',
                'type' => 'post',
                'method' => 'statusBulk',
                'has_params' => 0,
                'status' => 'approved',
                'created_at' => '2023-12-29 20:31:24',
                'updated_at' => '2023-12-29 20:36:58',
            )
        ));


    }
}
