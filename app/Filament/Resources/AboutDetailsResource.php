<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutDetailsResource\Pages;
use App\Filament\Resources\AboutDetailsResource\RelationManagers;
use App\Models\AboutDetails;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutDetailsResource extends Resource
{
    use Translatable;
    protected static ?string $model = AboutDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationLabel = 'AboutDetails';
    protected static ?string $modelLabel = 'AboutDetails';
    protected static ?string $navigationGroup = 'AboutCompany';
    protected static ?int $navigationSort = 14;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'name')
                    ->default(function () {
                        $company = Company::where('user_id', auth()->id())->first();
                        return $company ? $company->id : null;
                    })
                    ->disabled()
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
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
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
            ->query(function (AboutDetails $query) {
                return $query->whereHas('company', function ($companyQuery) {
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
            'index' => Pages\ListAboutDetails::route('/'),
            'create' => Pages\CreateAboutDetails::route('/create'),
            'view' => Pages\ViewAboutDetails::route('/{record}'),
            'edit' => Pages\EditAboutDetails::route('/{record}/edit'),
        ];
    }
}
