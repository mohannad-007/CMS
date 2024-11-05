<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $guarded=[];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function serviceInfo():HasMany
    {
        return $this->hasMany(ServiceInfo::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (!$service->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $service->company_id = $company ? $company->id : null;
            }
        });
    }

    protected static function booted()
    {
        static::deleting(function ($service) {
            if ($service->service_image_file && Storage::disk('public')->exists($service->service_image_file)) {
                Storage::disk('public')->delete($service->service_image_file);
            }
        });

        static::updating(function ($service) {
            if ($service->isDirty('service_image_file')) {
                $oldservice = $service->getOriginal('service_image_file');
                if ($oldservice && Storage::disk('public')->exists($oldservice)) {
                    Storage::disk('public')->delete($oldservice);
                }
            }
        });
    }


}
