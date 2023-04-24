<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    protected $table="_ratings";
    protected $fillable = [
        'expert_id',
        'user_id',
        'numrating'
    ];

    public function User(){
    return $this->belongsTo(User::class);
    }

    public function expert(){
    return $this->belongsTo(Expert::class,'expert_id');
    }
}
