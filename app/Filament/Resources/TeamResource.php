<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action as ActionsAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kategori')
                    ->required()
                    ->label('Kategori'),

                TextInput::make('nama')
                    ->required()
                    ->label('Nama Tim'),

                FileUpload::make('logo')
                    ->image()
                    ->directory('team_logos')
                    ->label('Logo Tim')
                    ->disk('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Tim')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable(),

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public')
                    ->url(fn($record) => asset("storage/{$record}")),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'SMA' => 'SMA',
                        'PRODI' => 'Prodi',
                    ])
                    ->label('Filter Kategori'),
            ])
            ->actions([
                ActionsAction::make('download_team_pdf')
                    ->label('Download Tim')
                    ->icon('heroicon-s-arrow-down-tray')
                    ->action(fn(Team $team) => redirect()->route('download.team.pdf', $team->id)),

                ActionsAction::make('download_surat_pdf')
                    ->label('Download Surat Rekomendasi')
                    ->icon('heroicon-o-document-text')
                    ->url(fn(Team $team) => route('download.surat.pdf', $team->id))
                    ->openUrlInNewTab(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
