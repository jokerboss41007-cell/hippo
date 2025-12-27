<?php

namespace App\Filament\Employee\Resources\PlatformCredentials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PlatformCredentialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('platform'),
                TextInput::make('username'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('password')
                    ->password(),
                TextInput::make('special_question'),
                TextInput::make('special_answer'),
                TextInput::make('api_key'),
                TextInput::make('profile_url')
                    ->url(),
            ]);
    }
}
