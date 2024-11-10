<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ServiceInfo extends Model
{
    use HasTranslations;
    protected $guarded=[];

    public array $translatable = [
        'title',
        'description',
    ];

    public $casts = [
        'title'=>'array',
        'description'=>'array',
    ];
    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

}
