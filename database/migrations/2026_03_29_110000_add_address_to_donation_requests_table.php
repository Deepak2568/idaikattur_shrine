<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('donation_requests', 'address')) {
            return;
        }

        Schema::table('donation_requests', function (Blueprint $table) {
            $table->string('address', 500)->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('donation_requests', 'address')) {
            return;
        }

        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }
};
