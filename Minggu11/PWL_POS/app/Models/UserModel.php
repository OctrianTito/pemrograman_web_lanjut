<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    use HasFactory;

    protected $table = 'm_user';  // Mendefinisikan nama tabel yang digunakan di model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan PK dari tabel yang digunakan

    protected $fillable = [
        'level_id', 
        'username', 
        'nama', 
        'password',
        'image'
    ];
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

    public function getRole() {
        return $this->level->level_kode;
    }

    protected function image(): Attribute {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' . $image),
        );
    }
}
