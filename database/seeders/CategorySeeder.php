<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Desain Grafis',
                'description' => 'Layanan desain logo, banner, ilustrasi, dll.',
            ],
            [
                'name' => 'Pemrograman & Teknologi',
                'description' => 'Layanan pembuatan website, aplikasi mobile, dan solusi IT lainnya.',
            ],
            [
                'name' => 'Penulisan & Penerjemahan',
                'description' => 'Layanan artikel, copywriting, dan penerjemahan bahasa.',
            ],
            [
                'name' => 'Video & Animasi',
                'description' => 'Layanan editing video, animasi 2D/3D, dan motion graphics.',
            ],
            [
                'name' => 'Pemasaran Digital',
                'description' => 'Layanan SEO, social media management, dan digital ads.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
