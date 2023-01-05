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
                'name'  => 'Hester',
                'code'  => 'H',
                'created_at' => date('Y-m-d H:i:s'),

            ],
            [
                'name'  => 'Heavy Breathing',
                'code'  => 'HB',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $colors = [
            [
                'name' => 'Hitam'
            ],
            [
                'name' => 'Putih'
            ],
            [
                'name' => 'Biru'
            ],
            [
                'name' => 'Merah'
            ],
            [
                'name' => 'Hijau'
            ],
            [
                'name' => 'Kuning'
            ],
        ];

        DB::table('brands')->insert($brands);
        DB::table('colors')->insert($colors);
    }
}
