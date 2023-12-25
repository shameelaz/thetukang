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
use Workbench\Admin\Service\PaymentServices;

class PaymentController extends Controller
{


    public function __construct()
    {

    }

    // ------------------- Payment ------------------- //

    public function paymentList(Request $request)
    {
      $payment = (new PaymentServices())->payList($request);

      return view('admin::admin.payment.list',compact('payment'));
    }

    public function paymentAdd(Request $request)
    {
      return view('admin::admin.payment.add');
    }

    public function paymentSave(Request $request)
    {
      $payment = (new PaymentServices())->payAdd($request);

      return redirect('/admin/payment/list')->withSuccess('Berjaya');
    }

    public function paymentEdit(Request $request)
    {
      $payment = (new PaymentServices())->payShow($request);

      return view('admin::admin.payment.edit',compact('payment'));
    }

    public function paymentUpd(Request $request)
    {
      $payment = (new PaymentServices())->payUpd($request);

      return redirect('/admin/payment/list')->withSuccess('Berjaya');
    }



}
