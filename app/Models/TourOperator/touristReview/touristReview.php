<?php

namespace App\Models\TourOperator\touristReview;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\TourPackages\TourPackageBookings\tourPackageBookings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class touristReview extends BaseModel
{
    use SoftDeletes;

    protected $table='tourist_reviews';
    protected $guarded=['uuid'];

    public function tourPackageBookings()
    {
        return $this->belongsTo(tourPackageBookings::class);
    }
    public function getReviewStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-info">Un Approved</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Approved + public</span>';
                break;
            default:
                return '<span class="badge badge-info">Un Approved</span>';
                break;
        }
    }
    public function getTouristReviewButtonActionsLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                 $btn='<a href="'.route('touristReview.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                 $btn=$btn.'<a href="'.route('touristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
                 return $btn;
            case 1:
                $btn='<a href="'.route('touristReview.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                $btn=$btn.'<a href="'.route('touristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
                return $btn;
            default:
                $btn='<a href="'.route('touristReview.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
                $btn=$btn.'<a href="'.route('touristReview.view',$this->uuid).'" class="btn btn-primary btn-sm">View</a>';
                return $btn;
        }
    }
    public function getDeletedTouristReviewButtonActionsLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                $btn='<a href="'.route('touristReview.restoreDeletedTouristReviews',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            case 1:
                $btn='<a href="'.route('touristReview.restoreDeletedTouristReviews',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
            default:
                $btn='<a href="'.route('touristReview.restoreDeletedTouristReviews',$this->uuid).'" class="btn btn-warning btn-sm">Restore</a>';
                return $btn;
        }
    }
}
