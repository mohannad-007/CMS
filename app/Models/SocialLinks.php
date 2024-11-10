<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class SocialLinks extends Model
{
    use HasTranslations;
    protected $guarded=[];

    public array $translatable = [
        'platform',
        'url',
    ];

    public $casts = [
        'platform'=>'array',
        'url'=>'array',
    ];
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($socialLink) {
            if (!$socialLink->company_id) {
                $company = Company::where('user_id', auth()->id())->first();
                $socialLink->company_id = $company ? $company->id : null;
            }
        });
    }
}
