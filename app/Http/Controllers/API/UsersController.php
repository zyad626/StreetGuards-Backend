<?php
namespace App\Http\Controllers\API;

use App\Exports\UsersExport;
use App\Http\Transformers\IncidentTransformer;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;
class UsersController extends Controller
{
    public function create(Request $request)
    {
        $user = User::firstOrNew(['userId' => $request->userId ]);
        $user->userId= $request->userId;
        $user->name= $request->name;
        $user->email= $request->email;
        $user->gender= $request->gender;
        $user->birthDate= $request->birthDate;
        $user->profession= $request->profession;
        $user->carOwnership= $request->carOwnership;
        $user->drivingExperience= $request->drivingExperience;
        $user->isExpert= $request->isExpert;
        $user->isTransportationExpert= $request->isTransportationExpert;
        $user->save();
    
        return response()->json(['status' => 200,'userId'=> $request->userId,]);
    }

    public function all(Request $request)
    {
        $user = User::get();
        return $this->collectionResponse($user, new IncidentTransformer);
    }

    public function getUser(Request $request)
    {
        $user = User::where('userId', $request->userId)->first();
        return response()->json($user);
    }

























    public function index(Request $request)
    {
        $x = [];

        $keyword = $request->get('keyword');
        $usersQuery = User::query();
    
        if ($keyword) {
            $usersQuery->where(['userId' => $keyword]);
        }

        $users = $usersQuery->orderBy('userId', 'desc')
            ->paginate();
        
        $data = [
            'users' => $users
        ];

        return view('admin.users.index', $data);
    }

    public function download(Request $request)
    {
      
                $exporter = new UsersExport;
                $name = 'users';
        

        return Excel::download($exporter, $name.'.xlsx');
    }

    public function view($incidentId)
    {
        $user = User::find($incidentId);
        $data = [
            'user' => $user
        ];
        
        return view('admin.users.view', $data);
    }


    public function export()
    {
        $users = User::orderBy('id', 'desc')->paginate(1);
        
    }

    public function delete($id)
    {
        $user = User::find($id);
        User::destroy($id);
        return redirect(route('admin.users'));
    }
}
