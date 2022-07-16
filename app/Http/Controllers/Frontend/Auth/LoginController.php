<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\Cliente;
use App\Models\ConfiguracionPlataformaCliente;
use App\Models\EstadoCliente;
use App\Models\TipoConfiguracion;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {

    use AuthenticatesUsers;

    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('redirect')->only('logout');
    }

    public function showLoginForm($urlAcceso) {
        
        $cliente = Cliente::where("url_acceso", $urlAcceso)->first();
    	
    	if(!$cliente){
	    	return view('frontend.errors.index')
    			->with('errorMsj', 'Por favor vuelva a ingresar al sistema utilizando el link, usuario y password que le fueron otorgados. Muchas gracias!')
    			->with('hideBackButton', true)
	    	; 
        }
        
        $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
        if($idioma=='es'){
            \App::setlocale('es');
        } else {
            \App::setlocale('en');
        }
        
        if($cliente->estado_id == EstadoCliente::INACTIVO){
            return view('frontend.errors.index')
    			->with('errorMsj', 'La plataforma a la que desea ingresar se encuentra inactiva.')
    			->with('hideBackButton', true)
	    	; 
        }
        $idd=$cliente->id;
        $placeholders= ConfiguracionPlataformaCliente::where('cliente_id', $idd)
                                                     ->where('tipo_configuracion_id', TipoConfiguracion::FONDO_CHICO)
                                                     ->first();
        
    	\Session::put('cliente', $cliente);
        
        $usa_uservoice = ConfiguracionPlataformaCliente::usaUservoice($urlAcceso);
    	
    	return view('frontend.auth.login')
                ->with('clienteId', $cliente->id)
                ->with('urlAcceso', $urlAcceso)
                ->with('cliente', $cliente)
    			->with('username', \Session::get('username'))
                ->with('usaLogoLogin', ConfiguracionPlataformaCliente::usaLogoLogin($cliente->id))
                ->with('placeholder_usuario', $placeholders->placeholder_usuario ?? '')
                ->with('placeholder_password', $placeholders->placeholder_password ?? '')
                ->with('usa_uservoice', $usa_uservoice);
    }

    protected function credentials(Request $request)
    {        
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'cliente_id' => $request->cliente_id];
    }

    protected function loggedOut(Request $request) {
        \Auth::logout();
        $request->session()->flush();
        return redirect()->route('login', ['urlAcceso' => $request->urlAcceso]);
    }

    public function username(){
        return 'username';
    }

    protected function redirectTo() {
        $user = \Auth::user();

    	$urlAcceso = $user->cliente->url_acceso;
        return route('login', ['urlAcceso' => $urlAcceso]);
    }
    protected function authenticated(Request $request, $user)
    {
        session()->put('locale', $user->idioma);
        \App::setLocale($user->idioma);
        (session()->get('locale') == 'ar') ? Carbon::setLocale('es_AR') : Carbon::setLocale($user->idioma);
    }
}
