<?php

namespace App\Filament\Resources\Bids\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;
use App\Models\User;
class BidForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Bid Information')->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Select::make('platform')
                            ->options([
                                'Upwork'        => 'Upwork',
                                'Fiverr'        => 'Fiverr',
                                'PeoplePerHour' => 'PeoplePerHour',
                                'Freelancer'    => 'Freelancer',
                                'LinkedIn'      => 'LinkedIn',
                                'Other'         => 'Other',
                            ])
                            ->placeholder('Platform')
                            ->searchable()
                            ->required(),

                        Select::make('assigned_to')
                            ->label('Assign to')
                            ->options(User::whereHas('roles', fn($q) =>
                                            $q->where('name', 'bidder')
                                        )->pluck('name','id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('bid_amount')
                            ->label('Bid Amount ($)')
                            ->numeric()
                            ->prefix('$'),
                ]),

                Section::make('Bid Status & Performance')->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        Select::make('status')
                            ->native(false)
                            ->options([
                                'pending'        => '🟡 Pending',
                                'interviewing'   => '🔵 Interviewing',
                                'won'            => '🟢 Won',
                                'lost'           => '🔴 Lost',
                                'in_discussion'  => '🟣 In Discussion',
                                'closed'         => '⚫ Closed',
                            ])
                            ->required(),


                        DatePicker::make('deadline')
                            ->required(),

                        TextInput::make('project_budget')
                            ->numeric()
                            ->label('Project Budget ($)')
                            ->prefix('$'),
                ]),

                Section::make('Platform Connects & Stats')->columnSpanFull()
                    ->columns(3)
                    ->schema([
                            TextInput::make('connections_used')
                            ->numeric(),

                            TextInput::make('connections_left')
                            ->numeric(),

                            TextInput::make('outbid_count')
                            ->numeric(),
                    ]),

                Section::make('Technical Data')->columnSpanFull()
                    ->columns(2)
                    ->schema([
                            TextInput::make('technology')
                            ->placeholder('Laravel, Vue, React...'),

                            TextInput::make('project_link')
                            ->url()
                            ->label('Project Link'),

                            TextInput::make('proposal_url')
                            ->url()
                            ->columnSpanFull(),

                            Textarea::make('notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
