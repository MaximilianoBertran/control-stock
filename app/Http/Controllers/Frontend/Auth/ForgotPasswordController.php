<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Cliente;
use App\Models\EstadoCliente;

class ForgotPasswordController extends Controller {

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm($urlAcceso) {

        $cliente = Cliente::where("url_acceso", $urlAcceso)->first();

        if(!$cliente){
	    	return view('frontend.errors.index')
    			->with('errorMsj', 'Por favor vuelva a ingresar al sistema utilizando el link, usuario y password que le fueron otorgados. Muchas gracias!')
    			->with('hideBackButton', true)
	    	; 
        }
        
        if($cliente->estado_id == EstadoCliente::INACTIVO){
            return view('frontend.errors.index')
    			->with('errorMsj', 'La plataforma a la que desea ingresar se encuentra inactiva.')
    			->with('hideBackButton', true)
	    	; 
        }
        
        return view('frontend.auth.passwords.email')->with('urlAcceso', $urlAcceso)
                                                    ->with('cliente', $cliente);
    }

}
