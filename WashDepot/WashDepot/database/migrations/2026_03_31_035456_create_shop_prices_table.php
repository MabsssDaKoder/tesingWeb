<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('shop_prices', function (Blueprint $table) {
        $table->id();
        $table->decimal('base_price', 8, 2)->default(0);
        $table->decimal('additional_per_kg', 8, 2)->default(0);
        $table->decimal('base_kg', 8, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_prices');
    }
};
