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
    Schema::create('addons', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('brand')->nullable();
        $table->enum('type', ['powder_soap', 'liquid_soap', 'fabric_conditioner', 'other']);
        $table->decimal('price', 8, 2)->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};
