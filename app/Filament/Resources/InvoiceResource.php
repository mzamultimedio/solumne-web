<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Finanzas';

    protected static ?string $navigationLabel = 'Facturación';

    protected static ?string $modelLabel = 'Factura';

    protected static ?string $pluralModelLabel = 'Facturas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identificación')
                    ->schema([
                        Forms\Components\TextInput::make('tipo')
                            ->label('Tipo de comprobante')
                            ->default('RECIBO')
                            ->maxLength(50)
                            ->required(),
                        Forms\Components\TextInput::make('letra')
                            ->label('Letra / Clase')
                            ->default('X')
                            ->maxLength(5)
                            ->required(),
                        Forms\Components\TextInput::make('numero')
                            ->label('Número')
                            ->numeric()
                            ->disabled()
                            ->hint('Autonumérico'),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Datos del alumno')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Alumno')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->default(fn() => request()->integer('user_id'))
                            ->required()
                            ->afterStateUpdated(function ($state, Set $set): void {
                                $set('alumno_nombre', optional(\App\Models\User::find($state))->name);
                            }),
                        Forms\Components\TextInput::make('alumno_nombre')
                            ->label('Nombre en comprobante')
                            ->required(),
                        Forms\Components\Select::make('curso_id')
                            ->label('Curso')
                            ->relationship('curso', 'title')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set): void {
                                $set('alumno_curso', optional(\App\Models\Curso::find($state))->title);
                            }),
                        Forms\Components\TextInput::make('alumno_curso')
                            ->label('Curso en comprobante')
                            ->hint('Texto editable, usa el título del curso por defecto')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('receptor_documento')
                            ->label('DNI/CUIT')
                            ->maxLength(30),
                        Forms\Components\TextInput::make('receptor_condicion_iva')
                            ->label('Condición frente al IVA (receptor)')
                            ->default('n/a')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('receptor_domicilio')
                            ->label('Domicilio (receptor)')
                            ->default('n/a')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Emisor')
                    ->schema([
                        Forms\Components\TextInput::make('emisor_razon_social')
                            ->label('Razón social (emisor)')
                            ->default('Solumne')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emisor_domicilio')
                            ->label('Domicilio (emisor)')
                            ->default('n/a')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emisor_condicion_iva')
                            ->label('Condición frente al IVA (emisor)')
                            ->default('n/a')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emisor_cuit')
                            ->label('CUIT (emisor)')
                            ->default('n/a')
                            ->maxLength(30),
                        Forms\Components\TextInput::make('emisor_ing_brutos')
                            ->label('Ing. Brutos')
                            ->default('n/a')
                            ->maxLength(50),
                        Forms\Components\DatePicker::make('emisor_inicio_actividades')
                            ->label('Inicio de actividades'),
                    ])
                    ->columns(3),
                Forms\Components\Section::make('Comprobante')
                    ->schema([
                        Forms\Components\DatePicker::make('fecha_emision')
                            ->label('Fecha de emisión')
                            ->default(now())
                            ->required(),
                        Forms\Components\DatePicker::make('fecha_pago')
                            ->label('Fecha de pago')
                            ->native(false),
                        Forms\Components\TextInput::make('forma_pago')
                            ->label('Forma de pago')
                            ->default('n/a')
                            ->maxLength(100),
                        Forms\Components\TextInput::make('cuota_nro')
                            ->label('N° de cuota')
                            ->maxLength(50)
                            ->required(),
                        Forms\Components\TextInput::make('monto_total')
                            ->label('Monto total (ARS)')
                            ->prefix('$')
                            ->numeric()
                            ->default(0)
                            ->readOnly(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Conceptos')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->orderable('position')
                            ->schema([
                                Forms\Components\TextInput::make('concepto')
                                    ->label('Concepto')
                                    ->required(),
                                Forms\Components\TextInput::make('importe')
                                    ->label('Importe')
                                    ->prefix('$')
                                    ->numeric()
                                    ->required()
                                    ->rule('numeric')
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $items = $get('../../items');
                                        $set('subtotal', static::calcSubtotal($state, $get('descuento')));
                                        $set('../../monto_total', static::sumItems($items));
                                    }),
                                Forms\Components\TextInput::make('descuento')
                                    ->label('Dto')
                                    ->prefix('$')
                                    ->numeric()
                                    ->default(0)
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $items = $get('../../items');
                                        $set('subtotal', static::calcSubtotal($get('importe'), $state));
                                        $set('../../monto_total', static::sumItems($items));
                                    }),
                                Forms\Components\TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->prefix('$')
                                    ->numeric()
                                    ->readOnly(),
                            ])
                            ->defaultItems(1)
                            ->minItems(1)
                            ->addActionLabel('Añadir concepto')
                            ->collapsible()
                            ->columns(3)
                            ->live()
                            ->afterStateUpdated(function (Set $set, Get $get): void {
                                $set('monto_total', static::sumItems($get('items')));
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('numero')
                    ->label('N°')
                    ->sortable()
                    ->searchable()
                    ->weight('bold')
                    ->prefix('#')
                    ->color('gray'),
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                Tables\Columns\TextColumn::make('alumno_nombre')
                    ->label('Alumno')
                    ->searchable()
                    ->description(fn(Invoice $record): string => $record->alumno_curso ?? '')
                    ->icon('heroicon-o-user')
                    ->iconColor('gray'),
                Tables\Columns\TextColumn::make('cuota_nro')
                    ->label('Cuota')
                    ->searchable()
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('fecha_emision')
                    ->label('Emisión')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('monto_total')
                    ->label('Monto')
                    ->money('ars', locale: 'es_AR')
                    ->weight('bold')
                    ->color('success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_pago')
                    ->label('Estado')
                    ->badge()
                    ->color(fn($state): string => $state ? 'success' : 'warning')
                    ->icon(fn($state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-clock')
                    ->formatStateUsing(fn($state): string => $state ? 'Pagado' : 'Pendiente'),
            ])
            ->filters([
                Tables\Filters\Filter::make('pagadas')
                    ->label('Pagadas')
                    ->query(fn($query) => $query->whereNotNull('fecha_pago')),
                Tables\Filters\Filter::make('pendientes')
                    ->label('Pendientes')
                    ->query(fn($query) => $query->whereNull('fecha_pago')),
                Tables\Filters\SelectFilter::make('tipo')
                    ->options([
                        'RECIBO' => 'Recibo',
                        'FACTURA' => 'Factura',
                        'NOTA DE CRÉDITO' => 'Nota de Crédito',
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('pdf')
                        ->label('Descargar PDF')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn(Invoice $record): string => route('invoices.pdf', $record))
                        ->openUrlInNewTab()
                        ->color('gray'),
                    Tables\Actions\ViewAction::make()
                        ->label('Ver detalles')
                        ->icon('heroicon-o-eye')
                        ->color('info'),
                    Tables\Actions\EditAction::make()
                        ->label('Editar')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning'),
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
            ->emptyStateHeading('No hay facturas')
            ->emptyStateDescription('Crea tu primera factura para empezar.')
            ->emptyStateIcon('heroicon-o-banknotes')
            ->emptyStateActions([
                Tables\Actions\Action::make('crear')
                    ->label('Crear factura')
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return in_array(auth()->user()?->role, ['admin', 'gestor'], true);
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

    public static function sumItems(?array $items): float
    {
        return collect($items ?? [])
            ->map(function ($item) {
                $importe = (float) ($item['importe'] ?? 0);
                $descuento = (float) ($item['descuento'] ?? 0);
                return $importe - $descuento;
            })
            ->sum();
    }

    public static function calcSubtotal($importe, $descuento): float
    {
        return max(0, (float) $importe - (float) $descuento);
    }
}
