<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $admins = $this->getList($request);

        $permissions = Permission::orderBy('display_name')->pluck('display_name', 'id');

        $request->session()->flashInput($request->input());
        return view('backend.admin.index')
                        ->with('admins', $admins->paginate(25))
                        ->with('permissions', $permissions)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::orderBy('display_name')->pluck('display_name', 'id');

        return view('backend.admin.create')
                        ->with('roles', $roles)
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate(Admin::rules());

        $admin = new Admin();
        $admin->username = $request->username;
        $this->save($admin, $request->all());

        return redirect()->route('backend.admin.index')
                        ->with('message', trans('crud.created', ['model' => trans('models.admin'), 'name' => $admin->name]))
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $admin = Admin::findOrFail($id);
        $roles = Role::orderBy('display_name')->pluck('display_name', 'id');

        return view('backend.admin.edit')
                        ->with('admin', $admin)
                        ->with('roles', $roles)
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
        $admin = Admin::findOrFail($id);
        $request->validate(Admin::rules($id));

        $this->save($admin, $request->all());

        return redirect()->route('backend.admin.index')
                        ->with('message', trans('crud.updated', ['model' => trans('models.admin'), 'name' => $admin->name]))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $admin = Admin::findOrFail($id);
        \DB::beginTransaction();
        try {
            $admin->roles()->detach();
            $admin->delete();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
        }

        return redirect()->route('backend.admin.index')
                        ->with('message', trans('crud.deleted', ['model' => trans('models.admin'), 'name' => $admin->name]))
        ;
    }
    protected function getList(Request $request) {
        $filters = $request->only(['username', 'name', 'lastname']);

        $sort = $request->s ?: 'id';
        $dir = $request->o ?: 'asc';

        $admins = Admin::query()
            ->with(['roles' => function($query) {
                return $query->orderBy('display_name');
            }])
            ->with(['permissions' => function($query) {
                return $query->orderBy('display_name');
            }])
            ->orderBy($sort, $dir)
        ;

        foreach ($filters as $key => $value) {
            $admins->likeUpper($key, $value);
        }

        if ($request->permission_id) {
            $admins->whereHas('permissions', function($permissions) use ($request) {
                return $permissions->where('id', $request->permission_id);
            });
        }

        return $admins;
    }

    private function save($admin, $data) {

        $admin->fill($data);
        if (isset($data['password']) && $data['password']) {
            $admin->password = Hash::make($data['password']);
        }

        \DB::beginTransaction();
        try {
            $admin->save();
            if (isset($data['roles'])) {
                $admin->roles()->sync($data['roles']);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

}
