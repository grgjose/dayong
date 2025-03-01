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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string("fname")->nullable();
            $table->string("mname")->nullable();
            $table->string("lname")->nullable();
            $table->string("ext")->nullable();
            $table->dateTime("birthdate")->nullable();
            $table->string("sex")->nullable();
            $table->string("birthplace")->nullable();
            $table->string("citizenship")->nullable();
            $table->string("civil_status")->nullable();
            $table->string("contact_num")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->string("agent_id")->nullable();
            $table->string("branch_id")->nullable();
            $table->string("claimant_id")->nullable();
            $table->string("beneficiaries_ids")->nullable();
            $table->string("status")->nullable();
            $table->boolean("is_deleted")->nullable()->default(false);
            $table->integer("lastUpdatedBy")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
