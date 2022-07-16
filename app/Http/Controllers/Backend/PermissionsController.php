<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = $this->getList($request);        
        return view('backend.permission.index')
                ->with('permissions', $permissions->paginate(25))
        ;
    }

    protected function getList(Request $request) {
        $filters = $request->only('name', 'display_name');

        $sort = $request->s ?: 'id';
        $dir = $request->o ?: 'asc';

        $permissions = Permission::query()
            ->with('roles')
            ->with('admins')
            ->orderBy($sort, $dir)
        ;

        foreach ($filters as $key => $value) {
            $permissions->likeUpper($key, $value);
        }

        return $permissions;
    }
}
