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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fname', 100);
            $table->string('lname', 100);
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->date('dob');
            $table->enum('gender', ['male', 'female']);
            $table->string('religion', 50);
            $table->string('subcaste', 50)->nullable();
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('password'); // will store hashed password
            $table->boolean('termsAccepted')->default(false);
            $table->bigInteger('active_status')->default(0);
            $table->enum('is_admin', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
