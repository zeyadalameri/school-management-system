<?php

namespace App\Filament\Resources\FeeInvoiceResource\Pages;

use App\Filament\Resources\FeeInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeeInvoices extends ListRecords
{
    protected static string $resource = FeeInvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
