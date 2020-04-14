<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jabatan;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

        public function login(Request $request)

        {   

        $input = $request->all();

   

        $this->validate($request, [

            'email' => 'required|email',

            'password' => 'required',

        ]);

   

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))

        {
        // 1 admin
        // 2 kepala bps
        // 3 kepala bps kabupaten
        // 4 kabid
        // 5 kasie
        // 6 staf
        
        // $user= new User;
                    $user = Auth::user();
            // if (auth()->user()->jabatan_id == 1) {

            //     return redirect()->route('admin.home');

            // }
            // elseif(auth()->user()->jabatan_id == 2){

            //     return redirect()->route('kepalabps.home');

            // }
            if($user->jabatan->role != 6 ){

                return redirect()->route('home');

            }
            elseif($user->jabatan->role == 6 ){

                return redirect()->route('home');

            }
            // elseif(auth()->user()->jabatan_id == range (29, 48)){

            //     return redirect()->route('home');

            // }
            // elseif(auth()->user()->jabatan_id == 5){

            //     return redirect()->route('kasie.home');

            // }
            // elseif(auth()->user()->jabatan_id == 6){

            //     return redirect()->route('staf.home');

            // }

            }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

            }

          

    }


}
