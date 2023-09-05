<?php

namespace App\Models\TourOperator\TourPackages\TourPackageBookings;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\touristReview\touristReview;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tourPackageBookings extends BaseModel
{
    use SoftDeletes;
    protected $table='tour_package_bookings';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function TourPackages()
    {
        return $this->belongsTo(TourPackages::class);
    }
    public function touristReview()
    {
        return $this->belongsTo(touristReview::class);
    }
    public function getbookingStatusLabelAttribute()
    {
     $status=$this->status;
     switch ($status)
        {
         case 0:
             return '<span class="badge badge-info badge-lg">Unapproved</span>';
             break;
         case 1:
             return '<span class="badge badge-success badge-lg">Approved</span>';
             break;
         default:
             return '<span class="badge badge-danger badge-lg">Unknown request</span>';
             break;
        }
    }
    public function getButtonActionLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('tourPackageBookings.view',$this->uuid).'" style="font-size: 15px">view/edit &blacktriangleright;</a>';
                return $btn;
            case 1:
                $btn='<a href="'.route('tourPackageBookings.view',$this->uuid).'" style="font-size: 15px;">view/edit &blacktriangleright;</a>';
                $btn=$btn.'<a href="'.route('touristReview.index',$this->uuid).'" style="font-size: 15px;">Reviews &blacktriangleright;</a>';
                return $btn;
        }
    }
    public function getTourPriceForForeignerAdultLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $tourPackage=TourPackages::query()->where('id',$tourPackageBooking->tour_package_id)->first();
        $tourPriceForForeignerAdult=$tourPackage->trip_price_adult_foreigner;
        return $tourPriceForForeignerAdult;
    }
    public function getTourPriceForForeignerChildLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $tourPackage=TourPackages::query()->where('id',$tourPackageBooking->tour_package_id)->first();
        $tourPriceForForeignerChild=$tourPackage->trip_price_child_foreigner;
        return $tourPriceForForeignerChild;
    }
    public function getTourPriceForTanzanianChildLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $tourPackage=TourPackages::query()->where('id',$tourPackageBooking->tour_package_id)->first();
        $tourPriceForTanzanianChild=$tourPackage->trip_price_child_tanzanian;
        return $tourPriceForTanzanianChild;
    }
    public function getTourPriceForTanzanianAdultLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $tourPackage=TourPackages::query()->where('id',$tourPackageBooking->tour_package_id)->first();
        $tourPriceForTanzanianAdult=$tourPackage->trip_price_adult_tanzanian;
        return $tourPriceForTanzanianAdult;
    }
    public function getTotalNumberOfAdultTravellersLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $totalNumberOfAdultTravellers=$tourPackageBooking->total_adult_travellers;
        return $totalNumberOfAdultTravellers;
    }
    public function getTotalNumberOfChildTravellersLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('uuid',$this->uuid)->first();
        $totalNumberOfChildrenTravellers=$tourPackageBooking->total_children_travellers;
        return $totalNumberOfChildrenTravellers;
    }
    public function getTourPriceForeignerLabelAttribute()
    {
        $tourPriceForForeignerAdult=$this->getTourPriceForForeignerAdultLabelAttribute();
        $tourPriceForForeignerChild=$this->getTourPriceForForeignerChildLabelAttribute();
        $totalNumberOfAdultTravellers=$this->getTotalNumberOfAdultTravellersLabelAttribute();
        $totalNumberOfChildrenTravellers=$this->getTotalNumberOfChildTravellersLabelAttribute();
        $tourPriceForeigner=($tourPriceForForeignerAdult * $totalNumberOfAdultTravellers) + ($tourPriceForForeignerChild * $totalNumberOfChildrenTravellers);
        return $tourPriceForeigner;
    }
    public function getTourPriceTanzanianLabelAttribute()
    {
        $tourPriceForTanzanianChild=$this->getTourPriceForTanzanianChildLabelAttribute();
        $tourPriceForTanzanianAdult=$this->getTourPriceForTanzanianAdultLabelAttribute();
        $totalNumberOfAdultTravellers=$this->getTotalNumberOfAdultTravellersLabelAttribute();
        $totalNumberOfChildrenTravellers=$this->getTotalNumberOfChildTravellersLabelAttribute();
        $tourPriceTanzanian=($tourPriceForTanzanianAdult * $totalNumberOfAdultTravellers) + ($tourPriceForTanzanianChild * $totalNumberOfChildrenTravellers);
        return $tourPriceTanzanian;
    }
    public function getTotalDaysForTourLabelAttribute()
    {
        $tourPackageBooking=tourPackageBookings::query()->where('tour_package_id',$this->tour_package_id)->first();
        $tourPackage=TourPackages::query()->where('id',$tourPackageBooking->tour_package_id)->first();
        $startDate=$tourPackage->safari_start_date;
        $endDate=$tourPackage->safari_end_date;
        $dateTime1=new \DateTime($startDate);
        $dateTime2=new \DateTime($endDate);
        $interval=$dateTime1->diff($dateTime2);
        return $interval->format('%d');
    }
    public function getTotalTouristReviewsLabelAttribute()
    {
        $totalTouristReviews=touristReview::query()->where('tour_package_booking_id',$this->id)->count();
        return $totalTouristReviews;
    }
    public function getTotalApprovedTouristReviewsLabelAttribute()
    {
        $totalApprovedTouristReviews=touristReview::query()->where('tour_package_booking_id',$this->id)->where('status','=',1)->count();
        return $totalApprovedTouristReviews;
    }
    public function getTotalUnApprovedTouristReviewsLabelAttribute()
    {
        $totalUnApprovedTouristReviews=touristReview::query()->where('tour_package_booking_id',$this->id)->where('status','=',0)->count();
        return $totalUnApprovedTouristReviews;
    }
    public function getTotalDeletedTouristReviewsLabelAttribute()
    {
        $totalDeletedTouristReviews=touristReview::onlyTrashed()->where('tour_package_booking_id',$this->id)->count();
        return $totalDeletedTouristReviews;
    }
}
