<?php

namespace App\Filament\Employee\Resources\PortfolioProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Facades\Auth;
use Filament\Schemas\Schema;

class PortfolioProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn () => Auth::id()),
                TextInput::make('title')
                    ->required(),
                TextInput::make('technology'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('project_url')
                    ->url(),
                DatePicker::make('completed_on'),
                TextInput::make('project_snap'),
            ]);
    }
}
