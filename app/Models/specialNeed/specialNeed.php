<?php

namespace App\Models\specialNeed;

use App\Models\BaseModel\BaseModel;
use App\Models\TourOperatorsBlogs\tourOperatorsBlogs;

class specialNeed extends BaseModel
{
    protected $table='special_needs';
    protected $guarded=['uuid'];

    public function tourOperatorsBlogs()
    {
        return $this->belongsToMany(tourOperatorsBlogs::class);
    }
    public function getSpecialNeedStatusLabelAttribute()
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
