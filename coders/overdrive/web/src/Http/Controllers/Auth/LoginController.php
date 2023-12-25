<?php

namespace Overdrive\Web\Http\Controllers\Auth;

use Overdrive\Web\Http\Requests\Auth\LoginRequest;
use Overdrive\Web\Providers\RouteServiceProvider;
use Illuminate\Routing\Controller;
use Overdrive\Web\Service\AuditServices;
use Illuminate\Http\Request;


use Auth;
use Redirect;
use DB;

class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        // visitor()->visit();

        if(\request('id'))
        {
            $email = \request('id');

            if($email){

                $userinfo = DB::table('users')->where('email','=',$email)->first();
                if($userinfo){

                    auth()->loginUsingId($userinfo->id);

                    return redirect(url('home'));

                }else{

                    return redirect(url('/auth/login'));
                }


            }


        }else{

            if(Auth::check())
            {
                 return redirect::to('/home');

            }


            $response = null;

            if(app('session')->get('reg'))
            {
                $response = app('session')->get('reg');
            }
            // $response = 'Pengesahan Emel telah dihantar ke email pengguna AKU .';


             return view('web::auth.login',compact('response'));
            //return view('web::auth.logmasuk');


        }//end else


        // return view('web::auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {


        // $validator = $request->validate([
        //     'g-recaptcha-response' => 'required|captcha'
        //     ],
        //     [
        //         'g-recaptcha-response.required' => 'Captha adalah wajib !',
        //         'g-recaptcha-response.captcha' => 'Captha adalah wajib !',


        //     ]);


        $request->authenticate();

        $request->session()->regenerate();

        $audit = (new AuditServices())->lastlogin($request);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
