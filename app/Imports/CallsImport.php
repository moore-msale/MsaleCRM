<?php

namespace App\Imports;

use App\Call;
use Maatwebsite\Excel\Concerns\ToModel;

class CallsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Call([
            'name' => $row[0],
            'company' => $row[1],
            'phone' => $row[2],
        ]);
    }
}
