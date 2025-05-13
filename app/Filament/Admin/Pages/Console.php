<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class Console extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-command-line';

    protected static string $view = 'filament.admin.pages.console';

    protected static ?string $navigationGroup = 'Server Management';
}
