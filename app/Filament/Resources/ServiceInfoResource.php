<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceInfoResource\Pages;
use App\Filament\Resources\ServiceInfoResource\RelationManagers;
use App\Models\ServiceInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceInfoResource extends Resource
{
    use Translatable;
    protected static ?string $model = ServiceInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?string $navigationLabel = 'ServiceInfo';
    protected static ?string $navigationGroup = 'Service';
    protected static ?string $modelLabel = 'serviceInfos';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->label('Company Name')
                    ->relationship('service', 'id', fn ($query) => $query->whereHas('company', fn ($q) => $q->where('user_id', auth()->id())))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->company->name)
                    ->default(fn () => auth()->user()->service->id ?? null)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('service.id')
//                    ->numeric()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->query(function (ServiceInfo $query) {
                return $query->whereHas('service.company', function ($companyQuery) {
                    $companyQuery->where('user_id', auth()->id());
                });
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceInfos::route('/'),
            'create' => Pages\CreateServiceInfo::route('/create'),
            'view' => Pages\ViewServiceInfo::route('/{record}'),
            'edit' => Pages\EditServiceInfo::route('/{record}/edit'),
        ];
    }
}
