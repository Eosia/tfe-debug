<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\{
    Job,
    City,
    Profession,
    User
};
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Toggle;


class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\Toggle::make('moderate')
                    ->required(),
                Forms\Components\Select::make('profession_id')
                    ->label('Profession')
                    ->options(Profession::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->label('Ville')
                    ->options(City::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Utilisateur')
                    ->options(User::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\TextInput::make('time')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\BooleanColumn::make('status'),
                Tables\Columns\TextColumn::make('profession_id'),
                Tables\Columns\TextColumn::make('city_id'),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\BooleanColumn::make('moderate'),
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
