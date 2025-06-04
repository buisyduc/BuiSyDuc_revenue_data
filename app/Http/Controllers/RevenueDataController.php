<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueDataController extends Controller
{
    function index(Request $request){



        $nam = $request->input('nam',now()->year);
        $thang=[];
        //lay du lieu trong thang
        for($day=1;$day<=12;$day++){
            $data= DB::table('revenue_datas')
            ->whereYear('date',$nam)
            ->whereMonth('date',$day)
            ->get();

            $doanhthu = $data->sum('revenue');
            $max_revenue_day = $data->sortByDesc('revenue')->first();
            $min_revenue_day = $data->sortByDesc('revenue')->last();
            $thang[]=[
                'thang'=> $day .'/'. $nam,
                'doanhthu' => $doanhthu,
                'max'=> $max_revenue_day ? $max_revenue_day->date : '',
                'min'=> $min_revenue_day ? $min_revenue_day->date : '',
            ];


        }

    return view('index',compact('thang', 'nam'));
    }
}
