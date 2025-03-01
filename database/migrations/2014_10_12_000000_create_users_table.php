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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->integer('usertype')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('ext')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('status')->nullable();
            $table->integer('branch_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('birthdate')->nullable();
            $table->string('contact_num')->nullable();
            $table->string('profile_pic')->nullable();
            $table->boolean('with_fidelity')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
