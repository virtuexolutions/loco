<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\PropertyFinancial;
use App\Models\PropertyAdditional;
use App\Models\PropertyPrimaryFeatures;
use App\Models\PropertyInterior;
use App\Models\PropertyExternal;
use App\Models\PropertyLocation;
use App\Models\PropertyImages;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        
       
         //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

 
    
     public function hit()
     {$this->apihit1();$this->apihit2();$this->apihit3();$this->apihit4(); $this->apihit5();}
     public function apihit5()
    {
    
        $response = Http::get('https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&start=5&type=results');
        $data= json_decode($response,1);
        foreach($data["Search Results"] as $k => $v)
        {
            $v["complete_detail"] = Http::get('https://sarosh.ad-wize.com/mls_data'.$v['details_link']);
            
            $vlongitudelatitude = explode(',',$v['longitude,latitude']);
            $property = PropertyDetail::where('listing_id',$v['complete_detail']['Basic Information']['Listing ID'])->first();
            if($property)
            {
                $propertydetail = [
                    'status' => (isset($v['status'])) ? $v['status'] :  $property->status,
                    'where_from'=>'api',
                    'image' => (isset($v['image'])) ? $v['image'] :  $property->image,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] :  $property->bedrooms,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] :  $property->totalbaths,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] :  $property->city,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] :  $property->state_abrv,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] :  $property->zip4_idx_hidden,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] :  $property->street_name,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] :  $property->number,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] :  $property->state,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] :  $property->zip_idx_hidden,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] :  $property->details_link,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] :  $property->longitude,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] :  $property->latitude,
                    'price' => (isset($v['price'])) ? $v['price'] :  $property->price,                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : $property->description,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : $property->contact_info,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : $property->detailsAddressRegion,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : $property->detailsAddressStreet,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : $property->subdivision,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : $property->listing_id,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : $property->full_baths,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : $property->property_type,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : $property->county,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : $property->year_built,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : $property->total_baths,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : $property->price_sqft,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : $property->partial_baths,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : $property->sqft,
                ];
                $property->update($propertydetail);
                $id = $property->id;
                $finance= PropertyFinancial::where('property_id',$id)->first();
                if(!empty($finance))
                {
                    $propertyFinancial = [
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] :  $finance->maintenance_fee_amount,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] :  $finance->hoa_mandatory,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] :  $finance->tax_rate,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] :  $finance->finance_available,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] :  $finance->tax_amount,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] :  $finance->fee_other_amount,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] :  $finance->compensation_buyer_agent,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] :  $finance->other_mandatory_fee,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] :  $finance->other_mandatory_fee,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] :  $finance->tax_year,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] :  $finance->water_sewer,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] :  $finance->fee_other,
                    ];
                    PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
                }else{
                    $propertyFinancial = [
                        'property_id' => $id,
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                    ];
                    PropertyFinancial::create($propertyFinancial);
                }
            
                $addition= PropertyAdditional::where('property_id',$id)->first();
                if(!empty($addition))
                {
                    $propertyAdditional = [
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : $addition->annual_maintenance_description,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : $addition->hoa_website,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : $addition->master_planned_community,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : $addition->restrictions,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : $addition->energy,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : $addition->legal,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : $addition->new_construction,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : $addition->year_built_source,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : $addition->exemptions,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : $addition->management_company_name,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : $addition->vacation_rental,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : $addition->disclosures,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : $addition->sqftsource,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : $addition->exclusions,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : $addition->builder_name,
                    ];
                    PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
                }else{
                    $propertyAdditional = [
                        'property_id' => $id,
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                    ];
                    PropertyAdditional::create($propertyAdditional);

                }
    
                $featuer =  PropertyPrimaryFeatures::where('property_id',$id)->first();
                if(!empty($featuer))
                {
                    $propertyPrimaryFeatures = [
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : $featuer->subdivision,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : $featuer->half_baths,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : $featuer->county,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : $featuer->year_built,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : $featuer->price_sqft,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : $featuer->property_type,
                    ];
                    PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
                }else{
                    $propertyPrimaryFeatures = [
                        'property_id' => $id,
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                    ];
                    PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                }
                
                $interior = PropertyInterior::where('property_id',$id)->first();
                if(!empty($interior))
                {
                    $propertyInterior = [
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : $interior->dishwasher,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : $interior->heat_system,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : $interior->disposal,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : $interior->room_description,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : $interior->bedroom_description,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : $interior->microwave,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : $interior->icemaker,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : $interior->connections,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : $interior->compactor,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : $interior->floors,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : $interior->master_bath_description,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : $interior->cool_system,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : $interior->interior,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : $interior->oven_type,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : $interior->fireplace_description,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : $interior->countertops,
                    ];
                    PropertyInterior::where('property_id',$id)->update($propertyInterior);
                }else{
                    $propertyInterior = [
                        'property_id' => $id,
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                    ];
                    PropertyInterior::create($propertyInterior);
                }
            
                $external = PropertyExternal::where('property_id',$id)->first();
                if(!empty($external))
                {
                    $propertyExternal = [
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : $external->foundation,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : $external->street_surface,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : $external->garage_description,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : $external->lot_description,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : $external->acres_description,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : $external->front_door_faces,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : $external->style,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : $external->pool_private_description,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : $external->garage_carport,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : $external->access,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : $external->lot_size,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : $external->number_of_garage_capacity,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : $external->exterior,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : $external->roof,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : $external->stories,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : $external->pool_area,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : $external->pool_private,
                    ];
                    PropertyExternal::where('property_id',$id)->update($propertyExternal);
                }else{
                    $propertyExternal = [
                        'property_id' => $id,
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                    ];
                    PropertyExternal::create($propertyExternal);
                }
        
                $location =  PropertyLocation::where('property_id',$id)->first();
                if(!empty($location))
                {
                    $propertyLocation = [
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : $location->parcel_number, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : $location->middle_school,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : $location->area, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : $location->high_school,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : $location->elementary_school, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : $location->subdivision,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : $location->school_district,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : $location->geo_market_area,  
                    ];
                        PropertyLocation::where('property_id',$id)->update($propertyLocation);

                }else{
                    $propertyLocation = [
                        'property_id' => $id,
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                    ];
    
                    PropertyLocation::create($propertyLocation);

                }                
                if(isset($v['complete_detail']['images']))
                {
                    $propertyImages = $v['complete_detail']['images'];                
                    foreach($propertyImages as $i)
                    {
                
                            $image = [
                                'image_url' => $i
                            ];
                            PropertyImages::create([
                                'property_id'=>$id,
                                'image_url' => $i
                            ]);
                        
                        
                    }
                }
                
            }
            else
            {

                $propertydetail = [
                    'status' => (isset($v['status'])) ? $v['status'] : null,
                    'where_from'=>'api',
                    'image' => (isset($v['image'])) ? $v['image'] : null,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] : null,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] : null,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] : null,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] : null,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] : null,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] : null,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] : null,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] : null,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] : null,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] : null,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] : null,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] : null,
                    'price' => (isset($v['price'])) ? $v['price'] : null,
                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : null,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : null,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : null,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : null,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : null,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : null,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : null,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : null,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : null,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : null,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : null,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : null,
                ];
                $property = PropertyDetail::create($propertydetail);
                $id = $property->id;
                $propertyFinancial = [
                    'property_id' => $id,
                    'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                    'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                    'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                    'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                    'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                    'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                    'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                    'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                    'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                    'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                    'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                    'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                ];
                PropertyFinancial::create($propertyFinancial);
                
                $propertyAdditional = [
                    'property_id' => $id,
                    'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                    'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                    'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                    'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                    'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                    'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                    'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                    'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                    'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                    'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                    'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                    'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                    'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                    'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                    'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                ];
                PropertyAdditional::create($propertyAdditional);
                
                $propertyPrimaryFeatures = [
                    'property_id' => $id,
                    'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                    'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                    'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                    'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                ];
                PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                
                $propertyInterior = [
                    'property_id' => $id,
                    'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                    'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                    'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                    'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                    'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                    'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                    'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                    'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                    'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                    'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                    'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                    'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                    'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                    'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                    'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                    'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                ];
                PropertyInterior::create($propertyInterior);
                
                $propertyExternal = [
                    'property_id' => $id,
                    'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                    'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                    'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                    'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                    'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                    'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                    'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                    'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                    'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                    'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                    'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                    'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                    'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                    'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                    'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                    'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                    'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                ];
                PropertyExternal::create($propertyExternal);
                
                $propertyLocation = [
                    'property_id' => $id,
                    'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                    'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                    'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                    'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                    'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                    'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                    'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                    'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                ];

                PropertyLocation::create($propertyLocation);

                $propertyImages = $v['complete_detail']['images'];
                foreach($propertyImages as $i)
                {
                    $image = [
                        'image_url' => $i
                    ];
                    PropertyImages::create([
                        'property_id' => $id,
                        'image_url' => $i
                    ]);
                }
            }
        }
    }
     public function apihit4()
    {
    
        $response = Http::get('https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&start=4&type=results');
        $data= json_decode($response,1);
        foreach($data["Search Results"] as $k => $v)
        {
            $v["complete_detail"] = Http::get('https://sarosh.ad-wize.com/mls_data'.$v['details_link']);
            
            $vlongitudelatitude = explode(',',$v['longitude,latitude']);
            $property = PropertyDetail::where('listing_id',$v['complete_detail']['Basic Information']['Listing ID'])->first();
            if($property)
            {
                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] :  $property->status,
                    'image' => (isset($v['image'])) ? $v['image'] :  $property->image,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] :  $property->bedrooms,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] :  $property->totalbaths,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] :  $property->city,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] :  $property->state_abrv,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] :  $property->zip4_idx_hidden,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] :  $property->street_name,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] :  $property->number,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] :  $property->state,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] :  $property->zip_idx_hidden,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] :  $property->details_link,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] :  $property->longitude,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] :  $property->latitude,
                    'price' => (isset($v['price'])) ? $v['price'] :  $property->price,                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : $property->description,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : $property->contact_info,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : $property->detailsAddressRegion,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : $property->detailsAddressStreet,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : $property->subdivision,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : $property->listing_id,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : $property->full_baths,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : $property->property_type,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : $property->county,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : $property->year_built,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : $property->total_baths,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : $property->price_sqft,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : $property->partial_baths,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : $property->sqft,
                ];
                $property->update($propertydetail);
                $id = $property->id;
                $finance= PropertyFinancial::where('property_id',$id)->first();
                if(!empty($finance))
                {
                    $propertyFinancial = [
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] :  $finance->maintenance_fee_amount,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] :  $finance->hoa_mandatory,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] :  $finance->tax_rate,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] :  $finance->finance_available,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] :  $finance->tax_amount,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] :  $finance->fee_other_amount,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] :  $finance->compensation_buyer_agent,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] :  $finance->other_mandatory_fee,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] :  $finance->other_mandatory_fee,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] :  $finance->tax_year,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] :  $finance->water_sewer,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] :  $finance->fee_other,
                    ];
                    PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
                }else{
                    $propertyFinancial = [
                        'property_id' => $id,
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                    ];
                    PropertyFinancial::create($propertyFinancial);
                }
            
                $addition= PropertyAdditional::where('property_id',$id)->first();
                if(!empty($addition))
                {
                    $propertyAdditional = [
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : $addition->annual_maintenance_description,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : $addition->hoa_website,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : $addition->master_planned_community,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : $addition->restrictions,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : $addition->energy,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : $addition->legal,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : $addition->new_construction,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : $addition->year_built_source,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : $addition->exemptions,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : $addition->management_company_name,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : $addition->vacation_rental,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : $addition->disclosures,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : $addition->sqftsource,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : $addition->exclusions,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : $addition->builder_name,
                    ];
                    PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
                }else{
                    $propertyAdditional = [
                        'property_id' => $id,
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                    ];
                    PropertyAdditional::create($propertyAdditional);

                }
    
                $featuer =  PropertyPrimaryFeatures::where('property_id',$id)->first();
                if(!empty($featuer))
                {
                    $propertyPrimaryFeatures = [
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : $featuer->subdivision,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : $featuer->half_baths,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : $featuer->county,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : $featuer->year_built,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : $featuer->price_sqft,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : $featuer->property_type,
                    ];
                    PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
                }else{
                    $propertyPrimaryFeatures = [
                        'property_id' => $id,
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                    ];
                    PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                }
                
                $interior = PropertyInterior::where('property_id',$id)->first();
                if(!empty($interior))
                {
                    $propertyInterior = [
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : $interior->dishwasher,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : $interior->heat_system,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : $interior->disposal,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : $interior->room_description,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : $interior->bedroom_description,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : $interior->microwave,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : $interior->icemaker,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : $interior->connections,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : $interior->compactor,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : $interior->floors,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : $interior->master_bath_description,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : $interior->cool_system,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : $interior->interior,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : $interior->oven_type,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : $interior->fireplace_description,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : $interior->countertops,
                    ];
                    PropertyInterior::where('property_id',$id)->update($propertyInterior);
                }else{
                    $propertyInterior = [
                        'property_id' => $id,
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                    ];
                    PropertyInterior::create($propertyInterior);
                }
            
                $external = PropertyExternal::where('property_id',$id)->first();
                if(!empty($external))
                {
                    $propertyExternal = [
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : $external->foundation,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : $external->street_surface,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : $external->garage_description,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : $external->lot_description,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : $external->acres_description,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : $external->front_door_faces,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : $external->style,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : $external->pool_private_description,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : $external->garage_carport,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : $external->access,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : $external->lot_size,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : $external->number_of_garage_capacity,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : $external->exterior,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : $external->roof,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : $external->stories,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : $external->pool_area,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : $external->pool_private,
                    ];
                    PropertyExternal::where('property_id',$id)->update($propertyExternal);
                }else{
                    $propertyExternal = [
                        'property_id' => $id,
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                    ];
                    PropertyExternal::create($propertyExternal);
                }
        
                $location =  PropertyLocation::where('property_id',$id)->first();
                if(!empty($location))
                {
                    $propertyLocation = [
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : $location->parcel_number, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : $location->middle_school,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : $location->area, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : $location->high_school,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : $location->elementary_school, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : $location->subdivision,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : $location->school_district,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : $location->geo_market_area,  
                    ];
    
                    PropertyLocation::where('property_id',$id)->update($propertyLocation);
    
                }else{
                    $propertyLocation = [
                        'property_id' => $id,
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                    ];
    
                    PropertyLocation::create($propertyLocation);

                }                
                if(isset($v['complete_detail']['images']))
                {
                    $propertyImages = $v['complete_detail']['images'];                
                    foreach($propertyImages as $i)
                    {
                
                            $image = [
                                'image_url' => $i
                            ];
                            PropertyImages::create([
                                'property_id'=>$id,
                                'image_url' => $i
                            ]);
                        
                        
                    }
                }
                
            }
            else
            {

                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] : null,
                    'image' => (isset($v['image'])) ? $v['image'] : null,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] : null,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] : null,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] : null,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] : null,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] : null,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] : null,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] : null,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] : null,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] : null,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] : null,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] : null,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] : null,
                    'price' => (isset($v['price'])) ? $v['price'] : null,
                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : null,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : null,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : null,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : null,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : null,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : null,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : null,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : null,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : null,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : null,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : null,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : null,
                ];
                $property = PropertyDetail::create($propertydetail);
                $id = $property->id;
                $propertyFinancial = [
                    'property_id' => $id,
                    'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                    'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                    'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                    'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                    'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                    'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                    'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                    'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                    'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                    'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                    'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                    'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                ];
                PropertyFinancial::create($propertyFinancial);
                
                $propertyAdditional = [
                    'property_id' => $id,
                    'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                    'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                    'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                    'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                    'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                    'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                    'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                    'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                    'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                    'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                    'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                    'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                    'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                    'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                    'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                ];
                PropertyAdditional::create($propertyAdditional);
                
                $propertyPrimaryFeatures = [
                    'property_id' => $id,
                    'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                    'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                    'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                    'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                ];
                PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                
                $propertyInterior = [
                    'property_id' => $id,
                    'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                    'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                    'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                    'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                    'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                    'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                    'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                    'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                    'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                    'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                    'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                    'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                    'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                    'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                    'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                    'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                ];
                PropertyInterior::create($propertyInterior);
                
                $propertyExternal = [
                    'property_id' => $id,
                    'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                    'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                    'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                    'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                    'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                    'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                    'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                    'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                    'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                    'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                    'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                    'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                    'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                    'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                    'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                    'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                    'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                ];
                PropertyExternal::create($propertyExternal);
                
                $propertyLocation = [
                    'property_id' => $id,
                    'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                    'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                    'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                    'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                    'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                    'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                    'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                    'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                ];

                PropertyLocation::create($propertyLocation);

                $propertyImages = $v['complete_detail']['images'];
                foreach($propertyImages as $i)
                {
                    $image = [
                        'image_url' => $i
                    ];
                    PropertyImages::create([
                        'property_id' => $id,
                        'image_url' => $i
                    ]);
                }
            }
        }
    }
     public function apihit3()
    {
    
        $response = Http::get('https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&start=3&type=results');
        $data= json_decode($response,1);
        foreach($data["Search Results"] as $k => $v)
        {
            $v["complete_detail"] = Http::get('https://sarosh.ad-wize.com/mls_data'.$v['details_link']);
            
            $vlongitudelatitude = explode(',',$v['longitude,latitude']);
            $property = PropertyDetail::where('listing_id',$v['complete_detail']['Basic Information']['Listing ID'])->first();
            if($property)
            {
                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] :  $property->status,
                    'image' => (isset($v['image'])) ? $v['image'] :  $property->image,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] :  $property->bedrooms,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] :  $property->totalbaths,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] :  $property->city,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] :  $property->state_abrv,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] :  $property->zip4_idx_hidden,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] :  $property->street_name,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] :  $property->number,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] :  $property->state,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] :  $property->zip_idx_hidden,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] :  $property->details_link,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] :  $property->longitude,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] :  $property->latitude,
                    'price' => (isset($v['price'])) ? $v['price'] :  $property->price,                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : $property->description,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : $property->contact_info,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : $property->detailsAddressRegion,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : $property->detailsAddressStreet,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : $property->subdivision,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : $property->listing_id,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : $property->full_baths,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : $property->property_type,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : $property->county,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : $property->year_built,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : $property->total_baths,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : $property->price_sqft,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : $property->partial_baths,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : $property->sqft,
                ];
                $property->update($propertydetail);
                $id = $property->id;
                $finance= PropertyFinancial::where('property_id',$id)->first();
                if(!empty($finance))
                {
                    $propertyFinancial = [
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] :  $finance->maintenance_fee_amount,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] :  $finance->hoa_mandatory,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] :  $finance->tax_rate,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] :  $finance->finance_available,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] :  $finance->tax_amount,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] :  $finance->fee_other_amount,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] :  $finance->compensation_buyer_agent,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] :  $finance->other_mandatory_fee,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] :  $finance->other_mandatory_fee,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] :  $finance->tax_year,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] :  $finance->water_sewer,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] :  $finance->fee_other,
                    ];
                    PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
                }else{
                    $propertyFinancial = [
                        'property_id' => $id,
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                    ];
                    PropertyFinancial::create($propertyFinancial);
                }
            
                $addition= PropertyAdditional::where('property_id',$id)->first();
                if(!empty($addition))
                {
                    $propertyAdditional = [
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : $addition->annual_maintenance_description,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : $addition->hoa_website,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : $addition->master_planned_community,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : $addition->restrictions,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : $addition->energy,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : $addition->legal,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : $addition->new_construction,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : $addition->year_built_source,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : $addition->exemptions,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : $addition->management_company_name,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : $addition->vacation_rental,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : $addition->disclosures,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : $addition->sqftsource,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : $addition->exclusions,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : $addition->builder_name,
                    ];
                    PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
                }else{
                    $propertyAdditional = [
                        'property_id' => $id,
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                    ];
                    PropertyAdditional::create($propertyAdditional);

                }
    
                $featuer =  PropertyPrimaryFeatures::where('property_id',$id)->first();
                if(!empty($featuer))
                {
                    $propertyPrimaryFeatures = [
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : $featuer->subdivision,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : $featuer->half_baths,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : $featuer->county,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : $featuer->year_built,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : $featuer->price_sqft,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : $featuer->property_type,
                    ];
                    PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
                }else{
                    $propertyPrimaryFeatures = [
                        'property_id' => $id,
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                    ];
                    PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                }
                
                $interior = PropertyInterior::where('property_id',$id)->first();
                if(!empty($interior))
                {
                    $propertyInterior = [
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : $interior->dishwasher,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : $interior->heat_system,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : $interior->disposal,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : $interior->room_description,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : $interior->bedroom_description,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : $interior->microwave,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : $interior->icemaker,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : $interior->connections,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : $interior->compactor,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : $interior->floors,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : $interior->master_bath_description,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : $interior->cool_system,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : $interior->interior,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : $interior->oven_type,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : $interior->fireplace_description,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : $interior->countertops,
                    ];
                    PropertyInterior::where('property_id',$id)->update($propertyInterior);
                }else{
                    $propertyInterior = [
                        'property_id' => $id,
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                    ];
                    PropertyInterior::create($propertyInterior);
                }
            
                $external = PropertyExternal::where('property_id',$id)->first();
                if(!empty($external))
                {
                    $propertyExternal = [
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : $external->foundation,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : $external->street_surface,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : $external->garage_description,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : $external->lot_description,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : $external->acres_description,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : $external->front_door_faces,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : $external->style,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : $external->pool_private_description,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : $external->garage_carport,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : $external->access,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : $external->lot_size,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : $external->number_of_garage_capacity,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : $external->exterior,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : $external->roof,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : $external->stories,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : $external->pool_area,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : $external->pool_private,
                    ];
                    PropertyExternal::where('property_id',$id)->update($propertyExternal);
                }else{
                    $propertyExternal = [
                        'property_id' => $id,
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                    ];
                    PropertyExternal::create($propertyExternal);
                }
        
                $location =  PropertyLocation::where('property_id',$id)->first();
                if(!empty($location))
                {
                    $propertyLocation = [
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : $location->parcel_number, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : $location->middle_school,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : $location->area, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : $location->high_school,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : $location->elementary_school, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : $location->subdivision,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : $location->school_district,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : $location->geo_market_area,  
                    ];
    
                    PropertyLocation::where('property_id',$id)->update($propertyLocation);
    
                }else{
                    $propertyLocation = [
                        'property_id' => $id,
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                    ];
    
                    PropertyLocation::create($propertyLocation);

                }                
                if(isset($v['complete_detail']['images']))
                {
                    $propertyImages = $v['complete_detail']['images'];                
                    foreach($propertyImages as $i)
                    {
                
                            $image = [
                                'image_url' => $i
                            ];
                            PropertyImages::create([
                                'property_id'=>$id,
                                'image_url' => $i
                            ]);
                        
                        
                    }
                }
                
            }
            else
            {

                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] : null,
                    'image' => (isset($v['image'])) ? $v['image'] : null,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] : null,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] : null,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] : null,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] : null,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] : null,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] : null,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] : null,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] : null,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] : null,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] : null,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] : null,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] : null,
                    'price' => (isset($v['price'])) ? $v['price'] : null,
                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : null,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : null,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : null,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : null,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : null,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : null,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : null,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : null,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : null,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : null,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : null,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : null,
                ];
                $property = PropertyDetail::create($propertydetail);
                $id = $property->id;
                $propertyFinancial = [
                    'property_id' => $id,
                    'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                    'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                    'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                    'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                    'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                    'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                    'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                    'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                    'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                    'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                    'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                    'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                ];
                PropertyFinancial::create($propertyFinancial);
                
                $propertyAdditional = [
                    'property_id' => $id,
                    'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                    'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                    'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                    'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                    'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                    'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                    'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                    'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                    'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                    'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                    'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                    'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                    'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                    'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                    'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                ];
                PropertyAdditional::create($propertyAdditional);
                
                $propertyPrimaryFeatures = [
                    'property_id' => $id,
                    'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                    'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                    'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                    'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                ];
                PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                
                $propertyInterior = [
                    'property_id' => $id,
                    'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                    'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                    'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                    'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                    'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                    'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                    'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                    'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                    'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                    'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                    'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                    'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                    'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                    'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                    'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                    'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                ];
                PropertyInterior::create($propertyInterior);
                
                $propertyExternal = [
                    'property_id' => $id,
                    'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                    'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                    'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                    'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                    'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                    'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                    'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                    'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                    'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                    'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                    'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                    'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                    'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                    'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                    'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                    'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                    'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                ];
                PropertyExternal::create($propertyExternal);
                
                $propertyLocation = [
                    'property_id' => $id,
                    'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                    'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                    'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                    'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                    'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                    'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                    'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                    'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                ];

                PropertyLocation::create($propertyLocation);

                $propertyImages = $v['complete_detail']['images'];
                foreach($propertyImages as $i)
                {
                    $image = [
                        'image_url' => $i
                    ];
                    PropertyImages::create([
                        'property_id' => $id,
                        'image_url' => $i
                    ]);
                }
            }
        }
    }
     public function apihit2()
    {
    
        $response = Http::get('https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&start=2&type=results');
        $data= json_decode($response,1);
        foreach($data["Search Results"] as $k => $v)
        {
            $v["complete_detail"] = Http::get('https://sarosh.ad-wize.com/mls_data'.$v['details_link']);
            
            $vlongitudelatitude = explode(',',$v['longitude,latitude']);
            $property = PropertyDetail::where('listing_id',$v['complete_detail']['Basic Information']['Listing ID'])->first();
            if($property)
            {
                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] :  $property->status,
                    'image' => (isset($v['image'])) ? $v['image'] :  $property->image,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] :  $property->bedrooms,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] :  $property->totalbaths,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] :  $property->city,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] :  $property->state_abrv,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] :  $property->zip4_idx_hidden,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] :  $property->street_name,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] :  $property->number,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] :  $property->state,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] :  $property->zip_idx_hidden,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] :  $property->details_link,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] :  $property->longitude,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] :  $property->latitude,
                    'price' => (isset($v['price'])) ? $v['price'] :  $property->price,                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : $property->description,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : $property->contact_info,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : $property->detailsAddressRegion,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : $property->detailsAddressStreet,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : $property->subdivision,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : $property->listing_id,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : $property->full_baths,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : $property->property_type,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : $property->county,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : $property->year_built,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : $property->total_baths,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : $property->price_sqft,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : $property->partial_baths,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : $property->sqft,
                ];
                $property->update($propertydetail);
                $id = $property->id;
                $finance= PropertyFinancial::where('property_id',$id)->first();
                if(!empty($finance))
                {
                    $propertyFinancial = [
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] :  $finance->maintenance_fee_amount,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] :  $finance->hoa_mandatory,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] :  $finance->tax_rate,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] :  $finance->finance_available,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] :  $finance->tax_amount,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] :  $finance->fee_other_amount,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] :  $finance->compensation_buyer_agent,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] :  $finance->other_mandatory_fee,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] :  $finance->other_mandatory_fee,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] :  $finance->tax_year,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] :  $finance->water_sewer,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] :  $finance->fee_other,
                    ];
                    PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
                }else{
                    $propertyFinancial = [
                        'property_id' => $id,
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                    ];
                    PropertyFinancial::create($propertyFinancial);
                }
            
                $addition= PropertyAdditional::where('property_id',$id)->first();
                if(!empty($addition))
                {
                    $propertyAdditional = [
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : $addition->annual_maintenance_description,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : $addition->hoa_website,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : $addition->master_planned_community,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : $addition->restrictions,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : $addition->energy,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : $addition->legal,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : $addition->new_construction,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : $addition->year_built_source,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : $addition->exemptions,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : $addition->management_company_name,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : $addition->vacation_rental,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : $addition->disclosures,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : $addition->sqftsource,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : $addition->exclusions,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : $addition->builder_name,
                    ];
                    PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
                }else{
                    $propertyAdditional = [
                        'property_id' => $id,
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                    ];
                    PropertyAdditional::create($propertyAdditional);

                }
    
                $featuer =  PropertyPrimaryFeatures::where('property_id',$id)->first();
                if(!empty($featuer))
                {
                    $propertyPrimaryFeatures = [
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : $featuer->subdivision,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : $featuer->half_baths,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : $featuer->county,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : $featuer->year_built,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : $featuer->price_sqft,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : $featuer->property_type,
                    ];
                    PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
                }else{
                    $propertyPrimaryFeatures = [
                        'property_id' => $id,
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                    ];
                    PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                }
                
                $interior = PropertyInterior::where('property_id',$id)->first();
                if(!empty($interior))
                {
                    $propertyInterior = [
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : $interior->dishwasher,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : $interior->heat_system,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : $interior->disposal,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : $interior->room_description,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : $interior->bedroom_description,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : $interior->microwave,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : $interior->icemaker,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : $interior->connections,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : $interior->compactor,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : $interior->floors,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : $interior->master_bath_description,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : $interior->cool_system,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : $interior->interior,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : $interior->oven_type,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : $interior->fireplace_description,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : $interior->countertops,
                    ];
                    PropertyInterior::where('property_id',$id)->update($propertyInterior);
                }else{
                    $propertyInterior = [
                        'property_id' => $id,
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                    ];
                    PropertyInterior::create($propertyInterior);
                }
            
                $external = PropertyExternal::where('property_id',$id)->first();
                if(!empty($external))
                {
                    $propertyExternal = [
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : $external->foundation,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : $external->street_surface,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : $external->garage_description,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : $external->lot_description,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : $external->acres_description,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : $external->front_door_faces,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : $external->style,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : $external->pool_private_description,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : $external->garage_carport,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : $external->access,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : $external->lot_size,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : $external->number_of_garage_capacity,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : $external->exterior,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : $external->roof,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : $external->stories,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : $external->pool_area,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : $external->pool_private,
                    ];
                    PropertyExternal::where('property_id',$id)->update($propertyExternal);
                }else{
                    $propertyExternal = [
                        'property_id' => $id,
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                    ];
                    PropertyExternal::create($propertyExternal);
                }
        
                $location =  PropertyLocation::where('property_id',$id)->first();
                if(!empty($location))
                {
                    $propertyLocation = [
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : $location->parcel_number, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : $location->middle_school,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : $location->area, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : $location->high_school,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : $location->elementary_school, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : $location->subdivision,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : $location->school_district,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : $location->geo_market_area,  
                    ];
    
                    PropertyLocation::where('property_id',$id)->update($propertyLocation);
    
                }else{
                    $propertyLocation = [
                        'property_id' => $id,
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                    ];
    
                    PropertyLocation::create($propertyLocation);

                }                
                if(isset($v['complete_detail']['images']))
                {
                    $propertyImages = $v['complete_detail']['images'];                
                    foreach($propertyImages as $i)
                    {
                
                            $image = [
                                'image_url' => $i
                            ];
                            PropertyImages::create([
                                'property_id'=>$id,
                                'image_url' => $i
                            ]);
                        
                        
                    }
                }
                
            }
            else
            {

                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] : null,
                    'image' => (isset($v['image'])) ? $v['image'] : null,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] : null,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] : null,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] : null,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] : null,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] : null,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] : null,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] : null,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] : null,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] : null,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] : null,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] : null,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] : null,
                    'price' => (isset($v['price'])) ? $v['price'] : null,
                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : null,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : null,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : null,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : null,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : null,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : null,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : null,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : null,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : null,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : null,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : null,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : null,
                ];
                $property = PropertyDetail::create($propertydetail);
                $id = $property->id;
                $propertyFinancial = [
                    'property_id' => $id,
                    'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                    'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                    'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                    'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                    'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                    'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                    'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                    'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                    'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                    'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                    'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                    'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                ];
                PropertyFinancial::create($propertyFinancial);
                
                $propertyAdditional = [
                    'property_id' => $id,
                    'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                    'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                    'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                    'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                    'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                    'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                    'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                    'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                    'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                    'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                    'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                    'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                    'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                    'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                    'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                ];
                PropertyAdditional::create($propertyAdditional);
                
                $propertyPrimaryFeatures = [
                    'property_id' => $id,
                    'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                    'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                    'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                    'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                ];
                PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                
                $propertyInterior = [
                    'property_id' => $id,
                    'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                    'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                    'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                    'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                    'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                    'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                    'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                    'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                    'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                    'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                    'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                    'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                    'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                    'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                    'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                    'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                ];
                PropertyInterior::create($propertyInterior);
                
                $propertyExternal = [
                    'property_id' => $id,
                    'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                    'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                    'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                    'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                    'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                    'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                    'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                    'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                    'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                    'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                    'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                    'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                    'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                    'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                    'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                    'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                    'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                ];
                PropertyExternal::create($propertyExternal);
                
                $propertyLocation = [
                    'property_id' => $id,
                    'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                    'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                    'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                    'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                    'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                    'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                    'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                    'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                ];

                PropertyLocation::create($propertyLocation);

                $propertyImages = $v['complete_detail']['images'];
                foreach($propertyImages as $i)
                {
                    $image = [
                        'image_url' => $i
                    ];
                    PropertyImages::create([
                        'property_id' => $id,
                        'image_url' => $i
                    ]);
                }
            }
        }
    }
    public function apihit1()
    {
    
        $response = Http::get('https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&start=1&type=results');
        $data= json_decode($response,1);
        foreach($data["Search Results"] as $k => $v)
        {
            $v["complete_detail"] = Http::get('https://sarosh.ad-wize.com/mls_data'.$v['details_link']);
            
            $vlongitudelatitude = explode(',',$v['longitude,latitude']);
            $property = PropertyDetail::where('listing_id',$v['complete_detail']['Basic Information']['Listing ID'])->first();
            if($property)
            {
                $propertydetail = [
                    'where_from'=>'api',
                    'status' => (isset($v['status'])) ? $v['status'] :  $property->status,
                    'image' => (isset($v['image'])) ? $v['image'] :  $property->image,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] :  $property->bedrooms,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] :  $property->totalbaths,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] :  $property->city,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] :  $property->state_abrv,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] :  $property->zip4_idx_hidden,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] :  $property->street_name,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] :  $property->number,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] :  $property->state,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] :  $property->zip_idx_hidden,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] :  $property->details_link,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] :  $property->longitude,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] :  $property->latitude,
                    'price' => (isset($v['price'])) ? $v['price'] :  $property->price,                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : $property->description,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : $property->contact_info,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : $property->detailsAddressRegion,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : $property->detailsAddressStreet,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : $property->subdivision,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : $property->listing_id,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : $property->full_baths,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : $property->property_type,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : $property->county,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : $property->year_built,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : $property->total_baths,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : $property->price_sqft,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : $property->partial_baths,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : $property->sqft,
                ];
                $property->update($propertydetail);
                $id = $property->id;
                $finance= PropertyFinancial::where('property_id',$id)->first();
                if(!empty($finance))
                {
                    $propertyFinancial = [
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] :  $finance->maintenance_fee_amount,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] :  $finance->hoa_mandatory,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] :  $finance->tax_rate,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] :  $finance->finance_available,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] :  $finance->tax_amount,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] :  $finance->fee_other_amount,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] :  $finance->compensation_buyer_agent,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] :  $finance->other_mandatory_fee,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] :  $finance->other_mandatory_fee,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] :  $finance->tax_year,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] :  $finance->water_sewer,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] :  $finance->fee_other,
                    ];
                    PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
                }else{
                    $propertyFinancial = [
                        'property_id' => $id,
                        'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                        'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                        'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                        'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                        'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                        'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                        'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                        'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                        'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                        'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                        'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                        'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                    ];
                    PropertyFinancial::create($propertyFinancial);
                }
            
                $addition= PropertyAdditional::where('property_id',$id)->first();
                if(!empty($addition))
                {
                    $propertyAdditional = [
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : $addition->annual_maintenance_description,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : $addition->hoa_website,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : $addition->master_planned_community,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : $addition->restrictions,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : $addition->energy,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : $addition->legal,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : $addition->new_construction,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : $addition->year_built_source,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : $addition->exemptions,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : $addition->management_company_name,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : $addition->vacation_rental,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : $addition->disclosures,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : $addition->sqftsource,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : $addition->exclusions,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : $addition->builder_name,
                    ];
                    PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
                }else{
                    $propertyAdditional = [
                        'property_id' => $id,
                        'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                        'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                        'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                        'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                        'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                        'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                        'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                        'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                        'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                        'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                        'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                        'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                        'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                        'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                        'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                    ];
                    PropertyAdditional::create($propertyAdditional);

                }
    
                $featuer =  PropertyPrimaryFeatures::where('property_id',$id)->first();
                if(!empty($featuer))
                {
                    $propertyPrimaryFeatures = [
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : $featuer->subdivision,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : $featuer->half_baths,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : $featuer->county,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : $featuer->year_built,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : $featuer->price_sqft,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : $featuer->property_type,
                    ];
                    PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
                }else{
                    $propertyPrimaryFeatures = [
                        'property_id' => $id,
                        'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                        'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                        'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                        'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                        'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                        'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                    ];
                    PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                }
                
                $interior = PropertyInterior::where('property_id',$id)->first();
                if(!empty($interior))
                {
                    $propertyInterior = [
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : $interior->dishwasher,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : $interior->heat_system,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : $interior->disposal,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : $interior->room_description,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : $interior->bedroom_description,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : $interior->microwave,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : $interior->icemaker,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : $interior->connections,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : $interior->compactor,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : $interior->floors,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : $interior->master_bath_description,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : $interior->cool_system,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : $interior->interior,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : $interior->oven_type,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : $interior->fireplace_description,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : $interior->countertops,
                    ];
                    PropertyInterior::where('property_id',$id)->update($propertyInterior);
                }else{
                    $propertyInterior = [
                        'property_id' => $id,
                        'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                        'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                        'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                        'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                        'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                        'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                        'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                        'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                        'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                        'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                        'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                        'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                        'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                        'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                        'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                        'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                    ];
                    PropertyInterior::create($propertyInterior);
                }
            
                $external = PropertyExternal::where('property_id',$id)->first();
                if(!empty($external))
                {
                    $propertyExternal = [
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : $external->foundation,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : $external->street_surface,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : $external->garage_description,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : $external->lot_description,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : $external->acres_description,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : $external->front_door_faces,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : $external->style,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : $external->pool_private_description,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : $external->garage_carport,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : $external->access,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : $external->lot_size,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : $external->number_of_garage_capacity,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : $external->exterior,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : $external->roof,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : $external->stories,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : $external->pool_area,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : $external->pool_private,
                    ];
                    PropertyExternal::where('property_id',$id)->update($propertyExternal);
                }else{
                    $propertyExternal = [
                        'property_id' => $id,
                        'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                        'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                        'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                        'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                        'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                        'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                        'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                        'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                        'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                        'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                        'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                        'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                        'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                        'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                        'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                        'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                        'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                    ];
                    PropertyExternal::create($propertyExternal);
                }
        
                $location =  PropertyLocation::where('property_id',$id)->first();
                if(!empty($location))
                {
                    $propertyLocation = [
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : $location->parcel_number, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : $location->middle_school,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : $location->area, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : $location->high_school,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : $location->elementary_school, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : $location->subdivision,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : $location->school_district,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : $location->geo_market_area,  
                    ];
    
                    PropertyLocation::where('property_id',$id)->update($propertyLocation);
    
                }else{
                    $propertyLocation = [
                        'property_id' => $id,
                        'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                        'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                        'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                        'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                        'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                        'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                        'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                        'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                    ];
    
                    PropertyLocation::create($propertyLocation);

                }                
                if(isset($v['complete_detail']['images']))
                {
                    $propertyImages = $v['complete_detail']['images'];                
                    foreach($propertyImages as $i)
                    {
                
                            $image = [
                                'image_url' => $i
                            ];
                            PropertyImages::create([
                                'property_id'=>$id,
                                'image_url' => $i
                            ]);
                        
                        
                    }
                }
                
            }
            else
            {

                $propertydetail = [
                    'status' => (isset($v['status'])) ? $v['status'] : null,
                    'where_from'=>'api',
                    'image' => (isset($v['image'])) ? $v['image'] : null,
                    'bedrooms' => (isset($v['details']['bedrooms'])) ? $v['details']['bedrooms'] : null,
                    'totalbaths' => (isset($v['details']['totalBaths'])) ? $v['details']['totalBaths'] : null,
                    'city' => (isset($v['address']['City'])) ? $v['address']['City'] : null,
                    'state_abrv' => (isset($v['address']['state-abrv'])) ? $v['address']['state-abrv'] : null,
                    'zip4_idx_hidden' => (isset($v['address']['zip4-IDX-hidden'])) ? $v['address']['zip4-IDX-hidden'] : null,
                    'street_name' => (isset($v['address']['street-name'])) ? $v['address']['street-name'] : null,
                    'number' => (isset($v['address']['number'])) ? $v['address']['number'] : null,
                    'state' => (isset($v['address']['state'])) ? $v['address']['state'] : null,
                    'zip_idx_hidden' => (isset($v['address']['zip-IDX-hidden'])) ? $v['address']['zip-IDX-hidden'] : null,
                    'details_link' => (isset($v['details_link'])) ? $v['details_link'] : null,
                    'longitude' => (isset($vlongitudelatitude[0])) ? $vlongitudelatitude[0] : null,
                    'latitude' => (isset($vlongitudelatitude[1])) ? $vlongitudelatitude[1] : null,
                    'price' => (isset($v['price'])) ? $v['price'] : null,
                    
                    'description' => (isset($v['complete_detail']['description'])) ? $v['complete_detail']['description'] : null,
                    'contact_info' => (isset($v['complete_detail']['contact_info'])) ? $v['complete_detail']['contact_info'] : null,
                    'detailsAddressRegion' => (isset($v['complete_detail']['detailsAddressRegion'])) ? $v['complete_detail']['detailsAddressRegion'] : null,
                    'detailsAddressStreet' => (isset($v['complete_detail']['detailsAddressStreet'])) ? $v['complete_detail']['detailsAddressStreet'] : null,
                    'subdivision' => (isset($v['complete_detail']['Basic Information']['Subdivision'])) ? $v['complete_detail']['Basic Information']['Subdivision'] : null,
                    'listing_id' => (isset($v['complete_detail']['Basic Information']['Listing ID'])) ? $v['complete_detail']['Basic Information']['Listing ID'] : null,
                    'full_baths' => (isset($v['complete_detail']['Basic Information']['Full Baths'])) ? $v['complete_detail']['Basic Information']['Full Baths'] : null,
                    'property_type' => (isset($v['complete_detail']['Basic Information']['Property Type'])) ? $v['complete_detail']['Basic Information']['Property Type'] : null,
                    'county' => (isset($v['complete_detail']['Basic Information']['County'])) ? $v['complete_detail']['Basic Information']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Basic Information']['Year Built'])) ? $v['complete_detail']['Basic Information']['Year Built'] : null,
                    'total_baths' => (isset($v['complete_detail']['Basic Information']['Total Baths'])) ? $v['complete_detail']['Basic Information']['Total Baths'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Basic Information']['Price/SqFt'])) ? $v['complete_detail']['Basic Information']['Price/SqFt'] : null,
                    'partial_baths' => (isset($v['complete_detail']['Basic Information']['Partial Baths'])) ? $v['complete_detail']['Basic Information']['Partial Baths'] : null,
                    'sqft' => (isset($v['complete_detail']['Basic Information']['SqFt'])) ? $v['complete_detail']['Basic Information']['SqFt'] : null,
                ];
                $property = PropertyDetail::create($propertydetail);
                $id = $property->id;
                $propertyFinancial = [
                    'property_id' => $id,
                    'maintenance_fee_amount' => (isset($v['complete_detail']['Financial']['Maintenance Fee Amount'])) ? $v['complete_detail']['Financial']['Maintenance Fee Amount'] : null,
                    'hoa_mandatory' => (isset($v['complete_detail']['Financial']['HOA Mandatory'])) ? $v['complete_detail']['Financial']['HOA Mandatory'] : null,
                    'tax_rate' => (isset($v['complete_detail']['Financial']['Tax Rate'])) ? $v['complete_detail']['Financial']['Tax Rate'] : null,
                    'finance_available' => (isset($v['complete_detail']['Financial']['Finance Available'])) ? $v['complete_detail']['Financial']['Finance Available'] : null,
                    'tax_amount' => (isset($v['complete_detail']['Financial']['Tax Amount'])) ? $v['complete_detail']['Financial']['Tax Amount'] : null,
                    'fee_other_amount' => (isset($v['complete_detail']['Financial']['Fee Other Amount'])) ? $v['complete_detail']['Financial']['Fee Other Amount'] : null,
                    'compensation_buyer_agent' => (isset($v['complete_detail']['Financial']['Compensation Buyer Agent'])) ? $v['complete_detail']['Financial']['Compensation Buyer Agent'] : null,
                    'other_mandatory_fee' => (isset($v['complete_detail']['Financial']['Other Mandatory Fee'])) ? $v['complete_detail']['Financial']['Other Mandatory Fee'] : null,
                    'tax_year' => (isset($v['complete_detail']['Financial']['Tax Year'])) ? $v['complete_detail']['Financial']['Tax Year'] : null,
                    'ownership' => (isset($v['complete_detail']['Financial']['Ownership'])) ? $v['complete_detail']['Financial']['Ownership'] : null,
                    'water_sewer' => (isset($v['complete_detail']['Financial']['Water Sewer'])) ? $v['complete_detail']['Financial']['Water Sewer'] : null,
                    'fee_other' => (isset($v['complete_detail']['Financial']['Fee Other'])) ? $v['complete_detail']['Financial']['Fee Other'] : null,
                ];
                PropertyFinancial::create($propertyFinancial);
                
                $propertyAdditional = [
                    'property_id' => $id,
                    'annual_maintenance_description' => (isset($v['complete_detail']['Additional']['Annual Maintenance Description'])) ? $v['complete_detail']['Additional']['Annual Maintenance Description'] : null,
                    'hoa_website' => (isset($v['complete_detail']['Additional']['HOA Website'])) ? $v['complete_detail']['Additional']['HOA Website'] : null,
                    'master_planned_community' => (isset($v['complete_detail']['Additional']['Master Planned Community'])) ? $v['complete_detail']['Additional']['Master Planned Community'] : null,
                    'restrictions' => (isset($v['complete_detail']['Additional']['Restrictions'])) ? $v['complete_detail']['Additional']['Restrictions'] : null,
                    'energy' => (isset($v['complete_detail']['Additional']['Energy'])) ? $v['complete_detail']['Additional']['Energy'] : null,
                    'legal' => (isset($v['complete_detail']['Additional']['Legal'])) ? $v['complete_detail']['Additional']['Legal'] : null,
                    'new_construction' => (isset($v['complete_detail']['Additional']['New Construction'])) ?  $v['complete_detail']['Additional']['New Construction'] : null,
                    'year_built_source' =>  (isset($v['complete_detail']['Additional']['Year Built Source'])) ? $v['complete_detail']['Additional']['Year Built Source'] : null,
                    'exemptions' => (isset($v['complete_detail']['Additional']['Exemptions'])) ? $v['complete_detail']['Additional']['Exemptions'] : null,
                    'management_company_name' => (isset($v['complete_detail']['Additional']['Management Company Name'])) ? $v['complete_detail']['Additional']['Management Company Name'] : null,
                    'vacation_rental' => (isset($v['complete_detail']['Additional']['Vacation Rental'])) ? $v['complete_detail']['Additional']['Vacation Rental'] : null,
                    'disclosures' => (isset($v['complete_detail']['Additional']['Disclosures'])) ?  $v['complete_detail']['Additional']['Disclosures'] : null,
                    'sqftsource' =>  (isset($v['complete_detail']['Additional']['SqFt Source'])) ? $v['complete_detail']['Additional']['SqFt Source'] : null,
                    'exclusions' => (isset($v['complete_detail']['Additional']['Exclusions'])) ?  $v['complete_detail']['Additional']['Exclusions'] : null,
                    'builder_name' => (isset($v['complete_detail']['Additional']['Builder Name'])) ? $v['complete_detail']['Additional']['Builder Name'] : null,
                ];
                PropertyAdditional::create($propertyAdditional);
                
                $propertyPrimaryFeatures = [
                    'property_id' => $id,
                    'subdivision' => (isset($v['complete_detail']['Primary Features']['Subdivision'])) ? $v['complete_detail']['Primary Features']['Subdivision'] : null,
                    'half_baths' => (isset($v['complete_detail']['Primary Features']['Half Baths'])) ? $v['complete_detail']['Primary Features']['Half Baths'] : null,
                    'county' => (isset($v['complete_detail']['Primary Features']['County'])) ? $v['complete_detail']['Primary Features']['County'] : null,
                    'year_built' => (isset($v['complete_detail']['Primary Features']['Year Built'])) ? $v['complete_detail']['Primary Features']['Year Built'] : null,
                    'price_sqft' => (isset($v['complete_detail']['Primary Features']['Price/SqFt'])) ? $v['complete_detail']['Primary Features']['Price/SqFt'] : null,
                    'property_type' => (isset($v['complete_detail']['Primary Features']['Property Type'])) ? $v['complete_detail']['Primary Features']['Property Type'] : null,
                ];
                PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
                
                $propertyInterior = [
                    'property_id' => $id,
                    'dishwasher' => (isset($v['complete_detail']['Interior']['Dishwasher'])) ? $v['complete_detail']['Interior']['Dishwasher'] : null,
                    'heat_system' => (isset($v['complete_detail']['Interior']['Heat System'])) ? $v['complete_detail']['Interior']['Heat System'] : null,
                    'disposal' => (isset($v['complete_detail']['Interior']['Disposal'])) ? $v['complete_detail']['Interior']['Disposal'] : null,
                    'room_description' => (isset($v['complete_detail']['Interior']['Room Description'])) ? $v['complete_detail']['Interior']['Room Description'] : null,
                    'bedroom_description' => (isset($v['complete_detail']['Interior']['Bedroom Description'])) ? $v['complete_detail']['Interior']['Bedroom Description'] : null,
                    'microwave' => (isset($v['complete_detail']['Interior']['Microwave'])) ? $v['complete_detail']['Interior']['Microwave'] : null,
                    'icemaker' => (isset($v['complete_detail']['Interior']['Icemaker'])) ? $v['complete_detail']['Interior']['Icemaker'] : null,
                    'connections' => (isset($v['complete_detail']['Interior']['Connections'])) ? $v['complete_detail']['Interior']['Connections'] : null,
                    'compactor' => (isset($v['complete_detail']['Interior']['Compactor'])) ? $v['complete_detail']['Interior']['Compactor'] : null,
                    'floors' => (isset($v['complete_detail']['Interior']['Floors'])) ? $v['complete_detail']['Interior']['Floors'] : null,
                    'master_bath_description' => (isset($v['complete_detail']['Interior']['Master Bath Description'])) ? $v['complete_detail']['Interior']['Master Bath Description'] : null,
                    'cool_system' => (isset($v['complete_detail']['Interior']['Cool System'])) ? $v['complete_detail']['Interior']['Cool System'] : null,
                    'interior' => (isset($v['complete_detail']['Interior']['Interior'])) ? $v['complete_detail']['Interior']['Interior'] : null,
                    'oven_type' => (isset($v['complete_detail']['Interior']['Oven Type'])) ? $v['complete_detail']['Interior']['Oven Type'] : null,
                    'fireplace_description' => (isset($v['complete_detail']['Interior']['Fireplace Description'])) ? $v['complete_detail']['Interior']['Fireplace Description'] : null,
                    'countertops' => (isset($v['complete_detail']['Interior']['Countertops'])) ? $v['complete_detail']['Interior']['Countertops'] : null,
                ];
                PropertyInterior::create($propertyInterior);
                
                $propertyExternal = [
                    'property_id' => $id,
                    'foundation' => (isset($v['complete_detail']['External']['Foundation'])) ? $v['complete_detail']['External']['Foundation'] : null,
                    'street_surface' => (isset($v['complete_detail']['External']['Street Surface'])) ? $v['complete_detail']['External']['Street Surface'] : null,
                    'garage_description' => (isset($v['complete_detail']['External']['Garage Description'])) ? $v['complete_detail']['External']['Garage Description'] : null,
                    'lot_description' => (isset($v['complete_detail']['External']['Lot Description'])) ? $v['complete_detail']['External']['Lot Description'] : null,
                    'acres_description' => (isset($v['complete_detail']['External']['Acres Description'])) ? $v['complete_detail']['External']['Acres Description'] : null,
                    'front_door_faces' => (isset($v['complete_detail']['External']['Front Door Faces'])) ? $v['complete_detail']['External']['Front Door Faces'] : null,
                    'style' => (isset($v['complete_detail']['External']['Style'])) ? $v['complete_detail']['External']['Style'] : null,
                    'pool_private_description' => (isset($v['complete_detail']['External']['Pool Private Description'])) ? $v['complete_detail']['External']['Pool Private Description'] : null,
                    'garage_carport' => (isset($v['complete_detail']['External']['Garage Carport'])) ? $v['complete_detail']['External']['Garage Carport'] : null,
                    'access' => (isset($v['complete_detail']['External']['Access'])) ? $v['complete_detail']['External']['Access'] : null,
                    'lot_size' => (isset($v['complete_detail']['External']['Lot Size'])) ? $v['complete_detail']['External']['Lot Size'] : null,
                    'number_of_garage_capacity' => (isset($v['complete_detail']['External']['Number Of Garage Capacity'])) ? $v['complete_detail']['External']['Number Of Garage Capacity'] : null,
                    'exterior' => (isset($v['complete_detail']['External']['Exterior'])) ? $v['complete_detail']['External']['Exterior'] : null,
                    'roof' => (isset($v['complete_detail']['External']['Roof'])) ? $v['complete_detail']['External']['Roof'] : null,
                    'stories' => (isset($v['complete_detail']['External']['Stories'])) ? $v['complete_detail']['External']['Stories'] : null,
                    'pool_area' => (isset($v['complete_detail']['External']['Pool Area'])) ? $v['complete_detail']['External']['Pool Area'] : null,
                    'pool_private' => (isset($v['complete_detail']['External']['Pool Private'])) ? $v['complete_detail']['External']['Pool Private'] : null,
                ];
                PropertyExternal::create($propertyExternal);
                
                $propertyLocation = [
                    'property_id' => $id,
                    'parcel_number' => (isset($v['complete_detail']['Location']['Parcel Number'])) ? $v['complete_detail']['Location']['Parcel Number'] : null, 
                    'middle_school' => (isset($v['complete_detail']['Location']['Middle School'])) ? $v['complete_detail']['Location']['Middle School'] : null,
                    'area' => (isset($v['complete_detail']['Location']['Area'])) ? $v['complete_detail']['Location']['Area'] : null, 
                    'high_school' => (isset($v['complete_detail']['Location']['High School'])) ? $v['complete_detail']['Location']['High School'] : null,
                    'elementary_school' => (isset($v['complete_detail']['Location']['Elementary School'])) ? $v['complete_detail']['Location']['Elementary School'] : null, 
                    'subdivision' => (isset($v['complete_detail']['Location']['Subdivision'])) ? $v['complete_detail']['Location']['Subdivision'] : null,  
                    'school_district' => (isset($v['complete_detail']['Location']['School District'])) ? $v['complete_detail']['Location']['School District'] : null,  
                    'geo_market_area' => (isset($v['complete_detail']['Location']['Geo Market Area'])) ? $v['complete_detail']['Location']['Geo Market Area'] : null,  
                ];

                PropertyLocation::create($propertyLocation);

                $propertyImages = $v['complete_detail']['images'];
                foreach($propertyImages as $i)
                {
                    $image = [
                        'image_url' => $i
                    ];
                    PropertyImages::create([
                        'property_id' => $id,
                        'image_url' => $i
                    ]);
                }
            }
        }
    }

    public function listing()
    {
        
        //$post_tags=explode(',',$product->tags);
    
        $data['asc'] = Property::OrderBy('id','asc')->limit(5)->get();
        $data['desc'] = Property::OrderBy('id','desc')->limit(5)->get();
        // $data['asc'] = Property::OrderBy('id','asc')->limit(5)->get();
        return view('listing',$data);
    }
    public function find_property(Request $request)
    {
        
        try{
            if(!empty($request->address) && !empty($request->ltd) && !empty($request->lng))
            {
                 $data['listing'] = PropertyDetail::
                where('state', 'like', '%'.$request->state.'%')->
                where('city', 'like', '%'.$request->city.'%')
                      ->select("property_details.*"
                        ,DB::raw("6371 * acos(cos(radians(" . $request->ltd . ")) 
                        * cos(radians(property_details.latitude)) 
                        * cos(radians(property_details.longitude) - radians(" . $request->lng . ")) 
                        + sin(radians(" .$request->ltd. ")) 
                        * sin(radians(property_details.latitude))) AS distance"))
                        ->orWhere([['property_details.detailsAddressStreet','LIKE' ,'%'.$request->address.'%'],['property_details.detailsAddressRegion','LIKE' ,'%'.$request->address.'%']])
                        ->groupBy("property_details.id")
                        ->OrderBy('property_details.id','desc')
                        // ->having('distance','<=',50)
                        ->get();
                 
             return view('search_listing',$data);
            }else{
                return back()->with(['error'=>'Something went wrong Try Again']);
            }
    
        }catch(\Exception $e)
        {
            return back()->with(['error'=>$e->getMessage()]);
        }
    }

    
    

    public function get_complete_detail_to_api($urlparams)
    {
        $response = Http::get(' https://sarosh.ad-wize.com/mls_data'.$urlparams.'');


        // https://sarosh.ad-wize.com/mls_data?idxID=b047&per=100&pt=1&bd=3&type=results

        // https://sarosh.ad-wize.com/mls_data?type=details&A=b047&B=28864527&C=9-West-Lane-Houston-TX-77019
        return json_decode($response,1);
    }
     public function emailform()
    {
        return view('emailform');
    }
    
    public function listing_detail()
    {
        // try{

    //  return 'as';
        $data['listing'] = Property::inRandomOrder()->first();
        // $data['listing'] = PropertyDetail::with('options')->inRandomOrder()->first();
        $data['properties'] = PropertyDetail::with('hasoptions')->whereHas('hasoptions',function($query)
        {
            $query->where('user_id',Auth::id());
        }
        )->get();
        
        $lat =  ($data['listing']) ? $data['listing']->latitude : 0;
        $lon = ($data['listing']) ? $data['listing']->longitude : 0;

          $data['best_maches'] =  '';//PropertyDetail::select("property_details.*"
        //  $data['best_maches'] = PropertyDetail::select("property_details.*"
        //         ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        //         * cos(radians(property_details.latitude)) 
        //         * cos(radians(property_details.longitude) - radians(" . $lon . ")) 
        //         + sin(radians(" .$lat. ")) 
        //         * sin(radians(property_details.latitude))) AS distance"))
        //         ->groupBy("property_details.id")
        //         ->limit(3)->get();
        return view('listing_detail',$data);
            // }catch(\Exception $e)
            // {
            //     return back()->with(['error'=>$e->getMessage()]);
            // }
    }
	
	
	public function remove_property(Request $request)
	{
		DB::table('properties_options')->where(['property_id'=>$request->id,'user_id'=>Auth::user()->id])->delete();
		return response()->json(['msg'=>'Removed SuccessFull']);
	}
    public function fetch_listing_detail()
    {
        try{
        $data['listing'] = Property::inRandomOrder()->first();
        $data['properties'] = '';//PropertyDetail::with('hasoptions')->whereHas('hasoptions',function($query)
        // $data['properties'] = PropertyDetail::with('hasoptions')->whereHas('hasoptions',function($query)
        // {
        //     $query->where('user_id',Auth::id());
        // }
        // )->get();

        $lat =  ($data['listing']) ? $data['listing']->latitude : 0 ;
        $lon = ($data['listing']) ? $data['listing']->longitude : 0;

        // Best Maches
        $data['best_maches'] = '';//PropertyDetail::select("property_details.*"
        // $data['best_maches'] = PropertyDetail::select("property_details.*"
        //     ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        //     * cos(radians(property_details.latitude)) 
        //     * cos(radians(property_details.longitude) - radians(" . $lon . ")) 
        //     + sin(radians(" .$lat. ")) 
        //     * sin(radians(property_details.latitude))) AS distance"))
        //     ->groupBy("property_details.id")
        //     ->get();
        return response()->json($data);
            }catch(\Exception $e)
            {
                return back()->with(['error'=>$e->getMessage()]);
            }
    }

    public function property_status(Request $request)
    {
        try{
		// $user = \App\Models\User::with('useroptionscreate')->find(Auth::id());
        // $property = $user->useroptionscreate()->where('property_id',$request->property_id)->first();
        // if($property)
        // {
        //     return response()->json(['msg'=>'already updated']);
        // }
        // else
        // {
        //     $user->useroptionscreate()->create([
        //         'property_id' => $request->property_id,
        //         'status' => $request->status,
        //     ]);
            return response()->json(['msg'=>'SuccessFull']);
        // }
            }catch(\Exception $e)
            {
                return back()->with(['error'=>$e->getMessage()]);
            }
    }
    
    public function index()
    {
        try
        {
            $data['listing'] = Property::paginate(12);
            return view('index',$data);
        }
        catch(\Exception $e)
        {
            return back()->with(['error'=>$e->getMessage()]);
        }
    }
}
