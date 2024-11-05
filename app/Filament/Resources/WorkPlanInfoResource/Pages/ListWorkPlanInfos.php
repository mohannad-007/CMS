<?php

namespace App\Filament\Resources\WorkPlanInfoResource\Pages;

use App\Filament\Resources\WorkPlanInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkPlanInfos extends ListRecords
{
    protected static string $resource = WorkPlanInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
