<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $elektronik = Kategori::where('slug', 'elektronik')->first();

        $barang = [
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Laptop Asus VivoBook 14',
                'kode'          => 'ELK-001',
                'deskripsi'     => 'Laptop 14 inci, Intel Core i5, RAM 8GB, SSD 512GB. Cocok untuk presentasi dan pekerjaan ringan.',
                'stok'          => 5,
                'stok_tersedia' => 5,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Proyektor Epson EB-X41',
                'kode'          => 'ELK-002',
                'deskripsi'     => 'Proyektor XGA 3600 lumens. Dilengkapi remote dan kabel HDMI.',
                'stok'          => 3,
                'stok_tersedia' => 3,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Kamera DSLR Canon EOS 250D',
                'kode'          => 'ELK-003',
                'deskripsi'     => 'Kamera DSLR 24.1 MP, lensa kit 18-55mm. Baterai + charger + tas kamera.',
                'stok'          => 2,
                'stok_tersedia' => 2,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Tripod Kamera Aluminum',
                'kode'          => 'ELK-004',
                'deskripsi'     => 'Tripod universal, tinggi max 160cm. Kompatibel dengan kamera DSLR dan mirrorless.',
                'stok'          => 4,
                'stok_tersedia' => 4,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Speaker Portable JBL Flip 5',
                'kode'          => 'ELK-005',
                'deskripsi'     => 'Speaker bluetooth waterproof, daya tahan baterai 12 jam.',
                'stok'          => 3,
                'stok_tersedia' => 2,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Microphone Condenser BM-800',
                'kode'          => 'ELK-006',
                'deskripsi'     => 'Microphone kondenser untuk rekaman suara dan siaran. Dilengkapi shock mount.',
                'stok'          => 2,
                'stok_tersedia' => 2,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
            [
                'kategori_id'   => $elektronik?->id,
                'nama'          => 'Tablet Samsung Galaxy Tab A8',
                'kode'          => 'ELK-007',
                'deskripsi'     => 'Tablet 10.5 inci, RAM 3GB, storage 32GB. Lengkap dengan charger.',
                'stok'          => 3,
                'stok_tersedia' => 3,
                'kondisi'       => 'baik',
                'aktif'         => true,
            ],
        ];

        $created = 0;
        foreach ($barang as $item) {
            if (! $item['kategori_id']) {
                $this->command->warn("Kategori tidak ditemukan untuk: {$item['nama']}");
                continue;
            }

            Barang::updateOrCreate(['kode' => $item['kode']], $item);
            $created++;
        }

        $this->command->info("BarangSeeder: {$created} barang berhasil dibuat.");
    }
}
