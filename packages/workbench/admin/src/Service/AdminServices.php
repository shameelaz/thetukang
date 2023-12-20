<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
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
use Config;
use Auth;
use File;
use Redirect;
use Mail;
use Curl;
use DB;
use Svg\Tag\Rect;
use Workbench\Database\Model\Agency\LkpRating;
use Workbench\Database\Model\Agency\LkpServiceType;

class AdminServices
{

    // ------------------- Lookup Service Type ------------------- //
    public function srvtypeList(Request $request)
    {
        $user           = Auth::user()->id;

        $srvtype        = LkpServiceType::get();
        
        return $srvtype;
    }

    public function srvtypeAdd(Request $request)
    {
        $user                               = Auth::user()->id;

        $srvtype                            = new LkpServiceType();
        $srvtype->name                      = $request->name;
        $srvtype->desc                      = $request->desc;
        $srvtype->status                    = $request->status;
        $srvtype->save();

    }

    public function srvtypeView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

       
        $srvtype = LkpServiceType::where('id', $request->id)->first();

        return $srvtype;
    }


    public function srvtypeUpd(Request $request)
    {
        $srvtype                            = LkpServiceType::where('id', $request->id)->first();
        $srvtype->name                      = $request->name;
        $srvtype->desc                      = $request->desc;
        $srvtype->status                    = $request->status;
        $srvtype->save();

    }

    public function srvtypeDelete(Request $request)
    {
        $srvtype                            = LkpServiceType::where('id', $request->id)->first();
        $srvtype->delete();

    }

    // ------------------- Lookup Rating ------------------- //
    public function rateList(Request $request)
    {
        $user           = Auth::user()->id;

        $rate           = LkpRating::get();
        
        return $rate;
    }

    public function rateAdd(Request $request)
    {
        $user                            = Auth::user()->id;

        $rate                            = new LkpRating();
        $rate->desc                      = $request->desc;
        $rate->rate                      = $request->rate;
        $rate->status                    = $request->status;
        $rate->save();

    }

    public function rateView(Request $request)
    {
        $user = Auth::user()->id;
        $roleid = Auth::user()->roles[0]->id;

       
        $rate = LkpRating::where('id', $request->id)->first();

        return $rate;
    }


    public function rateUpd(Request $request)
    {
        $rate                            = LkpRating::where('id', $request->id)->first();
        $rate->desc                      = $request->desc;
        $rate->rate                      = $request->rate;
        $rate->status                    = $request->status;
        $rate->save();

    }

    public function rateDelete(Request $request)
    {
        $rate                            = LkpRating::where('id', $request->id)->first();
        $rate->delete();

    }
  
}
