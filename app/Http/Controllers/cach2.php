<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class cach2 extends Controller
{
    function cach2(Request $request){
        $nam = $request->input('nam',now()->year);
        //truy van du lieu theo kieu grup by
            $data= DB::table('revenue_datas')
            ->selectRaw("
            DATE(date) as ngay,
            MONTH(date) as thang_so,
            DATE_FORMAT(date,'%m/%Y') as thang,
            SUM(revenue) as doanhthu
            ")
            ->whereYear('date',$nam)
            ->groupBy('thang_so', 'thang','ngay')
            ->orderBy('thang_so')
            ->get();
            $monthlyData = $data->groupBy('thang')->map(function($days, $thang) {
                $tong_doanhthu = $days->sum('doanhthu');

                $maxDay = $days->sortByDesc('doanhthu')->first();
                $minDay = $days->sortBy('doanhthu')->first();

                return [
                    'thang_so' => $maxDay->thang_so,
                    'thang' => $thang,
                    'tong_doanhthu' => $tong_doanhthu,
                    'ngay_max' => $maxDay->ngay,
                    'max_doanhthu' => $maxDay->doanhthu,
                    'ngay_min' => $minDay->ngay,
                    'min_doanhthu' => $minDay->doanhthu,
                ];
            })->sortBy('thang_so')->values();




        return view('cach2', ['monthlyData' => $monthlyData]);


    }

}
