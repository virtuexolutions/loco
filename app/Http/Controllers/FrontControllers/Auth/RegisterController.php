<?php

namespace App\Http\Controllers\FrontControllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Redirect;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function Index()
    {
        return view("auth.register");
    }

    public function postRegister(Request $request)
    {
        // print_r($request['property']['ltd']);die;
        // dd('asdd');
        $validator = Validator::make($request->all(), [
        //    'no_of_bedroom' => "required|array|min:1",
        //    "no_of_bedroom.*" => "required|string|distinct|min:1",
        //    'price_range_min' => 'required|string',
        //    'price_range_max' => 'required|string',
        //    'monthly_income' =>  'required|string',
        //    'moving_destinations' => "required|array|min:1",
        //    "moving_destinations.*" => "required|string|distinct|min:1",
        //    'type_of_building' => "required|array|min:1",
        //    "type_of_building.*" => "required|string|distinct|min:1",
        //    'features_amenities' => "required|array|min:1",
        //    "features_amenities.*" => "required|string|distinct|min:1",
        //    'bathroom_features' => "required|array|min:1",
        //    "bathroom_features.*" => "required|string|distinct|min:1",
        //    'pets' => "required|array|min:1",
        //    "pets.*" => "required|string|distinct|min:1",
        //    'how_get_there' => "required|array|min:1",
        //    "how_get_there.*" => "required|string|distinct|min:1",
        //    'care_most_about' => "required|array|min:1",
        //   "care_most_about.*" => "required|string|distinct|min:1",
        //    'move_date' => 'required|date',
        //    'is_evicted' => 'required|string', 'max:5',
        //    'name' =>  'required|string', 'max:255',
        //    'lastname' => 'required|string|max:255',
        //    'email' => 'required|string|email|max:255|unique:users',
        //    'phone' => 'required|string|max:255',
        //    'password' => 'required|string|min:8|confirmed',
        ]);
        if($validator->fails()){
            return Response::json([$validator->errors()], 422); 
        }
        else{
            $data = array(
                    'no_of_bedroom' => json_encode($request->no_of_bedroom),
                    'price_range' => $request->price_range_min ."-". $request->price_range_max,
                    'monthly_income' =>  $request->monthly_income,
                    'moving_destinations' => json_encode($request->moving_destinations),
                    'type_of_building' => json_encode($request->type_of_building),
                    'features_amenities' => json_encode($request->features_amenities),
                    'bathroom_features' => json_encode($request->bathroom_features),
                    'pets' =>  json_encode($request->pets),
                    'how_get_there' => json_encode($request->how_get_there),
                    'care_most_about' => json_encode($request->care_most_about),
                    //'move_date' => $request->move_date,
                    'is_evicted' => $request->is_evicted,
                    'name' =>  $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'address' => $request->address,
                    'ltd' => $request['property']['ltd'],
                    'lng' => $request['property']['lng'],
                    'phone' => $request->phone,
                    'password' =>  Hash::make($request->password),
            );
            $check = $this->create($data);
            $credentials = $request->all("email","password");
            if (Auth::attempt($credentials)) {
                return redirect()->intended('home')
                            ->withSuccess('You have Successfully loggedin');
            }
            return Redirect::to("login")->withSuccess('Great! You have Successfully loggedin');
        }
    }



    // protected function validator(array $data)
    // {
    //     Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ])->validate(1);
    //     // echo "<pre>";
    //     // print_R(response()->json($validator->errors(), 422));
    //    // return $validator;
    // }


    
    // protected function redirectTo($request)
    // {
    //     return route('asdasd');
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
    //  dd('saad');
     return User::create($data);
    }
}
