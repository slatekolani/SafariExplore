<?php

namespace App\Models\TourOperator;

use App\Models\Auth\User;
use App\Models\BaseModel\BaseModel;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\customTourBookings\customTourBookings;
use App\Models\TourOperator\TourPackages\TourPackageAccommodations\tourPackageAccommodations;
use App\Models\TourOperator\TourPackages\TourPackageActivities\tourPackageActivities;
use App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings;
use App\Models\TourOperator\TourPackages\TourPackageFeatures\tourPackageFeatures;
use App\Models\TourOperator\TourPackages\TourPackages;
use App\Models\TourOperator\TourPackages\TourPackageTrips\tourPackageTrips;
use App\Models\TourOperatorsBlogs\BlogAttractions\tourOperatorsBlogAttractions;
use App\Models\TourOperatorsBlogs\BlogService\tourOperatorBlogServices;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class tourOperator extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_operator';
    protected $guarded=['uuid'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function customTourBookings()
    {
        return $this->hasMany(customTourBookings::class);
    }
    public function tourOperatorsBlogs()
    {
        return $this->hasMany(tourOperatorsBlogs::class);
    }
    public function tourOperatorBlogServices()
    {
        return $this->hasMany(tourOperatorBlogServices::class);
    }
    public function tourOperatorsBlogAttractions()
    {
        return $this->hasMany(tourOperatorsBlogAttractions::class);
    }
    public function TourPackages()
    {
        return $this->hasMany(TourPackages::class);
    }
    public function tourPackageFeatures()
    {
        return $this->hasMany(tourPackageFeatures::class);
    }

    public function tourPackageActivities()
    {
        return $this->hasMany(tourPackageActivities::class);
    }
    public function tourPackageAccommodations()
    {
        return $this->hasMany(tourPackageAccommodations::class);
    }
    public function tourPackageTrips()
    {
        return $this->hasMany(tourPackageTrips::class);
    }
    public function tourPackageBookings()
    {
        return $this->hasMany(tourPackageBookings::class);
    }
    public function tourOperatorSafariAreaPreferences()
    {
        return $this->belongsToMany(tourOperator::class,'tour_operator_touristic_attraction','tour_operator_id','touristic_attraction_id');
    }
    public function getCompanyLogoLabelAttribute()
    {
        return url('public/TourOperatorsLogos/'.$this->company_logo);
    }
    public function getTourCompanyStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-warning">Inactive</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Active</span>';
                break;
            default:
                return '<span class="badge badge-danger">Unidentified company</span>';
                break;
        }
    }
    public function getTourCompanyButtonActionsLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                 $btn='<a href="'.route('tourOperator.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                 return $btn;
                 break;
            case 1:
                $btn='<a href="'.route('tourOperator.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                $btn=$btn.'<a href="'.route('tourPackages.index',$this->uuid).'" class="btn btn-primary btn-sm">Tour Packages</a>';
                $btn=$btn.'<a href="'.route('customTourBookings.index',$this->uuid).'" class="btn btn-primary btn-sm">Custom Bookings</a>';
                return $btn;
                break;
        }
    }
    public function getButtonActionsForDeletedTourCompaniesLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('tourOperator.restoreDeletedTourCompany',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            case 1:
                $btn='<a href="'.route('tourOperator.restoreDeletedTourCompany',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            default:
                $btn='<a href="'.route('tourOperator.restoreDeletedTourCompany',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
        }
    }

    public function getTourCompanyButtonActionsAsAdminLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('tourOperator.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
                break;
            case 1:
                $btn='<a href="'.route('tourOperator.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                $btn=$btn.'<a href="'.route('tourPackages.index',$this->uuid).'" class="btn btn-primary btn-sm">Tour Packages</a>';
                $btn=$btn.'<a href="'.route('customTourBookings.index',$this->uuid).'" class="btn btn-primary btn-sm">Custom Bookings</a>';
                return $btn;
                break;
        }
    }
    public function getTourOperatorSafariAreaPreferences(array $input, Model $tourOperatorCompany)
    {
        $tourOperatorSafariAreaPreferencesArray=[];
        foreach ($input as $key =>$value)
        {
            switch ($key)
            {
                case 'safari_area_preferences':
                    $tourOperatorSafariAreaPreferencesArray=$value;
                    break;
            }
        }
        $tourOperatorCompany->tourOperatorSafariAreaPreferences()->sync($tourOperatorSafariAreaPreferencesArray);
    }
    public function getTourOperatorSafariPreferencesLabelAttribute()
    {
        $tourOperatorSafariPreferenceId=DB::table('tour_operator_touristic_attraction')->where('tour_operator_id',$this->id)->pluck('touristic_attraction_id');
        $tourOperatorSafariPreferences=touristicAttractions::whereIn('id',$tourOperatorSafariPreferenceId)->get();
        $label=[];
        foreach ($tourOperatorSafariPreferences as $tourOperatorSafariPreference)
        {
            array_push($label,$tourOperatorSafariPreference->attraction_name);
        }
        return implode(',',$label);
    }

    public function getTotalTourPackagesPostedLabelAttribute()
    {
        $totalTourPackages=TourPackages::query()->where('tour_operator_id',$this->id)->count();
        return $totalTourPackages;
    }
    public function getTotalRecentTourPackagesPostedLabelAttribute()
    {
        $totalRecentTourPackages=TourPackages::query()->where('tour_operator_id',$this->id)->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        return $totalRecentTourPackages;
    }
    public function getTotalVerifiedTourPackagesPostedLabelAttribute()
    {
        $totalVerifiedTourPackages=TourPackages::query()->where('tour_operator_id',$this->id)->where('status','=',1)->count();
        return $totalVerifiedTourPackages;
    }
    public function getTotalUnVerifiedTourPackagesPostedLabelAttribute()
    {
        $totalUnVerifiedTourPackages=TourPackages::query()->where('tour_operator_id',$this->id)->where('status','=',0)->count();
        return $totalUnVerifiedTourPackages;
    }
    public function getTotalNearToursLabelAttribute()
    {
        $tourPackagesNearTours=TourPackages::query()->where('tour_operator_id',$this->id)->whereBetween('safari_start_date',[carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
        return $tourPackagesNearTours;
    }
    public function getTotalExpiredTourPackagesLabelAttribute()
    {
        $tourPackagesExpired=DB::table('tour_package')->where('tour_operator_id',$this->id)->where('safari_start_date','<=',[Carbon::now()])->count();
        return $tourPackagesExpired;
    }
    public function getTotalDeletedTourPackagesLabelAttribute()
    {
        $totalPackagesDeleted=TourPackages::onlyTrashed()->where('tour_operator_id',$this->id)->count();
        return $totalPackagesDeleted;
    }

    public function getTotalCustomTourBookingsLabelAttribute()
    {
        $totalCustomTourBookings=customTourBookings::query()->where('tour_operator_id',$this->id)->count();
        return $totalCustomTourBookings;
    }
    public function getTotalApprovedCustomTourBookingsLabelAttribute()
    {
        $totalApprovedCustomTourBookings=customTourBookings::query()->where('tour_operator_id',$this->id)->where('status','=',1)->count();
        return $totalApprovedCustomTourBookings;
    }
    public function getTotalUnApprovedCustomTourBookingsLabelAttribute()
    {
        $totalUnApprovedCustomTourBookings=customTourBookings::query()->where('tour_operator_id',$this->id)->where('status','=',0)->count();
        return $totalUnApprovedCustomTourBookings;
    }
    public function getTotalRecentCustomTourBookingsLabelAttribute()
    {
        $totalRecentCustomTourBookings=customTourBookings::query()->where('tour_operator_id',$this->id)->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        return $totalRecentCustomTourBookings;
    }
    public function getTotalNearCustomToursLabelAttribute()
    {
        $totalNearCustomTours=customTourBookings::query()->where('tour_operator_id',$this->id)->whereBetween('start_date',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])->count();
        return $totalNearCustomTours;
    }
    public function getTotalExpiredCustomTourBookingsLabelAttribute()
    {
        $totalExpiredCustomTourBookings=customTourBookings::query()->where('tour_operator_id',$this->id)->where('start_date','<=',Carbon::now())->count();
        return $totalExpiredCustomTourBookings;
    }
    public function getTotalRetrievedDeletedCustomBookingsLabelAttribute()
    {
        $totalRetrievedDeletedCustomBookings=customTourBookings::onlyTrashed()->where('tour_operator_id',$this->id)->count();
        return $totalRetrievedDeletedCustomBookings;
    }

}
