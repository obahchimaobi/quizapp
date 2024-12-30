<?php

namespace Database\Seeders;

use App\Models\Codes;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table('codes')->insert([
        //     'code' => strtoupper(Str::random(40)),
        //     'is_used' => false,
        // ]);

        Codes::factory()->count(100)->create();
    }
}
