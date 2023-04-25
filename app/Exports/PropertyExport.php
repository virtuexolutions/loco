<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;

class PropertyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Property::all('name','specials','supmarket','built','bath','rent','send','escort','commission','bonus','amenity','floorplan');
    }
}
