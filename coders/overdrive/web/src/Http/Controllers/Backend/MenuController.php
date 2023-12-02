<?php

namespace Overdrive\Web\Http\Controllers\Backend;

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
use Lang;

use Overdrive\Web\Service\MenuServices;
use Overdrive\Web\Service\SubmenuServices;
use Overdrive\Web\Service\OrderingServices;
use Overdrive\Web\Service\ManageServices;

class MenuController extends Controller
{

    public function index()
    {
 
       $segment = Menus::label()->with('child','child.submenu')->get();
       $parent = Menus::main()->with('child','child.submenu')->get();
       $permissions = Mpermission::get();


       $icons = [
          "activity",
          "airplay",
          "alert-circle",
          "alert-octagon",
          "alert-triangle",
          "align-center",
          "align-justify",
          "align-left",
          "align-right",
          "anchor",
          "aperture",
          "arrow-down-left",
          "arrow-down-right",
          "arrow-down",
          "arrow-left",
          "arrow-right",
          "arrow-up-left",
          "arrow-up-right",
          "arrow-up",
          "at-sign",
          "award",
          "bar-chart-2",
          "bar-chart",
          "battery-charging",
          "battery",
          "bell-off",
          "bell",
          "bluetooth",
          "bold",
          "book",
          "bookmark",
          "box",
          "briefcase",
          "calendar",
          "camera-off",
          "camera",
          "cast",
          "check-circle",
          "check-square",
          "check",
          "chevron-down",
          "chevron-left",
          "chevron-right",
          "chevron-up",
          "chevrons-down",
          "chevrons-left",
          "chevrons-right",
          "chevrons-up",
          "chrome",
          "circle",
          "clipboard",
          "clock",
          "cloud-drizzle",
          "cloud-lightning",
          "cloud-off",
          "cloud-rain",
          "cloud-snow",
          "cloud",
          "codepen",
          "command",
          "compass",
          "copy",
          "corner-down-left",
          "corner-down-right",
          "corner-left-down",
          "corner-left-up",
          "corner-right-down",
          "corner-right-up",
          "corner-up-left",
          "corner-up-right",
          "cpu",
          "credit-card",
          "crop",
          "crosshair",
          "delete",
          "disc",
          "download-cloud",
          "download",
          "droplet",
          "edit-2",
          "edit-3",
          "edit",
          "external-link",
          "eye-off",
          "eye",
          "facebook",
          "fast-forward",
          "feather",
          "file-minus",
          "file-plus",
          "file-text",
          "file",
          "film",
          "filter",
          "flag",
          "folder",
          "github",
          "gitlab",
          "globe",
          "grid",
          "hash",
          "headphones",
          "heart",
          "help-circle",
          "home",
          "image",
          "inbox",
          "info",
          "instagram",
          "italic",
          "layers",
          "layout",
          "life-buoy",
          "link-2",
          "link",
          "list",
          "loader",
          "lock",
          "log-in",
          "log-out",
          "mail",
          "map-pin",
          "map",
          "maximize-2",
          "maximize",
          "menu",
          "message-circle",
          "message-square",
          "mic-off",
          "mic",
          "minimize-2",
          "minimize",
          "minus-circle",
          "minus-square",
          "minus",
          "monitor",
          "moon",
          "more-horizontal",
          "more-vertical",
          "move",
          "music",
          "navigation-2",
          "navigation",
          "octagon",
          "package",
          "paperclip",
          "pause-circle",
          "pause",
          "percent",
          "phone-call",
          "phone-forwarded",
          "phone-incoming",
          "phone-missed",
          "phone-off",
          "phone-outgoing",
          "phone",
          "pie-chart",
          "play-circle",
          "play",
          "plus-circle",
          "plus-square",
          "plus",
          "pocket",
          "power",
          "printer",
          "radio",
          "refresh-ccw",
          "refresh-cw",
          "repeat",
          "rewind",
          "rotate-ccw",
          "rotate-cw",
          "save",
          "scissors",
          "search",
          "server",
          "settings",
          "share-2",
          "share",
          "shield",
          "shopping-cart",
          "shuffle",
          "sidebar",
          "skip-back",
          "skip-forward",
          "slack",
          "slash",
          "sliders",
          "smartphone",
          "speaker",
          "square",
          "star",
          "stop-circle",
          "sun",
          "sunrise",
          "sunset",
          "tablet",
          "tag",
          "target",
          "thermometer",
          "thumbs-down",
          "thumbs-up",
          "toggle-left",
          "toggle-right",
          "trash-2",
          "trash",
          "trending-down",
          "trending-up",
          "triangle",
          "tv",
          "twitter",
          "type",
          "umbrella",
          "underline",
          "unlock",
          "upload-cloud",
          "upload",
          "user-check",
          "user-minus",
          "user-plus",
          "user-x",
          "user",
          "users",
          "video-off",
          "video",
          "voicemail",
          "volume-1",
          "volume-2",
          "volume-x",
          "volume",
          "watch",
          "wifi-off",
          "wifi",
          "wind",
          "x-circle",
          "x-square",
          "x",
          "zap",
          "zoom-in",
          "zoom-out"
        ];

       

       if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {


            $locale = Lang::locale();
        }

        // $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();
        // dd($routeCollection);
       
       return view('web::backend.menu.index', compact('segment','parent','permissions','locale','icons'));

    }


    //For Main Menu

