<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CursoResource;
use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\UserResource;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;

class QuickActions extends Widget implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?int $sort = 2;

    protected static string $view = 'filament.widgets.quick-actions';

    protected int|string|array $columnSpan = 'full';
}
