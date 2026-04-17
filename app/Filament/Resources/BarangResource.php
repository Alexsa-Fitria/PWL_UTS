<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static ?string $navigationLabel = 'Barang';
    
    protected static ?string $pluralLabel = 'Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(Kategori::all()->pluck('kategori_nama', 'kategori_id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('barang_kode')
                    ->label('Kode Barang')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('barang_nama')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('harga_beli')
                    ->label('Harga Beli')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('harga_jual')
                    ->label('Harga Jual')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('barang_id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('barang_kode')
                    ->label('Kode Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('barang_nama')
                    ->label('Nama Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.kategori_nama')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_beli')
                    ->label('Harga Beli')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_jual')
                    ->label('Harga Jual')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}