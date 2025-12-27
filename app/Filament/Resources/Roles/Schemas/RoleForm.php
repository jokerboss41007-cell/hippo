<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\CheckboxList;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Role Name')
                ->required(),

            Section::make('Permissions')
                ->schema(self::permissionGroups())
                ->columns(1),
        ]);
    }

    private static function permissionGroups(): array
    {
        $permissions = Permission::all()
            ->groupBy(function ($permission) {
                $parts = explode(' ', $permission->name, 2);
                return $parts[1] ?? 'general';
            });

        $groups = [];

        foreach ($permissions as $module => $perms) {
            $fieldName = 'permissions_' . $module;

            $groups[] = Section::make(ucwords(str_replace('_', ' ', $module)))
                ->schema([
                    CheckboxList::make($fieldName)
                        ->label(false)
                        ->options($perms->pluck('name', 'name')->toArray())
                        ->columns(4)
                        ->bulkToggleable(),
                ])
                ->collapsed(false);
        }

        return $groups;
    }
}
