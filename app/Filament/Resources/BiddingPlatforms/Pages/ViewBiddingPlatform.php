<?php

namespace App\Filament\Resources\BiddingPlatforms\Pages;

use App\Filament\Resources\BiddingPlatforms\BiddingPlatformResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\ConnectionRequest;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
class ViewBiddingPlatform extends ViewRecord
{
    protected static string $resource = BiddingPlatformResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Platform Details')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Platform Name')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive'),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),

                Section::make('Financial Settings')
                    ->schema([
                        TextEntry::make('current_connection_balance')
                            ->label('Connects Balance')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('per_connection_cost')
                            ->label('Cost Per Connect')
                            ->badge()
                            ->money('USD'), // Added money formatting
                        TextEntry::make('conversion_rate')
                            ->label('Conversion Rate')
                            ->badge()
                            ->color('success')
                            ->suffix('%'), // Added percentage suffix
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible(),

                Section::make('Threshold Rules')
                    ->schema([
                        TextEntry::make('minimum_threshold_connection')
                            ->label('Minimum Threshold')
                            ->badge()
                            ->color('warning'),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->collapsible(),

                // 🔥 Active Requests
                // 🔥 Active Requests
            Section::make('Pending Connection Requests')
                ->description('Approve or reject connection requests made by bidders.')
                ->schema([
                    RepeatableEntry::make('pendingConnectionRequests')
                        ->label('')
                        ->schema([
                            TextEntry::make('requestedBy.name')
                                ->label('Requested By')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('notes')
                                ->label('Notes')
                                ->placeholder('-'),

                            TextEntry::make('created_at')
                                ->label('Requested On')
                                ->dateTime()
                                ->badge()
                                ->color('info'),
                            Action::make('edit')
                                ->label('Add Connect')
                                ->color('primary')
                                ->icon('heroicon-o-plus-circle')
                                ->url(fn ($record) => route(
                                    'filament.admin.resources.bidding-platforms.edit',
                                    $record
                                ))
                                ->openUrlInNewTab(false),


                            Section::make([
                                Action::make('approve')
                                    ->color('success')
                                    ->label('Approve')
                                    ->visible(fn (\App\Models\ConnectionRequest $record) => $record->status === 'pending')
                                    ->action(function (\App\Models\ConnectionRequest $record) {
                                        $record->update(['status' => 'approved']);

                                        Notification::make()
                                            ->title('Request Approved')
                                            ->success()
                                            ->send();
                                    }),

                                Action::make('reject')
                                    ->color('danger')
                                    ->label('Reject')
                                    ->form([
                                        \Filament\Forms\Components\Textarea::make('admin_notes')
                                            ->label('Reject Reason')
                                            ->required(),
                                    ])
                                    ->visible(fn (\App\Models\ConnectionRequest $record) => $record->status === 'pending')
                                    ->action(function (array $data, \App\Models\ConnectionRequest $record) {
                                        $record->update([
                                            'status'      => 'rejected',
                                            'admin_notes' => $data['admin_notes'],
                                        ]);

                                        Notification::make()
                                            ->title('Request Rejected')
                                            ->danger()
                                            ->send();
                                    }),
                            ])->columnSpanFull(),
                        ]),
                ])
                ->visible(fn ($record) => $record->pendingConnectionRequests()->exists())
                ->collapsible()
                ->columnSpanFull(),




                // 🔥 History
                Section::make('Connection Request History')
                    ->description('Track all past approvals and rejections for this platform.')
                    ->schema([
                        RepeatableEntry::make('connectionRequests')
                            ->label('')
                            ->schema([
                                TextEntry::make('requestedBy.name')->label('User')->badge()->color('gray'),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn($state) => match($state) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'pending' => 'warning',
                                        default => 'gray'
                                    }),
                                TextEntry::make('admin_notes')->label('Admin Notes')->placeholder('-')->columnSpanFull(),
                                TextEntry::make('updated_at')->label('Decision Date')->dateTime()->badge()->color('info'),
                            ])
                            ->columns(3)
                    ])
                    ->visible(fn($record) => $record->connectionRequests()->count() > 0)
                    ->collapsed()
                    ->columnSpanFull(),

            ]);
    }
}
