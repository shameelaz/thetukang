<?php

namespace Overdrive\Web\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use Laravolt\Epicentrum\Http\Requests\Role\Store;
use Laravolt\Epicentrum\Http\Requests\Role\Update;
use Laravolt\Epicentrum\Repositories\RoleRepository;
use Laravolt\Epicentrum\Repositories\RoleRepositoryInterface;
use Overdrive\Web\Model\Arole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var RoleRepositorye
     */
    protected $repository;

    /**
     * UserController constructor.
     *
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = ARole::get();

        return view('web::backend.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $permissions = config('laravolt.epicentrum.models.permission')::all();

        return view('web::backend.role.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Store $request)
    {
        $role = $this->repository->create($request->all());

        return redirect()->route('backend::role.index')->withSuccess(trans('web::user-management.role-edit-message-create'));
    }


    public function edit($id)
    {
        $role = $this->repository->findById($id);
        $permissions = config('laravolt.epicentrum.models.permission')::all();
        $assignedPermissions = old('permissions', $role->permissions()->pluck('id')->toArray());

        return view('web::backend.role.edit', compact('role','permissions','assignedPermissions'));
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edits($id)
    {
        $role = $this->repository->findById($id);
        $permissions = config('laravolt.epicentrum.models.permission')::all();
        $assignedPermissions = old('permissions', $role->permissions()->pluck('id')->toArray());

        return view('laravolt::roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;
        $role = $this->repository->update($id, $request->all());

        return redirect()->route('backend::role.index')->withSuccess(trans('web::user-management.role-edit-message-update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('epicentrum::roles.index')->withSuccess(trans('laravolt::message.role_deleted'));
    }
}
