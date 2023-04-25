<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Logo;
use App\User;
use App\Product;
use App\Models\PropertyDetail;
use App\Inquiry;
use DB;

use App\Exports\PropertyExport;
use App\Imports\PropertyImport;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function importExportView()
    {
       return view('admin.properties.import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PropertyExport, 'property.xlsx');
        // return redirect()->back()->with(['success'=> 'Property Export Successfully']);
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new PropertyImport,request()->file('file'));
           
        return back()->with(['success'=> 'Property Import Successfully']);
    }


    public function initContent(){

        $users = User::all();
        $totalUsers = count($users);

        
        $properties = PropertyDetail::all();
        $totalProperties = count($properties);


        // $inquiries = Inquiry::all();
        // $totalInquiries = count($inquiries);

        $inquiries = DB::select('select * from inquiries');
        $totalInquiries = count($inquiries);
		
		$love = DB::table('properties_options')->where('status','Love')->get();
        $totalLove = count($love);
		
		$maybe = DB::table('properties_options')->where('status','Maybe')->get();
        $totalmaybe = count($maybe);

        //dd($totalLove);
    	return view('admin.dashboard')
        ->with('totalUsers',$totalUsers)
		->with('totallove',$totalLove)
		->with('totalmaybe',$totalmaybe)
        ->with('totalInquiries',$totalInquiries)
        ->with('totalProperties',$totalProperties);
    }



    function upload(Request $request)
    {
     $image = $request->file('file');

     $imageName = time() . '.' . $image->extension();

     $image->move(public_path('images'), $imageName);

     return response()->json(['success' => $imageName]);
    }

    function fetch()
    {
     $images = \File::allFiles(public_path('images'));
     $output = '<div class="row">';
     foreach($images as $image)
     {
      $output .= '
      <div class="col-md-2" style="margin-bottom:16px;" align="center">
                <img src="'.asset('images/' . $image->getFilename()).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                <button type="button" class="btn btn-link remove_image" id="'.$image->getFilename().'">Remove</button>
            </div>
      ';
     }
     $output .= '</div>';
     echo $output;
    }

    function delete(Request $request)
    {
     if($request->get('name'))
     {
      \File::delete(public_path('images/' . $request->get('name')));
     }
    }
}
