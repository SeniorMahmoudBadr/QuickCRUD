<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->enum('type',['get','post','put','patch','delete'])->default('get')->after('guard_name')->nullable();
            $table->string('method')->after('type')->default('index');
            $table->boolean('has_params')->after('method')->default(0);
            $table->enum('status',['approved','suspended'])->after('has_params')->default('approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
