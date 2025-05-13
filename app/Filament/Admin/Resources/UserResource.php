<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Users Management';

    public static function getNavigationBadge(): ?string
    {
        return User::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Edit Users Details')
                ->description('Edit the users details')
                ->schema([
                    Forms\Components\TextInput::make('guid')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('email_verified_at'),
                ])->columns(2),

                Forms\Components\Section::make('Edit In-game Details')
                ->description('Edit the users in-game details')
                ->schema([
                    Forms\Components\TextInput::make('rank')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('level')
                        ->required()
                        ->numeric()
                        ->default(1),
                    Forms\Components\TextInput::make('banned')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('color')
                        ->required()
                        ->maxLength(255)
                        ->default(7),
                ])->columns(2),
//                 Forms\Components\TextInput::make('stripe_id')
//                     ->maxLength(255)
//                     ->default(null),
//                 Forms\Components\TextInput::make('pm_type')
//                     ->maxLength(255)
//                     ->default(null),
//                 Forms\Components\TextInput::make('pm_last_four')
//                     ->maxLength(4)
//                     ->default(null),
//                 Forms\Components\DateTimePicker::make('trial_ends_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('guid')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rank')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('level')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('banned')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
//                 Tables\Columns\TextColumn::make('stripe_id')
//                     ->searchable(),
//                 Tables\Columns\TextColumn::make('pm_type')
//                     ->searchable(),
//                 Tables\Columns\TextColumn::make('pm_last_four')
//                     ->searchable(),
//                 Tables\Columns\TextColumn::make('trial_ends_at')
//                     ->dateTime()
//                     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
