<?php

namespace App\Filament\Resources\CompanyDetailsResource\Pages;

use App\Filament\Resources\CompanyDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyDetails extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = CompanyDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
