<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SiswaExport;
use App\Exports\SiswaExportPdf;
use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = DB::table('siswa')->orderBy('jurusan')->orderBy('nama')->get()->groupBy(function($jurusan){
            return $jurusan->jurusan;
        });
        
        return view('admin.siswa.index', compact('siswa'));
    }

    public function diterima($id)
    {
        $siswa = Siswa::find($id);
        $siswa->status = 1;
        $siswa->save();

        return redirect()->back()->with('success', 'Data siswa berhasil divalidasi.');
    }

    public function ditolak($id)
    {
        $siswa = Siswa::find($id);
        $siswa->status = 2;
        $siswa->save();

        return redirect()->back()->with('success', 'Data siswa berhasil divalidasi.');
    }

    public function lihat($id)
    {
        $siswa = Siswa::find($id);
        
        return view('admin.siswa.show', compact('siswa'));
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        $siswa->delete();

        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'mimes:xlsx,xls'
        ],
        [
            'file.mimes' => 'Format file yang diizinkan (.xls .xlsx).'
        ]);

        $file = $request->file('file')->store('public/import');

        $import = new SiswaImport;
        $import->import($file);

        //check import failure
        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return redirect()->back()->with('success', 'Data siswa berhasil diimport.');
    }

    public function export()
    {
        $file_name = 'data_siswa_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new SiswaExport, $file_name);
    }

    public function pdf()
    {
        $siswa = DB::table('siswa')->orderBy('jurusan')->orderBy('nama')->get()->groupBy(function($jurusan){
            return $jurusan->jurusan;
        });

        return view('admin.siswa.print', compact('siswa'));
    }
}
