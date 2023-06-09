<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'property';
    protected $guarded = ['id'];

    public function property()
    {
        return $this->belongsTo(\App\Models\Image::class, 'id','property_id');
    }
}
