<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\User\Users;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Session;
use App;
use App\Imports\UsersImport;
use Config;;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelServices
{


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/

    // ------------------- Excel ------------------- //

    public function import()
    {
        Excel::import(new UsersImport, 'payeraccount.xlsx');

        return redirect('/')->with('success', 'All good!');
    }



}
