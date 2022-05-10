<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionResource\Pages;
use App\Filament\Resources\ProfessionResource\RelationManagers;
use App\Models\Category;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;

class ProfessionResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        $categories = Category::all();
        //dd($categories->all()->name);
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Profession')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('category_id')
                    ->label('Categorie')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Profession'),
                Tables\Columns\TextColumn::make('category_id')->label('Catégorie N°'),
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
            'index' => Pages\ListProfessions::route('/'),
            'create' => Pages\CreateProfession::route('/create'),
            'edit' => Pages\EditProfession::route('/{record}/edit'),
        ];
    }
}
