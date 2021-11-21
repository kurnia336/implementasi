<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsonError;
use Maatwebsite\Excel\Concerns\SkipsonFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
//use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use validation;
use throwable;

class CustomerImport implements ToModel,WithHeadingRow,WithValidation, SkipsonError,SkipsonFailure,WithBatchInserts
{
    use Importable, SkipsErrors,SkipsFailures;
    public function rules(): array
    {
        return [
            // '*.id_customer' => 'unique:customer,id_customer',
            '*.nama' => 'unique:customer,nama',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            //
            // 'id_customer' => $row['id_customer'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'id_kelurahan' => $row['id_kelurahan'],
        ]);
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
