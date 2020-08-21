<?php
namespace App\Http\Controllers\Admin;

use App\Exports\CrashExport;
use App\Exports\HazardExport;
use App\Exports\IncidentsExport;
use App\Exports\ThreateningExport;
use App\Models\Incident;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Excel;

class IncidentsController extends Controller
{
    public function index(Request $request)
    {
        $x = [];
        
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

    public function download(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 'crash_near_miss':
                $exporter = new CrashExport;
                $name = 'Crashes';
                break;
            case 'hazard':
                $exporter = new HazardExport;
                $name = 'Hazards';
                break;
            case 'threatening':
                $exporter = new ThreateningExport;
                $name = 'Threatening';
                break;
            default:
                $exporter = new IncidentsExport;
                $name = 'Incidents';
        }

        return Excel::download($exporter, $name.'.xlsx');
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
