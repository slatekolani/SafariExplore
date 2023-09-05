<?php

namespace App\Repositories\Admin\Nations;

use App\Models\Nations\nations;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class nationsRepository.
 */
class nationsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return nations::class;
    }
    public function storenation(array $input)
    {
        $nation=new nations();
        $nation->nation_name=$input['nation_name'];
        if($input['nation_flag'])
        {
            $file=$input['nation_flag'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/nationFlags/',$filename);
            $nation->nation_flag=$filename;
        }
        $nation->save();
    }
}
