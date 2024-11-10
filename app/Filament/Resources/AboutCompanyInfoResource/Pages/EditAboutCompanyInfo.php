<?php

namespace App\Filament\Resources\AboutCompanyInfoResource\Pages;

use App\Filament\Resources\AboutCompanyInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutCompanyInfo extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = AboutCompanyInfoResource::class;

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
