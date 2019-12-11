<?php
namespace App\Http\Controllers\Admin;

use App\Models\Incident;

class IncidentsController extends Controller
{
    public function index()
    {
        $incidents = Incident::orderBy('id', 'desc')->paginate(1);
        $data = [
            'incidents' => $incidents
        ];
        return view('admin.incidents.index', $data);
    }
}
