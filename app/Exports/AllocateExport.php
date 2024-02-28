<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AllocateExport implements FromView, WithTitle, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $allocate;

    public function __construct($data){
        $this->allocate = $data;
    }

    public function view(): View
    {
        return view('export.allocate', [
            'allocate' => $this->allocate
        ]);
    }

    public function title(): string
    {
        return 'Allocate';
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
