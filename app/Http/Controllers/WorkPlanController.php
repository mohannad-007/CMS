<?php

namespace App\Http\Controllers;

use App\Models\WorkPlan;
use App\Models\WorkPlanInfo;
use App\Traits\RespondsWithStatus;
use Illuminate\Http\Request;

class WorkPlanController extends Controller
{
    use RespondsWithStatus;

    public function getWorkPlan(){
        $workPlan = WorkPlan::first();
        $workPlanImage = str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "",'http://127.0.0.1:8000/storage/'. $workPlan->work_image_file );
        $workPlan->work_image_file= $workPlanImage;
        return $this->successResponse($workPlan, 'WorkPlan fetched successfully');
    }

    public function WorkPlanInfo(){
        $workPlanInfo = WorkPlanInfo::get();
        return $this->successResponse($workPlanInfo, 'WorkPlanInfo fetched successfully');
    }


}
