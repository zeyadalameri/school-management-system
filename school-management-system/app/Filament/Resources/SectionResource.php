<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $modelLabel = 'شعبة';

    protected static ?string $pluralModelLabel = 'الشعب';

    protected static ?string $navigationLabel = 'الشعب';

    protected static ?string $navigationGroup = 'الإعدادات الأكاديمية';

    protected static ?string $navigationIcon = 'heroicon-o-view-grid';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grade_level_id')
                    ->label('الصف الدراسي')
                    ->relationship('gradeLevel', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')->label('اسم الشعبة')->required()->maxLength(255),
                Forms\Components\TextInput::make('code')->label('الرمز')->maxLength(50),
                Forms\Components\TextInput::make('capacity')->label('السعة')->numeric()->default(30),
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
                Tables\Columns\TextColumn::make('gradeLevel.name')->label('الصف')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('الشعبة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('code')->label('الرمز')->searchable(),
                Tables\Columns\TextColumn::make('capacity')->label('السعة')->sortable(),
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }    
}
