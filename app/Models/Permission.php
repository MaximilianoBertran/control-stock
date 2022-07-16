<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model {

    use Filters;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function admins() {
        return $this->belongsToMany(Admin::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

}
