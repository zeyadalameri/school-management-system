<?php

namespace App\Filament\Resources\GradeLevelResource\Pages;

use App\Filament\Resources\GradeLevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGradeLevels extends ListRecords
{
    protected static string $resource = GradeLevelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
