<?php

namespace App\Exports;

use App\Models\Incident;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CrashExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Incident::where('type', 'crash_near_miss');
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($incident): array
    {
        $crashData = $incident['crash_data'];
        $files = $incident->files ?? [];
        $urls = [];
        foreach ($files as $file) {
            $urls[] = route('admin.files.view', $file->id);
        }

        return [
            $incident->location,
            $incident->date,
            $crashData['type'],
            $crashData['number_involved_bikes'] ?? 0,
            $crashData['number_involved_vehicles'] ?? 0,
            $crashData['number_involved_pedestrians'] ?? 0,
            $crashData['reporter_involved']??false ? 'Yes' : 'No',
            $crashData['reporter_type']??'',
            $crashData['type_of_collision'] ?? '',
            $crashData['type_of_collision_explain'] ?? '',
            $crashData['number_of_injuries'] ?? '',
            $crashData['number_of_fatalities'] ?? '',
            $incident->description,
            implode("\n", $urls)
        ];
    }

    public function headings(): array
    {
        return [
            'Location',
            'Date',
            'Type',
            'Bikes Invloved ',
            'Vehicles Invloved',
            'Pedestrians Invloved',
            'Report Invloved',
            'Report Type',
            'Collision Type',
            'Collision Type Other',
            'Number Of Injuries',
            'Number Of fatalities',
            'Description',
            'files',
        ];
    }
}
