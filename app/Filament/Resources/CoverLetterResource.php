<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoverLetterResource\Pages;
use App\Filament\Resources\CoverLetterResource\RelationManagers;
use App\Models\CoverLetter;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CoverLetterResource extends Resource
{
    protected static ?string $model = CoverLetter::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('proposal_id')
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('proposal_id'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCoverLetters::route('/'),
            'create' => Pages\CreateCoverLetter::route('/create'),
            'edit' => Pages\EditCoverLetter::route('/{record}/edit'),
        ];
    }
}
