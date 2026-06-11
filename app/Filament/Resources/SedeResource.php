<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SedeResource\Pages;
use App\Models\Sede;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SedeResource extends Resource
{
    protected static ?string $model = Sede::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Gestión Académica';

    protected static ?string $navigationLabel = 'Sedes';

    protected static ?string $pluralLabel = 'Sedes';

    protected static ?string $modelLabel = 'Sede';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información de la Sede')
                    ->description('Datos principales de la sede')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre de la Sede')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Sede Central, Sede Norte, etc.')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Imagen de la Sede')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->directory('sedes')
                            ->disk('public')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->imagePreviewHeight('250')
                            ->downloadable()
                            ->helperText('Imagen representativa de la sede (máx. 2MB)')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Redes Sociales')
                    ->description('Enlaces a redes sociales de la sede')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->maxLength(255)
                            ->url()
                            ->placeholder('https://facebook.com/sede')
                            ->prefixIcon('heroicon-o-globe-alt')
                            ->default(null),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->maxLength(255)
                            ->url()
                            ->placeholder('https://instagram.com/sede')
                            ->prefixIcon('heroicon-o-camera')
                            ->default(null),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->size(60)
                    ->defaultImageUrl(url('/images/default-sede.png')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Sede')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-o-building-office-2')
                    ->iconColor('warning'),
                Tables\Columns\IconColumn::make('facebook_url')
                    ->label('Facebook')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('info')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->tooltip(fn($record) => $record->facebook_url ? 'Configurado' : 'Sin configurar'),
                Tables\Columns\IconColumn::make('instagram_url')
                    ->label('Instagram')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('info')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->tooltip(fn($record) => $record->instagram_url ? 'Configurado' : 'Sin configurar'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creada')
                    ->since()
                    ->sortable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\Filter::make('con_facebook')
                    ->label('Con Facebook')
                    ->query(fn($query) => $query->whereNotNull('facebook_url')),
                Tables\Filters\Filter::make('con_instagram')
                    ->label('Con Instagram')
                    ->query(fn($query) => $query->whereNotNull('instagram_url')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\Action::make('ver_redes')
                        ->label('Ver Redes')
                        ->icon('heroicon-o-share')
                        ->color('info')
                        ->visible(fn($record) => $record->facebook_url || $record->instagram_url)
                        ->modalHeading(fn($record) => "Redes Sociales - {$record->name}")
                        ->modalContent(fn($record) => view('filament.modals.sede-redes', ['sede' => $record]))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Cerrar'),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->emptyStateHeading('No hay sedes')
            ->emptyStateDescription('Crea tu primera sede para empezar.')
            ->emptyStateIcon('heroicon-o-building-office-2')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear sede')
                    ->icon('heroicon-o-plus')
                    ->url(static::getUrl('create')),
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
            'index' => Pages\ListSedes::route('/'),
            'create' => Pages\CreateSede::route('/create'),
            'edit' => Pages\EditSede::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDeleteAny(): bool
    {
        return static::canViewAny();
    }
}
