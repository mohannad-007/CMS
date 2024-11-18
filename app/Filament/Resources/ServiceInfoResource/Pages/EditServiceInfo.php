<?php

namespace App\Filament\Resources\ServiceInfoResource\Pages;

use App\Filament\Resources\ServiceInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceInfo extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ServiceInfoResource::class;
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
