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

// Counting Items of Cart
function ItemsCount()
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
    return DB::table('cart')->where('user_id',$uid)->count();
}

// Top Nav Item Cart Box
function tonavCartBox()
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

// Used to Print Array 
function prx($arr)
{
    echo "<pre>";
  print_r($arr);
  die();
}
?>