<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'm_user'; // Nama tabel
    protected $primaryKey = 'user_id'; // Primary key
    
    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
