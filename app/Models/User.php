<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ad;
use App\Models\Favourite;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Ad::class)->using(AdUser::class)->withPivot('id', 'user_id', 'ad_id');
        //return $this->belongsToMany(Ad::class, 'ad_user', 'user_id', 'ad_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'npa',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
