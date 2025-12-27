<?php

namespace App\Filament\Employee\Resources\Bids\Pages;

use App\Filament\Employee\Resources\Bids\BidResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Models\{ConnectionRequest, BiddingPlatform, BiddingProfile, User};
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ListBids extends ListRecords
{
    protected static string $resource = BidResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            // 🔥 Request Connection Action
            Action::make('request_connection')
                ->label('Request Connection')
                ->icon('heroicon-o-paper-airplane')
                ->modalHeading('Request Platform/Profile Connection')
                ->form([
                    \Filament\Forms\Components\Select::make('bidding_platform_id')
                        ->label('Select Platform')
                        ->options(BiddingPlatform::pluck('title','id'))
                        ->reactive()
                        ->afterStateUpdated(fn($set) => $set('bidding_profile_id', null))
                        ->placeholder('Choose platform'),

                    \Filament\Forms\Components\Select::make('bidding_profile_id')
                        ->label('Select Profile')
                        ->options(BiddingProfile::pluck('profile_name','id'))
                        ->reactive()
                        ->afterStateUpdated(fn($set) => $set('bidding_platform_id', null))
                        ->placeholder('Choose profile'),

                    \Filament\Forms\Components\Textarea::make('notes')
                        ->label('Notes / Reason')
                        ->rows(3)
                        ->placeholder('Reason for your request...')
                        ->columnSpanFull()
                ])
                ->action(function (array $data) {

                    if (!$data['bidding_platform_id'] && !$data['bidding_profile_id']) {
                        Notification::make()
                            ->danger()
                            ->title('Please select Platform or Profile')
                            ->send();
                        return;
                    }

                    ConnectionRequest::create([
                        'requested_by' => Auth::id(),
                        'bidding_platform_id' => $data['bidding_platform_id'],
                        'bidding_profile_id' => $data['bidding_profile_id'],
                        'notes' => $data['notes'],
                        'status' => 'pending',
                    ]);

                    Notification::make()
                        ->title('New Connection Request')
                        ->body(Auth::user()->name . ' submitted a connect request.')
                        ->info()
                        ->sendToDatabase(User::role('admin')->get());

                    Notification::make()
                        ->success()
                        ->title('Request Sent Successfully')
                        ->send();
                })
                ->modalWidth('lg')
        ];
    }
}
