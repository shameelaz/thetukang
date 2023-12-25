<?php

namespace Overdrive\Web\Http\Controllers\Backend;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Redirect;
use DB;
use Auth;

class MainController extends BaseController
{

	public function index()
	{
		$user = auth()->user();
        $roleid = auth()->user()->roles['0']->id;

        switch ($roleid) {
        	case 1:
        		//super admin
        		return view('web::backend.dashboard.index');
        		break;

        	case 2:
        		// admin system
        		// return view('web::backend.dashboard.index');
        		return redirect(url('dashboard/admin'));
        		break;

        	case 3:
        		//admin kewangan
        		// return view('web::backend.dashboard.index');
        		break;

        	case 4:
        		//admin ptj/agensi
        		// return view('web::backend.dashboard.index');
        		return redirect(url('dashboard/agency'));
        		break;

        	case 5:
        		//pegawai agensi
        		// return view('web::backend.dashboard.index');
        		break;

        	case 6:
        		//vvip pengurasan tertinggi
        		// return view('web::backend.dashboard.index');
        		break;

        	case 7:
        		// return view('web::backend.dashboard.index');
        		return redirect(url('dashboard/pelanggan'));
        		break;

        	
        	default:
        		// code...
        		break;
        }

		return view('web::backend.dashboard.index');
	}

	public function readNotification($id)
	{
		return view('web::frontend.index');
	}
}
