<?php

namespace App\Exports;

use App\Models\Incident;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class IncidentsExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Incident::query();
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($incident): array
    {
        $files = $incident->files ?? [];
        $urls = [];
        foreach ($files as $file) {
            $urls[] = route('admin.files.view', $file->id);
        }

        return [
            $incident->id,
            $incident->date,
            $incident->location,
            $incident->contact,
            $incident->type,
            implode("\n", $urls),
            $incident->description,
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Date',
            'Location',
            'Contact',
            'Type',
            'files',
            'Description',
        ];
    }
}
