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
        Schema::create('priests', function (Blueprint $table) {
            $table->id();
            $table->string('father_name');
            $table->string('designation');
            $table->year('from_year');
            $table->year('to_year')->nullable();
            $table->string('image_path')->nullable();
            $table->string('original_name')->nullable();
            $table->string('image_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['from_year', 'to_year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priests');
    }
};
