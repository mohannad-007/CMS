<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use RespondsWithStatus;

    public function creatContactUs(ContactUsRequest $request){
        $contactUs = ContactUs::create([
           'rate'=> $request->rate,
           'information_problem'=> $request->information_problem,
           'email'=>$request->email,
        ]);
        return $this->resourceCreatedResponse($contactUs,'Contact Us created successfully');
    }
}
