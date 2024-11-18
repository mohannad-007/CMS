<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class AboutCompany extends Model
{
    use HasTranslations,HasFactory;
    protected $guarded=[];

    public array $translatable = [
        'question',
    ];

    public $casts = [
        'question'=>'array',
    ];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function aboutCompanyInfo() : HasMany
    {
        return $this->hasMany(AboutCompanyInfo::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($aboutCompany) {
            if (!$aboutCompany->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $aboutCompany->company_id = $company ? $company->id : null;
            }
        });
    }

}
