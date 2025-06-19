<?php

namespace App\Filament\Resources\RiwayatPembelianResource\Pages;

use App\Filament\Resources\RiwayatPembelianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiwayatPembelians extends ListRecords
{
    protected static string $resource = RiwayatPembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
