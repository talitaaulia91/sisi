<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UUID;

class Menu extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use UUID;

    protected $table = 'menus';

    public function menu()
    {
        return $this->belongsTo(MenuLevel::class);
    }

}
