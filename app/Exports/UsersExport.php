<?php

namespace App\Exports;


use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\User;

class UsersExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return User::query();
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($user): array
    {
        return [
            $user->id,
            $user->userId,
            $user->isExpert,
            $user->isTransportationExpert,
            $user->birthDate,
            $user->carOwnership,  
            $user->drivingExperience,
            $user->gender,
            $user->profession,
            $user->name,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'userId',
            'isExpert',
            'isTransportationExpert',
            'carOwnership',
            'birthDate',
            'drivingExperience',
            'gender',
            'profession',
            'name',
            'email',
        ];
    }
}
