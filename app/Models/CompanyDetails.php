<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CompanyDetails extends Model
{
    use HasTranslations;
    protected $guarded=[];

    public array $translatable = [
        'header',
        'information',
    ];

    public $casts = [
        'header'=>'array',
        'information'=>'array',
    ];

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
}
