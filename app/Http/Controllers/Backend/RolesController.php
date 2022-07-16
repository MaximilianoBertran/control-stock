<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $roles = $this->getList($request);

        $permissions = Permission::orderBy('display_name')->pluck('display_name', 'id');

        $request->session()->flashInput($request->input());
        return view('backend.role.index')
                        ->with('roles', $roles->paginate(25))
                        ->with('permissions', $permissions)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::orderBy('display_name')->pluck('display_name', 'id');

        return view('backend.role.create')
                        ->with('permissions', $permissions)
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate(Role::rules());

        $role = new Role();
        $this->save($role, $request->all());

        return redirect()->route('backend.role.index')
                        ->with('message', trans('crud.created', ['model' => trans('models.role'), 'name' => $role->display_name]))
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('display_name')->get()->pluck('display_name', 'id');

        return view('backend.role.edit')
                        ->with('role', $role)
                        ->with('permissions', $permissions)
                        ->with('permissionsSelected', $role->permissions()->pluck('id'))
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $role = Role::findOrFail($id);
        $request->validate(Role::rules($id));

        $this->save($role, $request->all());

        return redirect()->route('backend.role.index')
                        ->with('message', trans('crud.updated', ['model' => trans('models.role'), 'name' => $role->display_name]))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $role = Role::withCount('admins')->findOrFail($id);

        if ($role->admins_count) {
            return redirect()->route('backend.role.index');
        }
        $role->delete();

        return redirect()->route('backend.role.index')
                        ->with('message', trans('crud.deleted', ['model' => trans('models.role'), 'name' => $role->display_name]))
        ;
    }

    protected function getList(Request $request) {
        $filters = $request->only('name', 'display_name', 'description');

        $sort = $request->s ?: 'id';
        $dir = $request->o ?: 'asc';

        $roles = Role::query()
            ->withCount('admins')
            ->with(['permissions' => function($query) {
                $query->orderBy('display_name');
            }])
            ->orderBy($sort, $dir)
        ;

        foreach ($filters as $key => $value) {
            $roles->likeUpper($key, $value);
        }

        if ($request->permission_id) {
            $roles->hasPermission($request->permission_id);
        }

        return $roles;
    }

    private function save($role, $data) {

        $role->fill($data);

        \DB::beginTransaction();
        try {
            $role->save();
            if (isset($data['perms'])) {
                $role->permissions()->sync($data['perms']);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

}
