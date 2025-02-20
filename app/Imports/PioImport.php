<?php

namespace App\Imports;
use App\Models\PioMaster;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PioImport implements ToCollection ,ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
      /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        $item = PioMaster::where('address', $row['address'])->first();
        if(!$item) {

            return new PioMaster([

                'address' => $row['address'],


            ]);
        }
    }
}
