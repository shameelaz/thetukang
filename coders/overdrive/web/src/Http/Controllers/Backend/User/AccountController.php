<?php

namespace Overdrive\Web\Http\Controllers\Backend\User;

use Laravolt\Epicentrum\Contracts\Requests\Account\Update;
use Laravolt\Platform\Models\User as Users;
use Illuminate\Http\Request;
use Overdrive\Web\Model\Urole;

class AccountController extends UserController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // dd('sini');
        $user = $this->repository->findById($id);
        $statuses = $this->repository->availableStatus();
        $timezones = $this->timezone->all();
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');
        $multipleRole = config('laravolt.epicentrum.role.multiple');
        $roleEditable = config('laravolt.epicentrum.role.editable');

        $acl_role = app('laravolt.epicentrum.role')->all();

        return view('web::backend.user.edit', compact('user', 'statuses', 'timezones', 'roles', 'multipleRole', 'roleEditable','acl_role'));
    }

    public function saveuser(Request $request)
    {   

        $roles = $request->get('roles', []);    
        $id = $request->id;


        try {

            $this->repository->updateAccount($id, $request->except('_token', '_method'), $request->get('roles', []));

           
        } catch (\Exception $e) {
            
            return redirect()->back()->withError($e->getMessage());
        }

        $roleslist = Urole::where('user_id','=',$id)->get();

        $objb = (object)[];
        $objb->role = $roleslist;

         if($roles !== [])
            {
                $roleslist = Urole::where('user_id','=',$id)->delete();
                foreach ($roles as $key => $value) {
                        $newrole = new Urole;
                        $newrole->user_id = $id;
                        $newrole->role_id = $value;
                        $newrole->save();

                }
            }

            $user = Users::where('id','=',$id)->first();
            $objb->user = $user;
            $user->email_verified_at = date('Y-m-d h:m:s');
            $user->update();

            return redirect()->back()->withSuccess(trans('web::user-management.edit-message-update'));

      
    }
}
