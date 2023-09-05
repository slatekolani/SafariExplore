<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nations\nations;
use App\Models\TourOperator\tourOperator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class tourOperatorCompaniesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.index')->with('tourOperator', $tourOperator);
    }

    public function verifiedTourOperatorsCompaniesIndex()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.Verified.index')->with('tourOperator',$tourOperator);
    }

    public function unverifiedTourOperatorsCompaniesIndex()
    {
        $tourOperator = tourOperator::all();
        return view('TourOperator.adminView.Unverified.index')->with('tourOperator',$tourOperator);
    }

    public function deletedTourCompaniesIndex()
    {
        $tourOperator=tourOperator::all();
        return view('TourOperator.adminView.deletedTourOperator.index')->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function ActivateOrDeactivateCompany(Request $request)
    {
        $tourOperatorCompany = tourOperator::find($request->id);
        $status = $request->status;
        switch ($status) {
            case 0:
                $tourOperatorCompany->status = 1;
                break;
            case 1:
                $tourOperatorCompany->status = 0;
                break;
        }
        $tourOperatorCompany->save();
    }

    public function getTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('registrationDate', function ($tour_operator_companies) {
                return date('jS M Y H:m:s a', strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('company_logo', function ($tour_operator_companies) {
                return $tour_operator_companies->company_logo_label;
            })
            ->addColumn('company_name', function ($tour_operator_companies) {
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address', function ($tour_operator_companies) {
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number', function ($tour_operator_companies) {
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation', function ($tour_operator_companies) {
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company', function ($tour_operator_companies) {
                return $tour_operator_companies->about_company;
            })
            ->addColumn('website_url', function ($tour_operator_companies) {
                return $tour_operator_companies->website_url;
            })
            ->addColumn('instagram_url', function ($tour_operator_companies) {
                return $tour_operator_companies->instagram_url;
            })
            ->addColumn('whatsapp_url', function ($tour_operator_companies) {
                return $tour_operator_companies->whatsapp_url;
            })
            ->addColumn('gps_url', function ($tour_operator_companies) {
                return $tour_operator_companies->gps_url;
            })
            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_button_actions_as_admin_label;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions'])
            ->make(true);
    }

    public function getVerifiedTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->where('status', '=', 1)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('registrationDate', function ($tour_operator_companies) {
                return date('jS M Y H:m:s a', strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('company_logo', function ($tour_operator_companies) {
                return $tour_operator_companies->company_logo_label;
            })
            ->addColumn('company_name', function ($tour_operator_companies) {
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address', function ($tour_operator_companies) {
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number', function ($tour_operator_companies) {
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation', function ($tour_operator_companies) {
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company', function ($tour_operator_companies) {
                return $tour_operator_companies->about_company;
            })
            ->addColumn('website_url', function ($tour_operator_companies) {
                return $tour_operator_companies->website_url;
            })
            ->addColumn('instagram_url', function ($tour_operator_companies) {
                return $tour_operator_companies->instagram_url;
            })
            ->addColumn('whatsapp_url', function ($tour_operator_companies) {
                return $tour_operator_companies->whatsapp_url;
            })
            ->addColumn('gps_url', function ($tour_operator_companies) {
                return $tour_operator_companies->gps_url;
            })
            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_button_actions_as_admin_label;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions', 'activate_or_deactivate_company'])
            ->make(true);
    }

    public function getUnverifiedTourOperatorsCompanies()
    {
        $tour_operator_companies = tourOperator::query()->where('status', '=', 0)->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('registrationDate', function ($tour_operator_companies) {
                return date('jS M Y H:m:s a', strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('company_logo', function ($tour_operator_companies) {
                return $tour_operator_companies->company_logo_label;
            })
            ->addColumn('company_name', function ($tour_operator_companies) {
                return $tour_operator_companies->company_name;
            })
            ->addColumn('email_address', function ($tour_operator_companies) {
                return $tour_operator_companies->email_address;
            })
            ->addColumn('phone_number', function ($tour_operator_companies) {
                return $tour_operator_companies->phone_number;
            })
            ->addColumn('company_nation', function ($tour_operator_companies) {
                return nations::find($tour_operator_companies->company_nation)->nation_name;
            })
            ->addColumn('about_company', function ($tour_operator_companies) {
                return $tour_operator_companies->about_company;
            })
            ->addColumn('website_url', function ($tour_operator_companies) {
                return $tour_operator_companies->website_url;
            })
            ->addColumn('instagram_url', function ($tour_operator_companies) {
                return $tour_operator_companies->instagram_url;
            })
            ->addColumn('whatsapp_url', function ($tour_operator_companies) {
                return $tour_operator_companies->whatsapp_url;
            })
            ->addColumn('gps_url', function ($tour_operator_companies) {
                return $tour_operator_companies->gps_url;
            })
            ->addColumn('activate_or_deactivate_company', function ($tour_operator_companies) {
                $btn = '<label class="switch{{$tour_operator_companies->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('company_status', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions', function ($tour_operator_companies) {
                return $tour_operator_companies->tour_company_button_actions_as_admin_label;
            })
            ->rawColumns(['company_logo', 'company_status', 'actions'])
            ->make(true);
    }

    public function getDeletedTourOperatorCompanies()
    {
        $tour_operator_companies=tourOperator::onlyTrashed()->orderBy('company_name')->get();
        return DataTables::of($tour_operator_companies)
            ->addIndexColumn()
            ->addColumn('registrationDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->created_at));
            })
            ->addColumn('deletedDate',function ($tour_operator_companies){
                return date('jS M Y H:m:s a',strtotime($tour_operator_companies->deleted_at));
            })
            ->addColumn('company_logo',function ($tour_operator_companies){
                return $tour_operator_companies->company_logo_label;
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
            ->addColumn('website_url',function($tour_operator_companies){
                return $tour_operator_companies->website_url;
            })
            ->addColumn('instagram_url',function ($tour_operator_companies){
                return $tour_operator_companies->instagram_url;
            })
            ->addColumn('whatsapp_url',function ($tour_operator_companies){
                return $tour_operator_companies->whatsapp_url;
            })
            ->addColumn('gps_url',function ($tour_operator_companies){
                return $tour_operator_companies->gps_url;
            })
            ->addColumn('status',function ($tour_operator_companies){
                return $tour_operator_companies->tour_company_status_label;
            })
            ->addColumn('actions',function ($tour_operator_companies)
            {
                return $tour_operator_companies->ButtonActionsForDeletedTourCompaniesLabel;
            })
            ->rawColumns(['company_logo','status','actions'])
            ->make(true);
    }
}
