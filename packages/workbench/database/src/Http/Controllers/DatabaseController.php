<?php

namespace Workbench\Database\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;



class DatabaseController extends Controller
{


    public function __construct()
    {

    }


    public function index()
    {
      // dd('sini');
		  return view('database::database.index');


    }

    


}
