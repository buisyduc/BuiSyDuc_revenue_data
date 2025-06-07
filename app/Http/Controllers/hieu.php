<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Hieu extends Controller
{
    function hieu(Request $request){
        $nam = $request -> input('nam', now()->year);
      $datathang= DB::table('revenue_datas')
            ->selectRaw("
            DATE_FORMAT(date,'%m/%Y') as thang,
            SUM(revenue) as doanhthu
            ")
            ->whereYear('date',$nam)
            ->groupBy( 'thang',)
            ->get();


            foreach ($datathang as $item){
                $thang = $item->thang;
                $max = DB::table('revenue_datas')
                 ->selectRaw("
                DATE(date) as ngay,
                SUM(revenue) as doanhthu
                ")
                ->whereMonth('date',$thang)
                ->whereYear('date',$nam)
                ->groupBy('ngay')
                ->orderByDesc('doanhthu')
                ->first();


                 $min = DB::table('revenue_datas')
                 ->selectRaw("
                DATE(date) as ngay,
                SUM(revenue) as doanhthu
                ")
                ->whereMonth('date',$thang)
                ->whereYear('date',$nam)
                ->groupBy('ngay')
                ->orderBy('doanhthu')
                ->first();
                // print_r($datathang);
                // print_r($max);
                // print_r($min);

                $item->ngay_max = $max->ngay;
                $item->doanhthu_max = $max->doanhthu;
                $item->ngay_min = $min->ngay;
                $item->doanhthu_min = $min->doanhthu;
            }









        return view('hieu',compact('datathang'));


    }
}

