<?php
    
    namespace App\Filament\Resources;
    
    use App\Filament\Resources\ProductResource\Pages;
    use App\Models\Product;
    use App\Models\Tag;
    use Filament\Forms;
    use Filament\Forms\Components\Repeater;
    use Filament\Forms\Components\Split;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Columns\TextInputColumn;
    use Filament\Tables\Columns\ToggleColumn;
    use Filament\Tables\Table;
    use FilamentTiptapEditor\Enums\TiptapOutput;
    use FilamentTiptapEditor\TiptapEditor;
    
    class ProductResource extends Resource
    {
        protected static ?string $model = Product::class;
        
        protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
        protected static ?string $navigationGroup = 'Productos';
        protected static ?string $modelLabel = 'producto';
        protected static ?string $navigationLabel = 'Productos en venta';
        
        
        public static function form(Form $form): Form
        {
            return $form
              ->schema([
                Forms\Components\TextInput::make('name')
                  ->label('Producto')
                  ->required()
                  ->maxLength(255),
                Split::make([
                  Forms\Components\Toggle::make('oferta')
                    ->live(),
                  Forms\Components\Toggle::make('active')
                    ->label('Activo'),
                ]),
                Split::make([
                  Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Vendedor')
                    ->columnSpan(2)
                    ->required(),
                  Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->columnSpan(2)
                    ->prefix('€'),
                  Forms\Components\TextInput::make('units')
                    ->label('Unidades en Venta')
                    ->numeric()
                    ->columnSpan(2),
                  Forms\Components\TextInput::make('descuento')
                    ->numeric()
                    ->columnSpan(6)
                    ->visible(fn(Get $get): bool => $get('oferta')),
                ]),
                TiptapEditor::make('description')
                  ->profile('default')
                  ->output(TiptapOutput::Html)
                  ->columnSpanFull(),
                Forms\Components\FileUpload::make('images')
                  ->directory('images/products')
                  ->image()
                  ->reorderable()
                  ->openable()
                  ->label('Añadir Imagen')
                  ->imageEditor()
                  ->appendFiles()
                  ->columnSpanFull()
                  ->panelLayout('grid')
                  ->multiple(),
                Repeater::make('features')
                  ->translateLabel()
                  ->relationship('featuretitles')
                  ->schema([
                    TextInput::make('title')->required()->label('nombre'),
                    Forms\Components\RichEditor::make('text')->required()->label('Texto'),
                  ])
                  ->label('Detalles')
                  ->grid(2)
                  ->columnSpanFull(),
                Forms\Components\Select::make('category_id')
                  ->translateLabel()
                  ->relationship('categories', 'name')
                  ->reactive(), // Esto hace que al cambiar la categoría, se actualicen otros campos dinámicamente
                Forms\Components\CheckboxList::make('tag_id')
                  ->translateLabel()
                  ->relationship('tags')
                  ->options(fn(callable $get) => Tag::where('category_id', $get('category_id'))
                    ->pluck('name', 'id')
                  )
                  ->columns(3)
              ]);
            
        }
        
        public static function table(Table $table): Table
        {
            return $table
              ->columns([
                TextColumn::make('name')
                  ->label('Product')
                  ->searchable()
                  ->translateLabel(),
                TextColumn::make('price')
                  ->translateLabel()
                  ->money('EUR', divideBy: 100, locale: 'es'),
                ToggleColumn::make('active')
                  ->label('En Venta'),
                ToggleColumn::make('oferta'),
                TextInputColumn::make('descuento')
                  ->label('Descuento'),
                TextInputColumn::make('units')
                  ->label('Unidades'),
                TextColumn::make('user.name')
                  ->numeric()
                  ->sortable(),
                TextColumn::make('categories.name')
                  ->label('Categorias')
                  ->badge()
                  ->color('success'),
                TextColumn::make('tags.name')
                  ->label('Etiquetas')
                  ->badge(),
                TextColumn::make('user.name')
                  ->label('Seller')
                  ->translateLabel()
                  ->icon('heroicon-m-user')
                  ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                  ->dateTime()
                  ->sortable()
                  ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                  ->dateTime()
                  ->sortable()
                  ->toggleable(isToggledHiddenByDefault: true),
              ])
              ->filters([
                  //
              ])
              ->actions([
                Tables\Actions\EditAction::make()
                  // ->slideOver(),
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
              'index' => Pages\ListProducts::route('/'),
                //'create' => Pages\CreateProduct::route('/create'),
              'edit' => Pages\EditProduct::route('/{record}/edit'),
            ];
        }
        
        
    }
