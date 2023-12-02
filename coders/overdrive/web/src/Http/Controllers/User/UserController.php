<?php

namespace Overdrive\Web\Http\Controllers\User;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Laravolt\Epicentrum\Contracts\Requests\Account\Delete;
use Laravolt\Epicentrum\Contracts\Requests\Account\Store;
use Laravolt\Epicentrum\Mail\AccountInformation;
use Laravolt\Epicentrum\Repositories\RepositoryInterface;
use App\Models\User;
use Laravolt\Support\Contracts\TimezoneRepository;
use Illuminate\Http\Request;

use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\Urole;
use Workbench\Database\Model\User\Users;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Lang;
use Hash;
use Auth;
use DB;


class UserController extends Controller
{
    use AuthorizesRequests;

    protected RepositoryInterface $repository;

    protected TimezoneRepository $timezone;

    /**
     * UserController constructor.
     *
     * @param \Laravolt\Epicentrum\Repositories\RepositoryInterface $repository
     * @param \Laravolt\Support\Contracts\TimezoneRepository        $timezone
     */
    public function __construct(RepositoryInterface $repository, TimezoneRepository $timezone)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;

    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function formRegister(Request $request)
    {
        return view('web::user.register.form');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function svRegister(Request $request)
    {


        $email = data_get($request,'email');
        $check = User::where('email',$email)->first();
        $checkid = UserProfile::where('refid',data_get($request,'refid'))->first();


        if(($check)||($checkid)){

            // $error = "Sistem mendapati emel atau ID pengenalan yang dimasukkan sudah didaftarkan dalam sistem ini.Sila masukkan emel yang baru.";
            // $success = "";
            // echo "<script>alert('Sistem mendapati emel atau ID pengenalan yang dimasukkan sudah didaftarkan dalam sistem ini.Sila masukkan emel yang baru');</script>";
            // return redirect('/user/register')->withWarning('Sila Pilih email lain');
            // return view('web::user.register.form',compact('error'));
            return redirect('/user/register')->withWarning('Sistem mendapati emel atau ID pengenalan yang dimasukkan sudah didaftarkan dalam sistem ini.Sila masukkan emel yang baru');


        }else{

            // Auth::login(
            $user = User::create(
                [
                    'name' => strtoupper($request->name),
                    'email' => $request->email,
                    'status' => 1,
                    'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                    'email_verified_at' => date('Y-m-d h:i:s')
                ]
            );
            // );

            $up = new UserProfile;
            $up->fk_users = $user->id;
            $up->user_level = 2; //pengguna
            $up->flag_ptj = 0; // bukan adminptj
            $up->user_type = data_get($request,'seltype');
            $up->ref_type = data_get($request,'selrefid');
            $up->refid = data_get($request,'refid');
            $up->ref_name = data_get($request,'refname');
            $up->mobile_no = data_get($request,'phone_no');
            $up->save();


             //--- role 2
            $r  = new Urole;
            $r->role_id = 7; //pengguna awam
            $r->user_id = $user->id;
            $r->save();

            $token = Str::random(64);

            DB::table('password_resets')->insert([
              'email' => $user->email,
              'token' => $token,
              'user_id'=> $user->id,
              'created_at' => Carbon::now()
            ]);


            Mail::send('web::email.user.newregister', ['token' => $token,'user' => $user], function($message) use($user){
              $message->to($user->email);
              $message->subject('The Tukang : PENGESAHAN EMEL PENDAFTARAN PENGGUNA');
            });

            //uncomment


            event(new \Workbench\Database\Events\LogResetPassword($user->email,$user->name));

            // echo "<script>alert(''Pendaftaran berjaya. Sila semak emel anda untuk melakukan pengesahan pendaftaran');</script>";

            // $response = 'Pengesahan Emel telah dihantar ke email pengguna '.$user->email.' .';
            $response = 'Pendaftaran berjaya. Sila semak emel anda untuk melakukan pengesahan pendaftaran';
            $request->session()->put('reg',$response);
            return redirect()->route('auth::login.show');



        }


    } //end


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function showResetPasswordForm(Request $request)
    {

        $tokendata = DB::table('password_resets')->where('token',$request->token)->first();

        $error = "";
        $success = "";
        $token = $tokendata;
        if($tokendata){

            return view('web::user.forgot.forgetPasswordLink',compact('token','success','error'));

        }else{

            return view('web::user.forgot.tokenmissmatch');

        }
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function submitResetPasswordForm(Request $request)
    {
        $validator = $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
            ],
            [
                'name.required' => 'Anda Perlu Mengisi Katalaluan !',
                'password_confirmation.required' => 'Anda Perlu Mengisi Semula Pengesahan Katalaluan !'

            ]);


        $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token,
                                'user_id' => $request->user_id
                              ])
                              ->first();

        if(!$updatePassword){

              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)->where('id',$request->user_id)
                      ->update([
                        'password' => Hash::make($request->password),
                        'email_verified_at' => Carbon::now(),
                        'password_changed_at' => Carbon::now(),
                        'status' => 1
                        ]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return view('web::user.forgot.berjaya');


    }



    /**
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function index()
    {

        $useractive = User::get();

        return view('web::backend.user.index', compact('useractive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $statuses = $this->repository->availableStatus();
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');
        $multipleRole = config('laravolt.epicentrum.role.multiple');
        $timezones = $this->timezone->all();
        $acl_role = app('laravolt.epicentrum.role')->all();


        return view('web::backend.user.create', compact('statuses', 'roles', 'multipleRole', 'timezones','acl_role'));
    }

    /**
     * Store the specified resource.
     *
     * @param Store $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $checkfirst = User::where('email','=',$request->email)->first();
        if($checkfirst)
        {
            return redirect()->back()->withError('Error : You cannot create a user with same email. Email is already exist in system');
        }
        $roles = $request->get('roles', []);
        $user = $this->repository->createByAdmin($request->all(), $roles);

        $password = Hash::make($request->get('password'));
        $states = $request->get('permissions', []);

        $newuser = User::where('id','=',$user->id)->first();
        $newuser->status = 1;
        $newuser->email_verified_at = date('Y-m-d h:m:s');

        $newuser->update();

        return redirect('user/index')->withSuccess(Lang::get('web:user-management.user-created'));


    }


    public function destroy(Delete $request, $id)
    {
        try {
            $this->repository->delete($id);

            return redirect(route('epicentrum::users.index'))->withSuccess(trans('laravolt::message.user_deleted'));
        } catch (QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }



    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function formForgot(Request $request)
    {
        $error = array();
        $success = array();
        return view('web::auth.forgotpassword',compact('success','error'));

    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function resetPassword(Request $request)
    {
        // dd($request);
        $user = Users::where('email',$request->email)->first();
        // dd($user);
        // dd($checkemail);
        if($user){

            $token = Str::random(64);

            DB::table('password_resets')->insert([
              'email' => $user->email,
              'token' => $token,
              'user_id'=> $user->id,
              'created_at' => Carbon::now()
            ]);


            Mail::send('web::email.user.forgotpassword', ['token' => $token,'user' => $user], function($message) use($request,$user){
              $message->to($user->email);

              $message->subject('The Tukang Tukar Kata Laluan');
            });

            event(new \Workbench\Database\Events\LogResetPassword($user->email,$user->name));
            // return redirect('/user/forgot')->withSuccess('Pengesahan Emel telah dihantar ke email pengguna '.$user->email.' .');

            // return redirect('/user/forgot/password')->withSuccess('Sistem sudah berjaya menghantar email untuk tukar katalaluan');
            // $success = "Sistem sudah berjaya menghantar email untuk tukar katalaluan. Sila semak di emel ".$user->email.".";
            // $error = "";
            // return view('site::sistem.user.forgot.form',compact('success','error'));

            $success = "Sistem sudah berjaya menghantar email untuk tukar katalaluan. Sila semak di emel ".$user->email.".";
            $error = "";
            return view('web::auth.forgotpassword',compact('success','error'));

        }else{
            //takada email
            $success = "";
            $error = "Tiada padanan yang sama pada emel yang diberikan.Sila masukkan emel yang betul";
            return view('web::auth.forgotpassword',compact('success','error'));

            // return redirect()->back()->withError('Tiada padanan yang sama pada emel yang diberikan.Sila masukkan emel yang betul');
        }



    }






}
