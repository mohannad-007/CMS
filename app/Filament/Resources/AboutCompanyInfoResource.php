<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCompanyInfoResource\Pages;
use App\Filament\Resources\AboutCompanyInfoResource\RelationManagers;
use App\Models\AboutCompanyInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutCompanyInfoResource extends Resource
{
    protected static ?string $model = AboutCompanyInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $navigationLabel = 'AboutCompanyInfo';
    protected static ?string $modelLabel = 'AboutCompanyInfo';
    protected static ?string $navigationGroup = 'AboutCompany';
    protected static ?int $navigationSort = 13;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('about_company_id')
                    ->label('Company Name')
                    ->relationship('aboutCompany', 'id', fn ($query) => $query->whereHas('company', fn ($q) => $q->where('user_id', auth()->id())))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->company->name)
                    ->default(fn () => auth()->user()->service->id ?? null)                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('aboutCompany.id')
//                    ->numeric()
//                    ->sortable(),
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
            ->query(function (AboutCompanyInfo $query) {
                return $query->whereHas('aboutCompany.company', function ($companyQuery) {
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
            'index' => Pages\ListAboutCompanyInfos::route('/'),
            'create' => Pages\CreateAboutCompanyInfo::route('/create'),
            'view' => Pages\ViewAboutCompanyInfo::route('/{record}'),
            'edit' => Pages\EditAboutCompanyInfo::route('/{record}/edit'),
        ];
    }
}
