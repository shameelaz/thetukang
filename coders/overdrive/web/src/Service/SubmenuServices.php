<?php

namespace Overdrive\Web\Service;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use Mail;
use Curl;
use Overdrive\Web\Model\Menus;
use Overdrive\Web\Model\Mpermission;
use Session;
use App;
use Config;
use Overdrive\Web\Service\OrderingServices;

class SubmenuServices extends OrderingServices
{

    public function create(Request $request)
    {
        $neworder = $this->suborder($request->parent);

        $newmenu = new Menus;
        $newmenu->name_bm = $request->title_ms;
        $newmenu->name_en = $request->title_en;
        $newmenu->permission = json_encode($request->permission);
        $newmenu->route = $request->url;
        $newmenu->status = 2;
        $newmenu->parent_id = $request->parent;
        $newmenu->type = 1;
        $newmenu->order = $neworder+1;
        $newmenu->save();

        return redirect()->route('menum::menu.index')->withSuccess('Submenu Ditambah');
    }

}
