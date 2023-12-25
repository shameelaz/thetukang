<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Redirect;
use Auth;
use Session;


class Home extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('home');
    }


    public function changeLocale(request $request)
    {

        // dd($request->lang);

        $locale = App::currentLocale();
        // dd($locale);
       // dump(App::currentLocale());
        Session::put('locale', $request->lang);

        // dd(Session::get('locale'));
       \App::setLocale($request->lang);
        
        // dd(App::currentLocale());
        // if(Auth::check())
        // {
        //     $user = auth()->user();
        //     $user->language = $request->lang;
        //     $user->update();
        // }

        $pre = \URL::previous();

        $contains = Str::contains($pre, 'log');

        if($contains)
        {
           return redirect('/');
        }

        return redirect()->back();
    }
}
