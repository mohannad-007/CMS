<?php

namespace App\Filament\Resources\AboutCompanyResource\Pages;

use App\Filament\Resources\AboutCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCompanies extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = AboutCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
