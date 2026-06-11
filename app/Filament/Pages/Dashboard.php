<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AcademyStatsOverview;
use App\Filament\Widgets\PendingExamsWidget;
use App\Filament\Widgets\PendingInvoicesWidget;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\RecentCourses;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Panel Principal';

    protected function getHeaderWidgets(): array
    {
        return [
            AcademyStatsOverview::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            QuickActions::class,
            PendingExamsWidget::class,
            PendingInvoicesWidget::class,
            RecentCourses::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return [
            'md' => 2,
            'lg' => 2,
        ];
    }
}
