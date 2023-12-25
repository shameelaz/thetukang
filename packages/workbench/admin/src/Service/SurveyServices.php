<?php

namespace Workbench\Admin\Service;

use Illuminate\Routing\Controller;
use Workbench\Database\Model\Agency\Agency;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;
use Workbench\Database\Model\Base\BaseInfo;
use Workbench\Database\Model\Base\HubungiKami;
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
use Workbench\Database\Model\Survey\Survey;
use Workbench\Database\Model\Survey\SurveyForm;

class SurveyServices
{


    // ------------------- Payment ------------------- //

    public function list(Request $request)
    {
        $survey = Survey::all();

        return $survey;
    }

    public function save(Request $request)
    {

        if($request->image){

            $files=$request->image;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/survey')) {

                mkdir(public_path()."/uploads/base/survey");
            }

            $path = public_path()."/uploads/base/survey/";


            $filename= $files->getClientOriginalName();
            $fullpath = "/uploads/base/survey/".$filename;
            $extension = $files->getClientOriginalExtension();


            $files->move($path, $files->getClientOriginalName());


        }


        $survey = new Survey;
        $survey->image = $fullpath;
        $survey->description = $request->description;
        $survey->rate = $request->rate;
        $survey->status = 1;
        $survey->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Menambah Kajian Kepuasan Pelanggan'));
    }


    public function show(Request $request)
    {
        $survey = Survey::where('id',$request->id)->first();

        return $survey;
    }


    public function update(Request $request)
    {

        if($request->image){

            $files=$request->image;

            if (!file_exists(public_path().'/uploads')) {

                mkdir(public_path()."/uploads");
            }
            if (!file_exists(public_path().'/uploads/base')) {

                mkdir(public_path()."/uploads/base");
            }
            if (!file_exists(public_path().'/uploads/base/survey')) {

                mkdir(public_path()."/uploads/base/survey");
            }

            $path = public_path()."/uploads/base/survey/";


            $filename= $files->getClientOriginalName();
            $fullpath = "/uploads/base/survey/".$filename;
            $extension = $files->getClientOriginalExtension();

            $files->move($path, $files->getClientOriginalName());

            $upd = Survey::where('id',$request->id)->first();
            $upd->image = $fullpath;
            $upd->save();

            event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Gambar Kajian Kepuasan Pelanggan'));

        }


        $survey = Survey::where('id',$request->id)->first();
        // $survey->image = $fullpath;
        $survey->description = $request->description;
        $survey->rate = $request->rate;
        $survey->status = $request->status;
        $survey->save();

        event(new \Workbench\Database\Events\AuditTrail(Auth::user()->id,'Mengemaskini Kajian Kepuasan Pelanggan'));

    }


    public function public(Request $request)
    {
        $survey = Survey::where('status',1)->orderBy('rate','DESC')->get();
        return $survey;
    }

    public function saveSurvey(Request $request)
    {
        // dd($request);
        $fk_survey = $request->fk_survey;
        // $user = Auth::user()->id;

        // foreach($fk_survey as $key => $value)
        // {
        //     $surveyid = Survey::find($value);

        //     if($surveyid){

                $survey = new SurveyForm;
                // $survey->fk_user = $user;
                $survey->fk_survey = $request->fk_survey;
                $survey->remark = $request->remark;
                $survey->save();

            // }else{

            // }




    }




}
