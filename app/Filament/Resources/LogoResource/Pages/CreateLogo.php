<?php

namespace App\Filament\Resources\LogoResource\Pages;

use App\Filament\Resources\LogoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLogo extends CreateRecord
{
//    use CreateRecord\Concerns\Translatable;

    protected static string $resource = LogoResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\LocaleSwitcher::make(),
//        ];
//    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
