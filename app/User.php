<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value,
    // }

  
    protected $fillable = [
       'name',
	   'google_id',
       'lastname',
       'email',
       'country',
       'city',
       'address',
       'lng',
       'ltd',
       'radius',
       'phone',
       'image',
       'state',
       'zipcode',
       'country_code',
       'username',
       'company_name',
       'how_get_there',
       'type_of_building',
       'is_evicted',
       'price_range',
       'learn_more_about',
       'map_radius',
       'features_amenities',
       'monthly_income',
       'care_most_about',
       'bathroom_features',
       'move_date',
       'moving_destinations',
       'pets',
       'looking_lease_leght',
       'no_of_bedroom',
       'flexible_move_time',
       'user_type',
       'email_verified_at',
       'password',
       'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
