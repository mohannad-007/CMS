<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyDetails;
use App\Models\Logo;
use App\Models\Slider;
use App\Models\SocialLinks;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use RespondsWithStatus;

    public function getMyCompany(){
        $company = Company::with('user')->get();
//        $company = Company::get();
//        $jsonFormat=json_decode($company);
        return $this->successResponse($company, 'Company fetched successfully');
    }
    public function getlogo(){
        $logo=Logo::first();
        $logoPath=str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "", 'storage/'.$logo->logo_file);
        return $this->successResponse([
            'id'=>$logo->id,
            'company_id'=>$logo->company_id,
            'name'=>$logo->name,
            'LogoFile'=>asset($logoPath),
            'created_at'=>$logo->created_at,
            'updated_at'=>$logo->updated_at,
        ], 'Logo fetched successfully');
    }

    public function getSliders(){
        $slider=Slider::get();
        $sliderData=[];
        foreach ($slider as $sliders){
            $sliderPath=str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "", 'storage/'.$sliders->slider_file);
            $sliderData[]=[
                'id'=>$sliders->id,
                'company_id'=>$sliders->company_id,
                'SliderFile'=>asset($sliderPath),
                'created_at'=>$sliders->created_at,
                'updated_at'=>$sliders->updated_at,
            ];
        }
        return $this->successResponse($sliderData, 'Sliders fetched successfully') ;
    }
    public function getSocialLink(){
        $socilaLink = SocialLinks::get();
        return $this->successResponse($socilaLink, 'SocialLink fetched successfully');
    }
    public function getCompanyDetails(){
        $companyDetails = CompanyDetails::get();
        return $this->successResponse($companyDetails, 'CompanyDetails fetched successfully');
    }
}
