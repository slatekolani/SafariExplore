<?php

namespace App\Http\Controllers\TourOperator\customTourBookings;

use App\Http\Controllers\Controller;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\tourOperator;
use App\Repositories\customTourPackages\customTourBookingsRepository;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class customTourBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function approvedCustomTourBookingsIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.approvedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function unApprovedCustomTourBookingsIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.unApprovedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function recentCustomTourBookingsIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.recentCustomTourBookingsMade.index')
            ->with('tourOperator',$tourOperator);
    }
    public function nearCustomTourIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.nearCustomTours.index')
            ->with('tourOperator',$tourOperator);
    }
    public function expiredCustomTourBookingsIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.expiredCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        $tourOperatorSafariPreferenceId=DB::table('tour_operator_touristic_attraction')->where('tour_operator_id',$tourOperator->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::whereIn('id',$tourOperatorSafariPreferenceId)->pluck('attraction_name','id');
        return view('TourOperator.customTourBookings.create')
            ->with('tourOperatorSafariPreferences',$tourOperatorSafariPreferences)
            ->with('tourOperator',$tourOperator);
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
            'tourist_name'=>'required',
            'tourist_email_address'=>'required',
            'tourist_country'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'start_date'=>'required',
            'end_date'=>'required',
            'total_adult_travellers'=>'required',
            'total_children_travellers'=>'required',
            'message'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $customTourBookingsRepository=new customTourBookingsRepository();
        $customTourBookings=$customTourBookingsRepository->storeCustomTourBookings($input);
        return back()->with('customTourBookings',$customTourBookings)->withFlashSuccess('Thank you for requesting custom safari, this tour operator will reach out to you soon');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($custom_tour_booking_id)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$custom_tour_booking_id)->first();
        return view('TourOperator.customTourBookings.view')
            ->with('customTourBooking',$customTourBooking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($customTourBookingId)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBookingId)->first();
        $tourist_attractions=touristicAttractions::query()->where('status','=',1)->pluck('attraction_name','id');
        $customTourBookingTouristAttractionsId=DB::table('custom_tour_booking_tourist_attraction')->where('custom_tour_booking_id',$customTourBooking->id)->pluck('tourist_attraction_id');
        return view('TourOperator.customTourBookings.edit')
            ->with('tourist_attractions',$tourist_attractions)
            ->with('customTourBookingTouristAttractionsId',$customTourBookingTouristAttractionsId)
            ->with('customTourBooking',$customTourBooking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customTourBooking)
    {
        $validator=Validator::make($request->all(),[
            'tourist_name'=>'required',
            'tourist_email_address'=>'required',
            'tourist_country'=>'required',
            'tourist_phone_number'=>'required|regex:/^[0-9]{10}$/',
            'start_date'=>'required',
            'end_date'=>'required',
            'total_adult_travellers'=>'required',
            'total_children_travellers'=>'required',
            'message'=>'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $customTourBookingRepo=new customTourBookingsRepository();
        $customTourBooking=$customTourBookingRepo->updateCustomTourBooking($input,$customTourBooking);
        return back()->withFlashSuccess('The custom tour is successfully updated')->with('customTourBooking',$customTourBooking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customTourBooking)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBooking)->first();
        $customTourBooking->delete();
        return back()->withFlashSuccess('Custom booking deleted successfully');
    }
    public function DeletedCustomBookingsIndex($tourOperatorId)
    {
        $tourOperator=tourOperator::query()->where('uuid',$tourOperatorId)->first();
        return view('TourOperator.customTourBookings.deletedCustomTourBookings.index')
            ->with('tourOperator',$tourOperator);
    }
    public function RestoreDeletedCustomBooking($customTourBookingId)
    {
        $customBooking=customTourBookings::onlyTrashed()->where('uuid',$customTourBookingId)->first();
        $customBooking->restore();
        return back()->withFlashSuccess('Custom booking restored successfully');
    }
    public function approveOrUnApproveBooking(Request $request)
    {
        $customTourBooking=customTourBookings::find($request->id);
        $status=$customTourBooking->status;
        switch ($status)
        {
            case 0:
                $customTourBooking->status=1;
                break;
            case 1:
                $customTourBooking->status=0;
                break;
        }
        $customTourBooking->save();
    }
    public function getCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
               if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
               {
                   return '<span class="badge badge-primary">No</span>';
               }
               else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
               {
                   return '<span class="badge badge-info">Expired today</span>';
               }
               else
               {
                   return '<span class="badge badge-danger">Yes</span>';
               }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getApprovedCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('status','=',1)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getUnApprovedCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('status','=',0)->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getRecentCustomTourBookingsMade($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getNearCustomTours($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->whereBetween('start_date',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getExpiredCustomTourBookings($tourOperatorId)
    {
        $customTourBookings=customTourBookings::query()->where('tour_operator_id',$tourOperatorId)->where('start_date','<=',Carbon::now())->orderBy('tourist_name')->get();
        return DataTables::of($customTourBookings)
            ->addIndexColumn()
            ->addColumn('booking_date_and_time',function ($customTourBookings){
                return date('jS M Y, H:m:s',strtotime($customTourBookings->created_at));
            })
            ->addColumn('company_booked',function ($customTourBookings){
                return $customTourBookings->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($customTourBookings){
                return $customTourBookings->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($customTourBookings){
                return $customTourBookings->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($customTourBookings){
                return $customTourBookings->tourist_phone_number;
            })
            ->addColumn('tourDuration',function ($customTourBookings){
                return $customTourBookings->CustomTourDurationLabel;
            })
            ->addColumn('countDownDaysForCustomTour',function ($customTourBookings){
                return $customTourBookings->CountDownDaysForACustomTourLabel;
            })
            ->addColumn('start_date',function ($customTourBookings){
                return date('jS M Y',strtotime($customTourBookings->start_date));
            })
            ->addColumn('end_date',function ($customTourBookings){
                return date('jS M Y', strtotime($customTourBookings->end_date));
            })
            ->addColumn('isSafariExpired',function ($customTourBookings){
                if ($customTourBookings->CountDownDaysForACustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($customTourBookings->CountDownDaysForACustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($customTourBookings){
                return $customTourBookings->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($customTourBookings){
                return $customTourBookings->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($customTourBookings){
                return $customTourBookings->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($customTourBookings){
                return $customTourBookings->total_children_travellers;
            })
            ->addColumn('message',function ($customTourBookings){
                return $customTourBookings->message;
            })
            ->addColumn('approve_or_un_approve_booking',function($customTourBookings){
                $btn='<label class="switch{{$customTourBookings->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('booking_status',function ($customTourBookings){
                return $customTourBookings->bookingStatusLabel;
            })
            ->addColumn('actions',function ($customTourBookings){
                return $customTourBookings->buttonActionLabel;
            })
            ->rawColumns(['actions','tourDuration','isSafariExpired','countDownDaysForCustomTour','tourist_visit_areas','company_booked','booking_status','booking_date_and_time'])
            ->make(true);
    }
    public function getDeletedRecords($tourOperatorId)
    {
        $deletedCustomBooking = customTourBookings::with('tourOperator')
            ->onlyTrashed()
            ->where('tour_operator_id', $tourOperatorId)
            ->get();
        return DataTables::of($deletedCustomBooking)
            ->addIndexColumn()
            ->addColumn('deleted_at',function ($deletedCustomBooking){
                return date('jS M Y, H:m:s',strtotime($deletedCustomBooking->deleted_at));
            })
            ->addColumn('company_booked',function ($deletedCustomBooking){
                return $deletedCustomBooking->tourOperator->company_name;
            })
            ->addColumn('tourist_name',function ($deletedCustomBooking){
                return $deletedCustomBooking->tourist_name;
            })
            ->addColumn('tourist_email_address',function ($deletedCustomBooking){
                return $deletedCustomBooking->tourist_email_address;
            })
            ->addColumn('tourist_phone_number',function ($deletedCustomBooking){
                return $deletedCustomBooking->tourist_phone_number;
            })
            ->addColumn('DeletedCustomTourDurationLabel',function ($deletedCustomBooking){
                return $deletedCustomBooking->DeletedCustomTourDurationLabel;
            })
            ->addColumn('CountDownDaysForADeletedCustomTourLabel',function ($deletedCustomBooking){
                return $deletedCustomBooking->CountDownDaysForADeletedCustomTourLabel;
            })
            ->addColumn('start_date', function ($deletedCustomBooking) {
                return date('jS M Y', strtotime($deletedCustomBooking->start_date));
            })
            ->addColumn('end_date',function ($deletedCustomBooking){
                return date('jS M Y', strtotime($deletedCustomBooking->end_date));
            })
            ->addColumn('isDeletedSafariExpired',function ($deletedCustomBooking){
                if ($deletedCustomBooking->CountDownDaysForADeletedCustomTourLabel>=1)
                {
                    return '<span class="badge badge-primary">No</span>';
                }
                else if ($deletedCustomBooking->CountDownDaysForADeletedCustomTourLabel==0)
                {
                    return '<span class="badge badge-info">Expired today</span>';
                }
                else
                {
                    return '<span class="badge badge-danger">Yes</span>';
                }
            })
            ->addColumn('tourist_visit_areas',function ($deletedCustomBooking){
                return $deletedCustomBooking->CustomTourBookingTouristAttractionLabel;
            })
            ->addColumn('tourist_country',function ($deletedCustomBooking){
                return $deletedCustomBooking->tourist_country;
            })
            ->addColumn('total_adult_travellers',function ($deletedCustomBooking){
                return $deletedCustomBooking->total_adult_travellers;
            })
            ->addColumn('total_children_travellers',function ($deletedCustomBooking){
                return $deletedCustomBooking->total_children_travellers;
            })
            ->addColumn('message',function ($deletedCustomBooking){
                return $deletedCustomBooking->message;
            })
            ->addColumn('booking_status',function ($deletedCustomBooking){
                return $deletedCustomBooking->bookingStatusLabel;
            })
            ->addColumn('actions',function ($deletedCustomBooking){
                return $deletedCustomBooking->buttonActionForDeletedBookingLabel;
            })
            ->rawColumns(['actions','isDeletedSafariExpired','CountDownDaysForADeletedCustomTourLabel','company_booked','DeletedCustomTourDurationLabel','booking_status','approve_or_un_approve_booking'])
            ->make(true);
    }
}
