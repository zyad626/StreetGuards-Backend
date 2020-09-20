<?php

namespace App\Exports;

use App\Models\Incident;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HazardExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Incident::where('type', 'hazard');
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($incident): array
    {
        $hazardData = $incident['hazard_data'];
        $files = $incident->files ?? [];
        $urls = [];
        foreach ($files as $file) {
            $urls[] = route('admin.files.view', $file->id);
        }

        return [
            $incident->id,
            $incident->location,
            $incident->date,
            $incident->contact,
            $hazardData['type'],
            implode("\n", $urls),
            $incident->description,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Location',
            'Date',
            'Contact',
            'Type',
            'files',
            'Description',
        ];
    }
}
