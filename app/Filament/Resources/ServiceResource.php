<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Company;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\UploadedFile;

class ServiceResource extends Resource
{
    use Translatable;
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Service';
    protected static ?string $navigationGroup = 'Service';
    protected static ?string $modelLabel = 'Services';
    protected static ?int $navigationSort = 8;

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
                Forms\Components\FileUpload::make('service_image_file')
                    ->required()
                    ->disk('public')
                    ->directory('serviceImages')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(fn (UploadedFile $file) => $file->hashName())
                    ->acceptedFileTypes( ['image/*'] ),
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
                Tables\Columns\ImageColumn::make('service_image_file')
                    ->label('Service Image')
                    ->disk('public'),
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
            ->query(function (Service $query) {
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();
        if ($company && !$company->service()->exists()) {
            return true;
        }
        return false;
    }

}
