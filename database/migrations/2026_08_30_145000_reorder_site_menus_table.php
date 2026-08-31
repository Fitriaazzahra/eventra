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
        DB::table('site_menus')->where('key', 'home')->update(['sort_order' => 1]);
        DB::table('site_menus')->where('key', 'events')->update(['sort_order' => 2]);
        DB::table('site_menus')->where('key', 'speakers')->update(['sort_order' => 3]);
        DB::table('site_menus')->where('key', 'about')->update(['sort_order' => 4]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_menus')->where('key', 'events')->update(['sort_order' => 1]);
        DB::table('site_menus')->where('key', 'speakers')->update(['sort_order' => 2]);
        DB::table('site_menus')->where('key', 'about')->update(['sort_order' => 3]);
        DB::table('site_menus')->where('key', 'home')->delete();
    }
};
