<?php

namespace App\Filament\Admin\Resources\UsersStatsResource\Pages;

use App\Filament\Admin\Resources\UsersStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsersStats extends ListRecords
{
    protected static string $resource = UsersStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
