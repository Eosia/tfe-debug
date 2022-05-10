<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\{
    User,
    City,
    Role,
    Level
};
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('firstname')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('city_id')
                    ->label('Ville')
                    ->options(City::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
//                Forms\Components\TextInput::make('password')
  //                  ->password()
    ///                ->maxLength(191),
                Forms\Components\Textarea::make('two_factor_secret')
                    ->maxLength(65535),
                Forms\Components\Textarea::make('two_factor_recovery_codes')
                    ->maxLength(65535),
                Forms\Components\Select::make('role_id')
                    ->label('Role')
                    ->options(Role::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\Select::make('level_id')
                    ->label('Level')
                    ->options(Level::orderBy('name', 'ASC')->pluck('name', 'id'))
                    //->searchable()
                    ->required(),
                Forms\Components\Toggle::make('suspended')
                    ->required(),
                Forms\Components\TextInput::make('current_team_id'),
                Forms\Components\TextInput::make('profile_photo_path')
                    ->maxLength(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('city_id'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('two_factor_secret'),
                Tables\Columns\TextColumn::make('two_factor_recovery_codes'),
                Tables\Columns\TextColumn::make('two_factor_confirmed_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('level_id'),
                Tables\Columns\TextColumn::make('role_id'),
                Tables\Columns\BooleanColumn::make('suspended'),
                Tables\Columns\TextColumn::make('current_team_id'),
                Tables\Columns\TextColumn::make('profile_photo_path'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
