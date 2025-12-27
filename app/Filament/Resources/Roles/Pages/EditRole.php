<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $all = collect($data)
            ->filter(fn($v, $k) => str_starts_with($k, 'permissions_'))
            ->flatten()
            ->toArray();

        $this->record->syncPermissions($all);

        return ['name' => $data['name']];
    }

}
