<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetAdminPassword;

class Admin extends Authenticatable {

    use HasApiTokens;
    use Notifiable;
    use Filters;

    /**
     * Relations eagely loaded by default.
     *
     * @var array
     */
    protected $with = [
        'permissions',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rules($id = null) {
        $required = ($id == null ? 'required' : 'nullable');
        return [
            'username' => 'required|string|max:60|unique:admins,username,' . ($id ?: 'NULL'),
            'email' => 'nullable|string|email|max:255|unique:admins,email,' . ($id ?: 'NULL'),
            'name' => 'nullable|string|max:60',
            'lastname' => 'nullable|string|max:60',
            "password" => "$required|string|min:8|strong|confirmed",
        ];
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetAdminPassword($token));
    }
    public function getEmailForPasswordReset() {
        return $this->username;
    }
    public function isAdmin(){
        return true;
    }
}
