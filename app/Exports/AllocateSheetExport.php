<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllocateSheetExport implements WithMultipleSheets
{

    public function __construct($data){
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            'allocate' => new AllocateExport($this->data),
            'summary' => new SummaryALCExport($this->data)
        ];
    }
}
