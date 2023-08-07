<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class PendaftaranController extends Controller
{
    public function daftar(Request $request)
    {
        $validateData = $request->validate([
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
        ],
        [
            "nama.required" => 'Nama lengkap belum diisi.',
            "tempat_lahir.required" => 'Tempat Lahir belum diisi.',
            "tanggal_lahir.required" => 'Tanggal Lahir belum diisi.',
            "jenis_kelamin.required" => 'Jenis Kelamin belum diisi.',
            "agama.required" => 'Agama belum diisi.',
            "whatsapp.required" => 'Whatsapp belum diisi.',
            "whatsapp.unique" => 'Whatsapp sudah terdaftar.',
            "nama_ayah.required" => 'Nama Ayah belum diisi.',
            "nama_ibu.required" => 'Nama Ibu belum diisi.',
            "alamat.required" => 'ALamat belum diisi.',
            "asal_sekolah.required" => 'Asal Sekolah belum diisi.',
            "jurusan.required" => 'Jurusan belum diisi.',
        ]);

        Siswa::create($validateData);

        return redirect()->back()->with('success', 'Berhasil Mendaftar. Untuk proses selanjutnya anda akan dihubungi via Whatsapp');
    }
}
