<?php
    
    namespace App\Filament\Resources;
    
    use App\Filament\Resources\UserResource\Pages;
    use App\Filament\Resources\UserResource\RelationManagers;
    use App\Models\User;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Pages\CreateRecord;
    use Filament\Resources\Pages\Page;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Filters\Filter;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\Hash;
    use Log;
    use STS\FilamentImpersonate\Tables\Actions\Impersonate;
    
    class UserResource extends Resource
    {
        protected static ?string $model = User::class;
        
        protected static ?string $navigationGroup = 'Admin';
        protected static ?string $navigationIcon = 'heroicon-o-user-group';
        protected static ?int $navigationSort = 1;
        
        public static function form(Form $form): Form
        {
            return $form
              ->schema([
                Forms\Components\TextInput::make('name')
                  ->required()
                  ->maxLength(255),
                Forms\Components\TextInput::make('email')
                  ->email()
                  ->required()
                  ->maxLength(255),
                Forms\Components\FileUpload::make('avatar')
                  ->directory('/images/avatars')
                  ->avatar()
                  ->image()
                  ->imageEditor()
                  ->circleCropper(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                  ->password()
                  ->revealable()
                  ->required()
                  ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                  ->dehydrated(fn(?string $state): bool => filled($state))
                  ->autocomplete('false')
                  ->required(fn(Page $livewire) => ($livewire instanceof CreateRecord)),
              ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
              ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                  ->circular()
                  ->defaultImageUrl(function ($record) {
                      return 'https://ui-avatars.com/api/?background=random&color=fff&name='.urlencode($record->name);
                  }),
                Tables\Columns\TextColumn::make('name')
                  ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                  ->label('Verificado')
                  ->badge()
                  ->color('success')
                  ->icon('heroicon-o-check-circle')
                  ->formatStateUsing(fn($state) => filled($state) ? 'Verificado' : 'Pendiente'),
                Tables\Columns\TextColumn::make('email')
                  ->searchable(),
                Tables\Columns\ImageColumn::make('avatar')
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
                Filter::make('verified')
                  ->label('Email Verified')
                  ->query(fn(Builder $query) => $query->whereNotNull('email_verified_at')),
                Filter::make('unverified')
                  ->label('Email Not Verified')
                  ->query(fn(Builder $query) => $query->whereNull('email_verified_at')),
              ])
              ->actions([
                Impersonate::make(),
                Tables\Actions\EditAction::make()
                  ->slideOver(),
                Tables\Actions\DeleteAction::make(),
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
              'create' => Pages\CreateUser::route('/create'),
                //'edit' => Pages\EditUser::route('/{record}/edit'),
            ];
        }
        
        
    }
