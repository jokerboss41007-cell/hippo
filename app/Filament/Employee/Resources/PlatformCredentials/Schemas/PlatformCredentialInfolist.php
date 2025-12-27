<?php

namespace App\Filament\Employee\Resources\PlatformCredentials\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PlatformCredentialInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('platform')
                    ->placeholder('-'),
                TextEntry::make('username')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('special_question')
                    ->placeholder('-'),
                TextEntry::make('special_answer')
                    ->placeholder('-'),
                TextEntry::make('api_key')
                    ->placeholder('-'),
                TextEntry::make('profile_url')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
