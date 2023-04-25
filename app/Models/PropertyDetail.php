<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class PropertyDetail extends Model
{
    use HasFactory;
    protected $table = 'property_details';
    protected $guarded = [];

    public function options()
    {
        return $this->hasOne(\App\PropertyOptions::class,'property_id','listing_id')->where('user_id' ,'!=',Auth::user()->id);
    }
    public function hasoptions()
    {
        return $this->hasMany(\App\PropertyOptions::class,'property_id','listing_id');
    }
}
