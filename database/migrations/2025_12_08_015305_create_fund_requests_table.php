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
        Schema::create('fund_requests', function (Blueprint $table) {
            $table->id('fund_request_id');
            
            // FK ke Users
            $table->foreignId('requestor_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('approver_id')->nullable()->constrained('users', 'user_id')->onDelete('set null');
            
            $table->string('title', 120)->nullable();
            $table->date('request_date');
            $table->decimal('total_estimated', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_requests');
    }
};
