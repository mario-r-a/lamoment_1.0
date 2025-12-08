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
        Schema::create('event_checklist_items', function (Blueprint $table) {
            $table->id('event_checklist_item_id');
            
            // FK
            $table->foreignId('event_checklist_id')->constrained('event_checklists', 'event_checklist_id')->onDelete('cascade');
            $table->foreignId('inventory_unit_id')->constrained('inventory_units', 'unit_id')->onDelete('cascade');
            
            $table->string('condition', 20);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_checklist_items');
    }
};
