<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table='shedules';
    protected $primarykey='id';
    public $timestamps=false;
    protected $fillable = [
    'user_id',
    'expert_id',
    'day',
    'time'
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class,'expert_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
