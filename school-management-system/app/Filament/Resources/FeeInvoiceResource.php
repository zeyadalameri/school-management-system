<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeInvoiceResource\Pages;
use App\Models\FeeInvoice;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FeeInvoiceResource extends Resource
{
    protected static ?string $model = FeeInvoice::class;

    protected static ?string $modelLabel = 'فاتورة رسوم';

    protected static ?string $pluralModelLabel = 'فواتير الرسوم';

    protected static ?string $navigationLabel = 'فواتير الرسوم';

    protected static ?string $navigationGroup = 'المالية';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('الطالب')
                    ->relationship('student', 'first_name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('academic_year_id')
                    ->label('السنة الدراسية')
                    ->relationship('academicYear', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('invoice_number')->label('رقم الفاتورة')->required()->maxLength(50)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('title')->label('عنوان الفاتورة')->required()->maxLength(255),
                Forms\Components\TextInput::make('amount')->label('المبلغ')->numeric()->required(),
                Forms\Components\DatePicker::make('due_date')->label('تاريخ الاستحقاق'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'partial' => 'مدفوع جزئيا',
                        'paid' => 'مدفوعة',
                        'overdue' => 'متأخرة',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')->label('ملاحظات')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->label('رقم الفاتورة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('student.first_name')->label('الطالب')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('title')->label('العنوان')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('المبلغ')->sortable(),
                Tables\Columns\TextColumn::make('due_date')->label('تاريخ الاستحقاق')->date()->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'pending' => 'قيد الانتظار',
                        'partial' => 'مدفوع جزئيا',
                        'paid' => 'مدفوعة',
                        'overdue' => 'متأخرة',
                    ])
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'partial',
                        'success' => 'paid',
                        'danger' => 'overdue',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'partial' => 'مدفوع جزئيا',
                        'paid' => 'مدفوعة',
                        'overdue' => 'متأخرة',
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
            'index' => Pages\ListFeeInvoices::route('/'),
            'create' => Pages\CreateFeeInvoice::route('/create'),
            'edit' => Pages\EditFeeInvoice::route('/{record}/edit'),
        ];
    }    
}
