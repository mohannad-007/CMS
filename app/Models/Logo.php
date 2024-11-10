<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Logo extends Model
{
//    use HasTranslations;
    protected $guarded=[];

//    public array $translatable = [
//        'name',
////        'logo_file',
//    ];

//    public $casts = [
//        'name'=>'array',
////        'logo_file'=>'array',
//    ];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($logo) {
            if (!$logo->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $logo->company_id = $company ? $company->id : null;
            }
        });
    }

    protected static function booted()
    {
        static::deleting(function ($logo) {
            if ($logo->logo_file && Storage::disk('public')->exists($logo->logo_file)) {
                Storage::disk('public')->delete($logo->logo_file);
            }
        });

        static::updating(function ($logo) {
            if ($logo->isDirty('logo_file')) {
                $oldLogo = $logo->getOriginal('logo_file');
                if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                    Storage::disk('public')->delete($oldLogo);
                }
            }
        });
    }



}
