<?php

namespace App\Filament\Resources\Kelas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('jurusan_id')
            ->label('Jurusan')
            ->relationship('jurusan', 'nama')
            ->required()
            ->searchable()
            ->preload(),
            TextInput::make('nama')
            ->label('Nama Kelas')
            ->required()
            ->maxLength(255)
            ->placeholder('Contoh: TKJ 1'),
            Select::make('tingkat')
            ->label('Tingkat')
            ->options([
                '10' => 'Kelas 10',
                '11' => 'Kelas 11',
                '12' => 'Kelas 12',
            ])
            ->required()
            ->native(false),
        ]);
    }
}
