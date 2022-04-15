<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = [
            "fa" => "Persian فارسی",
            "en" => "English"
        ];

        foreach ($langs as $k => $v) {
            Language::updateOrCreate([
                "alpha2code" => $k
            ], [
                "name" => $v
            ]);
        }
    }
}