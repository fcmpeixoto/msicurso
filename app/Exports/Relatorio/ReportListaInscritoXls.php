<?php

namespace App\Exports\Relatorio;

use Maatwebsite\Excel\Concerns\FromCollection;

class ReportListaInscritoXls implements FromCollection
{
    /**
     * @var array
     */
    private $data;

    /**
     * ReportListaInscritoXls constructor.
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return $this->data;
    }
}
