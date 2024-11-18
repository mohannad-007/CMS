<?php

namespace App\Filament\Resources\SocialLinksResource\Pages;

use App\Filament\Resources\SocialLinksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialLinks extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = SocialLinksResource::class;

    public function update(){
//        $this->validate();
        $this->record->update($this->data);
    }
    public function delete(){
        $this->record->delete();
        session()->flash('success', 'Record deleted successfully.');
//        $this->redirect('/');
    }

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
