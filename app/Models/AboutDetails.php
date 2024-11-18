<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class AboutDetails extends Model
{
    use HasTranslations,HasFactory;
    protected $guarded=[];

    public array $translatable = [
        'title',
        'description',
    ];

    public $casts = [
        'title'=>'array',
        'description'=>'array',
    ];
    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
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

}
