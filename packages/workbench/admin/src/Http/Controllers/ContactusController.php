<?php

namespace Workbench\Admin\Http\Controllers;

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



class ContactusController extends Controller
{


    public function __construct()
    {

    }


    public function contactusEdit()
    {

		return view('admin::admin.contactus.edit');

    }




}
