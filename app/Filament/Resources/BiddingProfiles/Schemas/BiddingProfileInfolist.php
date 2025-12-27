<?php

namespace App\Filament\Resources\BiddingProfiles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Infolist;
use App\Models\BiddingPlatform;
use App\Models\User;
use Filament\Schemas\Schema;

class BiddingProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ---------------- Platform & Owner Section ---------------- */
                Section::make('Platform Details')
                    ->description('Information of the profile')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('biddingPlatform.title')
                            ->label('Platform')
                            ->badge()
                            ->color('info')
                            ->placeholder('-'),

                        TextEntry::make('createdBy.name')
                            ->label('Created By')
                            ->badge()
                            ->color('success')
                            ->placeholder('-'),

                        TextEntry::make('profile_name')
                            ->label('Profile Name')
                            ->weight('medium')
                            ->placeholder('-'),

                        TextEntry::make('profile_url')
                            ->label('Profile URL')
                            // ->url()
                            ->openUrlInNewTab()
                            ->icon('heroicon-o-link')
                            ->placeholder('-'),
                    ]),

                /* ---------------- Credentials Section ---------------- */
                Section::make('Login Credentials')
                    ->description('Internal details for authentication')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-o-envelope')
                            ->placeholder('-'),

                        TextEntry::make('username')
                            ->label('Username')
                            ->placeholder('-'),

                        TextEntry::make('category')
                            ->label('Category')
                            ->badge()
                            ->color('warning')
                            ->placeholder('-'),
                    ]),

                /* ---------------- Stats Section ---------------- */
                Section::make('Performance & Stats')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('success_score')
                            ->label('Success Score')
                            ->suffix('%')
                            ->badge()
                            ->color('success')
                            ->placeholder('-'),

                        TextEntry::make('rating')
                            ->label('Rating')
                            ->badge()
                            ->color('purple')
                            ->placeholder('-'),

                        TextEntry::make('connects_or_tokens')
                            ->label('Connects / Tokens')
                            ->badge()
                            ->color('info')
                            ->placeholder('-'),
                    ]),

                /* ---------------- Additional Data ---------------- */
                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('skills')
                            ->label('Skill Tags')
                            ->placeholder('-')
                            ->columnSpanFull()
                            ->wrap(),

                        TextEntry::make('notes')
                            ->label('Internal Notes')
                            ->columnSpanFull()
                            ->placeholder('-')
                            ->prose(),
                    ]),

                /* ---------------- Status & Timestamps ---------------- */
                Section::make('System Meta')
                    ->columns(3)
                    ->compact()
                    ->schema([
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn ($state) => match($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                                default => 'gray'
                            }),

                        TextEntry::make('created_at')
                            ->label('Created On')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
