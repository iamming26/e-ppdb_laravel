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
        //diterima perbulan selama setahun
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

        //ditolak perbulan selama setahun
        $DataSiswaPerbulanDitolak = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name"), DB::raw("MONTH(created_at) as month"), DB::raw("status as stts"))
                                    ->where('created_at', '>', Carbon::today()->subMonth(11))
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

        //total mendaftar berdasarkan status diterima / ditolak selama setahun
        $totalMendaftar = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("status as stts"))
                                ->whereYear('created_at', Carbon::now()->format('Y'))
                                ->groupBy('stts')
                                ->orderBy('created_at')
                                ->get();
                                
        $totalmendaftar = [];
        foreach($totalMendaftar as $row) {
            $totalmendaftar['label'][] = $row->stts;
            $totalmendaftar['data'][] = (int) $row->count;
        }

        //total mendaftar perbulan selama setahun
        $DataTotalMendaftarAll = Siswa::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M %Y') as month_name"), DB::raw("MONTH(created_at) as month"))
                                        ->where('created_at', '>', Carbon::today()->subMonth(11))
                                        ->whereYear('created_at', Carbon::now()->format('Y'))
                                        ->groupBy('month_name', 'month')
                                        ->orderBy('created_at')
                                        ->get();
        //dd($DataTotalMendaftarAll);
        $totalmendaftarall = [];
        foreach($DataTotalMendaftarAll as $row){
            $totalmendaftarall['label'][] = $row->month_name;
            $totalmendaftarall['data'][] = $row->count;
        }

        //json
        $data['perbulanditolak'] = json_encode($perbulanditolak);
        $data['perbulanditerima'] = json_encode($perbulanditerima);                           
        $data['totalmendaftar'] = json_encode($totalmendaftar);                           
        $data['totalmendaftarall'] = json_encode($totalmendaftarall);

        return view('admin.dashboard', $data);
    }
}
