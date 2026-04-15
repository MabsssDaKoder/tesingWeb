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
    Schema::create('queue', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('contact_number');
        $table->integer('queue_number');
        $table->enum('service_type', ['ordinary', 'rush'])->default('ordinary');
        $table->decimal('kg', 8, 2)->default(0);
        $table->json('addons')->nullable();
        $table->string('receiving_time')->nullable();
        $table->decimal('total_price', 8, 2)->default(0);
        $table->string('qr_code')->nullable();
        $table->enum('status', ['queued', 'processing', 'complete'])->default('queued');
        $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue');
    }
};
