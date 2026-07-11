<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuardianResource\Pages;
use App\Models\Guardian;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;

    protected static ?string $modelLabel = 'ولي أمر';

    protected static ?string $pluralModelLabel = 'أولياء الأمور';

    protected static ?string $navigationLabel = 'أولياء الأمور';

    protected static ?string $navigationGroup = 'الأشخاص';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->label('الاسم الأول')->required()->maxLength(255),
                Forms\Components\TextInput::make('last_name')->label('اسم العائلة')->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('رقم الجوال')->required()->tel()->maxLength(50),
                Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email()->maxLength(255),
                Forms\Components\TextInput::make('relationship')->label('صلة القرابة')->maxLength(100),
                Forms\Components\Textarea::make('address')->label('العنوان')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')->label('الاسم الأول')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->label('اسم العائلة')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('الجوال')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني')->searchable(),
                Tables\Columns\TextColumn::make('relationship')->label('صلة القرابة'),
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
            'index' => Pages\ListGuardians::route('/'),
            'create' => Pages\CreateGuardian::route('/create'),
            'edit' => Pages\EditGuardian::route('/{record}/edit'),
        ];
    }    
}
