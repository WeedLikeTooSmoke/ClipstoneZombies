<?php

namespace App\Filament\Admin\Resources\UsersStatsResource\Pages;

use App\Filament\Admin\Resources\UsersStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsersStats extends EditRecord
{
    protected static string $resource = UsersStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
