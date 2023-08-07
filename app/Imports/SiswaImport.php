<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            "nama" => $row['nama'],
            "tempat_lahir" => $row['tempat_lahir'],
            "tanggal_lahir" => $row['tanggal_lahir'],
            "jenis_kelamin" => $row['jenis_kelamin'],
            "agama" => $row['agama'],
            "whatsapp" => $row['whatsapp'],
            "nama_ayah" => $row['nama_ayah'],
            "nama_ibu" => $row['nama_ibu'],
            "alamat" => $row['alamat'],
            "asal_sekolah" => $row['asal_sekolah'],
            "jurusan" => $row['jurusan'],
        ]);
    }

    public function rules(): array
    {
        return [
            "nama" => 'required',
            "tempat_lahir" => 'required',
            "tanggal_lahir" => 'required',
            "jenis_kelamin" => 'required',
            "agama" => 'required',
            "whatsapp" => 'required|unique:siswa,whatsapp',
            "nama_ayah" => 'required',
            "nama_ibu" => 'required',
            "alamat" => 'required',
            "asal_sekolah" => 'required',
            "jurusan" => 'required',
        ];
    }
}
