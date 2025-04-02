<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('team_id')
                    ->label('Tim')
                    ->relationship('team', 'nama')
                    ->required(),

                FileUpload::make('foto_tim_berjersey') // Ganti dengan nama field yang sesuai
                    ->label('Foto Tim Berjersey')
                    ->image()
                    ->disk('public'),

                FileUpload::make('foto_jersey_pemain') // Ganti dengan nama field yang sesuai
                    ->label('Foto Jersey Pemain')
                    ->image()
                    ->disk('public'),

                FileUpload::make('foto_jersey_kiper') // Ganti dengan nama field yang sesuai
                    ->label('Foto Jersey Kiper')
                    ->image()
                    ->disk('public'),

                FileUpload::make('foto_player_satu') // Ganti dengan nama field yang sesuai
                    ->label('Foto Pemain 1')
                    ->image()
                    ->disk('public'),

                FileUpload::make('foto_player_dua') // Ganti dengan nama field yang sesuai
                    ->label('Foto Pemain 2')
                    ->image()
                    ->disk('public'),

                FileUpload::make('foto_player_tiga') // Ganti dengan nama field yang sesuai
                    ->label('Foto Pemain 3')
                    ->image()
                    ->disk('public'),

                FileUpload::make('surat_rekomendasi') // Ganti dengan nama field yang sesuai
                    ->label('Surat Rekomendasi')
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team.nama') // Menampilkan nama tim
                    ->label('Tim')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('foto_tim_berjersey') // Ganti sesuai dengan field yang diinginkan
                    ->label('Foto Tim Berjersey'),

                ImageColumn::make('foto_jersey_pemain') // Ganti sesuai dengan field yang diinginkan
                    ->label('Foto Jersey Pemain'),

                ImageColumn::make('foto_jersey_kiper') // Ganti sesuai dengan field yang diinginkan
                    ->label('Foto Jersey Kiper'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
