<?php

namespace App\Exports;

use App\Models\Incident;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ThreateningExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Incident::where('type', 'threatening');
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($incident): array
    {
        $threateningData = $incident['threatening_data'];
        $files = $incident->files ?? [];
        $urls = [];
        foreach ($files as $file) {
            $urls[] = route('admin.files.view', $file->id);
        }

        return [
            $incident->location,
            $incident->date,
            $incident->contact,
            $threateningData['type'],
            implode("\n", $urls),
            $incident->description,
        ];
    }

    public function headings(): array
    {
        return [
            
            'Location',
            'Date',
            'Contact',
            'Type',
            'files',
            'Description',
        ];
    }
}
