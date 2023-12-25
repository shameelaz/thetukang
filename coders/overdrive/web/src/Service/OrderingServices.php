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

class OrderingServices
{

    public function mainorder()
    {
        $data = Menus::where('type', '2')->max('order');

        return $data;
    }

    public function suborder($id)
    {
        $data = Menus::where('parent_id', $id)->max('order');

        return $data;
    }


    public static function reorder($id,$type)
    {
        $menu = Menus::where('id',$id)->first();
        if($menu->parent_id)
        {
            //kes child and sub child
            //first cari id asal punye order
            $current = $menu->order;
            
            if($type == 1)
            {
                $neworder = $current-1;
                               
            }
            else
            {
                $neworder = $current+1;
            }


            $oldmenu = Menus::where('parent_id',$menu->parent_id)->where('order',$neworder)->first();
            $oldmenu->order = $current;
            $oldmenu->update();

            $menu->order = $neworder;
            $menu->update();

            
           

        }else
        {
            //kes main menu
            //first cari id asal punye order
            $current = $menu->order;
            
            if($type == 1)
            {
                $neworder = $current-1;

            }
            else
            {
                $neworder = $current+1;
            }

            $oldmenu = Menus::where('type',2)->where('order',$neworder)->first();
            $oldmenu->order = $current;
            $oldmenu->update();

            $menu->order = $neworder;
            $menu->update();



        }

        return redirect()->route('menum::menu.index')->withSuccess('Susunan Dikemaskini');
    }

}
