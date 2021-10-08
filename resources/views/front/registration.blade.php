@extends('layouts/front_layout')
@section('front_title','Registration')
@section('front_content')

  
 
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
    <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
             
              <div class="col-md-8">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="" method="post" id="helo" class="aa-login-form">
                    <label for="">Username</label>
                    <input type="text"  name="uname" placeholder="Username">
                   
                    <label for="">Email</label>
                    <input type="email"  name="email" placeholder="Email">
                   
                    <label for="">Password</label>
                    <input type="password"  name="password" placeholder="Password">
                   
                    <label for="">Mobile</label>
                    <input type="number"  name="mob" placeholder="Mobile">
                  
                    @csrf
                    <button type="submit" id="register_btn"  class="aa-browse-btn">Register</button>                    
                  </form>
                   
                  </div>
                </div>
              </div>
            </div>          
         </div>
       </div>
       <div class="success_registration" >
          
      </div>
     </div>
     
   </div>
 </section>

@endsection