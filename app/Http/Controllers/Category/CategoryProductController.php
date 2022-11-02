<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
   
    public function index(Category $category)
    {
        $products = $category->products;

         return $this->show_all($products);
         
    }

   
}