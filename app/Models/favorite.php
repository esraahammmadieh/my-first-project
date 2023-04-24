<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;
    protected $table='favorites';
    protected $fillable = [
        'expert_id',
        'user_id'
    ];

    public function USER(){
    return $this->belongsTo(User::class);
    }

    public function expert(){
    return $this->belongsToMany(Expert::class);
    }
}

