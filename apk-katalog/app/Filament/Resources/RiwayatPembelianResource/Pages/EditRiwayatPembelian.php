<?php

namespace App\Filament\Resources\RiwayatPembelianResource\Pages;

use App\Filament\Resources\RiwayatPembelianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRiwayatPembelian extends EditRecord
{
    protected static string $resource = RiwayatPembelianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
