<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\DatePicker;
class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ==========================
                //   AVATAR INITIALS
                // ==========================
                TextColumn::make('avatar')
                    ->label('')
                    ->formatStateUsing(function ($record) {
                        $name = $record->name;
                        $words = explode(' ', $name);
                        $first = strtoupper($words[0][0] ?? '');
                        $last  = strtoupper($words[1][0] ?? '');
                        return $first . $last;
                    })
                    ->badge()
                    ->color('primary')
                    ->extraAttributes([
                        'style' => 'border-radius:50%; font-weight:bold; width:35px; height:35px;
                                    display:flex; align-items:center; justify-content:center; font-size:14px;'
                    ]),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucwords($state)),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->separator(', ')
                    ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state)))
                    ->color('success'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // ==========================
            //         FILTERS 🔥
            // ==========================
            ->filters([

                // Filter by Role
                SelectFilter::make('role')
                    ->label('Filter By Role')
                    ->relationship('roles', 'name')
                    ->options(Role::pluck('name', 'id')->toArray()),

                // Email Verified True/False
                TernaryFilter::make('email_verified_at')
                    ->label('Email Verified')
                    ->trueLabel('Verified')
                    ->falseLabel('Not Verified')
                    ->nullable(),

                // OPTIONAL: Date filter (enable if needed)
                Tables\Filters\Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),
            ])

            ->actions([
                EditAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
