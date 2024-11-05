<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPlanResource\Pages;
use App\Filament\Resources\WorkPlanResource\RelationManagers;
use App\Models\Company;
use App\Models\WorkPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\UploadedFile;

class WorkPlanResource extends Resource
{
    protected static ?string $model = WorkPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static ?string $navigationLabel = 'WorkPlan';
    protected static ?string $navigationGroup = 'WorkPlan';
    protected static ?string $modelLabel = 'WorkPlan';
    protected static ?int $navigationSort = 6;

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
                Forms\Components\FileUpload::make('work_image_file')
                    ->required()
                    ->disk('public')
                    ->directory('workPlanImages')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(fn (UploadedFile $file) => $file->hashName())
                    ->acceptedFileTypes( ['image/*'] ),
                Forms\Components\TextInput::make('section_title')
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
                Tables\Columns\ImageColumn::make('work_image_file')
                    ->label('WorkPlan Image')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('section_title')
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
            ->query(function (WorkPlan $query) {
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
            'index' => Pages\ListWorkPlans::route('/'),
            'create' => Pages\CreateWorkPlan::route('/create'),
            'view' => Pages\ViewWorkPlan::route('/{record}'),
            'edit' => Pages\EditWorkPlan::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();
        if ($company && !$company->workPlan()->exists()) {
            return true;
        }
        return false;
    }
}
