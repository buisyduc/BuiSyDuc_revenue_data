<?php

namespace App\Http\Controllers;

use App\Models\revenue_data;
use Illuminate\Http\Request;

class RevenueDataController extends Controller
{
    function index(Request $request){
        $query = revenue_data::query()->latest('id');
        if ($request->has('Loc') && !empty($request->Loc)) {
            $query->where('date', 'like', '%' . $request->Loc . '%');
        }
         $revenue_datas = $query->get();
         $max_revenue = $revenue_datas->sortByDesc('revenue')->first();
         $min_revenue = $revenue_datas->sortByDesc('revenue')->last();


    return view('index',compact('revenue_datas','max_revenue','min_revenue'));
    }
}
