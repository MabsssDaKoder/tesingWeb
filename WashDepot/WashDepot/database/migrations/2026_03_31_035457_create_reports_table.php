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
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->enum('period', ['daily', 'weekly', 'monthly', 'yearly']);
        $table->integer('total_customers')->default(0);
        $table->integer('white_clothes_count')->default(0);
        $table->integer('black_clothes_count')->default(0);
        $table->integer('colored_clothes_count')->default(0);
        $table->string('most_used_addon')->nullable();
        $table->string('busiest_day')->nullable();
        $table->decimal('total_revenue', 10, 2)->default(0);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
