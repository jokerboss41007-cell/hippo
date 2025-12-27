<?php

namespace App\Filament\Resources\BiddingProfiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Models\BiddingPlatform;
use App\Models\User;

class BiddingProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /** ---------------- PLATFORM & OWNER ------------------ */
            Section::make('Platform & Owner Details')
                ->description('Select the bidding platform and assign profile owner.')
                ->columns(2)
                ->schema([
                    Select::make('bidding_platform_id')
                        ->label('Platform')
                        ->required()
                        ->options(
                            BiddingPlatform::orderBy('title')->pluck('title','id')
                        )
                        ->searchable()
                        ->native(false)
                        ->validationMessages([
                            'required' => 'Please select the platform.',
                        ]),

                    Select::make('created_by')
                        ->label('Created By')
                        ->options(
                            User::whereHas('roles', fn ($query) =>
                                $query->where('name', 'admin')
                            )->orderBy('name')->pluck('name', 'id')
                        )
                        ->searchable()
                        ->required()
                        ->native(false)
                        ->validationMessages([
                            'required' => 'Please select who created this profile.',
                        ]),

                    TextInput::make('profile_name')
                        ->label('Profile Name')
                        ->maxLength(255)
                        ->required()
                        ->validationMessages([
                            'required' => 'Profile name is required.',
                            'max' => 'Profile name must not exceed 255 characters.',
                        ]),

                    TextInput::make('profile_url')
                        ->label('Profile URL')
                        ->url()
                        ->nullable()
                        ->validationMessages([
                            'url' => 'Please enter a valid URL.',
                        ]),
                ]),

            /** ---------------- LOGIN CREDENTIALS ------------------ */
            Section::make('Login Credentials')
                ->description('Internal use only — credentials are not publicly visible.')
                ->columns(2)
                ->schema([
                    TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->nullable()
                        ->validationMessages([
                            'email' => 'Enter a valid email address.',
                        ]),

                    TextInput::make('username')
                        ->label('Username')
                        ->nullable(),

                    TextInput::make('password_note')
                        ->label('Password / Notes')
                        ->password()
                        ->revealable(),

                    TextInput::make('category')
                        ->label('Category')
                        ->placeholder('Web Design, Mobile App, Ecommerce'),
                ]),

            /** ---------------- PERFORMANCE ------------------ */
            Section::make('Performance & Stats')
                ->columns(3)
                ->schema([
                    TextInput::make('success_score')
                        ->label('Success Score (%)')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(100)
                        ->suffix('%')
                        ->rules(['numeric', 'between:0,100'])
                        ->validationMessages([
                            'numeric' => 'Success score must be a number.',
                            'between' => 'Success score must be between 0 and 100.',
                        ]),

                    TextInput::make('rating')
                        ->label('Rating (out of 10)')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(10)
                        ->step('0.1')
                        ->rules(['numeric', 'between:0,10'])
                        ->validationMessages([
                            'numeric' => 'Rating must be numeric.',
                            'between' => 'Rating cannot exceed 10.',
                        ]),

                    TextInput::make('connects_or_tokens')
                        ->label('Connects / Tokens Available')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->rules(['integer', 'min:0'])
                        ->validationMessages([
                            'integer' => 'Connects must be a whole number.',
                            'min' => 'Connects cannot be negative.',
                        ]),
                ]),

            /** ---------------- OTHER DETAILS ------------------ */
            Section::make('Other Information')
                ->schema([
                    Textarea::make('skills')
                        ->label('Skill Tags')
                        ->placeholder("Laravel, Vue, Saas, API Integration…")
                        ->nullable(),

                    Textarea::make('notes')
                        ->label('Internal Notes')
                        ->nullable(),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'active'   => '🟢 Active',
                            'inactive' => '🔴 Inactive',
                        ])
                        ->default('active')
                        ->required()
                        ->validationMessages([
                            'required' => 'Please select a status.',
                        ]),
                ]),
        ]);
    }
}
