<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarkResource\Pages;
use App\Models\Mark;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MarkResource extends Resource
{
    protected static ?string $model = Mark::class;

    protected static ?string $modelLabel = 'درجة';

    protected static ?string $pluralModelLabel = 'الدرجات';

    protected static ?string $navigationLabel = 'الدرجات';

    protected static ?string $navigationGroup = 'العمليات';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('assessment_id')
                    ->label('التقييم')
                    ->relationship('assessment', 'title')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->label('الطالب')
                    ->relationship('student', 'first_name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('marks_obtained')->label('الدرجة المحصلة')->numeric()->required(),
                Forms\Components\Textarea::make('remarks')->label('ملاحظات')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('assessment.title')->label('التقييم')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('student.first_name')->label('الطالب')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('marks_obtained')->label('الدرجة')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإدخال')->dateTime()->sortable(),
            ])
            ->filters([
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
            'index' => Pages\ListMarks::route('/'),
            'create' => Pages\CreateMark::route('/create'),
            'edit' => Pages\EditMark::route('/{record}/edit'),
        ];
    }    
}
