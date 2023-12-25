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
use Workbench\Admin\Service\BaseServices;
use Workbench\Admin\Service\AgencyServices;
use Workbench\Admin\Service\AuditServices;



class BaseController extends Controller
{


    public function __construct()
    {

    }


    public function getBase(Request $request)
    {
      // dd('sini');

        $base = (new BaseServices())->getBase($request);
		return view('admin::base.index',compact('base'));
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function updBase(Request $request)
    {

        $base = (new BaseServices())->updBase($request);
        return redirect('/base/info')->withSuccess('Berjaya mengemaskini data');
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function formHubungi(Request $request)
    {
      $hubungi = (new BaseServices())->hubungi($request);

      return View('admin::admin.hubungi.form',compact('hubungi'));
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function updHubungi(Request $request)
    {
      // dd($request);
      $upd = (new BaseServices())->updateHubungi($request);

      return redirect('/admin/hubungi')->withSuccess('Berjaya mengemaskini');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function getLogo(Request $request)
    {
       $logo = (new BaseServices())->logo($request);
    //    dump($logo);
       return View('admin::admin.logo.index',compact('logo'));
    //    dd($base);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function updLogo(Request $request)
    {
    //   dd($request);
        // dimensions:min_width=60,min_height=60,max_width=60,max_height=60
        //dimensions:min_width=166,min_height=40,max_width=166,max_height=40
        $request->validate([
            'logo_negeri' => 'required|image|mimes:png|max:2048',
            'logo_sistem' => 'required|image|mimes:png|max:2048',
        ],
        [
            'logo_negeri.required' => 'Perlu upload logo negeri',
            'logo_negeri.image' => 'Perlu muatnaik imej sahaja untuk logo negeri',
            'logo_negeri.mimes' => 'Hanya format imej png yg boleh dimuatnaik untuk logo negeri',
            'logo_negeri.max' => 'Logo negeri mestilah tidak lebih dari 2MB',
            'logo_negeri.dimensions' => 'size resolution imej haruslah width = 60px dan  height= 60px',
            'logo_sistem.required' => 'Perlu upload logo sistem',
            'logo_sistem.image' => 'Perlu muatnaik imej sahaja untuk logo sistem',
            'logo_sistem.mimes' => 'Hanya format imej png yg boleh dimuatnaik untuk logo sistem',
            'logo_sistem.max' => 'Logo sistem mestilah tidak lebih dari 2MB',
            'logo_sistem.dimensions' => 'size resolution imej haruslah width = 166px dan  height= 40px',

        ]
        );

        $logo = (new BaseServices())->updlogo($request);

        return redirect('/base/logo')->withSuccess('Berjaya mengemaskini data');
        // dd($request);

    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function feedback(Request $request)
    {
        $agency = (new AgencyServices())->agensiList($request);

        return view('admin::public.maklumbalas.form',compact('agency'));
    }

    public function getAgency(Request $request)
    {
        $agency = (new AgencyServices())->agensiEdit($request);
        return $agency;
    }

    public function sendFeedback(Request $request)
    {
        // dd($request);
        // $validator = $request->validate([
        //     'g-recaptcha-response' => 'required|captcha'
        //     ],
        //     [
        //         'g-recaptcha-response.required' => 'Captha adalah wajib !',
        //         'g-recaptcha-response.captcha' => 'Captha adalah wajib !',


        //     ]);

        $feedback = (new BaseServices())->feedback($request);
        return redirect('/feedback')->withSuccess('Terima kasih kami sudah pun menghantar maklum balas anda mengikut agensi yang dipilih. Terima Kasih');
    }

    public function bannerList(Request $request)
    {
        $banner = (new BaseServices())->bannerList($request);
        return view('admin::admin.banner.index',compact('banner'));
    }

    public function bannerAdd(Request $request)
    {
        return view('admin::admin.banner.add');
    }

    public function bannerSave(Request $request)
    {
        $request->validate([
            'banner' => 'required|image|mimes:jpg,png,jpeg|max:5000|',
            // dimensions:min_width=1300,min_height=560,max_width=2600,max_height=1120
        ],
        [
            'banner.required' => 'Perlu upload imej ',
            'banner.image' => 'Perlu muatnaik imej sahaja untuk banner',
            'banner.mimes' => 'Hanya format imej png,jpg,jpeg sahaja yg boleh dimuatnaik',
            'banner.max' => 'Saiz mestilah tidak lebih dari 5MB',
            // 'banner.dimensions' => 'saiz resolusi imej haruslah width = 1300px dan  height= 560px',


        ]
        );

        // dd($request);

        $banner = (new BaseServices())->bannerSave($request);

        return redirect('/admin/banner/list')->withSuccess('Berjaya menambah data');
    }

    public function bannerEdit(Request $request)
    {
        $banner = (new BaseServices())->bannerShow($request);
        return view('admin::admin.banner.show',compact('banner'));
    }

    public function bannerUpd(Request $request)
    {
        // dd($request);

        if($request->banner){

            $request->validate([
                'banner' => 'required|image|mimes:jpg,png,jpeg|max:5000|',
                // dimensions:min_width=1300,min_height=560,max_width=2600,max_height=1120
            ],
            [
                'banner.required' => 'Perlu upload imej ',
                'banner.image' => 'Perlu muatnaik imej sahaja untuk banner',
                'banner.mimes' => 'Hanya format imej png,jpg,jpeg sahaja yg boleh dimuatnaik',
                'banner.max' => 'Saiz mestilah tidak lebih dari 5MB',
                // 'banner.dimensions' => 'saiz resolusi imej haruslah width = 1300px dan  height= 560px',


            ]
            );

            $update =  (new BaseServices())->bannerUpdImg($request);

            return redirect('/admin/banner/list')->withSuccess('Berjaya mengemaskini data');


        }else{
            //tak upload banner
            $update =  (new BaseServices())->bannerUpdData($request);

            return redirect('/admin/banner/list')->withSuccess('Berjaya mengemaskini data');
        }

        // dd($request);


    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function order(Request $request)
    {

        $order = (new BaseServices())->order($request);

        return redirect('/admin/banner/list')->withSuccess('Berjaya mengemaskini data');
    }


    /**
     * Audit Trail
     *
     * Undocumented function long description
     *
     * @param Type
     * @return type
     * @throws conditon
     **/
    public function audit(Request $request)
    {
        $audit = (new AuditServices())->audit($request);

        return view('admin::admin.audit.list',compact('audit'));
    }




}
