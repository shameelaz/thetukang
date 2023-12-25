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
use Overdrive\Web\Data\Repo\UserRepo;
use Overdrive\Web\Service\UsersServices;
use Carbon\Carbon;
use Lang;
use Hash;
use Auth;
use DB;



class ProfileController extends Controller
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
    public function __construct(RepositoryInterface $repository, TimezoneRepository $timezone,UserRepo $userrepo )
    {
        $this->repository = $repository;
        $this->timezone = $timezone;
        $this->userrepo = $userrepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function profile(Request $request)
    {

        // $profile = $this->userrepo->profile($request);
        $user = (new UsersServices())->profile($request);
        // dd($profile);

        return view('web::user.profile.index', compact('user'));
    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function updateProfile(Request $request)
    {

        $user = (new UsersServices())->update($request);

        return redirect('/home')->withSuccess('Berjaya mengemaskini profil');
        // return redirect('user/profile')->withSuccess('Berjaya');


    }


    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function testEmail(Request $request)
    {
        $data = [
            'title' => 'Test Email From The Tukang',
            'body' => 'This is the body of test email.'
        ];

         Mail::send('web::email.test', ['data' => $data], function($message) use($request){
              $message->to('wan.rizuan@3fresources.com');

              $message->subject('The Tukang TEST EMAIL');
            });

         dd('email berjaya dihantar');

    }


}
