<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

class ContactUsController extends Controller
{
    use RespondsWithStatus;

    public function creatContactUs(ContactUsRequest $request){
        $contactUs = ContactUs::create([
           'rate'=> $request->rate,
           'information_problem'=>json_encode($request->information_problem),
           'email'=>json_encode($request->email),
        ]);
//        $contactUs2 = json_decode($contactUs->information_problem,true);

        return $this->resourceCreatedResponse([
            'rate'=> $contactUs->rate,
            'information_problem'=> json_decode($contactUs->information_problem,true),
            'email'=> json_decode($contactUs->email,true),
        ],'Contact Us created successfully');
    }
}
