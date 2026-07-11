<?php

namespace App\Filament\Resources\AttendanceRecordResource\Pages;

use App\Filament\Resources\AttendanceRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttendanceRecord extends EditRecord
{
    protected static string $resource = AttendanceRecordResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
