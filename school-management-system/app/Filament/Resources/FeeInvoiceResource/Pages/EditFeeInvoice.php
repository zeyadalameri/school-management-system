<?php

namespace App\Filament\Resources\FeeInvoiceResource\Pages;

use App\Filament\Resources\FeeInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeeInvoice extends EditRecord
{
    protected static string $resource = FeeInvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
