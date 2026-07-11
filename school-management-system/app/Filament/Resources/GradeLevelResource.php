<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeLevelResource\Pages;
use App\Models\GradeLevel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GradeLevelResource extends Resource
{
    protected static ?string $model = GradeLevel::class;

    protected static ?string $modelLabel = 'صف دراسي';

    protected static ?string $pluralModelLabel = 'الصفوف الدراسية';

    protected static ?string $navigationLabel = 'الصفوف الدراسية';

    protected static ?string $navigationGroup = 'الإعدادات الأكاديمية';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('اسم الصف')->required()->maxLength(255),
                Forms\Components\TextInput::make('code')->label('الرمز')->required()->maxLength(50)->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('sort_order')->label('ترتيب العرض')->numeric()->default(0),
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
                Tables\Columns\TextColumn::make('name')->label('اسم الصف')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('code')->label('الرمز')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sort_order')->label('الترتيب')->sortable(),
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
            'index' => Pages\ListGradeLevels::route('/'),
            'create' => Pages\CreateGradeLevel::route('/create'),
            'edit' => Pages\EditGradeLevel::route('/{record}/edit'),
        ];
    }    
}
