<?php

namespace App\Filament\Resources\AboutCompanyInfoResource\Pages;

use App\Filament\Resources\AboutCompanyInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCompanyInfos extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = AboutCompanyInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
