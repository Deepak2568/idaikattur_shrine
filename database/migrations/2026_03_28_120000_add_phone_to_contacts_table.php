<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
        });

        // Allow the same email to submit the contact form more than once.
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->unique('email');
            $table->dropColumn('phone');
        });
    }
};
