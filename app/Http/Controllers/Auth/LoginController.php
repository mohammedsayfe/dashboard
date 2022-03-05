<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\MemberController;
use App\Models\Member;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:member')->except('logout');
    }


    // public function showAdminLoginForm()
    // {
    //     return view('auth.login', ['url' => 'admin']);
    // }


    // public function adminLogin(Request $request)
    // {
    //     $this->validate($request, [
    //         'email'   => 'required|email',
    //         'password' => 'required|min:6'
    //     ]);

    //     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

    //         return redirect()->intended('/admin');
    //     }
    //     return back()->withInput($request->only('email', 'remember'));
    // }

    public function showMemberLoginForm()
    {
        $route = 'memberLogin';
        return view('auth.login',compact('route'));
    }

    public function memberLogin(Request $request)
    {
        // $member = Member::Where('email',$request->email)->firstOrFail();
        // return $member;
        // $member->update([
        //     'password' => Hash::make('password')
        // ]);

        // $member = Member::whereEmail($request->email)->firstOrFail();

        // if(Hash::check($request->password, $member->password)){
        //     return 'Member';
        // }else{
        //     return 'Not Lofin';
        // }
        $request->validate([
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->route('sales.index');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
