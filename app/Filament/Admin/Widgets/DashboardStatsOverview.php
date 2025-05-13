<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Illuminate\Support\Facades\Cache;

use App\Models\User;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cachedUsers = Cache::remember('Users', 86400, function () {
            return User::count();
        });
        $users = User::count() - $cachedUsers;

        return [
            Stat::make('Registered Users', User::count())
                ->description($users.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$users, User::count()])
                ->color('info'),

            Stat::make('Newspaper Posts', User::count())
                ->description($users.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$users, User::count()])
                ->color('info'),

            Stat::make('Subscriptions', User::count())
                ->description($users.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$users, User::count()])
                ->color('info'),
        ];
    }
}
