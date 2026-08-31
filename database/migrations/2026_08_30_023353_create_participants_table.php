<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('participant_code')->unique()->index();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('ticket_type')->default('regular');
            $table->date('registration_date');
            $table->string('status')->default('registered')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};