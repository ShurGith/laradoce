<?php
    
    namespace App\Filament\Resources;
    
    use App\Filament\Resources\GeneraloptionsResource\Pages;
    use App\Filament\Resources\GeneraloptionsResource\RelationManagers;
    use App\Models\Generaloptions;
    use Filament\Forms\Components\Toggle;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    
    class GeneraloptionsResource extends Resource
    {
        protected static ?string $model = Generaloptions::class;
        
        protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
        protected static ?string $navigationGroup = 'Admin';
        
        public static function getNavigationLabel(): string
        {
            return __('General Options');
        }
        
        public static function form(Form $form): Form
        {
            return $form
              ->schema([
                
                Toggle::make('value')
                  ->onIcon('heroicon-m-plus-circle')
                  ->offIcon('heroicon-m-minus-circle')
                  ->onColor('success')
                  ->offColor('danger')
                  ->inline(false)
                  ->label('Desactivar / Activar')
              ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
              ->columns([
                Tables\Columns\TextColumn::make('name')
                  // ->formatStateUsing(fn(string $state) => Str::of($state)->replace('_', ' ')
                  ->formatStateUsing(fn(string $state) => __(ucfirst(str_replace('_', ' ', $state))))
                  ->label('Opción'),
                
                Tables\Columns\ToggleColumn::make('value')
                  ->label('Estado')
                  ->getStateUsing(fn($record) => in_array($record->value, [0, 1]) ? (bool) $record->value : false)
                  ->disabled(fn($record) => !in_array($record->value, [0, 1]))
                  ->onIcon('heroicon-m-plus-circle')
                  ->offIcon('heroicon-m-minus-circle')
                  ->onColor('success')
                  ->offColor('danger')
                  ->label('Desactivar / Activar')
              ])
              ->filters([
                  //
              ])
              ->actions([
                Tables\Actions\DeleteAction::make(),
              ])
              ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
              'index' => Pages\ListGeneraloptions::route('/'),
              'create' => Pages\CreateGeneraloptions::route('/create'),
              'edit' => Pages\EditGeneraloptions::route('/{record}/edit'),
            ];
        }
    }
