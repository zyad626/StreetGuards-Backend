<?php
namespace App\Http\Transformers;
use App\Models\Product;

class ProductTransformer extends AbstractTransformer
{
    public function transform(Product $product){
        return [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'image_url'=> $product->image_url,
            'seller_id'=> $product->seller_id,
        ];
    }
}