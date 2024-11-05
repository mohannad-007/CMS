<?php

namespace App\Filament\Resources\WorkPlanInfoResource\Pages;

use App\Filament\Resources\WorkPlanInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkPlanInfo extends CreateRecord
{
    protected static string $resource = WorkPlanInfoResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
