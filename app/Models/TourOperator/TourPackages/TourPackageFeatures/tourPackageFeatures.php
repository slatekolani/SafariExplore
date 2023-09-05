<?php

namespace App\Models\TourOperator\TourPackages\TourPackageFeatures;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperator\tourOperator;
use App\Models\TourOperator\TourPackages\TourPackages;
use Illuminate\Database\Eloquent\Model;

class tourPackageFeatures extends BaseModel
{
    protected $table='tour_package_features';
    protected $guarded=['uuid'];

    public function TourPackages()
    {
        return $this->belongsTo(TourPackages::class);
    }
    public function tourOperator()
    {
        return $this->belongsTo(tourOperator::class);
    }
}
