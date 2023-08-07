<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $DataSiswaPerhari = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%e %M') as day_name"), DB::raw("DAY(created_at) as day"))
                                    ->where('created_at', '>', Carbon::today()->subDay(6))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('day_name','day')
                                    ->orderBy('created_at')
                                    ->get();

        $DataSiswaPerbulan = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name"), DB::raw("MONTH(created_at) as month"), DB::raw("status as stts"))
                                    ->where('created_at', '>', Carbon::today()->subMonth(4))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('month_name','month', 'stts')
                                    ->orderBy('created_at')
                                    ->get();

        $DataSiswaPerjurusan = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("jurusan as jurusan"))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('jurusan')
                                    ->get();

        $JenisKelamin = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("jenis_kelamin as jk"))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('jk')
                                    ->get();

        $DataLaki = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%e %M') as day_name"), DB::raw("DAY(created_at) as day"), DB::raw("jenis_kelamin as jk"))
                                    ->where('jenis_kelamin', 'Laki - laki')
                                    ->where('created_at', '>', Carbon::today()->subDay(6))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('day_name','day')
                                    ->orderBy('created_at')
                                    ->get();

        $DataPerempuan = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%a, %e %M') as day_name"), DB::raw("DAY(created_at) as day"), DB::raw("jenis_kelamin as jk"))
                                    ->where('jenis_kelamin', 'Perempuan')
                                    ->where('created_at', '>', Carbon::today()->subDay(6))
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->groupBy('day_name','day')
                                    ->orderBy('created_at')
                                    ->get();
        $perhari = [];
        foreach($DataSiswaPerhari as $row) {
            $perhari['label'][] = $row->day_name;
            $perhari['data'][] = (int) $row->count;
        }

        $perbulan = [];
        foreach($DataSiswaPerbulan as $row) {
            $perbulan['label'][] = $row->month_name;
            $perbulan['data'][] = (int) $row->count;
        }
        
        $perjurusan = [];
        foreach($DataSiswaPerjurusan as $row) {
            $perjurusan['label'][] = $row->jurusan;
            $perjurusan['data'][] = (int) $row->count;
        }

        $jenis_kelamin = [];
        foreach($JenisKelamin as $row) {
            $jenis_kelamin['label'][] = $row->jk;
            $jenis_kelamin['data'][] = (int) $row->count;
        }
        
        $laki = [];
        foreach($DataLaki as $row) {
            $laki['label'][] = $row->day_name;
            $laki['data'][] = (int) $row->count;
        }
        
        $perempuan = [];
        foreach($DataPerempuan as $row) {
            $perempuan['label'][] = $row->day_name;
            $perempuan['data'][] = (int) $row->count;
        }
        
        $data['perhari'] = json_encode($perhari);
        $data['perbulan'] = json_encode($perbulan);
        $data['perjurusan'] = json_encode($perjurusan);
        $data['jenis_kelamin'] = json_encode($jenis_kelamin);
        $data['laki'] = json_encode($laki);
        $data['perempuan'] = json_encode($perempuan);



        // g==============================
        $DataSiswaPerbulanDiterima = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name"), DB::raw("MONTH(created_at) as month"), DB::raw("status as stts"))
                                    ->where('created_at', '>', Carbon::today()->subMonth(11)) //untuk 1 tahun
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->where('status', 1)
                                    ->groupBy('month_name','month')
                                    ->orderBy('created_at')
                                    ->get();
                                    
        $perbulanditerima = [];
        foreach($DataSiswaPerbulanDiterima as $row) {
            $perbulanditerima['label'][] = $row->month_name;
            $perbulanditerima['data'][] = (int) $row->count;
        }
        
        $data['perbulanditerima'] = json_encode($perbulanditerima);                           
        
        
        $DataSiswaPerbulanDitolak = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name"), DB::raw("MONTH(created_at) as month"), DB::raw("status as stts"))
                                    ->where('created_at', '>', Carbon::today()->subMonth(11)) //untuk 1 tahun
                                    ->whereYear('created_at', Carbon::now()->format('Y'))
                                    ->where('status', 2)
                                    ->groupBy('month_name','month')
                                    ->orderBy('created_at')
                                    ->get();
                                    
        $perbulanditolak = [];
        foreach($DataSiswaPerbulanDitolak as $row) {
            $perbulanditolak['label'][] = $row->month_name;
            $perbulanditolak['data'][] = (int) $row->count;
        }

        $data['perbulanditolak'] = json_encode($perbulanditolak);                           
                                    
        return view('admin.dashboard', $data);
    }
}
