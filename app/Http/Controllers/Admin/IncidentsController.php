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
        $incidentsQuery = Incident::query();
        if ($type) {
            $incidentsQuery->where(['type' => $type]);
        }

        $incidents = $incidentsQuery->orderBy('_id', 'desc')
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

    public function delete($id)
    {
        $incident = Incident::find($id);
        Incident::destroy($id);
        return redirect(route('admin.incidents', ['type' => $incident->type]));
    }
}
