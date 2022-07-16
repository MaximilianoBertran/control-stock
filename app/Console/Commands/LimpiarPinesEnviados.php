<?php

namespace App\Console\Commands;

use App\Models\CarritoCanjes;
use App\Models\Cliente;
use App\Models\HistorialCanjes;
use App\Models\PinCompartido;
use App\Models\PinDestinatario;
use App\Models\PinEnviado;
use App\Models\PinesComentario;
use App\Models\PinesComentarioLike;
use App\Models\PinesLike;
use App\Models\User;
use Illuminate\Console\Command;

class LimpiarPinesEnviados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-client-data {client : The ID of the client}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "remove data from a customer's sent pin";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client_id = $this->argument('client');

        $cliente = Cliente::query()->findOrFail($client_id);

        $users = User::query()->withTrashed()->where('cliente_id', $cliente->id)->get();

        foreach ($users as $user)
        {
            $pinesEnviados = PinEnviado::query()->withTrashed()->where('user_id', $user->id)->get();

            foreach ($pinesEnviados as $pinEnviado)
            {
                $pinesDestinatarios = PinDestinatario::query()->withTrashed()->where('pines_env_id', $pinEnviado->id)->get();
                foreach ($pinesDestinatarios as $pinDestinatario)
                {
                    $this->info('Eliminando Pin destinatario id -> '. $pinDestinatario->id . ' ...');
                    $pinDestinatario->forceDelete();
                }
                $this->info('Se han eliminado todos los Pines destinatario del cliente id -> '. $cliente->id . ' con exito');


                $pinesLikes = PinesLike::query()->withTrashed()->where('pines_env_id', $pinEnviado->id)->get();
                foreach ($pinesLikes as $pinLike)
                {
                    $this->info('Eliminando Pin like id -> '. $pinLike->id . ' ...');
                    $pinLike->forceDelete();
                }
                $this->info('Se han eliminado todos los Pines like del cliente id -> '. $cliente->id . ' con exito');


                $pinesCompartidos   = PinCompartido::query()->withTrashed()->where('pines_env_id', $pinEnviado->id)->get();
                foreach ($pinesCompartidos as $pinCompartido)
                {
                    $this->info('Eliminando Pin compartido id -> '. $pinCompartido->id . ' ...');
                    $pinCompartido->forceDelete();
                }
                $this->info('Se han eliminado todos los Pines compartidos del cliente id -> '. $cliente->id . ' con exito');


                $pinesComentarios   = PinesComentario::query()->withTrashed()->where('pines_env_id', $pinEnviado->id)->get();
                foreach ($pinesComentarios as $pinComentario)
                {

                    $pinesComentariosLikes = PinesComentarioLike::query()->withTrashed()->where('comentario_id', $pinComentario->id)->get();
                    foreach ($pinesComentariosLikes as $pinesComentariosLike)
                    {
                        $this->info('Eliminando Pin comentario like id -> '. $pinesComentariosLike->id . ' ...');
                        $pinesComentariosLike->forceDelete();
                    }

                    $this->info('Eliminando Pin comentario id -> '. $pinComentario->id . ' ...');
                    $pinComentario->forceDelete();
                }
                $this->info('Se han eliminado todos los Pines comentarios del cliente id -> '. $cliente->id . ' con exito');

                $canjes = CarritoCanjes::query()->withTrashed()->where('pin_env_id', $pinEnviado->id)->get();
                if ($canjes->count() == 0)
                {
                    $canjes = CarritoCanjes::query()->withTrashed()->where('user_id', $user->id)->get();
                }
                foreach ($canjes as $canje)
                {
                    $this->info('Eliminando Carrito canje id -> '. $canje->id . ' ...');
                    $canje->forceDelete();
                }
                $this->info('Se han eliminado todos los Carritos canje del cliente id -> '. $cliente->id . ' con exito');

                //REVISAR
                $historialCanjes = HistorialCanjes::query()->withTrashed()->where('pin_env_id', $pinEnviado->id)->get();
                if ($historialCanjes->count() == 0)
                {
                    $historialCanjes = HistorialCanjes::query()->withTrashed()->where('user_id', $user->id)->get();
                }
                foreach ($historialCanjes as $historialCanje)
                {
                    $this->info('Eliminando Historial de canje de usuario con id -> '. $user->id . ' ...');
                    $historialCanje->forceDelete();
                }
                $this->info('Se han eliminado todos los Historiales de canje del usuario id -> '. $cliente->id . ' con exito');


                $this->info('Eliminando Pin enviado id -> '. $pinEnviado->id . ' ...');
                $pinEnviado->forceDelete();
                $this->info(' ');
            }
            $this->info('Se han eliminado todos los Pines enviados del cliente id -> '. $cliente->id . ' con exito');

        }

        $this->info('El comando fue ejecutado con exito para el cliente de id -> '. $client_id);
    }
}
