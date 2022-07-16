<?php

namespace App\Exports;

use App\Models\ProductoReconocimiento;
use Maatwebsite\Excel\Concerns\FromArray;

class ListaProductosReco implements FromArray
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
