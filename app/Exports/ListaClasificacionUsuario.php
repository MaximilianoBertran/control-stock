<?php

namespace App\Exports;

use App\Models\ClasificacionUsuario;
use Maatwebsite\Excel\Concerns\FromArray;

class ListaClasificacionUsuario implements FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
}
