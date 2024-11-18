<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ServiceResource::class;
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
