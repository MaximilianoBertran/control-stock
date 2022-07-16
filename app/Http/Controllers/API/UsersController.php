<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller {

    public function show(Request $request) {
        return $request->user();
    }

}
