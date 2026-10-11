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
        Schema::create('repair_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_id')->constrained('repair_requests')->cascadeOnDelete();
            $table->enum('image_type', ['before', 'after']);
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_images');
    }
};
