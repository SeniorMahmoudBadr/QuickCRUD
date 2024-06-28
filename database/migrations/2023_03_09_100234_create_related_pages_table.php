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
        Schema::create('related_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained()->references('id')->on('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('child_id')->constrained()->references('id')->on('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', ['modal', 'route'])->default('route');
            $table->string('btn_color')->default('primary');
            $table->boolean('into_btn_action')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_pages');
    }
};
