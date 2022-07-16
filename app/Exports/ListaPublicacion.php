<?php

namespace App\Exports;

use App\Models\Publicacion;
use Maatwebsite\Excel\Concerns\FromArray;

class ListaPublicacion implements FromArray
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
