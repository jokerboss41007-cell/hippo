<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),

                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                DateTimePicker::make('email_verified_at')->native(false)->label('Email verified at'),

                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->dehydrateStateUsing(fn ($state) => $state ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state)),

                Select::make('roles')
                    ->label('Assign Roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->options(Role::pluck('name', 'id')->toArray()),
            ]);
    }
}
