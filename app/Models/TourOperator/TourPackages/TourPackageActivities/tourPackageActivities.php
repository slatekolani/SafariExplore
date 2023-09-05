<?php

namespace App\Models\TourOperator\TourPackages\TourPackageActivities;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackages;
use Illuminate\Database\Eloquent\Model;

class tourPackageActivities extends BaseModel
{
    protected $table='tour_package_activities';
    protected $guarded=['uuid'];

    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
    public function TourPackages()
    {
        return $this->belongsTo(TourPackages::class);
    }
}
