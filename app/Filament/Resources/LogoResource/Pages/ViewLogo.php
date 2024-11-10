<?php

namespace App\Filament\Resources\LogoResource\Pages;

use App\Filament\Resources\LogoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLogo extends ViewRecord
{
//    use ViewRecord\Concerns\Translatable;
    protected static string $resource = LogoResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }


}
