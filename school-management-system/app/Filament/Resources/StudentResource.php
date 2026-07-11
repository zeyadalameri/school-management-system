<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $modelLabel = 'طالب';

    protected static ?string $pluralModelLabel = 'الطلاب';

    protected static ?string $navigationLabel = 'الطلاب';

    protected static ?string $navigationGroup = 'الأشخاص';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('guardian_id')
                    ->label('ولي الأمر')
                    ->relationship('guardian', 'first_name')
                    ->searchable(),
                Forms\Components\TextInput::make('admission_number')->label('رقم القيد')->required()->maxLength(50)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('first_name')->label('الاسم الأول')->required()->maxLength(255),
                Forms\Components\TextInput::make('last_name')->label('اسم العائلة')->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->label('الجنس')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                    ]),
                Forms\Components\DatePicker::make('date_of_birth')->label('تاريخ الميلاد'),
                Forms\Components\TextInput::make('phone')->label('رقم الجوال')->tel()->maxLength(50),
                Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email()->maxLength(255),
                Forms\Components\DatePicker::make('admitted_on')->label('تاريخ القبول'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                        'graduated' => 'متخرج',
                        'transferred' => 'منقول',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('address')->label('العنوان')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('admission_number')->label('رقم القيد')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('first_name')->label('الاسم الأول')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('اسم العائلة')->searchable(),
                Tables\Columns\TextColumn::make('guardian.first_name')->label('ولي الأمر')->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('الجنس')
                    ->enum([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                    ])
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('الحالة')
                    ->enum([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                        'graduated' => 'متخرج',
                        'transferred' => 'منقول',
                    ])
                    ->colors([
                        'success' => 'active',
                        'warning' => 'inactive',
                        'primary' => 'graduated',
                        'danger' => 'transferred',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                        'graduated' => 'متخرج',
                        'transferred' => 'منقول',
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
