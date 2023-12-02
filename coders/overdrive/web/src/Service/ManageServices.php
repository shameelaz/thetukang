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

class ManageServices
{

    public static function status($id)
    {
        $menu = Menus::where('id',$id)->first();
        if($menu)
        {
            if($menu->status == 2)
            {
                $menu->status = 1;
                $menu->update();
            }
            else
            {
                $menu->status = 2;
                $menu->update();
            }
        }

        return redirect()->route('menum::menu.index')->withSuccess('Status Dikemaskini');
    }

    public static function icon($id,$name)
    {
        $menu = Menus::where('id',$id)->first();
        if($menu)
        {
            $menu->icon = $name;
            $menu->update();
        }

        return redirect()->route('menum::menu.index')->withSuccess('Icon Dikemaskini');
    }

}
