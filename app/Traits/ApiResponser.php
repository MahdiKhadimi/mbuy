<?php
namespace App\Traits ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
 

 /**
  *  this trait use for generalizing response methods
  */
 trait ApiResponser
 {

     private function success_response($data,$code)
     {
         return response()->json($data,$code);
     }

     protected function error_response($message,$code)
     {
       return response()->json(['error'=>$message,'code'=>$code],$code); 
     }

    public function show_all($data,$code=200)
    {
        $data = $this->sort_data($data);
        return $this->success_response(['data'=>$data],$code);
    }

    public function show_one(Model $model,$code=200)
    {
        return $this->success_response(['data'=>$model],$code);
    }
    
    public function show_message($message,$code=200)
    {
        return $this->success_response(['data'=>$message],$code);
    }

    protected function sort_data(Collection $collection)
    {
         if(request()->has('sort_by')){
             $attribute = request()->sort_by;
             $collection = $collection->sortBy($attribute);
         }
         return $collection;
    }
 }
 