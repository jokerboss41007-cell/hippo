<?php

namespace App\Filament\Employee\Resources\PlatformCredentials\Pages;

use App\Filament\Employee\Resources\PlatformCredentials\PlatformCredentialResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ViewPlatformCredential extends ViewRecord
{
    protected static string $resource = PlatformCredentialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make()
            //     ->icon('heroicon-o-pencil-square'),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Platform Information')
                    ->description('Basic platform details and identifiers')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Group::make()
                            ->columns(2)
                            ->schema([
                                TextEntry::make('platform')
                                    ->label('Platform Name')
                                    ->icon('heroicon-o-server')
                                    ->badge()
                                    ->color('primary')
                                    ->weight(FontWeight::Bold) ,


                                TextEntry::make('profile_url')
                                    ->label('Profile URL')
                                    ->icon('heroicon-o-link')
                                    ->url(fn ($state) => $state)
                                    ->openUrlInNewTab()
                                    ->placeholder('Not provided')
                                    ->copyable()
                                    ->copyMessage('URL copied!')
                                    ->copyMessageDuration(1500),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Account Credentials')
                    ->description('Login credentials for this platform')
                    ->icon('heroicon-o-key')
                    ->schema([
                        Group::make()
                            ->columns(2)
                            ->schema([
                                TextEntry::make('username')
                                    ->label('Username')
                                    ->icon('heroicon-o-user')
                                    ->placeholder('Not provided')
                                    ->copyable()
                                    ->copyMessage('Username copied!')
                                    ->weight(FontWeight::Medium),

                                TextEntry::make('email')
                                    ->label('Email Address')
                                    ->icon('heroicon-o-envelope')
                                    ->placeholder('Not provided')
                                    ->copyable()
                                    ->copyMessage('Email copied!'),
                            ]),

                        TextEntry::make('password')
                            ->label('Password')
                            ->icon('heroicon-o-lock-closed')
                            ->placeholder('Not provided')
                            ->copyable()
                            ->copyMessage('Password copied!')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),


                Section::make('Security Questions')
                    ->description('Additional security verification details')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        TextEntry::make('special_question')
                            ->label('Security Question')
                            ->icon('heroicon-o-question-mark-circle')
                            ->placeholder('Not provided')
                            ->columnSpanFull(),

                        TextEntry::make('special_answer')
                            ->label('Security Answer')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->placeholder('Not provided')
                            ->copyable()
                            ->copyMessage('Answer copied!')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('API Configuration')
                    ->description('API keys and integration details')
                    ->icon('heroicon-o-code-bracket')
                    ->schema([
                        TextEntry::make('api_key')
                            ->label('API Key')
                            ->icon('heroicon-o-key')
                            ->placeholder('Not provided')
                            ->copyable()
                            ->copyMessage('API Key copied!')
                            ->columnSpanFull()
                            ->hint('Keep this secure')
                            ->hintIcon('heroicon-o-exclamation-triangle')
                            ->hintColor('warning'),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Section::make('Record Information')
                    ->description('System timestamps')
                    ->icon('heroicon-o-clock')
                    ->schema([
                        Group::make()
                            ->columns(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->icon('heroicon-o-calendar')
                                    ->dateTime('M j, Y • g:i A')
                                    ->color('success'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->icon('heroicon-o-arrow-path')
                                    ->dateTime('M j, Y • g:i A')
                                    ->color('warning'),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
