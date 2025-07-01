<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $table = 'covers';
    protected $fillable = ['hashed_name', 'audio_id', 'cover_type_id'];

    public function audio()
    {
        return $this->belongsTo(Audio::class);
    }
    
    public function coverType()
    {
        return $this->belongsTo(CoverType::class);
    }
}
