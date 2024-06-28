<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('route');
            $table->string('controller');
            $table->string('blade');
            $table->string('javascript');
            $table->integer('parent_id')->default(0);
            $table->enum('position', ['top', 'left'])->default('left');
            $table->enum('display', ['show', 'hide'])->default('show');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('related_page')->nullable();
            $table->boolean('role_editable')->default(0);
            $table->integer('sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
