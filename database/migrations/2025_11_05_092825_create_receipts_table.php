<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenue_source_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 14,2);
            $table->string('reference')->unique();
            $table->date('receipt_date');
            $table->string('file')->nullable(); // PDF/JPG upload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
