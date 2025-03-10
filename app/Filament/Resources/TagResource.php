<?php
    
    namespace App\Filament\Resources;
    
    use App\Filament\Resources\TagResource\Pages;
    use App\Filament\Resources\TagResource\RelationManagers;
    use App\Models\Tag;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Guava\FilamentIconPicker\Forms\IconPicker;
    use Guava\FilamentIconPicker\Tables\IconColumn;
    
    class TagResource extends Resource
    {
        protected static ?string $model = Tag::class;
        
        protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
        
        protected static ?string $navigationGroup = 'Productos';
        protected static ?string $modelLabel = 'Etiquetas';
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
                  Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                ])->columnSpanFull(),
                Forms\Components\Split::make([
                  Forms\Components\FileUpload::make('image')
                    ->directory('images/products/tag_images')
                    ->image()
                    ->imageEditor(),
                  IconPicker::make('icon')
                    ->columns(5),
                ])->columnSpanFull(),
              ]);
        }
        
        public static function table(Table $table): Table
        {
            return $table
              ->columns([
                Tables\Columns\TextColumn::make('name')
                  ->url(fn(Tag $record): string => route('home', ['tag' => $record]))
                  ->openUrlInNewTab()
                  ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                  ->numeric()
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
              'index' => Pages\ListTags::route('/'),
              'create' => Pages\CreateTag::route('/create'),
                //'edit' => Pages\EditTag::route('/{record}/edit'),
            ];
        }
    }
