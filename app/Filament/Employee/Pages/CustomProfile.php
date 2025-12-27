<?php

namespace App\Filament\Employee\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Placeholder;
class CustomProfile extends Page
{
    public static function getNavigationIcon(): BackedEnum|string|null
    {
        return Heroicon::OutlinedUserCircle;
    }

    protected static ?string $title = 'My Profile';
    protected static ?string $navigationLabel = 'My Profile';

    protected string $view = 'filament.employee.pages.custom-profile';

    // 👇 This holds the form state when using Schema-based forms
    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();

        $this->data = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'profile_photo'         => $user->profile_photo ?? null,
            'password'              => null,
            'password_confirmation' => null,
        ];
    }

    /**
     * Schema-based form definition (Filament 4 "Schema" style)
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data') // 👈 bind form to $this->data
            ->components([
                // FileUpload::make('profile_photo')
                //     ->label('Profile Photo')
                //     ->avatar()
                //     ->disk('public')
                //     ->directory('profiles'),

                Placeholder::make('profile_name')
                    ->label('Name')
                    ->content(fn () => auth()->user()->name)
                    ->columnSpanFull(),

                Placeholder::make('profile_email')
                    ->label('Email')
                    ->content(fn () => auth()->user()->email)
                    ->columnSpanFull(),

                Placeholder::make('created_at')
                    ->label('Joining Date')
                    ->content(fn () => auth()->user()->email)
                    ->columnSpanFull(),

                Placeholder::make('profile_role')
                    ->label('Designation')
                    ->content(fn () => auth()->user()->roles->pluck('name')->join(', ') ?: 'N/A')
                    ->columnSpanFull(),
            ]);
    }

    public function save(): void
    {
        $user = auth()->user();
        $data = $this->data ?? [];

        // ✅ Handle password logic
        if (!empty($data['password'])) {
            if (($data['password'] ?? null) !== ($data['password_confirmation'] ?? null)) {
                Notification::make()
                    ->title('Password mismatch')
                    ->danger()
                    ->send();

                return;
            }

            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['password_confirmation']);

        $user->update($data);

        Notification::make()
            ->title('Profile updated successfully!')
            ->success()
            ->send();
    }
}
