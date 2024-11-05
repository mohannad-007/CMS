<?php

namespace App\Filament\Resources\WorkPlanInfoResource\Pages;

use App\Filament\Resources\WorkPlanInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkPlanInfo extends EditRecord
{
    protected static string $resource = WorkPlanInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
