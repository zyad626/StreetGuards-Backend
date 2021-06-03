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
        // $incident->geocode = $this->getGeocodedData($incident->location);
        $incident->ip = request()->ip();
        $incident->save();

        if (!empty($incidentData['file_ids'])) {
            $fileIds = $incidentData['file_ids'];
            $incident->files()->attach($fileIds);
        }
        
        return $this->itemResponse($incident, new IncidentTransformer);
    }

    protected function getGeocodedData($location)
    {
        $latLng = $location['lat'] .','. $location['lng'];
        try {
            $data = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$latLng&key=AIzaSyA_1fyKerAdiVuPk8GOGBV11O0ZrFGvB8g");
            return json_decode($data);
        } catch(\Exception $e) {
            return [];
        }
    }

    public function list(Request $request)
    {
        $type = $request->get('type');
        $incidents = Incident::where('type', $type)->get();
        return $this->collectionResponse($incidents, new IncidentTransformer);
    }
}
