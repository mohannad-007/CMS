<?php

namespace App\Filament\Resources\WorkPlanResource\Pages;

use App\Filament\Resources\WorkPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWorkPlan extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = WorkPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
