<?php

namespace App\Exports;

use App\Models\Pines;
use Maatwebsite\Excel\Concerns\FromArray;

class ListaPinesCliente implements FromArray
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
