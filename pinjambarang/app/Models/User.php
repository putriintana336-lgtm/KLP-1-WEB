<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    

    protected $fillable = [
        'name',
        'email',     
        'password',
        'role',
        'no_hp',     
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}