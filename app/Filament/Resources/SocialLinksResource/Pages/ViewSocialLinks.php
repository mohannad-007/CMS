<?php

namespace App\Filament\Resources\SocialLinksResource\Pages;

use App\Filament\Resources\SocialLinksResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialLinks extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = SocialLinksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
