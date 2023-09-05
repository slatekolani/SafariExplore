<?php

namespace App\Repositories\TourOperator;

use App\Http\Requests\Request;
use App\Models\TourOperator\tourOperator;
use Illuminate\Support\Facades\Validator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class tourOperatorRepository.
 */
class tourOperatorRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return tourOperator::class;
    }
    public function construct()
    {

    }

    public function storetourOperatorInformation(array $input)
    {
        $tourOperatorCompany=new tourOperator();
        $tourOperatorCompany->company_name=$input['company_name'];
        $tourOperatorCompany->email_address=$input['email_address'];
        $tourOperatorCompany->phone_number=$input['phone_number'];
        $tourOperatorCompany->website_url=$input['website_url'];
        $tourOperatorCompany->instagram_url=$input['instagram_url'];
        $tourOperatorCompany->whatsapp_url=$input['whatsapp_url'];
        $tourOperatorCompany->gps_url=$input['gps_url'];
        $tourOperatorCompany->company_nation=$input['company_nation'];
        $tourOperatorCompany->about_company=$input['about_company'];
        $tourOperatorCompany->users_id=auth()->user()->id;
        if($input['company_logo'])
        {
            $file=$input['company_logo'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TourOperatorsLogos/',$filename);
            $tourOperatorCompany->company_logo=$filename;
        }
        if($input['company_team_image'])
        {
            $file=$input['company_team_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/CompaniesTeamImage/',$filename);
            $tourOperatorCompany->company_team_image=$filename;
        }
        if($input['verification_certificate'])
        {
            $file=$input['verification_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/VerificationCertificates/',$filename);
            $tourOperatorCompany->verification_certificate=$filename;
        }
        if($input['terms_and_conditions'])
        {
            $file=$input['terms_and_conditions'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/companyTermsAndConditions/',$filename);
            $tourOperatorCompany->terms_and_conditions=$filename;
        }
        $tourOperatorCompany->save();
        $tourOperatorCompany->getTourOperatorSafariAreaPreferences($input,$tourOperatorCompany);
    }
    public function updatetourOperatorInformation(array $input,$tour_operator_company_id)
    {
        $tourOperatorCompany=tourOperator::query()->where('uuid',$tour_operator_company_id)->first();
        $tourOperatorCompany->company_name=$input['company_name'];
        $tourOperatorCompany->email_address=$input['email_address'];
        $tourOperatorCompany->phone_number=$input['phone_number'];
        $tourOperatorCompany->website_url=$input['website_url'];
        $tourOperatorCompany->instagram_url=$input['instagram_url'];
        $tourOperatorCompany->whatsapp_url=$input['whatsapp_url'];
        $tourOperatorCompany->gps_url=$input['gps_url'];
        $tourOperatorCompany->company_nation=$input['company_nation'];
        $tourOperatorCompany->about_company=$input['about_company'];
        $tourOperatorCompany->users_id=auth()->user()->id;
        if($input['company_logo'])
        {
            $file=$input['company_logo'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/TourOperatorsLogos/',$filename);
            $tourOperatorCompany->company_logo=$filename;
        }
        if($input['company_team_image'])
        {
            $file=$input['company_team_image'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/CompaniesTeamImage/',$filename);
            $tourOperatorCompany->company_team_image=$filename;
        }
        if($input['verification_certificate'])
        {
            $file=$input['verification_certificate'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/VerificationCertificates/',$filename);
            $tourOperatorCompany->verification_certificate=$filename;
        }
        if($input['terms_and_conditions'])
        {
            $file=$input['terms_and_conditions'];
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('public/companyTermsAndConditions/',$filename);
            $tourOperatorCompany->terms_and_conditions=$filename;
        }
        $tourOperatorCompany->save();
        $tourOperatorCompany->getTourOperatorSafariAreaPreferences($input,$tourOperatorCompany);
    }
}
