<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PropertyImages extends Model
{
    public $guarded = ['id'];

	public $table = 'properties_images';
}
