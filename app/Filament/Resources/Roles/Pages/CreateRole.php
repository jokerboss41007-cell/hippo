<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $role = \Spatie\Permission\Models\Role::create(['name' => $data['name']]);

        $role->syncPermissions(
            collect($data)
                ->filter(fn($v, $k) => str_starts_with($k, 'permissions_'))
                ->flatten()
                ->toArray()
        );

        return $data;
    }

}
