<?php

namespace App\Models\TourTypes;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Illuminate\Database\Eloquent\Model;

class tourTypes extends BaseModel
{
    protected $table='tour_types';
    protected $guarded=['uuid'];

    public function tourOperatorsBlogs()
    {
        return $this->belongsToMany(tourOperatorsBlogs::class);
    }
    public function gettourTypeStatusLabelAttribute()
    {
        $status=$this->status;
        switch ($status)
        {
            case 0:
                return '<span class="badge badge-warning">Unchecked</span>';
                break;
            case 1:
                return '<span class="badge badge-success">Checked</span>';
                break;
            default:
                return '<span class="badge badge-warning">Unchecked</span>';
                break;
        }
    }
}
