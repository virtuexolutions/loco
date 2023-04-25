<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyInterior extends Model
{
    use HasFactory;
    protected $table = 'property_interiors';
    protected $guarded = [];
}
