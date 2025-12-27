<?php

namespace App\Filament\Resources\BiddingPlatforms\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\{TextInput, Toggle};
// use Filament\Schemas\Components\Toggle;
use Filament\Schemas\Components\Grid;

class BiddingPlatformForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Section::make('Platform Details')
                ->description('General information about the bidding platform.')
                ->icon('heroicon-o-globe-alt')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Platform Name')
                            ->placeholder('e.g., Upwork, Fiverr, Guru')
                            ->required()
                            ->maxLength(100),

                        Toggle::make('status')
                            ->label('Platform Active Status')
                            ->default(true)
                            ->inline(false),
                    ]),
                ])
                ->collapsible()
                ->compact(),

            Section::make('Account Settings')
                ->description('Configure platform-specific cost rules and current balance for bidding activities.')
                ->icon('heroicon-o-banknotes')
                ->schema([
                    Grid::make(2)->schema([

                        TextInput::make('current_connection_balance')
                            ->label('Current Connects Balance')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('0'),

                        TextInput::make('per_connection_cost')
                            ->label('Cost Per Connect')
                            ->suffix('₹')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('2.5'),

                    ]),

                    TextInput::make('minimum_threshold_connection')
                        ->label('Minimum Threshold Connects')
                        ->numeric()
                        ->minValue(0)
                        ->placeholder('10'),
                ])
                ->collapsible()
                ->compact(),

            Section::make('Conversion Settings')
                ->description('Settings related to lead conversion rates on this platform.')
                ->icon('heroicon-o-exclamation-triangle')
                ->schema([
                    TextInput::make('conversion_rate')
                        ->label('Conversion Rate')
                        ->placeholder('E.g. 7.5')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->step('0.1'),
                ])
                ->collapsible()
                ->compact(),

        ]);
    }
}
