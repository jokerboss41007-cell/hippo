<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;

class PermissionForm
{
    public static function configure($schema)
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->unique(ignoreRecord: true),
        ]);
    }
}
