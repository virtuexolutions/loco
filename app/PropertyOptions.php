<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyDetail;
use App\User;

class PropertyOptions extends Model
{
    public $guarded = ['id'];

	public $table = 'properties_options';
	
	public function property()
    {
        return $this->hasOne(PropertyDetail::class,'listing_id','property_id');
    }
	
	public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}
