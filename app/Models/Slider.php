<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($slider) {
            if (!$slider->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $slider->company_id = $company ? $company->id : null;
            }
        });
    }

    protected static function booted()
    {
        static::deleting(function ($slider) {
            if ($slider->slider_file && Storage::disk('public')->exists($slider->slider_file)) {
                Storage::disk('public')->delete($slider->slider_file);
            }
        });

        static::updating(function ($slider) {
            if ($slider->isDirty('slider_file')) {
                $oldSlider = $slider->getOriginal('slider_file');
                if ($oldSlider && Storage::disk('public')->exists($oldSlider)) {
                    Storage::disk('public')->delete($oldSlider);
                }
            }
        });

    }


}
