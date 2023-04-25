<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\cms;
use App\PropertyOptions;
use App\Models\Property;

use App\Models\PropertyDetail;
use App\Models\PropertyFinancial;
use App\Models\PropertyAdditional;
use App\Models\PropertyPrimaryFeatures;
use App\Models\PropertyInterior;
use App\Models\PropertyExternal;
use App\Models\PropertyLocation;
use App\Models\PropertyImages;
use App\Models\Amenities;
use Session;
use File;
use Validator;

class ProperiesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {


        $propertys  = Property::orderBy('id','DESC')->get();
        return view("admin.properties.index",compact('propertys'));
    }
    public function add_properties()
    {
        $data['amenities'] = Amenities::get();
        // $contactdata  = DB::table('cms')->where('pagename','home')->get();
        return view("admin.properties.add",$data);
    }
	
	public function showproperties(request $request)
	{
		//$contactdata = DB::table('properties_options')
		//->select('properties.title','users.email','properties_options.status','properties.id as property_id')
		//->join('properties','properties.id','properties_options.property_id')
		//->join('users','users.id','properties_options.user_id')
		//->where('properties_options.status',$request->status)
		//->get();
		$contactdata = PropertyDetail::get();
		//return $contactdata;
		return view("properties.properties_status",compact('contactdata'));
	}

    public function store_new(Request $request)
    {
        //try{
             $requestt = implode(', ',$request->amenities_id);
            // $requestt = $request->all();
            //  return $requestt;
             Property::create(array_merge($request->all(), ['amenities_id' => $requestt]));
            return redirect()->back()->with(['success'=>'Property Create Successfully']);
        //}
        /* catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        } */
    }
    
    public function update_property_new(Request $request,$id)
    {
        try{
            $property = Property::find($id);
            $requestt = implode(', ',$request->amenities_id);
           
            $property->update(array_merge($request->all(), ['amenities_id' => $requestt]));
            return redirect()->back()->with(['success'=>'Property Update Successfully']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }
    /* public function upload_store(request $request)
    {
        try
        {

            $validation = Validator::make($request->all(),[
                'property.*.listing_id' =>'required|numeric|unique:property_details',
                'property.*'=> 'required',
                'financial.*'=> 'required',
                'additional.*'=> 'required',
                'primary.*'=> 'required',
                'interior.*'=> 'required',
                'external.*'=> 'required',
                'location.*'=> 'required',
            ],
            [
             'property.*.listing_id'=> 'Listing ID is Required and it should be Unique', // custom message
             'property.*'=> 'All Property Fields Are required', 
             'financial.*'=> 'All Financial Fields Are required', 
             'additional.*'=> 'All Additional Fields Are required', 
             'primary.*'=> 'All Primary Fields Are required', 
             'interior.*'=> 'All Interior Fields Are required', 
             'external.*'=> 'All External Fields Are required', 
             'location.*'=> 'All Location Fields Are required', 

            ]);
            if( $validation->fails())
            {
                return back()->withInput()->with(['error'=>$validation->errors()->first(),'old'=>$request->input()]);
            }
            $image = null;
            if($request->hasfile('image'))
            {
                $files = $request->file('image');
                $destinationPath = public_path('/uploads/properties/'); // upload path
                $video_fileName = rand(10,100) . date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $video_fileName);
                $image = asset('/uploads/properties/' .$video_fileName); 
            }

            $propertydetail = [
                'listing_id' => (isset($request->property['listing_id'])) ? $request->property['listing_id'] : null,
                'full_baths' => (isset($request->property['full_baths'])) ? $request->property['full_baths'] : null,
                'bedrooms' => (isset($request->property['no_of_Bedrooms'])) ? $request->property['no_of_Bedrooms'] : null,
                'property_type' => (isset($request->property['property_type'])) ? $request->property['property_type'] : null,
                'county' => (isset($request->property['county'])) ? $request->property['county'] : null,
                'year_built' => (isset($request->property['year_built'])) ? $request->property['year_built'] : null,
                'total_baths' => (isset($request->property['totalbaths'])) ? $request->property['totalbaths'] : null,
                'price_sqft' => (isset($request->property['price_sqft'])) ? $request->property['price_sqft'] : null,
                'partial_baths' => (isset($request->property['partial_baths'])) ? $request->property['partial_baths'] : null,
                'sqft' => (isset($request->property['sqft'])) ? $request->property['sqft'] : null,
                'subdivision' => (isset($request->property['subdivision'])) ? $request->property['subdivision'] : null,
                'detailsAddressStreet' => (isset($request->property['detailsAddressStreet'])) ? $request->property['detailsAddressStreet'] : null,
                'detailsAddressRegion' => (isset($request->property['detailsAddressRegion'])) ? $request->property['detailsAddressRegion'] : null,
                'contact_info' => (isset($request->property['contact_info'])) ? $request->property['contact_info'] : null,
                'price' => (isset($request->property['price'])) ? $request->property['price'] : null,
                'details_link' => (isset($request->property['details_link'])) ? $request->property['details_link'] : null,
                'state' => (isset($request->property['state'])) ? $request->property['state'] : null,
                'number' => (isset($request->property['number'])) ? $request->property['number'] : null,
                'street_name' => (isset($request->property['street_name'])) ? $request->property['street_name'] : null,
                'city' => (isset($request->property['city'])) ? $request->property['city'] : null,
                'status' => 'StatusActive',
                'where_from'=>'local',
                'image' => $image,
                'longitude' => (isset($request->property['longitude'])) ? $request->property['longitude'] : null,
                'latitude' => (isset($request->property['latitude'])) ? $request->property['latitude'] : null,
                'description' => (isset($request->property['description'])) ? $request->property['description'] : null,
                // 'totalbaths' => (isset($request->details['totalBaths'])) ? $request->details['totalBaths'] : null,
                // 'state_abrv' => (isset($request->property['state-abrv'])) ? $request->property['state-abrv'] : null,
                // 'zip4_idx_hidden' => (isset($request->property['zip4-IDX-hidden'])) ? $request->property['zip4-IDX-hidden'] : null,
                // 'zip_idx_hidden' => (isset($request->property['zip-IDX-hidden'])) ? $request->property['zip-IDX-hidden'] : null,
            ];
            $property = PropertyDetail::create($propertydetail);
            $id = $property->id;

            
            if($request->hasfile('gallery'))
            {
                foreach ($request->file('gallery') as $imagefile) 
                {
                    $files1 = $imagefile;
                    $destinationPath = public_path('/uploads/properties/'); // upload path
                    $fileName1 = rand(10,100).uniqid() . date('YmdHis') . "." . $files1->getClientOriginalExtension();
                    $files1->move($destinationPath, $fileName1);
                    $data['property_id'] = $id; 
                    $data['image_url'] = asset('/uploads/properties/'.$fileName1); 
                    PropertyImages::create($data);
                }
            }
            $propertyFinancial = [
                'property_id' => $id,
                'maintenance_fee_amount' => (isset($request->financial['maintenance_fee_amount'])) ? $request->financial['maintenance_fee_amount'] : null,
                'tax_rate' => (isset($request->financial['tax_rate'])) ? $request->financial['tax_rate'] : null,
                'finance_available' => (isset($request->financial['finance_available'])) ? $request->financial['finance_available'] : null,
                'tax_amount' => (isset($request->financial['tax_amount'])) ? $request->financial['tax_amount'] : null,
                'fee_other_amount' => (isset($request->financial['fee_other_amount'])) ? $request->financial['fee_other_amount'] : null,
                'compensation_buyer_agent' => (isset($request->financial['compensation_buyer_agent'])) ? $request->financial['compensation_buyer_agent'] : null,
                'tax_year' => (isset($request->financial['tax_year'])) ? $request->financial['tax_year'] : null,
                'ownership' => (isset($request->financial['ownership'])) ? $request->financial['ownership'] : null,
                'water_sewer' => (isset($request->financial['water_sewers'])) ? $request->financial['water_sewers'] : null,
                'hoa_mandatory' => (isset($request->financial['hoa_mandatory'])) ? $request->financial['hoa_mandatory'] : null,
                'other_mandatory_fee' => (isset($request->financial['other_mandatory_fee'])) ? $request->financial['other_mandatory_fee'] : null,
                'fee_other' => (isset($request->financial['fee_other'])) ? $request->financial['fee_other'] : null,
            ];
            PropertyFinancial::create($propertyFinancial);
            
            $propertyAdditional = [
                'property_id' => $id,
                'annual_maintenance_description' => (isset($request->additional['annual_maintenance_description'])) ? $request->additional['annual_maintenance_description'] : null,
                'hoa_website' => (isset($request->additional['hoa_website'])) ? $request->additional['hoa_website'] : null,
                'master_planned_community' => (isset($request->additional['master_planned_community'])) ? $request->additional['master_planned_community'] : null,
                'restrictions' => (isset($request->additional['restrictions'])) ? $request->additional['restrictions'] : null,
                'energy' => (isset($request->additional['energy'])) ? $request->additional['energy'] : null,
                'legal' => (isset($request->additional['legal'])) ? $request->additional['legal'] : null,
                'new_construction' => (isset($request->additional['new_construction'])) ?  $request->additional['new_construction'] : null,
                'year_built_source' =>  (isset($request->additional['year_built_source'])) ? $request->additional['year_built_source'] : null,
                'exemptions' => (isset($request->additional['exemptions'])) ? $request->additional['exemptions'] : null,
                'management_company_name' => (isset($request->additional['management_company_name'])) ? $request->additional['management_company_name'] : null,
                'vacation_rental' => (isset($request->additional['vacation_rental'])) ? $request->additional['vacation_rental'] : null,
                'disclosures' => (isset($request->additional['disclosures'])) ?  $request->additional['disclosures'] : null,
                'sqftsource' =>  (isset($request->additional['sqftsource'])) ? $request->additional['sqftsource'] : null,
                'exclusions' => (isset($request->additional['exclusions'])) ?  $request->additional['exclusions'] : null,
                'builder_name' => (isset($request->additional['builder_name'])) ? $request->additional['builder_name'] : null,
            ];
            PropertyAdditional::create($propertyAdditional);
            
            $propertyPrimaryFeatures = [
                'property_id' => $id,
                'subdivision' => (isset($request->primary['subdivision'])) ? $request->primary['subdivision'] : null,
                'half_baths' => (isset($request->primary['half_baths'])) ? $request->primary['half_baths'] : null,
                'county' => (isset($request->primary['county'])) ? $request->primary['county'] : null,
                'year_built' => (isset($request->primary['year_built'])) ? $request->primary['year_built'] : null,
                'price_sqft' => (isset($request->primary['price_sqft'])) ? $request->primary['price_sqft'] : null,
                'property_type' => (isset($request->primary['property_type'])) ? $request->primary['property_type'] : null,
            ];
            PropertyPrimaryFeatures::create($propertyPrimaryFeatures);
            
            $propertyInterior = [
                'property_id' => $id,
                'dishwasher' => (isset($request->interior['dishwasher'])) ? $request->interior['dishwasher'] : null,
                'heat_system' => (isset($request->interior['heat_system'])) ? $request->interior['heat_system'] : null,
                'disposal' => (isset($request->interior['disposal'])) ? $request->interior['disposal'] : null,
                'room_description' => (isset($request->interior['room_description'])) ? $request->interior['room_description'] : null,
                'bedroom_description' => (isset($request->interior['Bedroom Description'])) ? $request->interior['Bedroom Description'] : null,
                'microwave' => (isset($request->interior['microwave'])) ? $request->interior['microwave'] : null,
                'icemaker' => (isset($request->interior['icemaker'])) ? $request->interior['icemaker'] : null,
                'connections' => (isset($request->interior['connections'])) ? $request->interior['connections'] : null,
                'compactor' => (isset($request->interior['compactor'])) ? $request->interior['compactor'] : null,
                'floors' => (isset($request->interior['floors'])) ? $request->interior['floors'] : null,
                'master_bath_description' => (isset($request->interior['master_bath_description'])) ? $request->interior['master_bath_description'] : null,
                'cool_system' => (isset($request->interior['cool_system'])) ? $request->interior['cool_system'] : null,
                'interior' => (isset($request->interior['interior'])) ? $request->interior['interior'] : null,
                'oven_type' => (isset($request->interior['oven_type'])) ? $request->interior['oven_type'] : null,
                'fireplace_description' => (isset($request->interior['fireplace_description'])) ? $request->interior['fireplace_description'] : null,
                'countertops' => (isset($request->interior['countertops'])) ? $request->interior['countertops'] : null,
            ];
            PropertyInterior::create($propertyInterior);
            
            $propertyExternal = [
                'property_id' => $id,
                'foundation' => (isset($request->external['foundation'])) ? $request->external['foundation'] : null,
                'street_surface' => (isset($request->external['street_surface'])) ? $request->external['street_surface'] : null,
                'garage_description' => (isset($request->external['garage_description'])) ? $request->external['garage_description'] : null,
                'lot_description' => (isset($request->external['lot_description'])) ? $request->external['lot_description'] : null,
                'acres_description' => (isset($request->external['acres_description'])) ? $request->external['acres_description'] : null,
                'front_door_faces' => (isset($request->external['front_door_faces'])) ? $request->external['front_door_faces'] : null,
                'style' => (isset($request->external['style'])) ? $request->external['style'] : null,
                'pool_private_description' => (isset($request->external['pool_private_description'])) ? $request->external['pool_private_description'] : null,
                'garage_carport' => (isset($request->external['garage_carport'])) ? $request->external['garage_carport'] : null,
                'access' => (isset($request->external['access'])) ? $request->external['access'] : null,
                'lot_size' => (isset($request->external['lot_size'])) ? $request->external['lot_size'] : null,
                'number_of_garage_capacity' => (isset($request->external['number_of_garage_capacity'])) ? $request->external['number_of_garage_capacity'] : null,
                'exterior' => (isset($request->external['exterior'])) ? $request->external['exterior'] : null,
                'roof' => (isset($request->external['roof'])) ? $request->external['roof'] : null,
                'stories' => (isset($request->external['stories'])) ? $request->external['stories'] : null,
                'pool_area' => (isset($request->external['pool_area'])) ? $request->external['pool_area'] : null,
                'pool_private' => (isset($request->external['pool_private'])) ? $request->external['pool_private'] : null,
            ];
            PropertyExternal::create($propertyExternal);
            
            $propertyLocation = [
                'property_id' => $id,
                'parcel_number' => (isset($request->location['parcel_number'])) ? $request->location['parcel_number'] : null, 
                'middle_school' => (isset($request->location['middle_school'])) ? $request->location['middle_school'] : null,
                'area' => (isset($request->location['area'])) ? $request->location['area'] : null, 
                'high_school' => (isset($request->location['high_school'])) ? $request->location['high_school'] : null,
                'elementary_school' => (isset($request->location['elementary_school'])) ? $request->location['elementary_school'] : null, 
                'subdivision' => (isset($request->location['subdivision'])) ? $request->location['subdivision'] : null,  
                'school_district' => (isset($request->location['school_district'])) ? $request->location['school_district'] : null,  
                'geo_market_area' => (isset($request->location['geo_market_area'])) ? $request->location['geo_market_area'] : null,  
            ];

            PropertyLocation::create($propertyLocation);


        
            return redirect('admin/properties')->with('success','Record Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        }
    } */


    /* public function update_property(request $request,$id)
    {
        try{
            $proper = PropertyDetail::findOrFail($id);
            $image = $proper->image;
            if($request->hasfile('image'))
            {
                $files = $request->file('image');
                $destinationPath = public_path('/uploads/properties/'); // upload path
                $video_fileName = rand(10,100) . date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $video_fileName);
                $image = asset('/uploads/properties/' .$video_fileName); 
            }

            $propertydetail = [
                'listing_id' => (isset($request->property['listing_id'])) ? $request->property['listing_id'] : $proper->listing_id,
                'listing_id' => (isset($request->property['full_baths'])) ? $request->property['full_baths'] : $proper->listing_id,
                'listing_id' => (isset($request->property['no_of_Bedrooms'])) ? $request->property['no_of_Bedrooms'] : $proper->listing_id,
                'property_type' => (isset($request->property['property_type'])) ? $request->property['property_type'] : $proper->property_type,
                'county' => (isset($request->property['county'])) ? $request->property['county'] : $proper->county,
                'year_built' => (isset($request->property['year_built'])) ? $request->property['year_built'] : $proper->year_built,
                'total_baths' => (isset($request->property['totalbaths'])) ? $request->property['totalbaths'] : $proper->total_baths,
                'price_sqft' => (isset($request->property['price_sqft'])) ? $request->property['price_sqft'] : $proper->price_sqft,
                'partial_baths' => (isset($request->property['partial_baths'])) ? $request->property['partial_baths'] : $proper->partial_baths,
                'sqft' => (isset($request->property['sqft'])) ? $request->property['sqft'] : $proper->sqft,
                'subdivision' => (isset($request->property['subdivision'])) ? $request->property['subdivision'] : $proper->subdivision,
                'detailsAddressStreet' => (isset($request->property['detailsAddressStreet'])) ? $request->property['detailsAddressStreet'] : $proper->detailsAddressStreet,
                'detailsAddressRegion' => (isset($request->property['detailsAddressRegion'])) ? $request->property['detailsAddressRegion'] : $proper->detailsAddressRegion,
                'contact_info' => (isset($request->property['contact_info'])) ? $request->property['contact_info'] : $proper->contact_info,
                'price' => (isset($request->property['price'])) ? $request->property['price'] : $proper->price,
                'details_link' => (isset($request->property['details_link'])) ? $request->property['details_link'] : $proper->details_link,
                'state' => (isset($request->property['state'])) ? $request->property['state'] : $proper->state,
                'number' => (isset($request->property['number'])) ? $request->property['number'] : $proper->number,
                'street_name' => (isset($request->property['street_name'])) ? $request->property['street_name'] : $proper->street_name,
                'city' => (isset($request->property['city'])) ? $request->property['city'] : $proper->city,
                'status' => 'StatusActive',
                'where_from'=>'api',
                'image' => $image,
                'longitude' => (isset($request->property['longitude'])) ? $request->property['longitude'] : $proper->longitude,
                'latitude' => (isset($request->property['latitude'])) ? $request->property['latitude'] : $proper->latitude,
                'description' => (isset($request->property['description'])) ? $request->property['description'] : $proper->description,
                // 'totalbaths' => (isset($request->details['totalBaths'])) ? $request->details['totalBaths'] : null,
                // 'state_abrv' => (isset($request->property['state-abrv'])) ? $request->property['state-abrv'] : null,
                // 'zip4_idx_hidden' => (isset($request->property['zip4-IDX-hidden'])) ? $request->property['zip4-IDX-hidden'] : null,
                // 'zip_idx_hidden' => (isset($request->property['zip-IDX-hidden'])) ? $request->property['zip-IDX-hidden'] : null,
            ];
            $property = PropertyDetail::where('id',$id)->update($propertydetail);
            $id = $proper->id;

            
            if($request->hasfile('gallery'))
            {
                foreach ($request->file('gallery') as $imagefile) 
                {
                    $files1 = $imagefile;
                    $destinationPath = public_path('/uploads/properties/'); // upload path
                    $fileName1 = rand(10,100).uniqid() . date('YmdHis') . "." . $files1->getClientOriginalExtension();
                    $files1->move($destinationPath, $fileName1);
                    $data['property_id'] = $id; 
                    $data['image_url'] = asset('/uploads/properties/'.$fileName1); 
                    PropertyImages::create($data);
                }
            }
            $finance = PropertyFinancial::where('property_id',$id)->first();
            $propertyFinancial = [
            
                'maintenance_fee_amount' => (isset($request->financial['maintenance_fee_amount'])) ? $request->financial['maintenance_fee_amount'] : $finance->maintenance_fee_amount,
                'tax_rate' => (isset($request->financial['tax_rate'])) ? $request->financial['tax_rate'] : $finance->tax_rate,
                'finance_available' => (isset($request->financial['finance_available'])) ? $request->financial['finance_available'] : $finance->finance_available,
                'tax_amount' => (isset($request->financial['tax_amount'])) ? $request->financial['tax_amount'] : $finance->tax_amount,
                'fee_other_amount' => (isset($request->financial['fee_other_amount'])) ? $request->financial['fee_other_amount'] : $finance->fee_other_amount,
                'compensation_buyer_agent' => (isset($request->financial['compensation_buyer_agent'])) ? $request->financial['compensation_buyer_agent'] : $finance->compensation_buyer_agent,
                'tax_year' => (isset($request->financial['tax_year'])) ? $request->financial['tax_year'] : $finance->tax_year,
                'ownership' => (isset($request->financial['ownership'])) ? $request->financial['ownership'] : $finance->ownership,
                'water_sewer' => (isset($request->financial['water_sewers'])) ? $request->financial['water_sewers'] : $finance->water_sewer,
                'hoa_mandatory' => (isset($request->financial['hoa_mandatory'])) ? $request->financial['hoa_mandatory'] : $finance->hoa_mandatory,
                'other_mandatory_fee' => (isset($request->financial['other_mandatory_fee'])) ? $request->financial['other_mandatory_fee'] : $finance->other_mandatory_fee,
                'fee_other' => (isset($request->financial['fee_other'])) ? $request->financial['fee_other'] : $finance->fee_other,
            ];
            PropertyFinancial::where('property_id',$id)->update($propertyFinancial);
            $addion =  PropertyAdditional::where('property_id',$id)->first();
            $propertyAdditional = [
                'annual_maintenance_description' => (isset($request->additional['annual_maintenance_description'])) ? $request->additional['annual_maintenance_description'] : $addion->annual_maintenance_description,
                'hoa_website' => (isset($request->additional['hoa_website'])) ? $request->additional['hoa_website'] : $addion->hoa_website,
                'master_planned_community' => (isset($request->additional['master_planned_community'])) ? $request->additional['master_planned_community'] : $addion->master_planned_community,
                'restrictions' => (isset($request->additional['restrictions'])) ? $request->additional['restrictions'] : $addion->restrictions,
                'energy' => (isset($request->additional['energy'])) ? $request->additional['energy'] : $addion->energy,
                'legal' => (isset($request->additional['legal'])) ? $request->additional['legal'] : $addion->legal,
                'new_construction' => (isset($request->additional['new_construction'])) ?  $request->additional['new_construction'] : $addion->new_construction,
                'year_built_source' =>  (isset($request->additional['year_built_source'])) ? $request->additional['year_built_source'] : $addion->year_built_source,
                'exemptions' => (isset($request->additional['exemptions'])) ? $request->additional['exemptions'] : $addion->exemptions,
                'management_company_name' => (isset($request->additional['management_company_name'])) ? $request->additional['management_company_name'] : $addion->management_company_name,
                'vacation_rental' => (isset($request->additional['vacation_rental'])) ? $request->additional['vacation_rental'] : $addion->vacation_rental,
                'disclosures' => (isset($request->additional['disclosures'])) ?  $request->additional['disclosures'] : $addion->disclosures,
                'sqftsource' =>  (isset($request->additional['sqftsource'])) ? $request->additional['sqftsource'] : $addion->sqftsource,
                'exclusions' => (isset($request->additional['exclusions'])) ?  $request->additional['exclusions'] : $addion->exclusions,
                'builder_name' => (isset($request->additional['builder_name'])) ? $request->additional['builder_name'] : $addion->builder_name,
            ];
            PropertyAdditional::where('property_id',$id)->update($propertyAdditional);
            $feature = PropertyPrimaryFeatures::where('property_id',$id)->first();
            $propertyPrimaryFeatures = [
                'subdivision' => (isset($request->primary['subdivision'])) ? $request->primary['subdivision'] : $feature->subdivision,
                'half_baths' => (isset($request->primary['half_baths'])) ? $request->primary['half_baths'] : $feature->half_baths,
                'county' => (isset($request->primary['county'])) ? $request->primary['county'] : $feature->county,
                'year_built' => (isset($request->primary['year_built'])) ? $request->primary['year_built'] : $feature->year_built,
                'price_sqft' => (isset($request->primary['price_sqft'])) ? $request->primary['price_sqft'] : $feature->price_sqft,
                'property_type' => (isset($request->primary['property_type'])) ? $request->primary['property_type'] : $feature->property_type,
            ];
            PropertyPrimaryFeatures::where('property_id',$id)->update($propertyPrimaryFeatures);
            $interior = PropertyInterior::where('property_id',$id)->first();
            $propertyInterior = [
                'dishwasher' => (isset($request->interior['dishwasher'])) ? $request->interior['dishwasher'] : $interior->dishwasher,
                'heat_system' => (isset($request->interior['heat_system'])) ? $request->interior['heat_system'] : $interior->heat_system,
                'disposal' => (isset($request->interior['disposal'])) ? $request->interior['disposal'] : $interior->disposal,
                'room_description' => (isset($request->interior['room_description'])) ? $request->interior['room_description'] : $interior->room_description,
                'bedroom_description' => (isset($request->interior['Bedroom Description'])) ? $request->interior['Bedroom Description'] : $interior->bedroom_description,
                'microwave' => (isset($request->interior['microwave'])) ? $request->interior['microwave'] : $interior->microwave,
                'icemaker' => (isset($request->interior['icemaker'])) ? $request->interior['icemaker'] : $interior->icemaker,
                'connections' => (isset($request->interior['connections'])) ? $request->interior['connections'] : $interior->connections,
                'compactor' => (isset($request->interior['compactor'])) ? $request->interior['compactor'] : $interior->compactor,
                'floors' => (isset($request->interior['floors'])) ? $request->interior['floors'] : $interior->floors,
                'master_bath_description' => (isset($request->interior['master_bath_description'])) ? $request->interior['master_bath_description'] : $interior->master_bath_description,
                'cool_system' => (isset($request->interior['cool_system'])) ? $request->interior['cool_system'] : $interior->cool_system,
                'interior' => (isset($request->interior['interior'])) ? $request->interior['interior'] : $interior->interior,
                'oven_type' => (isset($request->interior['oven_type'])) ? $request->interior['oven_type'] : $interior->oven_type,
                'fireplace_description' => (isset($request->interior['fireplace_description'])) ? $request->interior['fireplace_description'] : $interior->fireplace_description,
                'countertops' => (isset($request->interior['countertops'])) ? $request->interior['countertops'] : $interior->countertops,
            ];
            PropertyInterior::where('property_id',$id)->update($propertyInterior);
            $external = PropertyExternal::where('property_id',$id)->first();
            $propertyExternal = [
                'foundation' => (isset($request->external['foundation'])) ? $request->external['foundation'] : $external->foundation,
                'street_surface' => (isset($request->external['street_surface'])) ? $request->external['street_surface'] : $external->street_surface,
                'garage_description' => (isset($request->external['garage_description'])) ? $request->external['garage_description'] : $external->garage_description,
                'lot_description' => (isset($request->external['lot_description'])) ? $request->external['lot_description'] : $external->lot_description,
                'acres_description' => (isset($request->external['acres_description'])) ? $request->external['acres_description'] : $external->acres_description,
                'front_door_faces' => (isset($request->external['front_door_faces'])) ? $request->external['front_door_faces'] : $external->front_door_faces,
                'style' => (isset($request->external['style'])) ? $request->external['style'] : $external->style,
                'pool_private_description' => (isset($request->external['pool_private_description'])) ? $request->external['pool_private_description'] : $external->pool_private_description,
                'garage_carport' => (isset($request->external['garage_carport'])) ? $request->external['garage_carport'] : $external->garage_carport,
                'access' => (isset($request->external['access'])) ? $request->external['access'] : $external->access,
                'lot_size' => (isset($request->external['lot_size'])) ? $request->external['lot_size'] : $external->lot_size,
                'number_of_garage_capacity' => (isset($request->external['number_of_garage_capacity'])) ? $request->external['number_of_garage_capacity'] : $external->number_of_garage_capacity,
                'exterior' => (isset($request->external['exterior'])) ? $request->external['exterior'] : $external->exterior,
                'roof' => (isset($request->external['roof'])) ? $request->external['roof'] : $external->roof,
                'stories' => (isset($request->external['stories'])) ? $request->external['stories'] : $external->stories,
                'pool_area' => (isset($request->external['pool_area'])) ? $request->external['pool_area'] : $external->pool_area,
                'pool_private' => (isset($request->external['pool_private'])) ? $request->external['pool_private'] : $external->pool_private,
            ];
            PropertyExternal::where('property_id',$id)->update($propertyExternal);
            $location = PropertyLocation::where('property_id',$id)->first();
            $propertyLocation = [
                'parcel_number' => (isset($request->location['parcel_number'])) ? $request->location['parcel_number'] : $location->parcel_number, 
                'middle_school' => (isset($request->location['middle_school'])) ? $request->location['middle_school'] : $location->middle_school,
                'area' => (isset($request->location['area'])) ? $request->location['area'] : $location->area, 
                'high_school' => (isset($request->location['high_school'])) ? $request->location['high_school'] : $location->high_school,
                'elementary_school' => (isset($request->location['elementary_school'])) ? $request->location['elementary_school'] : $location->elementary_school, 
                'subdivision' => (isset($request->location['subdivision'])) ? $request->location['subdivision'] : $location->subdivision,  
                'school_district' => (isset($request->location['school_district'])) ? $request->location['school_district'] : $location->school_district,  
                'geo_market_area' => (isset($request->location['geo_market_area'])) ? $request->location['geo_market_area'] : $location->geo_market_area,  
            ];

            PropertyLocation::where('property_id',$id)->update($propertyLocation);

            return redirect()->back()->with('success','Success');

        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('erro',$e->getMessage());

        }
    } */



    public function edit_property($id)
    {
        $data['property'] = Property::find($id);
        $data['amenities'] = Amenities::get();
/*         $data['images'] = PropertyImages::where('property_id',$id)->get();
        $data['location'] = PropertyLocation::where('property_id',$id)->first();
        $data['external'] = PropertyExternal::where('property_id',$id)->first();
        $data['interior'] = PropertyInterior::where('property_id',$id)->first();
        $data['feature'] = PropertyPrimaryFeatures::where('property_id',$id)->first();
        $data['addion'] =  PropertyAdditional::where('property_id',$id)->first();
        $data['finance'] = PropertyFinancial::where('property_id',$id)->first();
 */
        return view("admin.properties.edit",$data);
    }

    
    
    public function delete_gallery($id)
    {
        File::delete(public_path('/uploads/properties/'.$id));
        DB::table('property_images')->where('id',$id)->delete();
        return resdiect()->back()->with([ 'success' => 'Record deleted successfully!']);
    }
   
    public function delete_property($id)
    {
        PropertyDetail::find($id)->delete();
         return redirect()->to('admin/properties')->with('success','Delete Successfull');
      
    }
    
    public function upload_store_old(request $request)
    {
        print_r($request->all());
        // $image = $request->file('file');
        // $fileInfo = $image->getClientOriginalName();
        // $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        // $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        // $file_name= $filename.'-'.time().'.'.$extension;
        // $image->move(public_path('uploads/saad'),$file_name);
            
        // $imageUpload = new Gallery;
        // $imageUpload->original_filename = $fileInfo;
        // $imageUpload->filename = $file_name;
        // $imageUpload->save();
        // return response()->json(['saad'=>$file_name]);
    }
    
}
