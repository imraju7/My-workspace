<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;



class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('business_name')->label('Business Name')
                    ->required()
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('logo'),
                Forms\Components\TextInput::make('address')->label('Business Physical Address')
                    ->required()
                    ->maxLength(255),
                // https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d306.24223304076384!2d87.99008641060045!3d26.64016219037149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e5bbbd73b9cce1%3A0x91a606bff7f827f2!2sByte%20Encoder!5e0!3m2!1sen!2snp!4v16
                Forms\Components\TextInput::make('location')->label('Map url')
                    ->url()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->label('Business Mail')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('Business Phone Number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('footer_text')->label('Footer Text')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                SpatieMediaLibraryImageColumn::make('logo')->conversion('logosize'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        $array = [
            'index' => Pages\ListSettings::route('/'),
            'edit' => Pages\EditSetting::route('/{record}/edit')
        ];
        if (Setting::count() == 0) {
            $array = Arr::add($array, 'create', Pages\CreateSetting::route('/create'));
        }
        return $array;
    }
}
