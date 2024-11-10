<?php

namespace App\Filament\Resources\LogoResource\Pages;

use App\Filament\Resources\LogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogos extends ListRecords
{
//    use ListRecords\Concerns\Translatable;
    protected static string $resource = LogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
