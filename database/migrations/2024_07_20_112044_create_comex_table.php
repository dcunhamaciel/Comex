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
        Schema::create('comex', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('product_id');
            $table->char('flow', 1);
            $table->char('transport', 1);
            $table->integer('year');
            $table->integer('month');
            $table->decimal('weight', 15, 4);
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comex');
    }
};
