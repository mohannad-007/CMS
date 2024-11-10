<?php

namespace App\Filament\Resources\AboutCompanyResource\Pages;

use App\Filament\Resources\AboutCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAboutCompany extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = AboutCompanyResource::class;

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
