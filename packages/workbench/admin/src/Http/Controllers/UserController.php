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
use Workbench\Admin\Service\UserServices;




class UserController extends Controller
{


    public function __construct()
    {

    }


    public function userList(Request $request)
    {
        $user = (new UserServices())->awamList($request);
		return view('admin::admin.user.publiclist',compact('user'));

    }

    public function userAdd()
    {

		return view('admin::admin.user.add');

    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function awamList(Request $request)
    {
        $user = (new UserServices())->awamList($request);

        return view('admin::admin.pengguna.awam.list',compact('user'));

        // dd($user);
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function awamEdit(Request $request)
    {

        $user = (new UserServices())->userGet($request);
        // dd($user);
        return view('admin::admin.pengguna.awam.edit',compact('user'));
    }


    /**
       * undocumented function
       *
       * @return void
       * @author
       **/
    public function awamUpd(Request $request)
    {
        $user = (new UserServices())->userUpdate($request);
        return redirect('/admin/user/awam')->withSuccess('Berjaya mengemaskini data');
        // return redirect('/admin/user/awam/edit/'.$request->id)->withSuccess('Berjaya');
    }



    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencyList(Request $request)
    {
        $user = (new UserServices())->agencyList($request);


        return view('admin::admin.pengguna.agency.list',compact('user'));

        // dd($user);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencyForm(Request $request)
    {

        // $user = (new UserServices())->userGet($request);
        // dd($user);
        $agency = (new UserServices())->agencySel($request);
        $ptj = (new UserServices())->ptjSel($request);
        $roles = (new UserServices())->roleAgency($request);
        $position = (new UserServices())->positionSel($request);

        return view('admin::admin.pengguna.agency.add',compact('agency','ptj','roles','position'));
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencySave(Request $request)
    {
        // dd($request);

        $result = (new UserServices())->agencySave($request);

        if($result == 1){
            return redirect('/admin/user/agency')->withSuccess('Pendaftaran Pengguna Agensi PTJ berjaya. Sistem sudah berjaya menghantar email untuk tetapkan katalaluan');
        }else{
            return redirect()->back()->withError('Terdapat rekod yang sama untuk email yang dimasukkan. Sila gunakan emel lain');
        }


    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function agencyEdit(Request $request)
    {

        $user = (new UserServices())->userGet($request);
        $agency = (new UserServices())->agencySel($request);
        $ptj = (new UserServices())->ptjSel($request);
        $roles = (new UserServices())->roleAgency($request);
        $position = (new UserServices())->positionSel($request);

        // dd($user);
        return view('admin::admin.pengguna.agency.edit',compact('user','agency','ptj','roles','position'));
    }


    /**
       * undocumented function
       *
       * @return void
       * @author
       **/
    public function agencyUpd(Request $request)
    {
        $user = (new UserServices())->agencyUpdate($request);
        return redirect('/admin/user/agency')->withSuccess('Berjaya mengemaskini data');
        // return redirect('/admin/user/awam/edit/'.$request->id)->withSuccess('Berjaya');
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalList(Request $request)
    {
        $user = (new UserServices())->internalList($request);

        return view('admin::admin.pengguna.internal.list',compact('user'));

        // dd($user);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalForm(Request $request)
    {

        $roles = (new UserServices())->roleNotPtj($request);

        return view('admin::admin.pengguna.internal.add',compact('roles'));
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalSave(Request $request)
    {

        $result = (new UserServices())->internalSave($request);

        if($result == 1){
            return redirect('/admin/user/internal')->withSuccess('Pengguna berjaya ditambah.Sistem menghantar email untuk pengesahan ');
        }else{
            return redirect()->back()->withError('Sistem mendapati pengguna dengan email sudah wujud');
        }
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function internalEdit(Request $request)
    {

        $user = (new UserServices())->userGet($request);
        $roles = (new UserServices())->roleNotPtj($request);
        // dd($user);
        return view('admin::admin.pengguna.internal.edit',compact('user','roles'));
    }


    /**
       * undocumented function
       *
       * @return void
       * @author
       **/
    public function internalUpd(Request $request)
    {
        $user = (new UserServices())->internalUpd($request);
        return redirect('/admin/user/internal')->withSuccess('Berjaya mengemaskini data');
        // return redirect('/admin/user/awam/edit/'.$request->id)->withSuccess('Berjaya');
    }



    /**
     * undocumented function
     *
     * @return void
     * @author
    **/
    public function userPassword(Request $request)
    {

        // dd($request);
        $result = (new UserServices())->resetPassword($request);

        if($result == 1){
            return redirect()->back()->withSuccess('Sistem sudah berjaya menghantar email untuk tukar katalaluan');
        }else{
            return redirect()->back()->withError('Sistem tidak berjaya');
        }

    }


    /**
            * undocumented function
            *
            * @return void
            * @author
    **/
    public function getPtjList(Request $request)
    {
        $ptj = (new UserServices())->getptjlist($request);
        return view('admin::admin.pengguna.agency.ajax.ptj',compact('ptj'));
        // dd($ptj);
    }




}
