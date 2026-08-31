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
        Schema::create('site_about_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value_id')->nullable();
            $table->text('value_en')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $defaults = [
            ['key' => 'hero_title', 'value_id' => 'Membangun pengalaman event yang berkesan.', 'value_en' => 'Building memorable event experiences.', 'sort_order' => 1],
            ['key' => 'hero_description', 'value_id' => 'Eventra membantu komunitas, brand, dan organisasi menyusun event yang terstruktur, relevan, dan berdampak.', 'value_en' => 'Eventra helps communities, brands, and organizations host events that are well structured, relevant, and impactful.', 'sort_order' => 2],
            ['key' => 'story_title', 'value_id' => 'Eventra untuk momen yang lebih besar', 'value_en' => 'Eventra for bigger moments', 'sort_order' => 3],
            ['key' => 'story_description', 'value_id' => 'Dari seminar hingga komunitas digital, kami hadir untuk menghubungkan audience, pembicara, dan penyelenggara dalam satu ekosistem event yang rapi dan mudah diakses.', 'value_en' => 'From seminars to digital communities, we connect audiences, speakers, and organizers in one streamlined event ecosystem that is easy to access and manage.', 'sort_order' => 4],
            ['key' => 'vision_title', 'value_id' => 'Visi', 'value_en' => 'Vision', 'sort_order' => 5],
            ['key' => 'vision_text', 'value_id' => 'Menjadi platform event paling mudah dijangkau.', 'value_en' => 'To become the most accessible event platform.', 'sort_order' => 6],
            ['key' => 'mission_title', 'value_id' => 'Misi', 'value_en' => 'Mission', 'sort_order' => 7],
            ['key' => 'mission_text', 'value_id' => 'Menyediakan ruang bertumbuh bagi komunitas dan bisnis.', 'value_en' => 'Create spaces for growth across communities and business.', 'sort_order' => 8],
        ];

        foreach ($defaults as $default) {
            DB::table('site_about_settings')->insert([
                'key' => $default['key'],
                'value_id' => $default['value_id'],
                'value_en' => $default['value_en'],
                'sort_order' => $default['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_about_settings');
    }
};
