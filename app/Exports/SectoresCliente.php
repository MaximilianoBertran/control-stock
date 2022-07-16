<?php

namespace App\Exports;

use App\Models\Sector;
use Maatwebsite\Excel\Concerns\FromArray;

class SectoresCliente implements FromArray
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
