<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::where('email', 'budi@example.com')->first();
        $siti = User::where('email', 'siti@example.com')->first();

        $laptop     = Barang::where('kode', 'ELK-001')->first();
        $proyektor  = Barang::where('kode', 'ELK-002')->first();
        $kamera     = Barang::where('kode', 'ELK-003')->first();
        $tablet     = Barang::where('kode', 'ELK-007')->first();

        $data = [
            // Peminjaman sudah selesai dikembalikan
            [
                'peminjaman' => [
                    'kode_pinjam'         => 'PJM-CONTOH01',
                    'user_id'             => $budi?->id,
                    'barang_id'           => $laptop?->id,
                    'jumlah'              => 1,
                    'tgl_pinjam'          => now()->subDays(14)->toDateString(),
                    'tgl_kembali_rencana' => now()->subDays(7)->toDateString(),
                    'status'              => 'dikembalikan',
                    'catatan'             => 'Digunakan untuk presentasi tugas akhir.',
                ],
                'pengembalian' => [
                    'tgl_kembali_aktual' => now()->subDays(7)->toDateString(),
                    'kondisi_kembali'    => 'baik',
                    'catatan'            => 'Barang kembali dalam kondisi baik.',
                    'denda'              => 0,
                ],
            ],
            // Peminjaman sedang aktif
            [
                'peminjaman' => [
                    'kode_pinjam'         => 'PJM-CONTOH02',
                    'user_id'             => $siti?->id,
                    'barang_id'           => $proyektor?->id,
                    'jumlah'              => 1,
                    'tgl_pinjam'          => now()->subDays(2)->toDateString(),
                    'tgl_kembali_rencana' => now()->addDays(3)->toDateString(),
                    'status'              => 'dipinjam',
                    'catatan'             => 'Untuk acara seminar di aula.',
                ],
                'pengembalian' => null,
            ],
            // Peminjaman menunggu persetujuan
            [
                'peminjaman' => [
                    'kode_pinjam'         => 'PJM-CONTOH03',
                    'user_id'             => $budi?->id,
                    'barang_id'           => $kamera?->id,
                    'jumlah'              => 1,
                    'tgl_pinjam'          => now()->toDateString(),
                    'tgl_kembali_rencana' => now()->addDays(5)->toDateString(),
                    'status'              => 'menunggu',
                    'catatan'             => 'Untuk dokumentasi acara kampus.',
                ],
                'pengembalian' => null,
            ],
            // Peminjaman terlambat
            [
                'peminjaman' => [
                    'kode_pinjam'         => 'PJM-CONTOH04',
                    'user_id'             => $siti?->id,
                    'barang_id'           => $tablet?->id,
                    'jumlah'              => 1,
                    'tgl_pinjam'          => now()->subDays(10)->toDateString(),
                    'tgl_kembali_rencana' => now()->subDays(3)->toDateString(),
                    'status'              => 'terlambat',
                    'catatan'             => 'Tablet untuk kegiatan presentasi kelompok.',
                ],
                'pengembalian' => null,
            ],
        ];

        foreach ($data as $item) {
            if (! $item['peminjaman']['user_id'] || ! $item['peminjaman']['barang_id']) {
                continue;
            }

            $peminjaman = Peminjaman::updateOrCreate(
                ['kode_pinjam' => $item['peminjaman']['kode_pinjam']],
                $item['peminjaman']
            );

            if ($item['pengembalian']) {
                Pengembalian::updateOrCreate(
                    ['peminjaman_id' => $peminjaman->id],
                    array_merge(['peminjaman_id' => $peminjaman->id], $item['pengembalian'])
                );
            }
        }

        $this->command->info('PeminjamanSeeder: ' . count($data) . ' data peminjaman berhasil dibuat.');
    }
}
