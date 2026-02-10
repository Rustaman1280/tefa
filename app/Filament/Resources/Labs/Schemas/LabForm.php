<?php

namespace App\Filament\Resources\Labs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LabForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jurusan_id')
                    ->relationship('jurusan', 'nama')
                    ->label('Jurusan')
                    ->searchable()
                    ->required(),
                TextInput::make('nama')
                    ->label('Nama Lab')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}