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
    Schema::create('inventory', function (Blueprint $table) {
        $table->id();
        $table->string('item_name');
        $table->string('category')->nullable();
        $table->integer('quantity')->default(0);
        $table->integer('low_stock_threshold')->default(5);
        $table->string('unit')->nullable();
        $table->decimal('price', 8, 2)->default(0);
        $table->timestamps();
    });
}
   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
