<?php

namespace App\Filament\Resources\PesananResource\Pages;

use Filament\Actions;
use App\Models\Pesanan;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Textarea as ComponentsTextarea;
use App\Filament\Resources\PesananResource;

class EditPesanan extends EditRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('konfirmasiPesananAwal')
                ->label('Konfirmasi Pesanan')
                ->color('primary')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->action(function (Pesanan $record) {
                    $nextStatus = $record->metode_pembayaran === 'transfer'
                                    ? 'menunggu_pembayaran'
                                    : 'diproses';

                    $record->update(['status' => $nextStatus]);

                    $this->getSavedNotification()->send();
                })
                ->successRedirectUrl(static::getResource()::getUrl('index'))
                ->visible(fn (Pesanan $record): bool => $record->status === 'menunggu_konfirmasi'),

            Actions\Action::make('batalkanPesanan')
                ->label('Batalkan Pesanan')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->modalHeading('Batalkan Pesanan')
                ->modalDescription('Apakah Anda yakin ingin membatalkan pesanan ini? Stok produk akan dikembalikan. Aksi ini tidak dapat diurungkan.')
                ->modalSubmitActionLabel('Ya, Batalkan')
                ->form([
                    ComponentsTextarea::make('alasan_pembatalan')
                        ->label('Alasan Pembatalan')
                        ->required(),
                ])
                ->action(function (Pesanan $record, array $data) {
                    foreach ($record->details as $detail) {
                        $detail->produk()->increment('stok', $detail->jumlah);
                    }

                    $record->update([
                        'status' => 'dibatalkan',
                        'catatan' => 'Dibatalkan oleh penjual: ' . $data['alasan_pembatalan']
                    ]);
                    $this->getSavedNotification()->send();
                })
                ->successRedirectUrl(static::getResource()::getUrl('index'))
                ->visible(fn (Pesanan $record): bool => $record->status === 'menunggu_konfirmasi'),

            Actions\Action::make('konfirmasiPembayaran')
                ->label('Konfirmasi Pembayaran')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function (Pesanan $record) {
                    $record->update([
                        'status' => 'diproses'
                    ]);
                    $this->getSavedNotification()->send();
                })
                ->successRedirectUrl(static::getResource()::getUrl('index'))
                ->visible(fn (Pesanan $record): bool => $record->status == 'menunggu_konfirmasi_pembayaran'),

            Actions\Action::make('tolakPembayaran')
                ->label('Tolak Pembayaran')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->requiresConfirmation()
                ->form([
                    ComponentsTextarea::make('alasan_penolakan')
                        ->label('Alasan Penolakan')
                        ->required(),
                ])
                ->action(function (Pesanan $record, array $data) {
                    $record->update([
                        'status' => 'pembayaran_ditolak',
                        'catatan' => $data['alasan_penolakan']
                    ]);
                    $this->getSavedNotification()->send();
                })
                ->successRedirectUrl(static::getResource()::getUrl('index'))
                ->visible(fn (Pesanan $record): bool => $record->status == 'menunggu_konfirmasi_pembayaran'),

            Actions\Action::make('selesaikanPesanan')
                ->label('Selesaikan Pesanan')
                ->color('success')
                ->icon('heroicon-o-check-badge')
                ->requiresConfirmation()
                ->action(function (Pesanan $record) {
                    $record->update([
                        'status' => 'selesai'
                    ]);
                    $this->getSavedNotification()->send();
                })
                ->successRedirectUrl(static::getResource()::getUrl('index'))
                ->visible(fn (Pesanan $record): bool => $record->status == 'diproses'),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

}
