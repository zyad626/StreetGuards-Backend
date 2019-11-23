<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\CreateAccidentRequest;
use App\Models\Accident;
use App\Http\Transformers\AccidentTransformer;

class AccidentsController extends Controller
{
    public function create(CreateAccidentRequest $request)
    {
        $accidentData = $request->validated();

        $accident = Accident::fill($accidentData);

        $this->itemResponse($accident, new AccidentTransformer);
    }
}
