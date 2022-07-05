<?php 
namespace App\Utils;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ExcelUtils implements ToArray,WithCalculatedFormulas
{

    public function array(array $array)
    {
        return $array;
    }
   
}