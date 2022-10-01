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

    public function show_all(Collection $collection,$code=200)
    {
        return $this->success_response(['data'=>$collection],$code);
    }

    public function show_one(Model $model,$code=200)
    {
        return $this->success_response(['data'=>$model],$code);
    }
    

 }
 