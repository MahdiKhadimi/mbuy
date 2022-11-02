<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{
    public function __construct()
     {
         parent::__construct();
      
      
         $this->middleware('transform.input:'.CategoryTransformer::class)->only(['store','update']);

         
     }
  
    public function index()
    {
        $categories = Category::all();

        return $this->show_all($categories);
    }

    public function store(Request $request)
    {
         $rules = [
             'name'=>'required',
             'description'=>'required'
         ];

         $this->validate($request,$rules);
         
        $category = Category::create($request->all());
         
        return $this->show_one($category,201);

    }

   
    public function show(Category $category)
    {
        return $this->show_one($category);
    }

 
    public function update(Request $request, Category $category)
    {

        $category->update($request->all());
         
       return  $this->show_one($category);
        
    }

   
    public function destroy(Category $category)
    {
         $category->delete();
       return  $this->show_one($category);
    }
    
}