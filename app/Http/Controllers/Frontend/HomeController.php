<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Pines;
use App\Models\PinEnviado;
use App\Models\EstadoCliente;
use App\Models\TipoConfiguracion;
use App\Models\ConfiguracionPlataformaCliente;
use App\Models\TipoPin;
use App\Models\EstadoPin;


class HomeController extends Controller {

    public function index(Request $request) {
        return redirect('/backend/home');
    }

}
