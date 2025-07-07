<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'penjual';
    }

    public function produks()
    {
        return $this->hasMany(Produk::class, 'penjual_id');
    }

    public function pesananSebagaiPenjual()
    {
        return $this->hasMany(Pesanan::class, 'penjual_id');
    }

    public function pesananSebagaiPembeli()
    {
        return $this->hasMany(Pesanan::class, 'pembeli_id');
    }

    public function getAvatarUrlAttribute(): string
    {
        $fullName = $this->name;

        $words = explode(' ', $fullName);

        $initials = mb_substr($words[0], 0, 1);

        if (count($words) > 1) {
            $initials .= mb_substr(end($words), 0, 1);
        }

        $nameForUrl = urlencode(strtoupper($initials));
        $backgroundColor = 'FBBF24';
        $textColor = 'FFFFFF';

        return "https://ui-avatars.com/api/?name={$nameForUrl}&color={$textColor}&background={$backgroundColor}&bold=true&length=" . (strlen($initials) > 1 ? 2 : 1);
    }

}
