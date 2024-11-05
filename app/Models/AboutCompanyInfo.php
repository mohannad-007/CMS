<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutCompanyInfo extends Model
{
    protected $guarded=[];

    public function aboutCompany() : BelongsTo
    {
        return $this->belongsTo(AboutCompany::class,'about_company_id');
    }
}
