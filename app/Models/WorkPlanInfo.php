<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkPlanInfo extends Model
{
    protected $guarded=[];

    public function workPlan() : BelongsTo
    {
        return $this->belongsTo(WorkPlan::class,'workPlan_id');
    }

//    public static function boot()
//    {
//        parent::boot();
//
//        static::creating(function ($workPlanInfo) {
//            if (!$workPlanInfo->workPlan_id) {
//                $company = Company::where('user_id', auth()->id())->first();
//                $workPlan= WorkPlan::where($company->id , 'company_id')->first();
//                $workPlanInfo->workPlan_id  = $workPlan ? $workPlan->id : null;
//            }
//        });
//    }

}
