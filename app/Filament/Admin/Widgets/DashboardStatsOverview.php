<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Product;
use App\Models\Subscription;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $cachedUsers = Cache::remember('Users', 86400, function () {
            return User::count();
        });
        $users = User::count() - $cachedUsers;

        $productsUsers = Cache::remember('Products', 86400, function () {
            return Product::count();
        });
        $products = Product::count() - $productsUsers;

        $subscriptionsUsers = Cache::remember('Subscriptions', 86400, function () {
            return Subscription::count();
        });
        $subscriptions = Subscription::count() - $subscriptionsUsers;

        return [
            Stat::make('Users', User::count())
                ->description($users.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$users, User::count()])
                ->color('info'),

            Stat::make('Products', Product::count())
                ->description($products.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$products, Product::count()])
                ->color('info'),

            Stat::make('Subscriptions', Subscription::count())
                ->description($subscriptions.' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([$subscriptions, Subscription::count()])
                ->color('info'),
        ];
    }
}
