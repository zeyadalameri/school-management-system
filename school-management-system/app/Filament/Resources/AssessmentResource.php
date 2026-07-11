<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssessmentResource\Pages;
use App\Models\Assessment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $modelLabel = 'تقييم';

    protected static ?string $pluralModelLabel = 'التقييمات';

    protected static ?string $navigationLabel = 'التقييمات';

    protected static ?string $navigationGroup = 'العمليات';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                Forms\Components\Select::make('subject_id')
                    ->label('المادة')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('teacher_id')
                    ->label('المعلم')
                    ->relationship('teacher', 'first_name')
                    ->searchable(),
                Forms\Components\TextInput::make('title')->label('العنوان')->required()->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('النوع')
                    ->options([
                        'exam' => 'اختبار',
                        'quiz' => 'اختبار قصير',
                        'assignment' => 'واجب',
                        'project' => 'مشروع',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('total_marks')->label('الدرجة الكلية')->numeric()->required(),
                Forms\Components\DatePicker::make('assessment_date')->label('تاريخ التقييم'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'draft' => 'مسودة',
                        'published' => 'منشور',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('العنوان')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subject.name')->label('المادة')->sortable(),
                Tables\Columns\TextColumn::make('gradeLevel.name')->label('الصف')->sortable(),
                Tables\Columns\TextColumn::make('assessment_date')->label('التاريخ')->date()->sortable(),
                Tables\Columns\TextColumn::make('total_marks')->label('الدرجة الكلية')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'draft' => 'مسودة',
                        'published' => 'منشور',
                    ])
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('النوع')
                    ->options([
                        'exam' => 'اختبار',
                        'quiz' => 'اختبار قصير',
                        'assignment' => 'واجب',
                        'project' => 'مشروع',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'draft' => 'مسودة',
                        'published' => 'منشور',
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
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
        ];
    }    
}
