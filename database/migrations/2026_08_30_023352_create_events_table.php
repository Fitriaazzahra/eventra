<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_code')->unique()->index();
            $table->string('name');
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('event_categories')->cascadeOnDelete();
            $table->foreignId('venue_id')->constrained('venues')->cascadeOnDelete();
            $table->date('start_date')->index();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->decimal('ticket_price', 12, 2)->default(0);
            $table->string('status')->default('draft')->index();
            $table->string('cover_image')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};