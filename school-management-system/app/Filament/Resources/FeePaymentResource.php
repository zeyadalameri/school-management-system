<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeePaymentResource\Pages;
use App\Models\FeePayment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FeePaymentResource extends Resource
{
    protected static ?string $model = FeePayment::class;

    protected static ?string $modelLabel = 'دفعة';

    protected static ?string $pluralModelLabel = 'المدفوعات';

    protected static ?string $navigationLabel = 'المدفوعات';

    protected static ?string $navigationGroup = 'المالية';

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('fee_invoice_id')
                    ->label('الفاتورة')
                    ->relationship('feeInvoice', 'invoice_number')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('paid_amount')->label('المبلغ المدفوع')->numeric()->required(),
                Forms\Components\DatePicker::make('paid_on')->label('تاريخ الدفع')->required(),
                Forms\Components\Select::make('payment_method')
                    ->label('طريقة الدفع')
                    ->options([
                        'cash' => 'نقدا',
                        'card' => 'بطاقة',
                        'bank_transfer' => 'تحويل بنكي',
                        'online' => 'دفع إلكتروني',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('reference_number')->label('رقم المرجع')->maxLength(100),
                Forms\Components\Textarea::make('notes')->label('ملاحظات')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('feeInvoice.invoice_number')->label('الفاتورة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('paid_amount')->label('المبلغ')->sortable(),
                Tables\Columns\TextColumn::make('paid_on')->label('تاريخ الدفع')->date()->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('طريقة الدفع')
                    ->enum([
                        'cash' => 'نقدا',
                        'card' => 'بطاقة',
                        'bank_transfer' => 'تحويل بنكي',
                        'online' => 'دفع إلكتروني',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference_number')->label('رقم المرجع')->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('طريقة الدفع')
                    ->options([
                        'cash' => 'نقدا',
                        'card' => 'بطاقة',
                        'bank_transfer' => 'تحويل بنكي',
                        'online' => 'دفع إلكتروني',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeePayments::route('/'),
            'create' => Pages\CreateFeePayment::route('/create'),
            'edit' => Pages\EditFeePayment::route('/{record}/edit'),
        ];
    }    
}
