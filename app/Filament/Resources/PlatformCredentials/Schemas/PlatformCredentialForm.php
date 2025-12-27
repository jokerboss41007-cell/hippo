<?php

namespace App\Filament\Resources\PlatformCredentials\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
class PlatformCredentialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')->columnSpanFull()->columns(2)->schema([
                TextInput::make('platform'),
                TextInput::make('profile_url')->url(),
                ]),

                Section::make('Login Credentials')->columnSpanFull()->columns(2)->schema([
                    TextInput::make('username'),
                    TextInput::make('email')->label('Email address')->email(),
                    TextInput::make('password')->password(),
                ]),

                Section::make('Sqecial Information')->columnSpanFull()->columns(2)->schema([
                    TextInput::make('special_question'),
                    TextInput::make('special_answer'),
                    TextInput::make('api_key'),
                ]),
            ]);
    }
}
