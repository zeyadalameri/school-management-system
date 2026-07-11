<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $modelLabel = 'معلم';

    protected static ?string $pluralModelLabel = 'المعلمون';

    protected static ?string $navigationLabel = 'المعلمون';

    protected static ?string $navigationGroup = 'الأشخاص';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('حساب المستخدم')
                    ->relationship('user', 'name')
                    ->searchable(),
                Forms\Components\TextInput::make('employee_number')->label('الرقم الوظيفي')->required()->maxLength(50)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('first_name')->label('الاسم الأول')->required()->maxLength(255),
                Forms\Components\TextInput::make('last_name')->label('اسم العائلة')->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('رقم الجوال')->tel()->maxLength(50),
                Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email()->maxLength(255),
                Forms\Components\TextInput::make('specialization')->label('التخصص')->maxLength(255),
                Forms\Components\DatePicker::make('hired_on')->label('تاريخ التعيين'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee_number')->label('الرقم الوظيفي')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('first_name')->label('الاسم الأول')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('اسم العائلة')->searchable(),
                Tables\Columns\TextColumn::make('specialization')->label('التخصص')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('الجوال')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                    ])
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }    
}
