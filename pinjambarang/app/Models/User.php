<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}