<?php

namespace App\Exports;

use App\Models\Regalo;
use Maatwebsite\Excel\Concerns\FromArray;

class ListaRegalos implements FromArray
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
