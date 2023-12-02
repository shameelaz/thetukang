<?php

namespace Workbench\Database\Imports;

// use Workbench\Site\Model\Plant;
// use Workbench\Site\Model\LogFileUpload;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ParamImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $cols)
    {

        return $cols;
    }
}
