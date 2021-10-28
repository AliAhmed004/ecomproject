<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use App\Mail\CustomerVerification;
use Mail;
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
       $product_price=($product_qty * $r->input('product_price'));
   
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
          ,'product_price'=>$product_price
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
         ->update(['qty'=>$product_qty,'product_price'=>$product_price]);
         $msg="Updated";
       }

       return response()->json(['status'=>$msg,'Item_count'=>ItemsCount(),'data'=>tonavCartBox()]);
    }

 // Add to Cart Through Home Page
    function home_add_to_cart(Request $r)
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
      $product_qty=$r->input('product_qty');
      $product_attr_id=$r->input('product_attr_id');
      $product_id=$r->input('product_id');
      $product_price= $product_qty * $r->input('product_price');

      $check_data_exist=DB::table('cart')
       ->where('user_id',$uid)
       ->where('user_type',$user_type)
       ->where('product_id',$product_id)
       ->where('product_attr_id',$product_attr_id)
       ->get();

       if($check_data_exist->isEmpty())
       {
          DB::table('cart')
          ->insertGetId(['user_id'=>$uid
          ,'user_type'=>$user_type
          ,'qty'=>$product_qty
          ,'product_id'=>$product_id
          ,'product_price'=>$product_price
          ,'product_attr_id'=>$product_attr_id]);
          $msg="Added";
       }
       else
       {
         DB::table('cart')
         ->where('user_id',$uid)
         ->where('user_type',$user_type)
         ->where('product_id',$product_id)
         ->where('product_attr_id',$product_attr_id)
         ->update(['qty'=>$product_qty,'product_price'=>$product_price]);
         $msg="Updated";
       }

       return response()->json(['status'=>$msg]);
    }

    // Cart Page

    function cart(Request $r)
    {  
       if(session()->has('FRONT_LOGIN_USER'))
      {
         $uid=$r->session()->get('FRONT_LOGIN_USER');
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
        
      $cart['cart']=DB::table('cart')
          ->join('products','cart.product_id','=','products.id')
          ->join('product_attr','cart.product_attr_id','=','product_attr.id')
          ->join('sizes','product_attr.size_id','=','sizes.id')
          ->join('colors','product_attr.color_id','=','colors.id')
          ->where('cart.user_id',$uid)
          ->select('cart.id','cart.qty','products.title','products.slug','sizes.size','colors.color','product_attr.image','product_attr.price')
          ->get();

       return view('front.cart',$cart);
    }

    // cart page items update
    function cart_items_update(Request $r)
    { 
       
      $qty=$r->input('qty');
      $item_id=$r->input('item_id');
       DB::table('cart')->where('id','=',$item_id)->update(['qty'=>$qty]);
    }

   //  Cart Item Delete
    function cart_product_delete(Request $r)
    {
      DB::table('cart')->where('id',$r->input('cart_item_id'))->delete();
      return response()->json(['status'=>'item Deleted Successfully','Item_count'=>ItemsCount(),'data'=>tonavCartBox()]);
    }

    // Category Page

    function category(Request $r,$id)
    {
       
      $query=DB::table('products');
      $query=$query->where('products.category_id',$id);
      $sort='';
      $query=$query->Join('product_attr','product_attr.pid','=','products.id');
      if($r->get('sorting_action')!=null)
      {
         $sort=$r->get('sorting_action');
      }
      if($sort=='product_name')
      {
         $query=$query->orderBy('products.title','asc');
      }
      if($sort=='price_date')
      {
         $query=$query->orderBy('products.id','asc');
      }
      if($sort=='price_asc')
      {
         $query=$query->orderBy('product_attr.price','asc');
      }
      if($sort=='price_desc')
      {
         $query=$query->orderBy('product_attr.price','desc');
      }
        
      if($r->input('start_price')!==Null && $r->input('end_price')!==Null)
      {
             if($r->input('start_price') > 0 && $r->input('end_price') > 0)
             {
               $query=$query->WhereBetween('product_attr.price',[$r->input('start_price'),$r->input('end_price')]);
             }
      }
      $query=$query->distinct()->select('products.*');
      $query=$query->get();
     
      $categories['products']=$query;
    
      $categories['action']=$sort;
      $categories['start_prcie']=$r->input('start_price');
      $categories['end_prcie']=$r->input('end_price');
      $categories['active_cat']=$id;
      
       foreach($categories['products'] as $list)
       {
         $query1=DB::table('product_attr');
         $query1=$query1->where('pid',$list->id);
         
         $query1=$query1->get();
         $categories['product_attrs'][$list->id]=$query1;
        
       }
      
       //-------Categories-------
       $categories['left_cat']=DB::table('categories')
       ->where('status','=',1)->get();
       return view('front.category',$categories);
    }
// Search
  function search($str)
  {
   $search['search']=DB::table('products')
   ->orwhere('title','like','%'.$str.'%')
   ->orwhere('desc','like','%'.$str.'%')
   ->orwhere('keywords','like','%'.$str.'%')
   ->orwhere('model','like','%'.$str.'%')
   ->where('status',1)
   ->get();

   foreach($search['search'] as $items)
   {
      $search['search_product_attr'][$items->id]=DB::table('product_attr')->where('pid',$items->id)->get();
   }
   return view('front.search',$search);
  }
  // Customer Registration

function registration()
{
   if(!session()->has('FRONT_LOGIN_USER'))
   {
    return view('front.registration');
   }
   else
   {
      return redirect('/');
   }
}
function register(Request $r)
{
 
   $valid=validator::make($r->all(),[
      'uname'=>'required',
      'email'=>'required|email|unique:customers,email',
      'password'=>'required|min:6',
      'mob'=>'required|min:11|max:11'
   ]);
   if(!$valid->passes())
   {
      return response()->json(['status'=>'Error','error'=>$valid->errors()->toArray()]);
   }
   else
   {
      $rand_id=rand(1111111,9999999);
      $arr=[
         'name'=>$r->input('uname'),
         'email'=>$r->input('email'),
         'password'=>Crypt::encrypt($r->input('password')),
         'mobile'=>$r->input('mob'),
         'rand_id'=>$rand_id

      ];
      Mail::to($r->input('email'))->send(new CustomerVerification($rand_id));
   }
   $query=DB::table('customers')->insert($arr);
   if($query)
   {
      return response()->json(['status'=>'success','msg'=>'Registration Successfully, Please Check Your Mail Id for the Verification']);
   }
}

//  Email Verification
function verification($code)
{
   $verified=DB::table('customers')->where('rand_id',$code)->get();
  if(isset($verified[0]))
  {
    if(DB::table('customers')->where('rand_id','=',$code)->where('is_verified',1)->count() > 0)
    {
      return redirect('/');
    }  
    else
    {
   DB::table('customers')->where('rand_id','=',$code)->update(['is_verified'=>1]);
   return view('front.email_verified');
   }
  }
  else
  {
     return redirect('/');
  }
}
// Customer Login
function login(Request $r)
{
  $email=$r->input('login_customer_email');
$password=$r->input('login_customer_pass');
$valid=validator::make($r->all(),[
   'login_customer_email'=>'required|email',
   'login_customer_pass'=>'required'
]);
if(!$valid->passes())
{
   return response()->json(['status'=>'Error','error'=>$valid->errors()->toArray()]);
}
else
{
   $get_email=DB::table('customers')->where('email',$email)->get();

   if(isset($get_email[0]))
   {
        $db_pwd=Crypt::decrypt($get_email[0]->password);

        if($password==$db_pwd)
        {
           if($get_email[0]->is_verified <= 0)
           {
            $status='NotValid';
            $msg='Please Verifiy your email id';
            return response()->json(['status'=>$status,'msg'=>$msg]);
           }
         //   session()->put('FRONT_USER_LOGIN',true);
           session()->put('FRONT_LOGIN_USER',$get_email[0]->id);
           session()->put('FRONT_USER_NAME',$get_email[0]->name);
           if($r->input('rememberme')===null)
           {
            setcookie('user_email',$get_email[0]->email,100);
            setcookie('user_password',$password,100);
           }
           else
           {
            setcookie('user_email',$get_email[0]->email,time() + ( 365 * 24 * 60 * 60));
            setcookie('user_password',$password,time() + ( 365 * 24 * 60 * 60));
           }
           
           $status='success';
           $msg='';
        }
        else
        {
         $status='invalid_password';
         $msg='Please Enter Valid Password';
        }
   }
   else
   {
      $msg="Enter Valid Email id";
      $status='invalid_email';
   }
   return response()->json(['status'=>$status,'msg'=>$msg]);
}
  
  
}
// Coupon Code
function coupon_code(Request $r)
{
   $code=$r->input('coupon_code');
   $result=DB::table('coupons')->where('code',$code)->get();
   $total_price=0;
   if(isset($result[0]))
   {
      $type=$result[0]->type;
      $value=$result[0]->value;
            if($result[0]->status==1)
            {
                  if($result[0]->is_one_time==1)
                  {
                        $status='error';
                        $msg='Coupon Code Already Used';
                  }
                  else
                  {
                        $min_order_am=$result[0]->min_order_am;
                        if($min_order_am > 0)
                        {
                              
                              foreach(currentUserCartItems() as $list_items)
                              {
                                 $total_price = $total_price + ($list_items->qty * $list_items->price); 
                              }
                                 
                              if($total_price > $min_order_am)
                              {
                                 $status='success';
                                 $msg='Coupon Code Applied';
                              }
                              else
                              {
                                    $status='min_order_am';
                                    $msg='Price must be Greater than '.$min_order_am;
                              }
                        }
                        else
                        {
                           $status='success';
                           $msg='Coupon Code Applied';
                        }
                       
                     
                  }
            }
            else
            {
               $status='deactivate';
               $msg='Coupon Code Deactivate';
            }
            // $status='success';
            // $msg='Coupon Code Applied';
   }
   else
   {
      $status='invalid';
      $msg='Please Enter Valid Code';
   }

   if($status=='success')
   {
      if($type=='value')
      {
         $total_price=$total_price-$value;
      }
      if($type=='per')
      {
         $total_price=($value/100)*$total_price;
      }
   }
   return response()->json(['status'=>$status,'msg'=>$msg,'total'=>$total_price]);
}
// Remove Coupon Code
function remove_coupon_code()
{
   $total_price=0;
   foreach(currentUserCartItems() as $list_items)
   {
      $total_price = $total_price + ($list_items->qty * $list_items->price); 
   }
   return response()->json(['total'=>$total_price]);                       
}

// Checkout

function checkout()
{
   if(ItemsCount() > 0)
   {
  
      $checkout['cart_items']=currentUserCartItems();
   
      if(session()->has('FRONT_LOGIN_USER'))
      {
      $customer_details=DB::table('customers')->where('id',session()->get('FRONT_LOGIN_USER'))->get();
      $checkout['customer_details']['name']=$customer_details[0]->name;
      $checkout['customer_details']['email']=$customer_details[0]->email;
      $checkout['customer_details']['city']=$customer_details[0]->city;
      $checkout['customer_details']['address']=$customer_details[0]->address;
      $checkout['customer_details']['mobile']=$customer_details[0]->mobile;
      $checkout['required']='required';
      }
      else
      {
         $checkout['customer_details']['name']='';
         $checkout['customer_details']['email']='';
         $checkout['customer_details']['city']='';
         $checkout['customer_details']['address']='';
         $checkout['customer_details']['mobile']='';
         $checkout['required']='';
      }
     
      return view('front.checkout',$checkout);
   }
   else
   {
      return redirect('/');
   }
  
}
 // Place Order
 function place_order(Request $r)
 {
   
    if(session()->has('FRONT_LOGIN_USER'))
    {
      $uid=session()->get('FRONT_LOGIN_USER');
      $total_price=0;
      foreach(currentUserCartItems() as $list_items)
      {
         $total_price = $total_price + ($list_items->qty * $list_items->price); 
      }
       $arr=[
          'customer_id'=>$uid,
          'name'=>$r->input('name'),
          'email'=>$r->input('email'),
          'city'=>$r->input('city'),
          'mobile'=>$r->input('mobile'),
          'address'=>$r->input('address'),
          'Payment_type'=>$r->input('payment_type'),
          'coupon_code'=>$r->input('coupon_code'),
          'Payment_type'=>$r->input('Payment_type'),
          'Payment_status'=>'Pending',
          'order_status'=>1,
          'total_amt'=>$total_price,
          'added_on'=>date('Y-m-d h:i:s'),
          
       ];
       $order_id=DB::table('orders')->insertGetId($arr);
       if($order_id > 0)
       {
         foreach(cartData() as $list_item)
         {
           DB::table('order_details')->insert(['orders_id'=>$order_id,
           'product_id'=>$list_item->product_id,
           'product_attr_id'=>$list_item->product_attr_id,
           'price'=>$list_item->product_price,
           'qty'=>$list_item->qty,
            ]);
         }

         DB::table('cart')->where(['user_id'=>$uid,'user_type'=>'Reg'])->delete();
         $r->session()->put('order_id'.$order_id,$order_id);

         $status='success';
         $msg='Order Placed';
       }
       else
       {
         $status='error';
         $msg='Please Try again after sometime';
       }
      
     
    }
    else
    {
      $status='false';
      $msg='Please Login in to place order';
    }
    return response()->json(['status'=>$status,'msg'=>$msg]);  
   //  prx($r->all());
 }

 function place_order_notification()
 {
    $customer_order_detect=DB::table('orders')->where('customer_id',session()->get('FRONT_LOGIN_USER'))->get();
    if(isset($customer_order_detect[0]))
    {
      
      $customer_order_detect['customer_id']=session()->get('order_id'.$customer_order_detect[0]->id);
      return view('front.order_placed',$customer_order_detect);
    }
    else
    {
       return redirect('/');
    }
 
    
 }
}


