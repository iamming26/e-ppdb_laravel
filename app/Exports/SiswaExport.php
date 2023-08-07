<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SiswaExport implements FromCollection, WithMapping, ShouldAutoSize, WithHeadings
{
    use Exportable;
    
    public function collection()
    {
        return Siswa::all();
    }

    public function map($siswa): array
    {
        return [
            $siswa->nama,
            $siswa->tempat_lahir,
            $siswa->tanggal_lahir,
            $siswa->jenis_kelamin,
            $siswa->agama,
            $siswa->whatsapp,
            $siswa->nama_ayah,
            $siswa->nama_ibu,
            $siswa->alamat,
            $siswa->asal_sekolah,
            $siswa->jurusan,
            $siswa->status,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tempat lahir',
            'Tanggal lahir',
            'Jenis kelamin',
            'Agama',
            'Whatsapp',
            'Nama Ayah',
            'Nama Ibu',
            'Alamat',
            'Asal Sekolah',
            'Jurusan',
            'Status',
        ];
    }
}
