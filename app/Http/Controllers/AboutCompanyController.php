<?php

namespace App\Http\Controllers;

use App\Models\AboutCompany;
use App\Models\AboutCompanyInfo;
use App\Models\AboutDetails;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;

class AboutCompanyController extends Controller
{
    use RespondsWithStatus;

    public function getAboutCompany(){
        $aboutCompany = AboutCompany::first();
        return $this->successResponse($aboutCompany, 'About Company fetched successfully');
    }

    public function getAboutCompanyInfo(){
        $aboutCompanyInfo = AboutCompanyInfo::get();
        return $this->successResponse($aboutCompanyInfo, 'About Company fetched successfully');
    }
    public function getAboutDetails(){
        $aboutCompanyDetails = AboutDetails::get();
        return $this->successResponse($aboutCompanyDetails, 'About Company Details fetched successfully');
    }
}
