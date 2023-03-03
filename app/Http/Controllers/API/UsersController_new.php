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

        if (User_new::where('userId', $userData["userId"])->exists()) {
            // User with the specified userId already exists
            return response()->json(["result" => "User already exists"], 409);
        }
        else{
            $user = new User_new;
            $user->fill($userData);
            $user->ip = request()->ip();
            $user->save();
    
            // return $this->itemResponse($user, new UserTransformer);
            return response()->json(["result" => "ok"], 200);
        }


    }
    public function getUser($id)
    {
        
        $user = User_new::where('userId', $id)->get();
        if($user->isEmpty()){
            return response()->json(["message" => "User not found"], 404);
        }
        return $this->collectionResponse($user, new UserTransformer);
    }
    public function destroy($id){
        $user = User_new::where('userId', $id)->get();
        if($user->isEmpty()){
            return response()->json(["message" => "User not found"], 404);
        }
        $user->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(CreateUserRequest $request,$id){

        $userData = $request->validated();
        $user = User_new::where('userId', $id)->first();
        if(!$user){
            return response()->json(["message" => "User not found"], 404);
        }
        $user->fill($userData);
        $user->save();
        
        return response()->json(["result" => "ok"], 201); 
    }
}
