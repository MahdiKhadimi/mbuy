<?php
namespace App\Traits ;
use App\Models\User;
use Spatie\Fractal\Fractal;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Doctrine\Inflector\Rules\Transformation;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
 

 /**
  *  this trait use for generalizing response methods
  */
 trait ApiResponser
 {

     private function successResponse($data,$code)
     {
         return response()->json($data,$code);
     }

     protected function errorResponse($message,$code)
     {
       return response()->json(['error'=>$message,'code'=>$code],$code); 
     }

    public function showAll($data,$code=200)
    {
        $transformer =$data->first()->transformer;

        $data = $this->sortData($data);
        $data = $this->paginate( $data);
        $data = $this->transformData($data,$transformer);
        $data = $this->cacheResponse($data);
        return $this->successResponse(['data'=>$data],$code);
    }

    public function showOne(Model $model,$code=200)
    {
        $transformer = $model->transformer;
        $data = $this->transformData($model,$transformer);
        
        $data = $this->cacheResponse($data);
        return $this->successResponse(['data'=>$data],$code);
    }
    
    public function showMessage($message,$code=200)
    {
        return $this->successResponse(['data'=>$message],$code);
    }

    protected function sortData($collection)
    {
         if(request()->has('sort_by')){
             $attribute = request()->sort_by;
             $collection = $collection->sortBy($attribute);
         }
         return $collection;
    }

    protected function paginate(Collection $collection)
    {
         $current_page = LengthAwarePaginator::resolveCurrentPage();

         $per_page = 15;
         $offset = ($current_page-1)*$per_page;

         $results = $collection->slice($offset,$per_page)->values();

         $paginator = new LengthAwarePaginator(
             $results,
             $collection->count(),
             $per_page,      
             $current_page,
              [
             'path' => LengthAwarePaginator::resolveCurrentPath(),
              ]             
        );

        $paginator->appends(request()->all());

        return $paginator;

    }

    protected function transformData($data,$transformer)
    {
        $transformation = fractal($data,new $transformer);
         
        return $transformation->toArray();
       
    }

    public function cacheResponse($data)
    {
        $url = request()->url();
        return Cache::remember($url, 30/60,function () use($data){
            return $data;
        });   
    }
    
 }
 