<?php

namespace App\Filament\Resources\FeeInvoiceResource\Pages;

use App\Filament\Resources\FeeInvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeeInvoice extends CreateRecord
{
    protected static string $resource = FeeInvoiceResource::class;
}
