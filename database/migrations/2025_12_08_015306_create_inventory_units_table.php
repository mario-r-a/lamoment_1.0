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
        Schema::create('inventory_units', function (Blueprint $table) {
            $table->id('unit_id');
            
            // FK ke Inventory Items
            $table->foreignId('inventory_item_id')->constrained('inventory_items', 'inventory_item_id')->onDelete('cascade');
            
            $table->string('condition', 50)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->integer('lifespan_months')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_units');
    }
};
