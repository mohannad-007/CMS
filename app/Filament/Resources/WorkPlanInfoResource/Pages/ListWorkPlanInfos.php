<?php

namespace App\Filament\Resources\WorkPlanInfoResource\Pages;

use App\Filament\Resources\WorkPlanInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkPlanInfos extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = WorkPlanInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
