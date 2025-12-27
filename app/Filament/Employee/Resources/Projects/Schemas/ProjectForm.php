<?php

namespace App\Filament\Employee\Resources\Projects\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Client;
use App\Models\Bid;
use App\Models\User;
class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // 📌 Basic Project Info
            Section::make('Project Summary')
                ->description('General details about the project')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Project Name')
                            ->required(),

                        TextInput::make('status')
                            ->default('pending')
                            ->label('Project Status')
                            ->placeholder('e.g. ongoing / cancelled / completed'),
                    ]),

                    Textarea::make('description')
                        ->label('Project Description')
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-clipboard-document')
                ->columnSpanFull(),


            // 📅 Timeline
            Section::make('Project Timeline')
                ->description('Manage schedule and key dates')
                ->schema([
                    Grid::make(3)->schema([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->native(false)
                            ->required()
                            ->displayFormat('F j, Y'),

                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->native(false)
                            ->required()
                            ->displayFormat('F j, Y'),

                        DatePicker::make('deadline')
                            ->label('Deadline')
                            ->native(false)
                            ->displayFormat('F j, Y'),
                    ]),

                    DatePicker::make('completed_at')
                        ->label('Completed On')
                        ->displayFormat('F j, Y')
                        ->native(false),
                ])
                ->collapsed() // starts closed for clean UI
                ->icon('heroicon-o-calendar')
                ->columnSpanFull(),


            // 👥 Client + Bidding + Team
            Section::make('Associations')
                ->description('Link relevant client, project manager & bid')
                ->schema([
                    Grid::make(3)->schema([

                        // 🔹 Select client dynamically
                        Select::make('client_id')
                            ->label('Client')
                            ->searchable()
                            ->options(fn () => Client::pluck('name', 'id'))
                            ->placeholder('Select Client')
                            ->required(),

                        // 🔹 Select bid from Bid table
                        Select::make('bid_id')
                            ->label('Bid Reference')
                            ->searchable()
                            ->options(fn () => Bid::pluck('title', 'id'))
                            ->placeholder('Select Bid')
                            ->required(),

                        // 🔹 Select only users having Manager role
                        Select::make('project_manager')
                            ->label('Project Manager')
                            ->searchable()
                            ->options(fn () => User::role('manager')->pluck('name', 'id'))
                            ->placeholder('Select Manager')
                            ->required(),
                    ]),
                ])
                ->collapsed()
                ->icon('heroicon-o-users'),


            // 🌐 External Resource
            Section::make('Project Links & Tech')
                ->schema([
                    TextInput::make('project_link')
                        ->label('Project URL')
                        ->placeholder('https://project-link.com')
                        ->url()
                        ->suffixIcon('heroicon-o-link'),

                    TextInput::make('technology')
                        ->label('Technology Stack')
                        ->placeholder('React, Laravel, Vue, etc'),
                ])
                ->collapsed()
                ->icon('heroicon-o-globe-alt'),


            // 💰 Financials
            Section::make('Budget & Financials')
                ->description('Track revenue, expenses & net results')
                ->schema([
                    Grid::make(4)->schema([

                        TextInput::make('project_budget')
                            ->numeric()
                            ->prefix('$')
                            ->label('Budget'),

                        TextInput::make('final_cost')
                            ->numeric()
                            ->prefix('$')
                            ->label('Final Cost'),

                        TextInput::make('profit')
                            ->numeric()
                            ->prefix('+$')
                            ->label('Profit'),

                        TextInput::make('loss')
                            ->numeric()
                            ->prefix('-$')
                            ->label('Loss'),
                    ]),
                ])
                ->collapsed()
                ->icon('heroicon-o-currency-dollar')
                ->columnSpanFull(),

        ]);
    }
}
