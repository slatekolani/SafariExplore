<?php

namespace App\Http\Controllers;

use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TourPackages $tour_package)
    {
        $tourPackages=TourPackages::all()->where('tourPackages',$tour_package->id)->where('status','=',1)->where('safari_start_date','>=',Carbon::now())->take(3);
        $recentTourPackages=TourPackages::query()->orderBy('id','desc')->whereBetween('created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->where('safari_start_date','>=',Carbon::now())->take(3)->get();
        return view('home')
            ->with('tourPackages',$tourPackages)
            ->with('recentTourPackages',$recentTourPackages);
    }
}
