<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyDetailsResource\Pages;
use App\Filament\Resources\CompanyDetailsResource\RelationManagers;
use App\Models\Company;
use App\Models\CompanyDetails;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyDetailsResource extends Resource
{
    use Translatable;
    protected static ?string $model = CompanyDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationGroup = 'Company-form';
    protected static ?string $navigationLabel = 'Company Details';
    protected static ?string $modelLabel = 'Company Details';

    protected static ?int $navigationSort= 11;

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
                Forms\Components\TextInput::make('header')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('information')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('percentage')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('header')
                    ->searchable(),
                Tables\Columns\TextColumn::make('information')
                    ->searchable(),
                Tables\Columns\TextColumn::make('percentage')
                    ->numeric(),
//                    ->sortable(),
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
            ->query(function (CompanyDetails $query) {
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
            'index' => Pages\ListCompanyDetails::route('/'),
            'create' => Pages\CreateCompanyDetails::route('/create'),
            'view' => Pages\ViewCompanyDetails::route('/{record}'),
            'edit' => Pages\EditCompanyDetails::route('/{record}/edit'),
        ];
    }
}
