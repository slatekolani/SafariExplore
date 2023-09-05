<?php

namespace App\Models\Nations;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Model;

class nations extends BaseModel
{
    protected $table='nations';
    protected $guarded=['uuid'];

    public function getNationFlagLabelAttribute()
    {
        return url('public/nationFlags/',$this->nation_flag);
    }
    public function getNationStatusLabelAttribute()
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
        }
    }
    public function getButtonActionsLabelAttribute()
    {
        $btn='<a href="'.route('nations.delete',$this->uuid).'" class="btn btn-danger btn-sm">Delete</a>';
        $btn=$btn.'<a href="#" class="btn btn-primary btn-sm">Edit</a>';
        return $btn;
    }
}
