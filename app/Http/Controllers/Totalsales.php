<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Sale\Sale;
class Totalsales extends Controller
{
	
   
    public function index()
    {
    	$Sales=DB::table('sales')->sum('total_amount');
    	//dd($Sales);
        return view('dashboard.dashboard.index',compact('Sales'));
}


}