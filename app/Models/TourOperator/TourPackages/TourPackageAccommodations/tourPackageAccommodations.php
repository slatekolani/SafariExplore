<?php

namespace App\Models\TourOperator\TourPackages\TourPackageAccommodations;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackages;
use Illuminate\Database\Eloquent\Model;

class tourPackageAccommodations extends BaseModel
{
    protected $table='tour_package_accommodations';
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
