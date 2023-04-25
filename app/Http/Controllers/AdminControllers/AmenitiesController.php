<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenities;
class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function index()
    {
        $amenities = Amenities::all();
        return view('admin.amenities.index',compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenities::all();
        return view('admin.amenities.add',compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // return $request->all();
            Amenities::create($request->all());
            return redirect()->back()->with(['success'=>'Amenities Create Successfully']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenities = Amenities::find($id);
        return view('admin.amenities.edit',compact('amenities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            // return $request->all();
            $amenities = Amenities::find($id);
            $amenities->update($request->all());
            return redirect()->back()->with(['success'=>'Amenities Update Successfully']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // return $request->all();
            $amenities = Amenities::find($id);
            $amenities->delete();
            return redirect()->back()->with(['success'=>'Amenities Delete Successfully']);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage())->withInput($request->input());
        }
    }
}
