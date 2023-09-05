<?php

namespace App\Models\TouristicAttractions;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;

class touristicAttractions extends BaseModel
{
    protected $table='touristic_attractions';
    protected $guarded=['uuid'];

    public function getAttractionStatusLabelAttribute()
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
                return '<span class="badge badge-danger">Unidentified</span>';
                break;
        }
    }
    public function getButtonActionLabelAttribute()
    {
        $btn='<a href="'.route('touristicAttractions.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        $btn=$btn.'<a href="#" class="btn btn-primary btn-sm">Edit</a>';
        return $btn;
    }
}
