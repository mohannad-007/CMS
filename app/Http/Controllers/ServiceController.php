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
        $serviceImage = str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "",'storage/'. $service->service_image_file);
        return $this->successResponse([
            'id'=>$service->id,
            'company_id'=>$service->company_id,
            'question'=>$service->question,
            'work_image_file'=>asset($serviceImage),
        ], 'Service fetched successfully');
    }

    public function getServiceInfo(){
        $workPlanInfo = ServiceInfo::get();
        return $this->successResponse($workPlanInfo, 'ServiceInfo fetched successfully');
    }
}
