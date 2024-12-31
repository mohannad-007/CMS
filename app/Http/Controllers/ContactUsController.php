<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use App\Models\User;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\json;

class ContactUsController extends Controller
{
    use RespondsWithStatus;

    public function creatContactUs(ContactUsRequest $request){
        $email = User::first();
        $data=[
            'rate'               => $request->rate,
            'information_problem'=>$request->information_problem,
            'email'              =>$request->email,
        ];
        Mail::to($email->email)->send(new ContactUsMail($data));
        $contactUs = ContactUs::create([
            'rate'               =>$data['rate'],
            'information_problem'=>$data['information_problem'],
            'email'              =>$data['email'],
        ]);
        return $this->resourceCreatedResponse(
            $contactUs,
            'Contact Us created successfully'
        );
    }
}
