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
        Schema::table('customers', function (Blueprint $table) {
            // Address
            $table->text('address')->nullable();
            
            // Physical Details
            $table->string('height', 50)->nullable();
            $table->string('weight', 50)->nullable();
            $table->enum('body_type', ['slim', 'average', 'athletic', 'curvy', 'plus_size'])->nullable();
            $table->enum('complexion', ['very_fair', 'fair', 'wheatish', 'wheatish_brown', 'black'])->nullable();
            $table->string('blood_group', 10)->nullable();
            $table->enum('physical_status', ['normal', 'physically_challenged'])->nullable();
            $table->enum('marital_status', ['unmarried', 'married', 'widowed', 'divorced'])->nullable();
            
            // Education
            $table->enum('education', ['high_school', 'diploma', 'bachelor', 'master', 'phd', 'other'])->nullable();
            $table->string('education_details', 255)->nullable();
            
            // Occupation
            $table->enum('employed_in', ['private', 'government', 'others'])->nullable();
            $table->string('occupation_details', 255)->nullable();
            $table->string('occupation_category', 255)->nullable();
            $table->string('working_state', 255)->nullable();
            $table->string('working_place', 255)->nullable();
            $table->string('salary', 100)->nullable();
            
            // Family Details
            $table->string('father_name', 255)->nullable();
            $table->string('father_occupation', 255)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->string('mother_occupation', 255)->nullable();
            $table->string('brother_name', 255)->nullable();
            $table->string('brother_occupation', 255)->nullable();
            $table->enum('brother_status', ['married', 'unmarried'])->nullable();
            $table->string('sister_name', 255)->nullable();
            $table->string('sister_occupation', 255)->nullable();
            $table->enum('sister_status', ['married', 'unmarried'])->nullable();
            
            // Partner Preference
            $table->text('partner_preference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'address', 'height', 'weight', 'body_type', 'complexion', 'blood_group',
                'physical_status', 'marital_status', 'education', 'education_details',
                'employed_in', 'occupation_details', 'occupation_category', 'working_state',
                'working_place', 'salary', 'father_name', 'father_occupation', 'mother_name',
                'mother_occupation', 'brother_name', 'brother_occupation', 'brother_status',
                'sister_name', 'sister_occupation', 'sister_status', 'partner_preference'
            ]);
        });
    }
};
