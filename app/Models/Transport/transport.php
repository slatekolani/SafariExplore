<?php

namespace App\Models\Transport;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;
use Illuminate\Database\Eloquent\Model;

class transport extends BaseModel
{
    protected $table='transports';
    protected $guarded=['uuid'];

    public function tourOperatorsBlogs()
    {
        return $this->belongsToMany(tourOperatorsBlogs::class);
    }
    public function getTransportStatusLabelAttribute()
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
}
