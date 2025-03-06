<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\UserResource\Pages;
use App\Filament\User\Resources\UserResource\RelationManagers;
use App\Models\Product;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Usuario';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $pluralModelLabel = 'Perfil';
    protected static bool $hasTitleCaseModelLabel = false;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Tables\Columns\ImageColumn::make('avatar')
                    -> circular()
                        ->defaultImageUrl(function ($record) {
                            return 'https://ui-avatars.com/api/?background=random&color=fff&name=' . urlencode($record->name);
                        }),
                    Tables\Columns\TextColumn::make('name'),
                    Tables\Columns\TextColumn::make('email'),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('products_count')
                            ->state(fn() => Product::where('active', true)->where('user_id', Auth::user()->id)->count() . ' Productos Activos')
                            ->label('Productos Activos')
                            ->icon('heroicon-o-shopping-bag')
                            ->weight(FontWeight::Bold)
                            ->badge()
                            ->numeric()
                            ->color('success'),
                        Tables\Columns\TextColumn::make('Productos Inactivos')
                            ->label('')
                            ->icon('heroicon-o-building-storefront')
                            ->weight(FontWeight::Bold)
                            ->badge()
                            ->numeric()
                            ->color('danger')
                            ->state(fn() => Product::where('active', false)->where('user_id', Auth::user()->id)->count() . ' Productos sin Activar'),
                    ])->space(1),
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\ViewAction::make()
                    ->slideOver()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            //'create' => CreateUser::route('/create'),
            //'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),
                TextEntry::make('email'),
                TextEntry::make('products.name')
                    ->columns(2)
                    ->icon('heroicon-m-shopping-bag')
                    ->iconColor('primary')
                    ->listWithLineBreaks()
                    ->limitList(2)
                    ->badge()
                    ->expandableLimitedList(),
                ImageEntry::make('avatar')
                    ->circular()
                    ->defaultImageUrl(url('https://placehold.co/400')),
                TextEntry::make('products.name', [
                ])->label('Activos'),
            ]);
    }

    public static function canCreate(): bool
    {
        return false; // Desactiva el botón "New User"
    }

    public static function afterCreate($record): void
    {
        // Registrar en logs
        Log::info("✳️✳️✳️ Desde User/UserResource Enviando correo a usuario: " . $record->email);

        /*   // Enviar correo al usuario registrado
           Mail::to($record->email)->send(new UserRegistered($record));

           // Enviar correo al administrador
           Mail::to('esnola@gmail.com')->send(new UserRegistered($record));*/
    }
}
