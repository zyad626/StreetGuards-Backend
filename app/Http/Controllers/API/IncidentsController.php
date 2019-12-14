<?php
namespace App\Http\Controllers\API;

use App\Http\Transformers\IncidentTransformer;
use App\Http\Requests\CreateIncidentRequest;
use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentsController extends Controller
{
    public function create(CreateIncidentRequest $request)
    {
        $incidentData = $request->validated();
        
        $incident = new Incident;
        $incident->fill($incidentData);
        $incident->save();
        return $this->itemResponse($incident, new IncidentTransformer);
    }

    public function list(Request $request)
    {
        $type = $request->get('type');
        $incidents = Incident::where('type', $type)->get();
        return $this->collectionResponse($incidents, new IncidentTransformer);
    }
}
