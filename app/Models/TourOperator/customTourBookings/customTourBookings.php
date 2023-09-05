<?php

namespace App\Models\TourOperator\customTourBookings;

use App\Models\BaseModel\BaseModel;
use App\Models\TouristicAttractions\touristicAttractions;
use App\Models\TourOperator\tourOperator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class customTourBookings extends BaseModel
{
    use SoftDeletes;
    protected $table='custom_tour_bookings';
    protected $guarded=['uuid'];
    protected $dates=['deleted_at'];
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function customTourBookingTouristAttractions()
    {
        return $this->belongsToMany(customTourBookings::class,'custom_tour_booking_tourist_attraction','custom_tour_booking_id','tourist_attraction_id');
    }
    public function getBookingStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-info">Un-Approved</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Approved</span>';
                break;
            default:
                return '<span class="badge badge-danger">Unknown</span>';
                break;
        }
    }
    public function getButtonActionLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('customTourBookings.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
            case 1:
                $btn='<a href="'.route('customTourBookings.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                return $btn;
        }
    }
    public function getButtonActionForDeletedBookingLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('customTourBookings.RestoreDeletedCustomBooking',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            case 1:
                $btn='<a href="'.route('customTourBookings.RestoreDeletedCustomBooking',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            default:
                $btn='<a href="'.route('customTourBookings.RestoreDeletedCustomBooking',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
        }
    }
    public function getCustomTourBookingTouristAttractions(array $input, Model $customTourBooking)
    {
        $CustomTourBookingTouristAttractionsArray=[];
        foreach($input as $key =>$value)
        {
            switch ($key)
            {
                case 'tourist_visit_areas':
                    $CustomTourBookingTouristAttractionsArray=$value;
                    break;
            }
        }
        $customTourBooking->customTourBookingTouristAttractions()->sync($CustomTourBookingTouristAttractionsArray);
    }
    public function getCustomTourBookingTouristAttractionLabelAttribute()
    {
        $customTourBookingsTouristAttractionId=DB::table('custom_tour_booking_tourist_attraction')->where('custom_tour_booking_id',$this->id)->pluck('tourist_attraction_id');
        $customTourBookingsTouristAttractions=touristicAttractions::whereIn('id',$customTourBookingsTouristAttractionId)->get();
        $label=[];
        foreach ($customTourBookingsTouristAttractions as $customTourBookingsTouristAttraction)
        {
            array_push($label,$customTourBookingsTouristAttraction->attraction_name);
        }
        return implode(',',$label);
    }
    public function getCountDownDaysForACustomTourLabelAttribute()
    {
        $customTourBooking=customTourBookings::find($this->id);
        $today=Carbon::now();
        $startDate=$customTourBooking->start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%R%d');
    }
    public function getCountDownDaysForADeletedCustomTourLabelAttribute()
    {
        $customTourBooking=customTourBookings::onlyTrashed()->find($this->id);
        $today=Carbon::now();
        $startDate=$customTourBooking->start_date;
        $dateTime1=new \DateTime($today);
        $dateTime2=new \DateTime($startDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%R%d');
    }
    public function getCustomTourDurationLabelAttribute()
    {
        $customTourBooking=customTourBookings::find($this->id);
        $startDate=$customTourBooking->start_date;
        $endDate=$customTourBooking->end_date;
        $dateTime1=new \DateTime($startDate);
        $dateTime2=new \DateTime($endDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%d');
    }
    public function getDeletedCustomTourDurationLabelAttribute()
    {
        $customTourBooking=customTourBookings::onlyTrashed()->find($this->id);
        $startDate=$customTourBooking->start_date;
        $endDate=$customTourBooking->end_date;
        $dateTime1=new \DateTime($startDate);
        $dateTime2=new \DateTime($endDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%d');
    }
}
