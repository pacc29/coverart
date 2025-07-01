<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverType extends Model
{
    protected $table = 'cover_types';
    protected $fillable = ['name'];

    public const FRONT = 1;
    public const BACK = 2;

    public function covers()
    {
        return $this->hasMany(Cover::class);
    }
}
