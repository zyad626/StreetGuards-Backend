<?php
namespace App\Http\Controllers\API;

use App\Http\Transformers\ProductTransformer;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
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

        return $this->itemResponse($product, new ProductTransformer);

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

        $product = Product::where('id', $id)->update([$request->attribute => $request->{$request->attribute}]);
        return response()->json(["result" => "ok"], 201); 
    }
    public function index(Request $request)
    {
    
        $products = Product::get();
        return $this->collectionResponse($products, new ProductTransformer);
    }
}