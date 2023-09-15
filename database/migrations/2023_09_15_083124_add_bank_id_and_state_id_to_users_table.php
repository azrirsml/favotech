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
        Schema::table('users', function (Blueprint $table) {
            $table->after('address', function ($table) {
                $table->unsignedBigInteger('bank_id');
                $table->foreign('bank_id')->references('id')->on('banks');
                $table->string('bank_number')->nullable();
                $table->unsignedBigInteger('state_id');
                $table->foreign('state_id')->references('id')->on('states');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
