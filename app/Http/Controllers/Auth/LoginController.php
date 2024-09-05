<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\VisaDataModel;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->type == 'Agent') {
            if ($user->status == 'Active') {
                return redirect()->route('home');
            } else {
                $notification = array(
                    'message' => 'Please Wait For Admin approval.',
                    'alert-type' => 'error'
                );
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is inactive. Please contact the administrator.')->with($notification);
            }
        } elseif ($user->type == 'Customer') {
            $visaData = VisaDataModel::where('user_id', $user->id)->first();

            if ($visaData) {
                return redirect()->route('home');
            } else {
                return redirect()->route('visa.data.first');
            }
        } else {
            $notification = array(
                'message' => 'Unauthorized access.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with('error', 'You do not have access to this area.')->with($notification);
        }
    }

    // public function username()
    // {
    //     return 'phone';
    // }

    // protected function credentials(Request $request)
    // {
    //     return [
    //         'phone' => $request->input('phone'),
    //         'password' => $request->input('password'),
    //     ];
    // }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontant_with_extra_path.login');
    }
}
