<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('site_menus')->updateOrInsert(
            ['key' => 'home'],
            [
                'label_id' => 'Beranda',
                'label_en' => 'Home',
                'target_url' => '/id',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_menus')->where('key', 'home')->delete();
    }
};
