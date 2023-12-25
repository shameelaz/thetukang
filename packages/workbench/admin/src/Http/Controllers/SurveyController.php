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
use Workbench\Admin\Service\SurveyServices;


class SurveyController extends Controller
{


    public function __construct()
    {

    }


    public function list(Request $request)
    {
      // dd('sini');

        $survey = (new SurveyServices())->list($request);
		return view('admin::admin.survey.list',compact('survey'));
    }

    public function add(Request $request)
    {
        return view('admin::admin.survey.add');
    }

    public function save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',

        ],
        [
            'image.required' => 'Perlu upload imej ',
            'image.image' => 'Perlu muatnaik imej sahaja untuk banner',
            'image.mimes' => 'Hanya format imej png,jpg,jpeg sahaja yg boleh dimuatnaik',
            'image.max' => 'Saiz mestilah tidak lebih dari 2MB',


        ]
        );

        $survey = (new SurveyServices())->save($request);
        return redirect('/admin/survey/list')->withSuccess('Berjaya menambah data');
    }

    public function show(Request $request)
    {
        $survey = (new SurveyServices())->show($request);
        return view('admin::admin.survey.show',compact('survey'));
    }

    public function update(Request $request)
    {
        $survey = (new SurveyServices())->update($request);
        return redirect('/admin/survey/list')->withSuccess('Berjaya mengemaskini data');
    }

    public function public(Request $request)
    {
        $survey = (new SurveyServices())->public($request);
        return view('admin::public.survey.show',compact('survey'));
    }

    public function saveSurvey(Request $request)
    {
        $survey = (new SurveyServices())->saveSurvey($request);

        return redirect('/')->withSuccess('Terima kasih kerana maklum balas anda');
    }







}
