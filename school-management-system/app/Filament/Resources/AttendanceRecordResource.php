<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceRecordResource\Pages;
use App\Models\AttendanceRecord;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AttendanceRecordResource extends Resource
{
    protected static ?string $model = AttendanceRecord::class;

    protected static ?string $modelLabel = 'سجل حضور';

    protected static ?string $pluralModelLabel = 'سجلات الحضور';

    protected static ?string $navigationLabel = 'الحضور';

    protected static ?string $navigationGroup = 'العمليات';

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

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
                Forms\Components\Select::make('section_id')
                    ->label('الشعبة')
                    ->relationship('section', 'name')
                    ->searchable(),
                Forms\Components\DatePicker::make('attendance_date')->label('تاريخ الحضور')->required(),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'present' => 'حاضر',
                        'absent' => 'غائب',
                        'late' => 'متأخر',
                        'excused' => 'بعذر',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('notes')->label('ملاحظات')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('attendance_date')->label('التاريخ')->date()->sortable(),
                Tables\Columns\TextColumn::make('student.first_name')->label('الطالب')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('academicYear.name')->label('السنة')->sortable(),
                Tables\Columns\TextColumn::make('section.name')->label('الشعبة'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'present' => 'حاضر',
                        'absent' => 'غائب',
                        'late' => 'متأخر',
                        'excused' => 'بعذر',
                    ])
                    ->colors([
                        'success' => 'present',
                        'danger' => 'absent',
                        'warning' => 'late',
                        'primary' => 'excused',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'present' => 'حاضر',
                        'absent' => 'غائب',
                        'late' => 'متأخر',
                        'excused' => 'بعذر',
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
            'index' => Pages\ListAttendanceRecords::route('/'),
            'create' => Pages\CreateAttendanceRecord::route('/create'),
            'edit' => Pages\EditAttendanceRecord::route('/{record}/edit'),
        ];
    }    
}
