<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;

class PropertyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // print_r($row->getRowCount());die;
        return new Property([
            'name'     => $row[0],
            'specials'    => $row[1], 
            'supmarket'    => $row[2], 
            'built'    => $row[3], 
            'bath'    => $row[4], 
            'rent'    => $row[5], 
            'send'    => $row[6], 
            'escort'    => $row[7], 
            'commission'    => $row[8], 
            'bonus'    => $row[9], 
            'studio_net_cost'    => $row[10], 
            'br_starting_1'    => $row[11], 
            'br_starting_2'    => $row[12], 
            'br_3'    => $row[13], 
            'br_den_1'    => $row[14], 
            'br_den_2'    => $row[15], 
            'penthouse'    => $row[16], 
            'amenity_fees'    => $row[17], 
            'essential_housing_available'    => $row[18], 
            'flooring'    => $row[19], 
            'flooring_color'    => $row[20], 
            'flooring_color_2'    => $row[21], 
            'cabinet_color'    => $row[22], 
            'cabinet_color_2'    => $row[23], 
            'counter_top_color'    => $row[24], 
            'counter_color_2'    => $row[25], 
            'stand_up_showers'    => $row[26], 
            'garden_tubs'    => $row[27], 
            'pool'    => $row[28], 
            'roof_top_pool'    => $row[29], 
            'lap_pool'    => $row[30], 
            'heated_pool'    => $row[31], 
            'hot_tub'    => $row[32], 
            'sauna'    => $row[33], 
            'fitness_center'    => $row[34], 
            'floor_to_ceiling_windows'    => $row[35], 
            'downtown_views'    => $row[36], 
            'private_yards'    => $row[37], 
            'stories'    => $row[38], 
            'type'    => $row[39], 
            'pet_spa'    => $row[40], 
            'rooftop_amenities'    => $row[41], 
            'washer_dryer_in_unit'    => $row[42], 
            'washer_dryer_laundry_facility'    => $row[43], 
            'apartment_name'    => $row[44], 
            'street'    => $row[45], 
            'city'    => $row[46], 
            'state'    => $row[47], 
            'neighborhood'    => $row[48], 
            'latitude'    => $row[49], 
            'longitude'    => $row[50], 
            'year_built_renovated'    => $row[51], 
            'bedrooms'    => $row[52], 
            'price_range'    => $row[53], 
            // 'floorplan'    => $row[11], 
        ]);
    }
}
