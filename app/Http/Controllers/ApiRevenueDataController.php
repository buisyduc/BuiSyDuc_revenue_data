<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\RevenueDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiRevenueDataController extends Controller
{
    public function show(Request $request){
        
        $object = new RevenueDataController;
        $revenueData = $object->index($request);
        $showRevenueData = json_decode($revenueData->getContent(), true);
        print_r($showRevenueData);
        return view('index-api',compact('showRevenueData'));
    }
}
