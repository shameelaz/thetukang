<?php

namespace Overdrive\Web\Http\Controllers\Backend\User;

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
use Lang;
use Hash;

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
     * Display a listing of the resource.
     *
     * @throws \Exception
     */
    public function index()
    {
        
        // return view('laravolt::users.index');

        $useractive = User::get();
       // $userinactive  = Users::where('status','=','PENDING')->get();
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
}
