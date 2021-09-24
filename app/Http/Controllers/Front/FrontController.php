<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use App\Models\Front\home;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //-------Categories-------
        $home_data['home_cats']=DB::table('categories')
        ->where('status','=',1)
        ->where('is_home','=',1)->get();

        foreach($home_data['home_cats'] as $single_cat)
        {
         $home_data['home_cats_products'][$single_cat->id]=DB::table('products')
         ->where(['category_id'=>$single_cat->id])->get();

            foreach( $home_data['home_cats_products'][$single_cat->id] as $key=>$list)
            {
               $home_data['home_cats_products_attr'][$list->id]=DB::table('product_attr')->where('pid',$list->id)->get();
            }
        }
        
    
        //-------Brands-------
        $home_data['Brands']=DB::table('brands')->where('status',1)->get();

         //-------Featured-------
         $home_data['is_featured']=DB::table('products')->where('status',1)->where('is_featured',1)->get();
         
         foreach($home_data['is_featured'] as $is_featured_products)
         {
            $home_data['is_featured_attr'][$is_featured_products->id] = DB::table('product_attr')->where('pid','=',$is_featured_products->id)->get();
         }
        
         //-------Discounted-------
         $home_data['is_discounted']=DB::table('products')->where('status',1)->where('is_discounted',1)->get();
         foreach($home_data['is_discounted'] as $is_discounted_products)
         {
            $home_data['is_discounted_attr'][$is_discounted_products->id] = DB::table('product_attr')->where('pid','=',$is_discounted_products->id)->get();
         }

         
         //-------Trending-------
         $home_data['is_trending']=DB::table('products')->where('status',1)->where('is_trending',1)->get();
         foreach($home_data['is_trending'] as $is_trending_products)
         {
            $home_data['is_trending_attr'][$is_trending_products->id] = DB::table('product_attr')->where('pid','=',$is_trending_products->id)->get();
         }

         //-------Home Banner-------
         $home_data['home_banner']=DB::table('homebanners')->where('status',1)->get();


         return view('front.index',$home_data);


    }

    function product($slug)
    {
       //-------- Product Info--------
       $product['product']=DB::table('products')->where('slug',$slug)->get();
      
       $product_id=$product['product'][0]->id;
 
       $category_id=$product['product'][0]->category_id;
       $product['thubmnail_images']=DB::table('multiple_images')->where('pid',$product_id)->get();
      
       $product['product_attributes']=DB::table('product_attr')->where('pid',$product_id)
       ->join('sizes','product_attr.size_id','sizes.id')
       ->join('colors','product_attr.color_id','colors.id')
       ->get();

       //-------- Related Products--------
       $product['related_products']=DB::table('products')->where('category_id','=',$category_id)->where('id','!=',$product_id)->get();
       foreach($product['related_products'] as $list)
       {
         $product['related_products_attr'][$list->id]=DB::table('product_attr')->where('pid','=',$list->id)->get();
       }
      
       return view('Front.product',$product);
    }
   
    // Add to cart
    function add_to_cart(Request $r)
    {
       if(session()->has('FRONT_LOGIN_USER'))
       {
          $uid=$r->session()->get('FRONT_LOGIN_USER');
          $user_type="Reg";
       }
       else
       {
         $uid=getTempUserId();
         $user_type="Not-Reg";
       }
       $color_name=$r->input('color_name');
       $size_name=$r->input('size_name');
       $product_ids=$r->input('product_ids');
       $product_qty=$r->input('product_qty');
   
      $product_attr_id= DB::table('product_attr')
       ->select('product_attr.id')
       ->join('sizes','product_attr.size_id','=','sizes.id')
       ->join('colors','product_attr.color_id','=','colors.id')
       ->where('product_attr.pid',$product_ids)
       ->where('sizes.size',$size_name)
       ->where('colors.color',$color_name)
       ->get();

      
       $check_data_exist=DB::table('cart')
       ->where('user_id',$uid)
       ->where('user_type',$user_type)
       ->where('product_id',$product_ids)
       ->where('product_attr_id',$product_attr_id[0]->id)
       ->get();

       if($check_data_exist->isEmpty())
       {
          DB::table('cart')
          ->insertGetId(['user_id'=>$uid
          ,'user_type'=>$user_type
          ,'qty'=>$product_qty
          ,'product_id'=>$product_ids
          ,'product_attr_id'=>$product_attr_id[0]->id]);
          $msg="Added";
       }
       else
       {
         DB::table('cart')
         ->where('user_id',$uid)
         ->where('user_type',$user_type)
         ->where('product_id',$product_ids)
         ->where('product_attr_id',$product_attr_id[0]->id)
         ->update(['qty'=>$product_qty]);
         $msg="Updated";
       }

       return response()->json(['status'=>$msg]);
    }

}
