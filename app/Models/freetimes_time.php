<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freetimes_time extends Model
{
    use HasFactory;
    protected $table='freetimes_time';
    protected $primarykey='id';

    protected $fillable = [
        'expert_id',
        'day',
        'start_time',
        'end_time',
    ];
    public $timestamps=false ;
    public function expert()
    {
        return $this->belongsTo(Expert::class,'expert_id');
    }
}
