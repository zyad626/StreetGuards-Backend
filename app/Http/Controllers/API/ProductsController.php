<?php
namespace App\Http\Controllers\API;

use App\Http\Transformers\ProductTransformer;
use App\Http\Requests\CreateProductRequest;
use App\Http\Transformers\UserTransformer;
use App\Models\Product;
use App\Models\User_new;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function create(CreateProductRequest $request)
    {
        $productData = $request->validated();
        if (Product::where('id', $productData["id"])->exists()) {
            // User with the specified userId already exists
            return response()->json(["result" => "Product already exists"], 409);
        }
        $product = new Product;
        $product->fill($productData);
        $product->ip = request()->ip();
        $product->save();

        // return $this->itemResponse($product, new ProductTransformer);
        return response()->json(["result" => "ok"], 200);

    }
    public function getProduct($id)
    {
        
        $product = Product::where('id', $id)->get();
        if($product->isEmpty()){
            return response()->json(["message" => "Product not found"], 404);
        }
        return $this->collectionResponse($product, new ProductTransformer);
    }
    public function destroy($id){
        $product = Product::where('id', $id)->get();
        if($product->isEmpty()){
            return response()->json(["message" => "Product not found"], 404);
        }
        $product->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(CreateProductRequest $request,$id){
        $productData = $request->validated();

        $product = Product::where('id', $id)->first();
        if(!$product){
            return response()->json(["message" => "Product not found"], 404);
        }
        $product->fill($productData);
        $product->save();
        
        return response()->json(["result" => "ok"], 201); 
    }
    public function index(Request $request)
    {
        if(!$request->has("options")){
            $products = Product::get();
            return $this->collectionResponse($products, new ProductTransformer);
        }
        else{
            $options = $request->query("options");
            $userId = $request->query("content");

            $user = User_new::where('userId', $userId)->first();
            if(!$user){
                return response()->json(["message" => "User not found"], 404);
            }
            if($options == "userProducts"){
                $productIds = $user->products;
                $Userproducts = Product::whereIn('id', $productIds)->get();
                return $this->collectionResponse($Userproducts, new ProductTransformer);

            }
            elseif($options == "userFavorits"){
                $productIds = $user->favProductsList;
                $Userproducts = Product::whereIn('id', $productIds)->get();
                return $this->collectionResponse($Userproducts, new ProductTransformer);
            }
            return response()->json(["message" => "Invalid category"], 422);
        }
        
    }
}