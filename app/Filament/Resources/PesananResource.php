<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pesanan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers\DetailsRelationManager;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan')
                    ->schema([
                        TextInput::make('pembeli.name')
                            ->label('Nama Pembeli')
                            ->disabled()
                            ->dehydrated(false)
                            ->afterStateHydrated(function ($component, $state, $record) {
                                if ($record && $record->pembeli) {
                                    $component->state($record->pembeli->name);
                                } else {
                                    $component->state('N/A');
                                }
                            }),
                        TextInput::make('id')->label('ID Pesanan')->disabled(),
                        TextInput::make('total_harga')->numeric()->prefix('Rp')->disabled(),
                        TextInput::make('metode_pengiriman')->disabled(),
                        TextInput::make('metode_pembayaran')->disabled(),
                        Select::make('status')
                            ->options([
                                'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
                                'menunggu_pembayaran' => 'Menunggu Pembayaran',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ])
                            ->disabled(),
                        Textarea::make('catatan')->columnSpanFull()->disabled(),
                        Textarea::make('alamat_pengiriman')->columnSpanFull()->disabled(),
                        Placeholder::make('bukti_pembayaran')
                        ->label('Bukti Pembayaran')
                        ->content(function ($record) {
                            if ($record->bukti_transfer) {
                                return new \Illuminate\Support\HtmlString(
                                    "<img src='" . asset('storage/' . $record->bukti_transfer) . "' alt='bukti transfer' style='max-height: 300px;'>"
                                );
                            }
                            return 'Tidak ada bukti pembayaran.';
                        })
                        ->columnSpanFull()
                        ->visible(fn ($record) => $record && $record->bukti_transfer),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('pembeli.name')->label('Nama Pembeli')->searchable(),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'menunggu_konfirmasi' => 'warning',
                    'menunggu_pembayaran' => 'warning',
                    'menunggu_konfirmasi_pembayaran' => 'info', // Status baru kita
                    'pembayaran_ditolak' => 'danger', // Status baru kita
                    'diproses' => 'primary',
                    'selesai' => 'success',
                    'dibatalkan' => 'danger',
                }),
                TextColumn::make('total_harga')->money('IDR'),
                TextColumn::make('created_at')->label('Tanggal Pesan')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('pembeli')->where('penjual_id', Auth::id());
    }
}
