<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Product;
use App\Models\Producttype;



class ProductController extends Controller
{   
    //home page
   public function getProduct(Request $request)
    {
      if($request->id)
      {
        $products = Product::where('product_type_id',$request->id)->select('product_name','recurr_inr_monthly','product_image','product_description')->get();
      }else
      {
        $products = Product::select('product_name','recurr_inr_monthly','product_image','product_description')->get();
      }
      
      if(count($products) > 0)
             {
                $data['status']                 =   'true';
                $data['data']                 =   $products;
                $data['user_status_message']    =   "Product Found Successfully";
                return response()->json($data, 200);   
             }else
             {
                $data['status']                 =   'false';
                $data['data']                 =   '';
                $data['user_status_message']    =   "Product not Found";
                return response()->json($data, 200);   
             }
      
    }
   //////////////getProductCategory 
 public function getProductCategory()
    {
      
      $Producttype = Producttype::select('name','id')->get();
      if(count($Producttype) > 0)
             {
                $data['status']                 =   'true';
                $data['data']                 =   $Producttype;
                $data['user_status_message']    =   "Product type Found Successfully";
                return response()->json($data, 200);   
             }else
             {
                $data['status']                 =   'false';
                $data['data']                 =   '';
                $data['user_status_message']    =   "Product type not Found";
                return response()->json($data, 200);   
             }
      
    }

}
