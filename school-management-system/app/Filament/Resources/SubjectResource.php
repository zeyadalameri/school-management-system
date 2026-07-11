<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Subject;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $modelLabel = 'مادة';

    protected static ?string $pluralModelLabel = 'المواد';

    protected static ?string $navigationLabel = 'المواد';

    protected static ?string $navigationGroup = 'الإعدادات الأكاديمية';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grade_level_id')
                    ->label('الصف الدراسي')
                    ->relationship('gradeLevel', 'name')
                    ->searchable(),
                Forms\Components\Select::make('teacher_id')
                    ->label('المعلم')
                    ->relationship('teacher', 'first_name')
                    ->searchable(),
                Forms\Components\TextInput::make('name')->label('اسم المادة')->required()->maxLength(255),
                Forms\Components\TextInput::make('code')->label('الرمز')->required()->maxLength(50)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('weekly_hours')->label('الساعات الأسبوعية')->numeric()->default(0),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشطة',
                        'inactive' => 'غير نشطة',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('المادة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('code')->label('الرمز')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gradeLevel.name')->label('الصف')->sortable(),
                Tables\Columns\TextColumn::make('teacher.first_name')->label('المعلم')->searchable(),
                Tables\Columns\TextColumn::make('weekly_hours')->label('الساعات')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'active' => 'نشطة',
                        'inactive' => 'غير نشطة',
                    ])
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('grade_level_id')
                    ->relationship('gradeLevel', 'name')
                    ->label('الصف'),
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشطة',
                        'inactive' => 'غير نشطة',
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }    
}
