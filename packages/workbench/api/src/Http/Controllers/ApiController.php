<?php

namespace Workbench\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Workbench\Api\Service\ApiServices;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use Illuminate\Support\Facades\URL;



class ApiController extends Controller
{


    public function __construct()
    {

    }


    public function index()
    {
		  return view('api::api.index');
    }

    public function runFunc(Request $request)
    {
        $userid = $request->userid;
        $token = $request->token;

        $validate = (new ApiServices())->validate($request);

        if($validate){

            if($request->fid == 4)
            {
                // status bayaran
                $data = (new ApiServices())->statusBayaran($request);

                return response()->json(['status' => '1','content'=>['success' => 'Data telah berjaya']]);


            }elseif($request->fid == 3)
            {
                // payer and payer bill
                $data = (new ApiServices())->payerandbill($request);

                if($data == 1){
                    return response()->json(['status' => '1','content'=>['success' => 'Data berjaya di tambah']]);
                }else{
                    return response()->json(['status' => '0','content'=>['error' => 'Data telah wujud']]);
                }

            }elseif($request->fid == 2)
            {
                // payer account
                $data = (new ApiServices())->account($request);

                if($data == 1){
                    return response()->json(['status' => '1','content'=>['success' => 'Data berjaya di tambah']]);
                }else{
                    return response()->json(['status' => '0','content'=>['error' => 'Data telah wujud']]);
                }

            }elseif($request->fid == 1)
            {
                // payer bill or payer account-kalau ada payeraccount
                $data = (new ApiServices())->upload($request);

                if($data == 1){
                    return response()->json(['status' => '1','content'=>['success' => 'Data berjaya di tambah']]);
                }else{
                    return response()->json(['status' => '0','content'=>['error' => 'Data telah wujud']]);
                }

            }else{

                return response()->json(['status' => '0','content'=>['error' => 'Tiada fid']]);
            }

        }else{
            return response()->json(['status' => '0','content'=>['error' => 'Salah userid atau token']]);
        }

    }


    public function singleRun(Request $request)
    {
        // dd(json_decode($request));



        $userid = $request->input('userid');
        $token = $request->input('token');
        // dd($userid);

        $request->userid = $request->input('userid');
        $request->token = $request->input('token');

        $validate = (new ApiServices())->validate($request);

        return view('api::api.single',compact('request'));
    }

    public function testApiSingle(Request $request)
    {
        // dd(url()->current());
        // dd($_SERVER['SERVER_NAME']);
        $server = $_SERVER['SERVER_NAME'];
        // $url = "http://".$server."/api/run";
        $url = "http://perakepay.local:8080/api/single/run";
        // dd($url);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_POST, true);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

        $headers = array(

                "Authorization:O/UzKJqm9PimaxSgCDwHI2PT3AgFS81oKC19DyLNzeo=",

                "Content-Type:application/json",

            );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


        $dataarray = array(
			'userid'            => 'eSijilPerak',
			'token'             => 'krpEMH6l6IuOBLVPp869YCKarTFDOykM1taecrXOydm6I7TpvzTR9JfU9ZjEIBLM',
			'name'              => 'NAMA TEST',
			'account_no'        => '1112121',
			'identification_no' => '800101016578',
			'reference_no'      => 'REF99181',
			'amount'            => '300.00',
			'bill_detail'       => 'LESEN A',
			'bill_date'         => '2023-01-01',
			'bill_end_date'     => '2023-01-31',
			'status'            => 1,
		);

        $encodedData = json_encode($dataarray);



        // $pay = '{"payload":{"subsysId":"EL","password":"El3seNPPj2022!!","orderNo":'.'"'.$payment->fpx_trans_id.'","description":'.'"'.$payment->fpx_trans_id.'","txnTime":'.'"'.$payment->fpx_date.'","amount":'.'"'.$payment->total_amount.'"}}';
        // $userid = "eSijilPerak";
        // $token = "krpEMH6l6IuOBLVPp869YCKarTFDOykM1taecrXOydm6I7TpvzTR9JfU9ZjEIBLM";
        // $name = "NAMA TEST";
        // $account_no = "1112121";
        // $identification_no = "800101016578";
        // $reference_no = "REF99181";
        // $amount = "300.00";
        // $bill_detail = "LESEN A";
        // $bill_date = "2023-01-01";
        // $bill_end_date = "2023-01-31";
        // $status = 1;

        // $pay = '{"data":{"userid":'.'"'.$userid.'","token":"'.$token.'","name":'.'"'.$name.'","account_no":'.'"'.$account_no.'","identification_no":'.'"'.$identification_no.'","reference_no":'.'"'.$reference_no.'","amount":'.'"'.$amount.'","bill_detail":'.'"'.$bill_detail.'","bill_date":'.'"'.$bill_date.'","bill_end_date":'.'"'.$bill_end_date.'","status":'.'"'.$status.'" }}';
        // dd(json_decode($pay));
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $pay);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);

        $resp = curl_exec($curl);
        // dd($resp);
        $response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($curl , CURLINFO_HEADER_SIZE );
        $headerStr = substr( $resp , 0 , $headerSize );
        $bodyStr = substr( $resp , $headerSize );


        // echo "Body: ".$bodyStr."<br><br>";

        curl_close($curl);

        // $value = json_decode($resp);

        // dd($value);



    }

    public function exeJalan(Request $request)
    {
        $url = "http://perakepay.local:8080/api/jalan";
        $dataarray = array(
			'userid'            => 'eSijilPerak',
			'token'             => 'krpEMH6l6IuOBLVPp869YCKarTFDOykM1taecrXOydm6I7TpvzTR9JfU9ZjEIBLM',
			'name'              => 'NAMA TEST',
			'account_no'        => '1112121',
			'identification_no' => '800101016578',
			'reference_no'      => 'REF99181',
			'amount'            => '300.00',
			'bill_detail'       => 'LESEN A',
			'bill_date'         => '2023-01-01',
			'bill_end_date'     => '2023-01-31',
			'status'            => 1,
		);

		$encodedData = json_encode($dataarray);
        // dd($encodedData);
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
		$result = curl_exec($curl);
		curl_close($curl);
		$value = json_decode($result);

        dd($result);
    }

    public function jalan(Request $request)
    {
        dd($request);
        // return response()->json($request);
        // $validate = (new ApiServices())->validate($request);
        // return response()->json($validate);
    }




}
