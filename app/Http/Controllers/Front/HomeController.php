<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use App\Models\Front\home;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        ->whereNull('parent_cat_id')
        ->where('status','=',1)
        ->where('is_header','=',1)->get();

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

}
