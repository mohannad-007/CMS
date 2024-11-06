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
        $workPlanImage = str_replace("C:\\Users\\m.lababidi\\Desktop\\AL-Naweia\\public\\", "",'storage/'. $workPlan->work_image_file );
        return $this->successResponse([
            'id'=>$workPlan->id,
            'company_id'=>$workPlan->company_id,
            'work_image_file'=>asset($workPlanImage),
            'section_title'=>$workPlan->section_title,
        ], 'WorkPlan fetched successfully');
    }

    public function WorkPlanInfo(){
        $workPlanInfo = WorkPlanInfo::get();
        return $this->successResponse($workPlanInfo, 'WorkPlanInfo fetched successfully');
    }


}
