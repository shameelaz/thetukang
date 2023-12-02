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
use Illuminate\Support\Facades\Auth;
use Laravolt\Suitable\Columns\Raw;
use Svg\Tag\Rect;
use Workbench\Admin\Service\UserServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\PtjServices;
use Workbench\Admin\Service\KhidmatServices;

class AgencyptjController extends Controller
{


    public function __construct()
    {

    }

     // ------------------- Agensi ------------------- //

     public function agensiptjList(Request $request)
     {
       $agptj = (new AgencyServices())->agptjList($request);

       return view('admin::admin.agensiptj.list',compact('agptj'));
     }

     public function agensiptjAdd(Request $request)
     {
        $agptj = (new AgencyServices())->agensiList($request);

       return view('admin::admin.agensiptj.add', compact('agptj'));
     }

     public function agensiptjSave(Request $request)
     {
       $agptj = (new AgencyServices())->agptjAdd($request);

       return redirect('/admin/agensiptj/list')->withSuccess('Berjaya Menambah Data');
     }

     public function agensiptjEdit(Request $request)
     {
       $agptj = (new AgencyServices())->agptjEdit($request);

       return view('admin::admin.agensiptj.edit',compact('agptj'));
     }

     public function agensiptjUpd(Request $request)
     {
        if($request->logo_agensi){

          $request->validate([
            'logo_agensi' => 'required|image|mimes:png,jpeg,jpg|max:2048',
          ],
          [
              'logo_agensi.required' => 'Perlu upload logo agensi',
              'logo_agensi.image' => 'Perlu muatnaik imej sahaja untuk logo agensi',
              'logo_agensi.mimes' => 'Hanya format imej png yg boleh dimuatnaik untuk logo agensi',
              'logo_agensi.max' => 'Logo agensi mestilah tidak lebih dari 2MB',
              'logo_agensi.dimensions' => 'saiz resolusi imej haruslah width = 60px dan  height= 60px',


          ]
          );


        }else{



        }



       $agptj = (new AgencyServices())->agptjUpd($request);

       return redirect('/admin/agensiptj/list')->withSuccess('Berjaya Kemaskini Data');
     }


     public function agensiShow(Request $request)
     {

        $agensi = (new AgencyServices())->agptjEdit($request);

        $dalaman = (new AgencyServices())->khidmatDalaman($request);
        // dump($dalaman);

        return view('admin::public.agensi.show',compact('agensi','dalaman'));

     }


     // ------------------- Agensi/Khidmat ------------------- //


     public function agkhidmatList(Request $request)
     {
       $khid = (new AgencyServices())->khidResult($request);


       return view('admin::admin.agensiptj.khidmat.list',compact('khid'));
     }

     public function agkhidmatForm(Request $request)
     {
        $agensi = (new AgencyServices())->agensiResult($request);

        // dd($agensi);
       return view('admin::admin.agensiptj.khidmat.add', compact('agensi','request'));
     }

     public function agkhidmatSave(Request $request)
     {
        // dd($request);
       $khid = (new AgencyServices())->khidAdd($request);

       return redirect('/admin/agensiptj/khidmat/list/'.$request->fk_laman_agensi)->withSuccess('Berjaya Menambah Data');
     }

     public function agkhidmatEdit(Request $request)
    {
        $khid = (new AgencyServices())->khidShow($request);

      return view('admin::admin.agensiptj.khidmat.edit',compact('request','khid'));
    }

    public function agkhidmatUpd(Request $request)
    {
        $khid = (new AgencyServices())->khidUpd($request);

        return redirect('/admin/agensiptj/khidmat/list/'.$request->fk_laman_agensi)->withSuccess('Berjaya Kemaskini Data');
    }


    public function pubAgencyList(Request $request)
    {
        $user = Auth::user();
        $agency =  (new AgencyServices())->agptjList($request);

        return view('admin::public.agensi.list',compact('agency','user'));
    }


    public function khidmatDlmList(Request $request)
    {
        $agency =  (new AgencyServices())->agptjEdit($request);
        // dd($agency);
        return view('admin::admin.agensiptj.khidmat.dalaman.list',compact('agency'));
        // dd($agency);
    }

    public function khidmatDlmAdd(Request $request)
    {
        $lkpkhidmat = (new AgencyServices())->kodHasilList($request);
        // dd($lkpkhidmat);

        return view('admin::admin.agensiptj.khidmat.dalaman.add',compact('lkpkhidmat'));
    }

    public function khidmatDlmSave(Request $request)
    {
        // dd($request);
        $data = (new AgencyServices())->addKodHasilLmnAgensi($request);

        return redirect('/admin/agensiptj/khidmat/dalaman/list/'.$request->fk_laman_agensi)->withSuccess('Berjaya Kemaskini Data');

    }

    public function khidmatDlmShow(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatDlmShow($request);
        $lkpkhidmat = (new AgencyServices())->kodHasilList($request);
        // dump($khidmat);
        return view('admin::admin.agensiptj.khidmat.dalaman.show',compact('lkpkhidmat','khidmat'));

    }

    public function khidmatDlmUpd(Request $request)
    {
        $khidmat = (new AgencyServices())->khidmatDlmUpd($request);
        return redirect('/admin/agensiptj/khidmat/dalaman/list/'.$request->fk_laman_agensi)->withSuccess('Berjaya Kemaskini Data');
    }
}
