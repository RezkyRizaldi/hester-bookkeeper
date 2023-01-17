<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Hester',
                'code' => 'H',
                'created_at' => now(),
            ],
            [
                'name' => 'Heavy Breathing',
                'code' => 'HB',
                'created_at' => now(),
            ],
        ];
        $colors = [
            ['name' => 'Hitam'],
            ['name' => 'Putih'],
            ['name' => 'Biru'],
            ['name' => 'Merah'],
            ['name' => 'Hijau'],
            ['name' => 'Kuning'],
        ];
        $stores = [
            ['name' => 'LAZADA'],
            ['name' => 'Shopee'],
            ['name' => 'TikTok'],
        ];

        DB::table('brands')->insert($brands);
        DB::table('colors')->insert($colors);
        DB::table('stores')->insert($stores);
    }
}
