<?php

namespace App\Filament\Resources\ServiceInfoResource\Pages;

use App\Filament\Resources\ServiceInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceInfo extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = ServiceInfoResource::class;


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
