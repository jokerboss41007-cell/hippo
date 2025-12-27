<?php

namespace App\Filament\Employee\Resources\Bids\Tables;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class BidsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateDescription('Once you have bids, it will appear here.')
            ->emptyStateIcon('heroicon-o-briefcase')

            ->modifyQueryUsing(fn ($query) =>
                $query->where('assigned_to', Auth::id()) // 🔥 Only show assigned bids
            )

            ->columns([
                TextColumn::make('title')
                    ->label('Bid Title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                TextColumn::make('biddingProfile.profile_name')
                    ->sortable()
                    ->searchable()
                    ->badge(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info'    => 'interviewing',
                    ])
                    ->sortable(),

                TextColumn::make('bid_amount')
                    ->label('Bid $')
                    ->money('usd')
                    ->sortable(),
            ])

            ->filters([

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'       => 'Pending',
                        'interviewing'  => 'Interviewing',
                    ]),
            ])

            ->recordActions([
                EditAction::make(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
