<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUs extends Model
{
    protected $guarded=[];

//    public function company() : BelongsTo
//    {
//        return $this->belongsTo(Company::class);
//    }
}
