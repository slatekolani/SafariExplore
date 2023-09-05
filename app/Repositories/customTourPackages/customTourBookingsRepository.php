<?php

namespace App\Repositories\customTourPackages;

use App\Models\TourOperator\customTourBookings\customTourBookings;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class customTourBookingsRepository.
 */
class customTourBookingsRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return customTourBookings::class;
    }

    public function storeCustomTourBookings(array $input)
    {
        $customTourBookings=new customTourBookings();
        $customTourBookings->tourist_name=$input['tourist_name'];
        $customTourBookings->tourist_email_address=$input['tourist_email_address'];
        $customTourBookings->tourist_country=$input['tourist_country'];
        $customTourBookings->tourist_phone_number=$input['tourist_phone_number'];
        $customTourBookings->start_date=$input['start_date'];
        $customTourBookings->end_date=$input['end_date'];
        $customTourBookings->total_adult_travellers=$input['total_adult_travellers'];
        $customTourBookings->total_children_travellers=$input['total_children_travellers'];
        $customTourBookings->message=$input['message'];
        $customTourBookings->tour_operator_id=$input['tour_operator_id'];
        $customTourBookings->save();
        $customTourBookings->getCustomTourBookingTouristAttractions($input,$customTourBookings);
    }

    public function updateCustomTourBooking(array $input, $customTourBooking)
    {
        $customTourBooking=customTourBookings::query()->where('uuid',$customTourBooking)->first();
        $customTourBooking->tourist_name=$input['tourist_name'];
        $customTourBooking->tourist_email_address=$input['tourist_email_address'];
        $customTourBooking->tourist_country=$input['tourist_country'];
        $customTourBooking->tourist_phone_number=$input['tourist_phone_number'];
        $customTourBooking->start_date=$input['start_date'];
        $customTourBooking->end_date=$input['end_date'];
        $customTourBooking->total_adult_travellers=$input['total_adult_travellers'];
        $customTourBooking->total_children_travellers=$input['total_children_travellers'];
        $customTourBooking->message=$input['message'];
        $customTourBooking->tour_operator_id=$input['tour_operator_id'];
        $customTourBooking->save();
        $customTourBooking->getCustomTourBookingTouristAttractions($input,$customTourBooking);
    }
}
