<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{
   
    public function index(Product $product)
    {
        $categories = $product->categories;

        return $this->show_all($categories);
    }
   

  
    public function update(Request $request, Product $product,Category $category)
    {
         $product->categories()
        ->syncWithoutDetaching([$category->id]);

        return $this->show_all($product->categories);
    }

 
    public function destroy(Product $product,Category $category)
    {
        if(!$product->categories()->find($category->id)){
            return $this->error_response('The category doesn\'n exist on the specific product',422);
        }

        $product->categories()->detach($category->id);
        
        return $this->show_all($product->categories);
        
    }
}