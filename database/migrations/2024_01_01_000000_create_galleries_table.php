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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('folder_name');
            $table->string('image_path');
            $table->string('original_name')->nullable();
            $table->string('image_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index('folder_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
