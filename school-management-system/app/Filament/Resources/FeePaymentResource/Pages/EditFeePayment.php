<?php

namespace App\Filament\Resources\FeePaymentResource\Pages;

use App\Filament\Resources\FeePaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeePayment extends EditRecord
{
    protected static string $resource = FeePaymentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
