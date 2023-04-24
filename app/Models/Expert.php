<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Expert extends Authenticatable
{
    use HasFactory,HasApiTokens;
    protected $table='experts';
    protected $primarykey='id';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'image_url',
        'Phone',
        'Address'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function informations()
    {
        return $this->hasMany(Information::class);
    }
    public function freeappointments()
    {
        return $this->hasMany(Freetime::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function Favorite()
    {
        return $this->hasMany(favorite::class);
    }
    public function Rating()
    {
        return $this->hasMany(rating::class);
    }
}
