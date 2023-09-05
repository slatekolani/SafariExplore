<?php

namespace App\Repositories\Admin\TouristicAttraction;

use App\Models\TouristicAttractions\touristicAttractions;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class touristicAttractionRepository.
 */
class touristicAttractionRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return touristicAttractions::class;
    }
    public function storeTouristicAttractions(array $input)
    {
        $touristicAttraction=new touristicAttractions();
        $touristicAttraction->attraction_name=$input['attraction_name'];
        $touristicAttraction->attraction_description=$input['attraction_description'];
        $touristicAttraction->attraction_category=$input['attraction_category'];
        $touristicAttraction->GPS_url=$input['GPS_url'];
        $touristicAttraction->save();
    }
}
