<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->string('rental_code')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('rental_days');
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'ongoing', 'completed', 'cancelled', 'overdue'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};




