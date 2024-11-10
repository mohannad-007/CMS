<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceInfo;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use RespondsWithStatus;

    public function getService(){
        $service = Service::first();
        $serviceImage = str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "",'http://127.0.0.1:8000/storage/'. $service->service_image_file);
        $service->service_image_file=$serviceImage;
        return $this->successResponse($service, 'Service fetched successfully');
    }

    public function getServiceInfo(){
        $workPlanInfo = ServiceInfo::get();
        return $this->successResponse($workPlanInfo, 'ServiceInfo fetched successfully');
    }
}
