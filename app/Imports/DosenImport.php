<?php
namespace App\Imports;

use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Haki;
use App\Models\Paten;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Carbon\Carbon;

class DosenImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Penelitian' => new PenelitianSheetImport(),
            'Pengabdian' => new PengabdianSheetImport(),
            'HAKI' => new HakiSheetImport(),
            'PATEN' => new PatenSheetImport(),
        ];
    }
}

class PenelitianSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || !isset($row['skema'])) {
            return null; // Lewati jika baris tidak valid
        }

        // Gunakan NIDN dari Excel jika ada, jika tidak buat NIDN unik
        $nidn = isset($row['nidn']) && !empty($row['nidn']) ? $row['nidn'] : 'NIDN-' . uniqid();
        
        $dosen = Dosen::firstOrCreate(
            ['nidn' => $nidn],
            [
                'nama' => $row['nama'],
                'nip' => $row['nip'] ?? null,
                'nuptk' => $row['nuptk'] ?? null,
            ]
        );

        return new Penelitian([
            'dosen_id' => $dosen->id,
            'skema' => $row['skema'],
            'posisi' => $row['posisi'],
            'judul_penelitian' => $row['judul_penelitian'],
            'sumber_dana' => $row['sumber_dana'],
            'status' => $row['status'],
            'tahun' => $row['tahun'],
            'link_luaran' => $row['link_luaran'] ?? null,
        ]);
    }
}

class PengabdianSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || !isset($row['skema'])) {
            return null;
        }

        $nidn = isset($row['nidn']) && !empty($row['nidn']) ? $row['nidn'] : 'NIDN-' . uniqid();
        
        $dosen = Dosen::firstOrCreate(
            ['nidn' => $nidn],
            [
                'nama' => $row['nama'],
                'nip' => $row['nip'] ?? null,
                'nuptk' => $row['nuptk'] ?? null,
            ]
        );

        return new Pengabdian([
            'dosen_id' => $dosen->id,
            'skema' => $row['skema'],
            'posisi' => $row['posisi'],
            'judul_pengabdian' => $row['judul_pengabdian'],
            'sumber_dana' => $row['sumber_dana'],
            'status' => $row['status'],
            'tahun' => $row['tahun'],
            'link_luaran' => $row['link_luaran'] ?? null,
        ]);
    }
}

class HakiSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || !isset($row['judul_haki'])) {
            return null;
        }

        $nidn = isset($row['nidn']) && !empty($row['nidn']) ? $row['nidn'] : 'NIDN-' . uniqid();
        
        $dosen = Dosen::firstOrCreate(
            ['nidn' => $nidn],
            [
                'nama' => $row['nama'],
                'nip' => $row['nip'] ?? null,
                'nuptk' => $row['nuptk'] ?? null,
            ]
        );

        $expired = null;
        if (!empty($row['expired'])) {
            try {
                $expired = Carbon::parse($row['expired'])->format('Y-m-d');
            } catch (\Exception $e) {
                $expired = null;
            }
        }

        return new Haki([
            'dosen_id' => $dosen->id,
            'judul_haki' => $row['judul_haki'],
            'expired' => $expired,
            'link' => $row['link'] ?? null,
        ]);
    }
}

class PatenSheetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || !isset($row['judul_paten'])) {
            return null;
        }

        $nidn = isset($row['nidn']) && !empty($row['nidn']) ? $row['nidn'] : 'NIDN-' . uniqid();
        
        $dosen = Dosen::firstOrCreate(
            ['nidn' => $nidn],
            [
                'nama' => $row['nama'],
                'nip' => $row['nip'] ?? null,
                'nuptk' => $row['nuptk'] ?? null,
            ]
        );

        $expired = null;
        if (!empty($row['expired'])) {
            try {
                $expired = Carbon::parse($row['expired'])->format('Y-m-d');
            } catch (\Exception $e) {
                $expired = null;
            }
        }

        return new Paten([
            'dosen_id' => $dosen->id,
            'judul_paten' => $row['judul_paten'],
            'jenis_paten' => $row['jenis_paten'],
            'expired' => $expired,
            'link' => $row['link'] ?? null,
        ]);
    }
}