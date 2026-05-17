<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama'      => 'Elektronik',
                'slug'      => 'elektronik',
                'deskripsi' => 'Peralatan elektronik seperti laptop, proyektor, kamera, dan sejenisnya.',
            ],
        ];

        foreach ($kategori as $item) {
            Kategori::updateOrCreate(['slug' => $item['slug']], $item);
        }

        $this->command->info('KategoriSeeder: ' . count($kategori) . ' kategori berhasil dibuat.');
    }
}
