<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('label_id');
            $table->string('label_en');
            $table->string('target_url');
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('site_menus')->insert([
            [
                'key' => 'home',
                'label_id' => 'Beranda',
                'label_en' => 'Home',
                'target_url' => '/id',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'events',
                'label_id' => 'Acara',
                'label_en' => 'Events',
                'target_url' => '/id/events',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'speakers',
                'label_id' => 'Pembicara',
                'label_en' => 'Speakers',
                'target_url' => '/id/speakers',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'about',
                'label_id' => 'Tentang',
                'label_en' => 'About',
                'target_url' => '/id/about',
                'is_active' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_menus');
    }
};
