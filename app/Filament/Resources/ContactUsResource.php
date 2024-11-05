<?php
//
//namespace App\Filament\Resources;
//
//use App\Filament\Resources\ContactUsResource\Pages;
//use App\Filament\Resources\ContactUsResource\RelationManagers;
//use App\Models\ContactUs;
//use Filament\Forms;
//use Filament\Forms\Form;
//use Filament\Resources\Resource;
//use Filament\Tables;
//use Filament\Tables\Table;
//use Illuminate\Database\Eloquent\Builder;
//use Illuminate\Database\Eloquent\SoftDeletingScope;
//
//class ContactUsResource extends Resource
//{
//    protected static ?string $model = ContactUs::class;
//
//    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
//    protected static ?string $navigationLabel = 'ContactUs';
//    protected static ?string $modelLabel = 'ContactUs';
////    protected static ?string $navigationGroup = '';
//    protected static ?int $navigationSort = 10;
//
//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\Select::make('company_id')
//                    ->relationship('company', 'id')
//                    ->required(),
//                Forms\Components\TextInput::make('rate')
//                    ->required()
//                    ->numeric(),
//                Forms\Components\TextInput::make('information_problem')
//                    ->required()
//                    ->maxLength(255),
//                Forms\Components\TextInput::make('email')
//                    ->email()
//                    ->maxLength(255)
//                    ->default(null),
//            ]);
//    }
//
//    public static function table(Table $table): Table
//    {
//        return $table
//            ->columns([
//                Tables\Columns\TextColumn::make('company.id')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('rate')
//                    ->numeric()
//                    ->sortable(),
//                Tables\Columns\TextColumn::make('information_problem')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('email')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('created_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
//                Tables\Columns\TextColumn::make('updated_at')
//                    ->dateTime()
//                    ->sortable()
//                    ->toggleable(isToggledHiddenByDefault: true),
//            ])
//            ->filters([
//                //
//            ])
//            ->actions([
//                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
//            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ]);
//    }
//
//    public static function getRelations(): array
//    {
//        return [
//            //
//        ];
//    }
//
//    public static function getPages(): array
//    {
//        return [
//            'index' => Pages\ListContactUs::route('/'),
//            'create' => Pages\CreateContactUs::route('/create'),
//            'view' => Pages\ViewContactUs::route('/{record}'),
//            'edit' => Pages\EditContactUs::route('/{record}/edit'),
//        ];
//    }
//}
