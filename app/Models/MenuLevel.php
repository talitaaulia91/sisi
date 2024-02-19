<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UUID;

class MenuLevel extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    use UUID;

    protected $table = 'menu_levels';

    protected $fillable = [
        'level',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }

}
