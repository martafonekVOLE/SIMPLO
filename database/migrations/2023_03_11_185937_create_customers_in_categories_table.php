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
        Schema::create('customers_in_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customers_id");
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger("categories_id");
            $table->foreign("categories_id")->references("id")->on("categories")->onDelete("cascade");
            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => 'CustomersInCategoriesSeeder',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_in_categories');
    }
};
