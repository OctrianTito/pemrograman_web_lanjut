<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';  // Mendefinisikan nama tabel yang digunakan di model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan PK dari tabel yang digunakan

    protected $fillable = ['level_id', 'username', 'nama', 'password'];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];
    
    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id'); // Mendefinisikan relasi OneToOne, menggunakan foreign key level_id dan primary key level_id di tabel m_level
    }

    public function getAuthIdentifierName(){
        return 'username';
    }

    /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool {
        return $this->level->level_kode == $role;
    }
}
