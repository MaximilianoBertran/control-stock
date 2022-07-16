<?php

use App\Imports\AutoevaluacionImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AutoevaluacionUsersSeeder extends Seeder {

    public function run() {
        $ds = DIRECTORY_SEPARATOR;

        $salud = database_path("seeds{$ds}data{$ds}salud.xlsx");
        Excel::import(new AutoevaluacionImport, $salud);

        $docente = database_path("seeds{$ds}data{$ds}docente.xlsx");
        Excel::import(new AutoevaluacionImport, $docente);

        $aprenderenlaescuela = database_path("seeds{$ds}data{$ds}aprenderenlaescuela.xlsx");
        Excel::import(new AutoevaluacionImport, $aprenderenlaescuela);

    }

}
