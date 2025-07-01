<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table = 'audios';
    protected $fillable = ['original_name', 'hashed_name', 'extension'];

    public function covers()
    {
        return $this->hasMany(Cover::class);
    }
}
