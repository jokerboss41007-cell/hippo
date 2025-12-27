<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class ProfileStatusWidget extends TableWidget
{
    public function getTableQuery(): Builder
    {
        return User::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name'),
            TextColumn::make('role'),
            BadgeColumn::make('status')->colors([
                'success' => 'active',
                'danger'  => 'inactive'
            ]),
        ];
    }

}
