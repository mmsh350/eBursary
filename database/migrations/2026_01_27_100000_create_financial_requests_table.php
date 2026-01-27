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
        Schema::create('financial_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->decimal('amount', 15, 2);
            $table->string('currency')->default('NGN');
            $table->text('purpose');
            $table->longText('description')->nullable();

            $table->foreignId('department_id')->constrained();
            $table->foreignId('budget_head_id')->constrained();

            $table->date('required_date');
            $table->date('expected_retirement_date')->nullable();

            $table->string('status')->default('DRAFT');
            $table->string('current_step')->nullable();

            $table->json('payment_details')->nullable();
            $table->json('meta_data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_requests');
    }
};
