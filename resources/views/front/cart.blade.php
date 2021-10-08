@extends('layouts/front_layout')
@section('front_title','Cart')
@section('front_content')
   
   <!-- wpf loader Two -->
    <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> 
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 @if(!$cart->isEmpty())
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0
                        @endphp
                        @foreach($cart as $cat_items) 
                      <tr>
                        <td>
                            <a class="remove" href=""><fa class="fa fa-close"></fa></a>
                            <input type="hidden" name="cart_product_id" id="cart_product_id" value="{{$cat_items->id}}">
                       
                        </td>
                           
                            <td><a href="{{asset('storage/media/product_attributes')}}/{{$cat_items->image}}"><img src="{{asset('storage/media/product_attributes')}}/{{$cat_items->image}}" alt="img"></a>
                        
                    </td>
                       
                        <td>
                            <a class="aa-cart-title" href="product/{{$cat_items->slug}}">{{$cat_items->title}}</a>
                            <br>
                            <span>Size:-<b>{{$cat_items->size}}</b></span>
                            <span>Color:-<b>{{$cat_items->color}}</b></span>
                    </td>
                        <td class="item_price" >
                            {{$cat_items->price}}
                
                        </td>
                        <td><input class="aa-cart-quantity"  type="number" value="{{$cat_items->qty}}"></td>
                        <td>{{$cat_items->price * $cat_items->qty}}</td>
                      </tr>
                   @php
                      $i=($cat_items->price * $cat_items->qty) + $i
                     @endphp   
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>$450</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td class="item_total">{{$i}}</td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 @else
 <div>
     -------Cart is Empty----------
 </div>
 @endif
 <!-- / Cart view section -->


  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

<!-- Add to cart -->
<form id="cart_item_delete" action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="cart_item_id" class="cart_item_id" value="">
  @csrf
  </form> 
  @endsection