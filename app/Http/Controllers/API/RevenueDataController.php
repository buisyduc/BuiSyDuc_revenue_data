<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueDataController extends Controller
{
    function index(Request $request){
        $nam = $request -> input('nam', now()->year);
        $datathang= DB::table('revenue_datas')
            ->selectRaw("
            DATE_FORMAT(date,'%m/%Y') as thang,
            SUM(revenue) as doanhthu,
            MONTH(date) as month
            ")
            ->whereYear('date',$nam)
            ->groupBy( 'thang','month')
            ->orderBy('month')
            ->get();


            foreach ($datathang as $item){
                $thang = $item->month;
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
                $item->ngay_max = $max->ngay;
                $item->doanhthu_max = $max->doanhthu;
                $item->ngay_min = $min->ngay;
                $item->doanhthu_min = $min->doanhthu;
            }
            return response()->json(data: $datathang);

    }
}
