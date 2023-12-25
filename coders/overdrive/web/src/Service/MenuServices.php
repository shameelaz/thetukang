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

class MenuServices extends OrderingServices
{


    public function create(Request $request)
    {

        $neworder = $this->mainorder();

        $newmenu = new Menus;
        $newmenu->name_bm = $request->title_ms;
        $newmenu->name_en = $request->title_en;
        $newmenu->permission = json_encode($request->permission);
        $newmenu->route = $request->url;
        $newmenu->status = 2;
        $newmenu->type = 2;
        $newmenu->order = $neworder+1;
        $newmenu->save();

        return redirect()->route('menum::menu.index')->withSuccess('Menu Baharu Ditambah');
    }


    public function update(Request $request)
    {


        $newmenu = Menus::where('id',$request->mid)->first(); 
        $newmenu->name_bm = $request->title_ms;
        $newmenu->name_en = $request->title_en;
        $newmenu->permission = json_encode($request->permission);
        $newmenu->route = $request->url;
        $newmenu->update();

        return redirect()->route('menum::menu.index')->withSuccess('Menu Dikemaskini');
    }

    public static function delete($id)
    {
        $menu = Menus::where('id',$id)->delete();
        
        return redirect()->route('menum::menu.index')->withSuccess('Menu Dihapuskan');
    }

}
