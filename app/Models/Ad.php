<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'km', 'power_kw', 'color_hexa', 'model_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ad_user', 'ad_id', 'user_id');
    }

    public function model()
    {
        return $this->belongsTo(BikeModel::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
