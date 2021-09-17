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
       $product['product']=DB::table('products')->where('slug',$slug)->get();
       $product_id=$product['product'][0]->id;
       $category_id=$product['product'][0]->category_id;
       $product['product_attributes']=DB::table('product_attr')->where('pid',$product_id)
       ->join('sizes','product_attr.size_id','sizes.id')
       ->join('colors','product_attr.color_id','colors.id')
       ->get();
       
       $product['related_products']=DB::table('products')->where('category_id','=',$category_id)->where('id','!=',$product_id)->get();
       foreach($product['related_products'] as $list)
       {
         $product['related_products_attr'][$list->id]=DB::table('product_attr')->where('pid','=',$list->id)->get();
       }
       
       return view('Front.product',$product);
    }

}
