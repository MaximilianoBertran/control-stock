<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function edit() {
        $user = \Auth::user();
    	$urlAcceso = $user->cliente->url_acceso;
        return view('frontend.profile.edit')
                        ->with('user', $user)
                        ->with('user', \Auth::user())
                        ->with('urlAcceso', $urlAcceso)
        ;
    }

    public function update(Request $request) {

        $user = \Auth::user();
        $urlAcceso = $user->cliente->url_acceso;
        $request->validate(User::updatePassword($user->id));

        $this->save($user, $request->all());

        return redirect()->route('profile.edit',$urlAcceso)
                        ->with('user', $user)
                        ->with('message', __('Your profile has been updated'))
        ;
    }

    public function updateEmail(Request $request) {

        $user = \Auth::user();
        $urlAcceso = $user->cliente->url_acceso;
        $this->validate($request, ['email' => 'email']);

        $this->save($user, $request->all());

        return redirect()->route('profile.edit',$urlAcceso)
                        ->with('user', $user)
                        ->with('message', __('Your profile has been updated'))
        ;
    }

    private function save($user, $data) {

        $user->fill($data);
        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        \DB::beginTransaction();
        try {
            $user->save();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    public function imageProfile(Request $request) {
        $this->validate($request, ['foto' => 'required|image|max:2048']);
        $user = \Auth::user();
        $actualFile = $user->foto;
        
        if($actualFile != null){
            $actualStorage = "CLIENTE_" . $user->cliente->id . '/USUARIOS/PERFIL_' . $user->id . '/' . $actualFile;
            Storage::delete($actualStorage);
        }
        
        $file = array('imagen_pin' => \Request::file('foto'));
        $filePathStorage = "CLIENTE_" . $user->cliente->id . '/USUARIOS/PERFIL_' . $user->id . '/' . $request['nombre'];
        Storage::put($filePathStorage, file_get_contents($file['imagen_pin']->getRealPath()));

        $user->foto = $request['nombre'];
        $user->save(); 

        return $request;
        
    }

}
