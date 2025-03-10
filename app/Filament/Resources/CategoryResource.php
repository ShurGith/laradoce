<?php
    
    namespace App\Filament\Resources;
    
    use App\Filament\Resources\CategoryResource\Pages;
    use App\Filament\Resources\CategoryResource\RelationManagers;
    use App\Models\Category;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Guava\FilamentIconPicker\Forms\IconPicker;
    use Guava\FilamentIconPicker\Tables\IconColumn;
    
    class CategoryResource extends Resource
    {
        protected static ?string $model = Category::class;
        
        protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
        
        protected static ?string $navigationGroup = 'Productos';
        protected static ?string $modelLabel = 'Categorías';
        protected static ?int $navigationSort = 1;
        
        public static function form(Form $form): Form
        {
            return $form
              ->schema([
                Forms\Components\Split::make([
                  Forms\Components\TextInput::make('name')
                    ->required(),
                  Forms\Components\ColorPicker::make('color'),
                  Forms\Components\ColorPicker::make('bgcolor'),
                  Forms\Components\ToggleButtons::make('icon_active')
                    ->label('¿Activar Icono?')
                    ->boolean()
                    ->grouped(),
                ])->columnSpanFull(),
                Forms\Components\Split::make([
                  Forms\Components\FileUpload::make('image')
                    ->directory('images/products/categ_images')
                    ->image()
                    ->imageEditor(),
                  IconPicker::make('icon')
                    ->label('Icono')
                    ->columns(5),
                ])->columnSpanFull(),
              ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
              ->columns([
                Tables\Columns\TextColumn::make('name')
                  ->url(fn(Category $record): string => route('home', ['category' => $record]))
                  ->openUrlInNewTab()
                  ->sortable(),
                Tables\Columns\ColorColumn::make('color')
                  ->copyable(),
                Tables\Columns\ColorColumn::make('bgcolor')
                  ->copyable(),
                Tables\Columns\ImageColumn::make('image'),
                IconColumn::make('icon')
                  ->label('Icono'),
                Tables\Columns\ToggleColumn::make('icon_active')
                  ->label('Icono Activo')
                  ->onColor('success')
                  ->offColor('naranja')
                  ->onIcon('heroicon-m-lock-open')
                  ->offIcon('heroicon-m-lock-closed'),
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make()
                  ->slideOver(),
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
              'index' => Pages\ListCategories::route('/'),
              'create' => Pages\CreateCategory::route('/create'),
                //'edit' => Pages\EditCategory::route('/{record}/edit'),
            ];
        }
    }
