<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('visit_date');
            $table->string('visitor_hash', 64);
            $table->timestamps();

            $table->unique(['visit_date', 'visitor_hash']);
            $table->index('visit_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_visitors');
    }
};
