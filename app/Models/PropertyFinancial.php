<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFinancial extends Model
{
    use HasFactory;
    protected $table = 'property_financials';
    protected $guarded = [];
}
