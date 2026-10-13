<?php

namespace App\Models;

// Menggunakan Authenticatable untuk fitur Login / Auth Laravel
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Kolom yang bisa diisi (Mass Assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'pembimbing_id', 
    ];

    /**
     * Kolom yang harus disembunyikan saat serialisasi data
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke model Pembimbing
     */
    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'pembimbing_id');
    }
}
