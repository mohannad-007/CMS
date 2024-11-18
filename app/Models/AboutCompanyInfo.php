<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class AboutCompanyInfo extends Model
{
    use HasTranslations,HasFactory;
    protected $guarded=[];

    public array $translatable = [
        'description',
    ];

    public $casts = [
        'description'=>'array',
    ];
    public function aboutCompany() : BelongsTo
    {
        return $this->belongsTo(AboutCompany::class,'about_company_id');
    }
}
