<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function edit() {
        return view('backend.profile.edit')
                        ->with('admin', \Auth::user())
        ;
    }

    public function update(Request $request) {

        $admin = \Auth::user();
        $request->validate(Admin::rules($admin->id));

        $this->save($admin, $request->all());

        return redirect()->route('backend.profile.edit')
                        ->with('message', 'Perfil actualizado correctamente');
    }

    private function save($admin, $data) {

        $admin->fill($data);
        if (isset($data['password']) && $data['password']) {
            $admin->password = Hash::make($data['password']);
        }

        \DB::beginTransaction();
        try {
            $admin->save();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

}
