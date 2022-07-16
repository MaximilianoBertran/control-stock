<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class AutoevaluacionImport implements OnEachRow, WithHeadingRow {

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row) {
        $row = $row->toArray();

        $user = User::firstOrCreate([
            'email' => Str::lower(trim($row['email'])),
        ],[
            'email' => Str::lower(trim($row['email'])),
            'name' => trim($row['name']),
            'lastname' => trim($row['lastname']),
            'password' => $row['password'],
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);

        return $user;
    }
}
