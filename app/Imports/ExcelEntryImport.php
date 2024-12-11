<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\Importable;

class ExcelEntryImport implements WithMultipleSheets
{
    use Importable;

    public $count = 0;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function sheets(): array
    {

        $array = [];

        for($i = 0; $i < $this->count; $i++){
            if($i == 0)
            {
                $array[0] = null;
            }
            elseif ($i != 0 && ($i % 2) == 1)
            {
                $array[$i] = new EntryImport();
            }
            elseif ($i != 0 && ($i % 2) == 0)
            {
                //$array[$i] = new SalesImport();
                $array[$i] = null;
            }
        }

        return $array;
    }
}
