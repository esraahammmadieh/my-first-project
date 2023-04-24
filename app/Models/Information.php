<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Expert;
class Information extends Model
{
    use HasFactory;
    protected $table='informations';
    protected $primarykey='id';
    protected $fillable = [
    'expert_id',
    'name_of_counseling',
    'details'
    ];
    public $timestamps=false ;
    public function expert()
    {
        return $this->belongsTo(Expert::class,'expert_id');
    }
}
