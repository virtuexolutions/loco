<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyExternal extends Model
{
    use HasFactory;
    protected $table = 'property_externals';
    protected $guarded = [];
}