    public function loadicon($id)
    {
      $icons = [
          "activity",
          "airplay",
          "alert-circle",
          "alert-octagon",
          "alert-triangle",
          "align-center",
          "align-justify",
          "align-left",
          "align-right",
          "anchor",
          "aperture",
          "arrow-down-left",
          "arrow-down-right",
          "arrow-down",
          "arrow-left",
          "arrow-right",
          "arrow-up-left",
          "arrow-up-right",
          "arrow-up",
          "at-sign",
          "award",
          "bar-chart-2",
          "bar-chart",
          "battery-charging",
          "battery",
          "bell-off",
          "bell",
          "bluetooth",
          "bold",
          "book",
          "bookmark",
          "box",
          "briefcase",
          "calendar",
          "camera-off",
          "camera",
          "cast",
          "check-circle",
          "check-square",
          "check",
          "chevron-down",
          "chevron-left",
          "chevron-right",
          "chevron-up",
          "chevrons-down",
          "chevrons-left",
          "chevrons-right",
          "chevrons-up",
          "chrome",
          "circle",
          "clipboard",
          "clock",
          "cloud-drizzle",
          "cloud-lightning",
          "cloud-off",
          "cloud-rain",
          "cloud-snow",
          "cloud",
          "codepen",
          "command",
          "compass",
          "copy",
          "corner-down-left",
          "corner-down-right",
          "corner-left-down",
          "corner-left-up",
          "corner-right-down",
          "corner-right-up",
          "corner-up-left",
          "corner-up-right",
          "cpu",
          "credit-card",
          "crop",
          "crosshair",
          "delete",
          "disc",
          "download-cloud",
          "download",
          "droplet",
          "edit-2",
          "edit-3",
          "edit",
          "external-link",
          "eye-off",
          "eye",
          "facebook",
          "fast-forward",
          "feather",
          "file-minus",
          "file-plus",
          "file-text",
          "file",
          "film",
          "filter",
          "flag",
          "folder",
          "github",
          "gitlab",
          "globe",
          "grid",
          "hash",
          "headphones",
          "heart",
          "help-circle",
          "home",
          "image",
          "inbox",
          "info",
          "instagram",
          "italic",
          "layers",
          "layout",
          "life-buoy",
          "link-2",
          "link",
          "list",
          "loader",
          "lock",
          "log-in",
          "log-out",
          "mail",
          "map-pin",
          "map",
          "maximize-2",
          "maximize",
          "menu",
          "message-circle",
          "message-square",
          "mic-off",
          "mic",
          "minimize-2",
          "minimize",
          "minus-circle",
          "minus-square",
          "minus",
          "monitor",
          "moon",
          "more-horizontal",
          "more-vertical",
          "move",
          "music",
          "navigation-2",
          "navigation",
          "octagon",
          "package",
          "paperclip",
          "pause-circle",
          "pause",
          "percent",
          "phone-call",
          "phone-forwarded",
          "phone-incoming",
          "phone-missed",
          "phone-off",
          "phone-outgoing",
          "phone",
          "pie-chart",
          "play-circle",
          "play",
          "plus-circle",
          "plus-square",
          "plus",
          "pocket",
          "power",
          "printer",
          "radio",
          "refresh-ccw",
          "refresh-cw",
          "repeat",
          "rewind",
          "rotate-ccw",
          "rotate-cw",
          "save",
          "scissors",
          "search",
          "server",
          "settings",
          "share-2",
          "share",
          "shield",
          "shopping-cart",
          "shuffle",
          "sidebar",
          "skip-back",
          "skip-forward",
          "slack",
          "slash",
          "sliders",
          "smartphone",
          "speaker",
          "square",
          "star",
          "stop-circle",
          "sun",
          "sunrise",
          "sunset",
          "tablet",
          "tag",
          "target",
          "thermometer",
          "thumbs-down",
          "thumbs-up",
          "toggle-left",
          "toggle-right",
          "trash-2",
          "trash",
          "trending-down",
          "trending-up",
          "triangle",
          "tv",
          "twitter",
          "type",
          "umbrella",
          "underline",
          "unlock",
          "upload-cloud",
          "upload",
          "user-check",
          "user-minus",
          "user-plus",
          "user-x",
          "user",
          "users",
          "video-off",
          "video",
          "voicemail",
          "volume-1",
          "volume-2",
          "volume-x",
          "volume",
          "watch",
          "wifi-off",
          "wifi",
          "wind",
          "x-circle",
          "x-square",
          "x",
          "zap",
          "zoom-in",
          "zoom-out"
        ];
        return view('web::backend.menu.ajax.icon', compact('icons','id'));
    }


    public function addsubs($id)
    {
       $permissions = Mpermission::get();
       $menu = Menus::where('id',$id)->first();

       if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {


            $locale = Lang::locale();
        }

       return view('web::backend.menu.ajax.addsub', compact('menu','permissions','locale'));
    }

    
    public function add(Request $request)
    {
        return (new MenuServices())->create($request);
    }

    // edit all menu
    public function edit(Request $request)
    {
        return (new MenuServices())->update($request);
    }

    // delete all menu
    public function delete($id)
    {
         return MenuServices::delete($id);
    }



    //for Sub menu

    public function addsub(Request $request)
    {
        return (new SubmenuServices())->create($request);
    }



    //for Other menu manager

    public function togle($id)
    {
        return ManageServices::status($id);
    }

    public function order($id,$type)
    {
        return OrderingServices::reorder($id,$type);
    }

    public function icon($id,$name)
    {
        return ManageServices::icon($id,$name);
    }


    

}
