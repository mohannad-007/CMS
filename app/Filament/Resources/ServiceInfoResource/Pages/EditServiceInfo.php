<?php

namespace App\Filament\Resources\ServiceInfoResource\Pages;

use App\Filament\Resources\ServiceInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceInfo extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ServiceInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
