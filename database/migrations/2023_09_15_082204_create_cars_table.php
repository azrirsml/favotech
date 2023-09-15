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
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        \DB::table('car_types')->insert([
            ['name' => 'suv'],
            ['name' => 'sedan'],
            ['name' => 'hatchback'],
            ['name' => 'lorry'],
        ]);

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->unsignedBigInteger('car_type_id');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->decimal('rent_price', 14, 2)->nullable();
            $table->decimal('promo_price', 14, 2)->nullable();
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->string('status')->default('available')->nullable();
            $table->dateTime('available_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
