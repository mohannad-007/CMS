<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    protected $guarded=[];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function logo() : HasOne
    {
        return $this->hasOne(Logo::class);
    }

    public function slider() :HasMany
    {
        return $this->hasMany(Slider::class);
    }
    public function socialLinks() :HasMany
    {
        return $this->hasMany(SocialLinks::class);
    }
    public function workPlan() :HasOne
    {
        return $this->hasOne(WorkPlan::class);
    }
    public function service() :HasOne
    {
        return $this->hasOne(Service::class);
    }
//    public function contactUs() :HasOne
//    {
//        return $this->hasOne(ContactUs::class);
//    }
    public function aboutCompany() :HasOne
    {
        return $this->hasOne(AboutCompany::class);
    }
    public function aboutDetails() :HasMany
    {
        return $this->hasMany(AboutDetails::class);
    }
    public function companyDetails() :HasMany
    {
        return $this->hasMany(CompanyDetails::class);
    }

}
