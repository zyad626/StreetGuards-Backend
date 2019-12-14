<?php
namespace App\Http\Controllers\Admin;

use App\Models\Incident;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class IncidentsController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $incidents = Incident::orderBy('id', 'desc')
            ->where(['type' => $type])
            ->paginate();
        $data = [
            'incidents' => $incidents
        ];
        return view('admin.incidents.index', $data);
    }

    public function view($incidentId)
    {
        $incident = Incident::find($incidentId);
        $data = [
            'incident' => $incident
        ];

        return view('admin.incidents.view', $data);
    }


    public function export()
    {
        $incidents = Incident::orderBy('id', 'desc')->paginate(1);
        
    }
}
