<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    use HasFactory;
    protected $table="hosts";
    protected $fillable = ["name","email"];


    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'user_id');
    }
    
}
