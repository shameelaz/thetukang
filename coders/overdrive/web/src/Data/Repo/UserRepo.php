<?php 
namespace Overdrive\Web\Data\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Overdrive\Web\Model\ARole;
use Overdrive\Web\Model\Urole;
use Workbench\Database\Model\User\Users;
use Workbench\Database\Model\User\AclRoleUser;
use Workbench\Database\Model\User\APermission;
use Workbench\Database\Model\User\UserProfile;
use Workbench\Database\Model\User\UserRoles;

/**
 *  
 *
 * @laravolt site
 * @author wan.rizuan@3fresources.com
 **/
class UserRepo
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/


	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function profile($request)
	{
		$user = Auth::user();
		dd($user);
	}
	

	

	
} //end of class