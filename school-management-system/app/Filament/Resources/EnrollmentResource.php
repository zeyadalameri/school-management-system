<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Models\Enrollment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $modelLabel = 'تسجيل';

    protected static ?string $pluralModelLabel = 'التسجيلات';

    protected static ?string $navigationLabel = 'التسجيلات';

    protected static ?string $navigationGroup = 'العمليات';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';

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
                Forms\Components\Select::make('grade_level_id')
                    ->label('الصف الدراسي')
                    ->relationship('gradeLevel', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('section_id')
                    ->label('الشعبة')
                    ->relationship('section', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('roll_number')->label('رقم الطالب في الصف')->maxLength(50),
                Forms\Components\DatePicker::make('enrolled_on')->label('تاريخ التسجيل'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'enrolled' => 'مسجل',
                        'withdrawn' => 'منسحب',
                        'completed' => 'مكتمل',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')->label('الطالب')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('academicYear.name')->label('السنة')->sortable(),
                Tables\Columns\TextColumn::make('gradeLevel.name')->label('الصف')->sortable(),
                Tables\Columns\TextColumn::make('section.name')->label('الشعبة')->sortable(),
                Tables\Columns\TextColumn::make('roll_number')->label('رقم الصف')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'enrolled' => 'مسجل',
                        'withdrawn' => 'منسحب',
                        'completed' => 'مكتمل',
                    ])
                    ->colors([
                        'success' => 'enrolled',
                        'danger' => 'withdrawn',
                        'primary' => 'completed',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year_id')
                    ->relationship('academicYear', 'name')
                    ->label('السنة'),
                Tables\Filters\SelectFilter::make('grade_level_id')
                    ->relationship('gradeLevel', 'name')
                    ->label('الصف'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'enrolled' => 'مسجل',
                        'withdrawn' => 'منسحب',
                        'completed' => 'مكتمل',
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
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }    
}
