<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicYearResource\Pages;
use App\Models\AcademicYear;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;

    protected static ?string $modelLabel = 'سنة دراسية';

    protected static ?string $pluralModelLabel = 'السنوات الدراسية';

    protected static ?string $navigationLabel = 'السنوات الدراسية';

    protected static ?string $navigationGroup = 'الإعدادات الأكاديمية';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('اسم السنة')->required()->maxLength(255),
                Forms\Components\DatePicker::make('starts_on')->label('تبدأ في')->required(),
                Forms\Components\DatePicker::make('ends_on')->label('تنتهي في')->required(),
                Forms\Components\Toggle::make('is_current')->label('السنة الحالية'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشطة',
                        'archived' => 'مؤرشفة',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم السنة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('starts_on')->label('تبدأ في')->date()->sortable(),
                Tables\Columns\TextColumn::make('ends_on')->label('تنتهي في')->date()->sortable(),
                Tables\Columns\IconColumn::make('is_current')->label('الحالية')->boolean(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'active' => 'نشطة',
                        'archived' => 'مؤرشفة',
                    ])
                    ->colors([
                        'success' => 'active',
                        'secondary' => 'archived',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشطة',
                        'archived' => 'مؤرشفة',
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
            'index' => Pages\ListAcademicYears::route('/'),
            'create' => Pages\CreateAcademicYear::route('/create'),
            'edit' => Pages\EditAcademicYear::route('/{record}/edit'),
        ];
    }    
}
