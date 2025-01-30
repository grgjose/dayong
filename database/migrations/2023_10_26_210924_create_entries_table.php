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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->integer("branch_id");
            $table->integer("encoder_id");
            $table->integer("marketting_agent");
            $table->integer("member_id");
            $table->string("or_number");
            $table->double("amount");
            $table->integer("number_of_payment");
            $table->string("program_id");
            $table->string("month_from")->nullable();
            $table->string("month_to")->nullable();
            $table->integer("incentives");
            $table->double("incentives_total");
            $table->double("net");
            $table->integer("fidelity");
            $table->double("fidelity_total");
            $table->integer("is_reactivated");
            $table->integer("is_transferred");
            $table->boolean("is_remitted");
            $table->string("remarks")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
