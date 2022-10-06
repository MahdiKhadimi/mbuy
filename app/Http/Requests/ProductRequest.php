<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'description'=>'required',
            'image'=>'nullable|image',
            'quantity'=>'integer|min:1'
        ];
    }

    public function handle_product_store($seller)
    {   
        $product = $this->validated();
        
        if($this->has('image')){
         $image = $this->image;
         $image_name = $image->getClientOriginalName();
         $image = $image->storAs('images/products',time().$image_name);
         $product['image']=$image; 
        }else{
         $product['image']='3.jpg'; 
        }

        $product['status']= Product::UNAVAILABLE_PRODUCT;
        $product['seller_id']=$seller->id;
       

        $product = Product::create($product);
        
        return $product;
    }

}