<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class WorkPlan extends Model
{
    protected $guarded=[];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    public function workPlanInf() : HasMany
    {
        return $this->hasMany(WorkPlanInfo::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($workPlan) {
            if (!$workPlan->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $workPlan->company_id = $company ? $company->id : null;
            }
        });
    }

    protected static function booted()
    {
        static::deleting(function ($workPlan) {
            if ($workPlan->work_image_file && Storage::disk('public')->exists($workPlan->work_image_file)) {
                Storage::disk('public')->delete($workPlan->work_image_file);
            }
        });

        static::updating(function ($workPlan) {
            if ($workPlan->isDirty('work_image_file')) {
                $oldWorkPlan = $workPlan->getOriginal('work_image_file');
                if ($oldWorkPlan && Storage::disk('public')->exists($oldWorkPlan)) {
                    Storage::disk('public')->delete($oldWorkPlan);
                }
            }
        });
    }
}
