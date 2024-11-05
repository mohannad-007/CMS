<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPlanInfoResource\Pages;
use App\Filament\Resources\WorkPlanInfoResource\RelationManagers;
use App\Models\WorkPlanInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkPlanInfoResource extends Resource
{
    protected static ?string $model = WorkPlanInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static ?string $navigationLabel = 'WorkPlanInfo';
    protected static ?string $navigationGroup = 'WorkPlan';
    protected static ?string $modelLabel = 'WorkPlanInfos';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('workPlan_id')
                    ->label('Company Name')
                    ->relationship('workPlan', 'id', fn ($query) => $query->whereHas('company', fn ($q) => $q->where('user_id', auth()->id())))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->company->name)
                    ->default(fn () => auth()->user()->workPlan->id ?? null)
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
//                Tables\Columns\TextColumn::make('workPlan.name')
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
            ->query(function (WorkPlanInfo $query) {
                return $query->whereHas('workPlan.company', function ($companyQuery) {
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
            'index' => Pages\ListWorkPlanInfos::route('/'),
            'create' => Pages\CreateWorkPlanInfo::route('/create'),
            'view' => Pages\ViewWorkPlanInfo::route('/{record}'),
            'edit' => Pages\EditWorkPlanInfo::route('/{record}/edit'),
        ];
    }
}
