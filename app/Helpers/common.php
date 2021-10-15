<?php
// Generating A Temporary User ID
function getTempUserId()
{
    if(!session()->has('USE_TEMP_ID'))
    {
        $rand=rand(1111111,9999999);
        session()->put('USE_TEMP_ID',$rand);
        return $rand;
    }
    else
    {
        return session()->get('USE_TEMP_ID');
    }
}

// Current User Cart Items
function currentUserCartItems()
{
    if(session()->has('FRONT_LOGIN_USER'))
    {
       $uid=session()->get('FRONT_LOGIN_USER');
       $user_type="Reg";
       if(session()->has('USE_TEMP_ID'))
       {
        DB::table('cart')->where('user_id','=',session()->get('USE_TEMP_ID'))->update(['user_id'=>$uid,'user_type'=>'Reg']);
       }
    }
    else
    {
      $uid=getTempUserId();
      $user_type="Not-Reg";
    }
     $result['currentUserCartItems']=DB::table('cart')
    ->join('products','cart.product_id','=','products.id')
    ->join('product_attr','cart.product_attr_id','=','product_attr.id')
    ->join('sizes','product_attr.size_id','=','sizes.id')
    ->join('colors','product_attr.color_id','=','colors.id')
    ->where('cart.user_id',$uid)
    ->select('cart.id','cart.qty','products.title','products.slug','sizes.size','colors.color','product_attr.image','product_attr.price')
    ->get();
    return $result['currentUserCartItems'];

}

// Counting Items of Cart
function ItemsCount()
{
    if(session()->has('FRONT_LOGIN_USER'))
    {
       $uid=session()->get('FRONT_LOGIN_USER');
       $user_type="Reg";
       if(session()->has('USE_TEMP_ID'))
       {
        DB::table('cart')->where('user_id','=',session()->get('USE_TEMP_ID'))->update(['user_id'=>$uid,'user_type'=>'Reg']);
       }
    }
    else
    {
      $uid=getTempUserId();
      $user_type="Not-Reg";
    }
    return DB::table('cart')->where('user_id',$uid)->count();
}


// Cart Table Data
function cartData()
{
    if(session()->has('FRONT_LOGIN_USER'))
    {
       $uid=session()->get('FRONT_LOGIN_USER');
       $user_type="Reg";
       if(session()->has('USE_TEMP_ID'))
       {
        DB::table('cart')->where('user_id','=',session()->get('USE_TEMP_ID'))->update(['user_id'=>$uid,'user_type'=>'Reg']);
       }
    }
    else
    {
      $uid=getTempUserId();
      $user_type="Not-Reg";
    }
     $cartData['cartData']=DB::table('cart')->where('user_id',$uid)->get();
    return $cartData['cartData'];

}

// Top Nav Item Cart Box
function tonavCartBox()
{
    if(session()->has('FRONT_LOGIN_USER'))
    {
       $uid=session()->get('FRONT_LOGIN_USER');
       $user_type="Reg";
       if(session()->has('USE_TEMP_ID'))
       {
        DB::table('cart')->where('user_id','=',session()->get('USE_TEMP_ID'))->update(['user_id'=>$uid,'user_type'=>'Reg']);
       }
    }
    else
    {
      $uid=getTempUserId();
      $user_type="Not-Reg";
    }
     $toNavCart['topnavcart']=DB::table('cart')
    ->join('products','cart.product_id','=','products.id')
    ->join('product_attr','cart.product_attr_id','=','product_attr.id')
    ->join('sizes','product_attr.size_id','=','sizes.id')
    ->join('colors','product_attr.color_id','=','colors.id')
    ->where('cart.user_id',$uid)
    ->select('cart.id','cart.qty','products.title','products.slug','sizes.size','colors.color','product_attr.image','product_attr.price')
    ->get();
    return $toNavCart['topnavcart'];

}


// Used to Print Data
function prx($arr)
{
    echo "<pre>";
  print_r($arr);
  die();
}
?>