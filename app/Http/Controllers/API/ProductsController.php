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
        return $this->collectionResponse($product, new ProductTransformer);
    }
    public function destroy($id){
        $product = Product::where('id', $id);
        $product->delete();
        return response()->json(["result" => "ok"], 200);
    }
    public function update(Request $request,$id){
        $productData = $request->all();

        $product = Product::where('id', $id)->first();
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
        }
        
    }
}