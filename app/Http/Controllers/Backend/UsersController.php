<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $users = $this->getList($request);

        $request->session()->flashInput($request->input());
        return view('backend.user.index')
                        ->with('users', $users->paginate())
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('backend.user.create')
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate(User::rules());

        $user = new User();
        $user->email_verified_at = Carbon::now();
        $this->save($user, $request->all());

        return redirect()->route('backend.user.index')
                        ->with('message', trans('crud.created', ['model' => trans('models.user'), 'name' => $user->name]))
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id);

        return view('backend.user.edit')
                        ->with('user', $user)
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
        $user = User::findOrFail($id);

        $request->validate(User::rules($id));

        $this->save($user, $request->all());

        return redirect()->route('backend.user.index')
                        ->with('message', trans('crud.updated', ['model' => trans('models.user'), 'name' => $user->fullname]))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('backend.user.index')
                        ->with('message', trans('crud.deleted', ['model' => trans('models.user'), 'name' => $user->fullname]))
        ;
    }

    /**
     * Resend the email verification notification.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function resend($id) {
        $user = User::findOrFail($id);
        $user->sendEmailVerificationNotification();

        return redirect()->route('backend.user.index')
                        ->with('message', __(':name :verb', ['name' => __('Verification E-Mail'), 'verb' => __('resent')]))
        ;
    }

    /**
     * Verify the user's email address.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id) {
        $user = User::findOrFail($id);
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return redirect()->route('backend.user.index')
                        ->with('message', trans('crud.updated', ['model' => trans('models.user'), 'name' => $user->fullname]))
        ;
    }

    /**
     * Log into the application as the user.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function login($id) {
        $user = User::findOrFail($id);
        Auth::guard('web')->login($user);
        return redirect()->route('profile.edit');
    }

    protected function getList(Request $request) {
        $filters = $request->only(['name', 'lastname', 'email']);

        $sort = $request->input('s', 'created_at');
        $dir = $request->input('o', 'asc');

        $users = User::orderBy($sort, $dir);

        foreach ($filters as $key => $value) {
            $users->likeUpper($key, $value);
        }

        return $users;
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

}
