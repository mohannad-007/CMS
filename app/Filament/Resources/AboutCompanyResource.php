<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCompanyResource\Pages;
use App\Filament\Resources\AboutCompanyResource\RelationManagers;
use App\Models\AboutCompany;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutCompanyResource extends Resource
{
    use Translatable;
    protected static ?string $model = AboutCompany::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-columns';

    protected static ?string $navigationLabel = 'AboutCompany';
    protected static ?string $modelLabel = 'AboutCompany';
    protected static ?string $navigationGroup = 'AboutCompany';
    protected static ?int $navigationSort = 12;

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
                Forms\Components\TextInput::make('question')
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
                Tables\Columns\TextColumn::make('question')
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
            ->query(function (AboutCompany $query) {
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
            'index' => Pages\ListAboutCompanies::route('/'),
            'create' => Pages\CreateAboutCompany::route('/create'),
            'view' => Pages\ViewAboutCompany::route('/{record}'),
            'edit' => Pages\EditAboutCompany::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();
        if ($company && !$company->aboutCompany()->exists()) {
            return true;
        }
        return false;
    }

}
