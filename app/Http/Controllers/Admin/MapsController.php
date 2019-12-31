<?php
namespace App\Http\Controllers\Admin;

use App\Models\Incident;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MapsController extends Controller
{
    public function incidents(Request $request)
    {
        $type = $request->get('type');
        $incidentsQuery = Incident::query();
        if ($type) {
            $incidentsQuery->where(['type' => $type]);
        }

        $incidents = $incidentsQuery->with(['files'])->orderBy('_id', 'desc')
            ->get();
        return response()->json($incidents);
    }

    public function index()
    {
        return view('admin.maps.index');
    }
}
