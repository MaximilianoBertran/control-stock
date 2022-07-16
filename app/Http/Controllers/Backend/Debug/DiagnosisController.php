<?php

namespace App\Http\Controllers\Backend\Debug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiagnosisController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:backend');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $handler = config('services.userdata.default');
        try {
            $logs = collect(\File::files('../storage/logs'))->reverse()->slice(0, 9);
        } catch (\Exception $e) {
            $logs = [];
        }
        return view('backend.debug.diagnosis.index')
            ->with('handler', $handler)
            ->with('logs', $logs)
        ;
    }

    public function log(Request $request, $log) {
        return response()->download(base_path('storage/logs/' . $log));
    }
}
