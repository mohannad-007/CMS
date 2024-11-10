<?php

namespace App\Filament\Resources\WorkPlanResource\Pages;

use App\Filament\Resources\WorkPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkPlan extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = WorkPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
