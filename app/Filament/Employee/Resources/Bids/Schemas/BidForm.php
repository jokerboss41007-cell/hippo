<?php

namespace App\Filament\Employee\Resources\Bids\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use App\Models\{User, BiddingProfile};
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

                        Select::make('bidding_profile_id')
                            ->label('Profile')
                            ->options(
                                BiddingProfile::query()
                                    ->orderBy('profile_name')
                                    ->pluck('profile_name', 'id')
                            )
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->placeholder('Select a Profile'),

                        Select::make('status')
                            ->native(false)
                            ->options([
                                'pending'        => '🟡 Pending',
                                'interviewing'   => '🔵 Interviewing',
                                // 'won'            => '🟢 Won',
                                // 'lost'           => '🔴 Lost',
                                // 'in_discussion'  => '🟣 In Discussion',
                                'closed'         => '⚫ Closed',
                            ])
                            ->required(),

                        Select::make('assigned_to')
                            ->label('Assign to')
                            ->options(
                                User::whereHas('roles', fn($q) => $q->where('name', 'bidder'))
                                    ->pluck('name', 'id')
                            )
                            ->disabled()
                            ->dehydrated()
                            ->default(fn ($record) => $record?->assigned_to ?? Auth::id()),



                        TextInput::make('bid_amount')
                            ->label('Bid Amount ($)')
                            ->numeric()
                            ->prefix('$'),

                        TextInput::make('project_link')
                            ->url()
                            ->label('Project Link'),
                ]),

                Section::make('Platform Connects & Stats')->columnSpanFull()
                    ->columns(3)
                    ->schema([
                            TextInput::make('connections_used')
                            ->numeric(),

                            TextInput::make('outbid_count')
                            ->label('Connection refunded')
                            ->numeric(),
                    ]),

                Section::make('Additional Information')->columnSpanFull()
                    ->columns(2)
                    ->schema([
                            RichEditor::make('notes')
                            ->label('Notes / Detailed Proposal')
                            ->columnSpanFull()
                             ->extraAttributes([
                                     'style' => 'min-height: 450px;'
                                ])
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'strike',
                                'redo',
                                'undo',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'codeBlock',
                                'link',
                                // 'hr',
                            ]),

                    ]),
            ]);
    }
}
