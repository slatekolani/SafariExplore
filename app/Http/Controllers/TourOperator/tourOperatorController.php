<?php

namespace App\Http\Controllers\TourOperator;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\touristReview\touristReview;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\TourPackages;
use App\Repositories\TourOperator\tourOperatorRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class tourOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $tour_operator_repo;
    public function construct()
    {
        $this->tour_operator_repo = new tourOperatorRepository();
    }
    public function index()
    {
        return view('TourOperator.index');
    }

    public function verifiedCompaniesIndex()
    {
        return view('TourOperator.Verified.index');
    }

    public function UnverifiedCompaniesIndex()
    {
        return view('TourOperator.Unverified.index');
    }
    public function deletedTourCompaniesIndex()
    {
        return view('TourOperator.deletedTourOperator.index');
    }
    public function adminViewIndex()
    {
        $tourOperator=tourOperator::all();
        return view('TourOperator.adminView.index')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nations=nations::where('status','=',1)->pluck('nation_name','id');
        $tourist_attractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        return view('TourOperator.register')
            ->with('tourist_attractions',$tourist_attractions)
            ->with('nations',$nations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'company_name'=>'required',
            'email_address'=>'required|email',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'about_company'=>'required',
            'company_nation'=>'required',
            'website_url'=>'required|url',
            'instagram_url'=>'required|url',
            'whatsapp_url'=>'required|url',
            'gps_url'=>'required|url',
            'company_logo'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',
            'company_team_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',
            'verification_certificate'=>'required|mimes:pdf|max:2048'
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourOperatorRepo=new tourOperatorRepository();
        $tourOperatorCompany=$tourOperatorRepo->storetourOperatorInformation($input);
        return redirect()->route('tourOperator.index')->with('tourOperatorCompany',$tourOperatorCompany)->withFlashSuccess('Company information submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tour_operator_company_id)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        return view('TourOperator.view')->with('tourOperator',$tourOperator);
    }

    public function publicView($tour_operator_company_id)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $totalTouristReviews=touristReview::query()->where('tour_operator_id',$tourOperator->id)->count();
        $touristReviews=touristReview::query()->where('tour_operator_id',$tourOperator->id)->take(3)->get();
        $tourPackages=TourPackages::query()->where('tour_operator_id',$tourOperator->id)->where('safari_start_date','>=',Carbon::now())->get();
        return view('TourOperator.publicView')
            ->with('totalTouristReviews',$totalTouristReviews)
            ->with('touristReviews',$touristReviews)
            ->with('tourPackages',$tourPackages)
            ->with('tourOperator',$tourOperator);
    }

    public function allTourOperators()
    {
        $tourOperators=tourOperator::all();
        return view('TourOperator.allTourOperators.show')->with('tourOperators',$tourOperators);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tour_operator_company_id)
    {
        $tour_operator_company=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $tourist_attractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $touristAttractionsId=DB::table('tour_operator_touristic_attraction')->where('tour_operator_id',$tour_operator_company->id)->pluck('touristic_attraction_id');
        return view('TourOperator.edit')
            ->with('tourist_attractions',$tourist_attractions)
            ->with('touristAttractionsId',$touristAttractionsId)
            ->with('tour_operator_company',$tour_operator_company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$tour_operator_company_id)
    {
        $validator=Validator::make($request->all(),[
            'company_name'=>'required',
            'email_address'=>'required|email',
            'phone_number'=>'required|regex:/^[0-9]{10}$/',
            'about_company'=>'required',
            'company_nation'=>'required',
            'website_url'=>'required|url',
            'instagram_url'=>'required|url',
            'whatsapp_url'=>'required|url',
            'gps_url'=>'required|url',
            'company_logo'=>'required|mimes:jpg,png,jpeg|dimensions:max_height:1000,max_width:1000',
            'company_team_image'=>'required|mimes:jpg,jpeg,png|max:2048|dimensions:max_height=1000,max_width=1000',
            'verification_certificate'=>'required|mimes:pdf|max:2048'
            ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $tourOperatorRepo=new tourOperatorRepository();
        $tourOperatorCompany=$tourOperatorRepo->updatetourOperatorInformation($input,$tour_operator_company_id);
        return redirect()->route('tourOperator.index')->with('tourOperator',$tourOperatorCompany)->withFlashSuccess('Company Information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tourOperator $tourOperatorCompany)
    {
        $tourOperatorCompany->delete();
        return redirect()->back()->withFlashSuccess('Company Information deleted successfully');
    }
    public function restoreDeletedTourCompany($tourOperatorId)
    {
        $tourOperator=tourOperator::onlyTrashed()->where('uuid',$tourOperatorId)->first();
        $tourOperator->restore();
        return back()->withFlashSuccess('Tour Company Restored Successfully');
    }
    public function getTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address',function ($tour_operator_companies){
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number',function ($tour_operator_companies){
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company',function ($tour_operator_companies){
                return $tour_operator_companies->about_company;
            })
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getVerifiedTourCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->where('status','=',1)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address',function ($tour_operator_companies){
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number',function ($tour_operator_companies){
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company',function ($tour_operator_companies){
                return $tour_operator_companies->about_company;
            })
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getUnverifiedTourCompanies()
    {
        $tour_operator_companies=tourOperator::query()->where('users_id',auth()->user()->id)->where('status','=',0)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address',function ($tour_operator_companies){
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number',function ($tour_operator_companies){
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company',function ($tour_operator_companies){
                return $tour_operator_companies->about_company;
            })
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->tour_company_button_actions_label;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }
    public function getDeletedTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::onlyTrashed()->where('users_id',auth()->user()->id)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('id',function ($tour_operator_companies){
                return ($tour_operator_companies->id);
            })
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
            ->addColumn('company_name',function($tour_operator_companies){
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address',function ($tour_operator_companies){
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number',function ($tour_operator_companies){
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation',function ($tour_operator_companies){
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company',function ($tour_operator_companies){
                return $tour_operator_companies->about_company;
            })
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->ButtonActionsForDeletedTourCompaniesLabel;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }

}
