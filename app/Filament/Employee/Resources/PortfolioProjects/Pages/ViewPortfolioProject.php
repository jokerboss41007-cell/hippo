<?php

namespace App\Filament\Employee\Resources\PortfolioProjects\Pages;

use App\Filament\Employee\Resources\PortfolioProjects\PortfolioProjectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Schemas\Schema;
class ViewPortfolioProject extends ViewRecord
{
    protected static string $resource = PortfolioProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->button()
                ->color('primary')
                ->icon('heroicon-m-pencil-square'),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Portfolio Project Details')
                    ->schema([

                        TextEntry::make('title')
                            ->label(false)
                            ->weight('bold')
                            ->size('2xl')
                            ->extraAttributes(['class'=>'text-gray-900 dark:text-gray-100']),

                        TextEntry::make('technology')
                            ->label('Tech Stack')
                            ->badge()
                            ->color('info')
                            ->extraAttributes(['class' => 'text-sm']),

                        TextEntry::make('description')
                            ->label('About Project')
                            ->columnSpanFull()
                            ->extraAttributes(['class'=>'leading-relaxed text-gray-600 dark:text-gray-300']),

                        TextEntry::make('completed_on')
                            ->label('Completed On')
                            ->date('F j, Y')
                            ->color('success'),

                        TextEntry::make('project_url')
                            ->label('Project Link')
                            // ->url()
                            ->openUrlInNewTab()
                            ->icon('heroicon-m-link')
                            ->color('primary')
                            ->extraAttributes(['class'=>'font-medium']),

                        ImageEntry::make('project_snap')
                            ->label('Preview')
                            ->columnSpanFull()
                            ->height('450px')
                            ->default(fn ($record) =>
                                $record->project_snap
                                    ? asset('storage/' . $record->project_snap)
                                    : 'https://cdn.slidemodel.com/wp-content/uploads/21550-01-portfolio-presentation-template-16x9-1.jpg'
                            )
                            ->extraAttributes([
                                'class' => 'shadow-md border border-gray-200 dark:border-gray-700 rounded-xl object-cover'
                            ]),

                    ])
                    ->columns(2) // clean two-column layout
                    ->columnSpanFull()
                    ->compact() // minimal design
                    ->extraAttributes(['class'=>'p-6 rounded-xl bg-white/70 dark:bg-gray-900/50 shadow-sm backdrop-blur-md'])
            ]);
    }
}
