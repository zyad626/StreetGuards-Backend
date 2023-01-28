<?php
namespace App\Http\Controllers\API;

use App\Http\Transformers\UserTransformer;
use App\Http\Requests\CreateUserRequest;
use App\Models\User_new;
use Illuminate\Http\Request;

class UsersController_new extends Controller
{
    
    public function create(CreateUserRequest $request)
    {
        $userData = $request->validated();

        $user = new User_new;
        $user->fill($userData);
        $user->ip = request()->ip();
        $user->save();

        // return $this->itemResponse($user, new UserTransformer);
        return response()->json(["result" => "ok"], 200);

    }
    public function getUser($id)
    {
        
        $user = User_new::where('userId', $id)->get();
        return $this->collectionResponse($user, new UserTransformer);
    }
    public function destroy($id){
        $user = User_new::where('userId', $id);
        $user->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(Request $request,$id){

        $userData = $request->all();
        $user = User_new::where('userId', $id)->first();
        $user->fill($userData);
        $user->save();
        
        return response()->json(["result" => "ok"], 201); 
    }
}
