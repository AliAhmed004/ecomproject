<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    
    <!-- Title Page-->
    <title>@yield('title')</title>
    
    <script src="{{asset('assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Fontfaces CSS-->
    <link href="{{asset('assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- Bootstrap CSS-->
    <link href="{{asset('assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
     <!-- Main CSS-->
     <link href="{{asset('assets/css/theme.css')}}" rel="stylesheet" media="all">
   
    <!-- Vendor CSS
    <link href="assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all"> -->



</head>

<body class="animsition" >
    
<script>
var myclass = location.pathname.substring(location.pathname.lastIndexOf('/')+1);
 $('.page-wrapper').addClass(myclass);
</script>
<div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('/admin')}}">
                            <img src="{{asset('assets/images/icon/logo.png')}}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="" href="{{url('/admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                           
                        </li>
                       
                       
                       
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                
                <a href="/admin">
                    <img src="{{asset('assets/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        
                        <li class="@yield('dash_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            
                        </li>
                        <li class=" @yield('cat_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/category')}}">
                            <i class="fa fa-th-large" aria-hidden="true"></i>category</a>
                           
                        </li>
                        <li class=" @yield('coupon_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/coupon')}}">
                            <i class="fa fa-tag" aria-hidden="true"></i>coupon</a>
                           
                        </li>
                        <li class=" @yield('brand_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/brand')}}">
                            <i class="fa fa-bandcamp" aria-hidden="true"></i>Brand</a>
                           
                        </li>
                        <li class=" @yield('size_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/size')}}">
                            <i class="fa fa-square"></i>Size</a>
                           
                        </li>
                        <li class=" @yield('color_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/color')}}">
                            <i class="fa fa-paint-brush" aria-hidden="true"></i>Color</a>
                           
                        </li>
                        <li class=" @yield('product_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/product')}}">
                            <i class="fa fa-product-hunt" aria-hidden="true"></i>product</a>
                           
                        </li>
                        <li class=" @yield('customer_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/customer')}}">
                            <i class="fa fa-user-o" aria-hidden="true"></i></i>Customers</a>
                           
                        </li>
                        <li class=" @yield('banner_active') has-sub">
                            <a class="js-arrow" href="{{url('/admin/home_banner')}}">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i></i>Home Banner</a>
                           
                        </li>
                       
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
      <?php

        use Illuminate\Support\Facades\DB;
       $admin_info=DB::table('admins')->where('id',session()->get('admin_id'))->get();
       
      ?>
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                           
                            <div class="header-button">
                              
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{asset('assets/images/icon/avatar-01.jpg')}}" alt="{{$admin_info[0]->name}}" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{$admin_info[0]->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{asset('assets/images/icon/avatar-01.jpg')}}" alt="{{$admin_info[0]->name}}" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{$admin_info[0]->name}}</a>
                                                    </h5>
                                                    <span class="email">{{$admin_info[0]->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    @section('content')
                    
                    @show
                          
                       <div class="row" ></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
  <!-- Jquery JS-->

    <!-- Bootstrap JS-->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
  

    <!-- Main JS-->

    
    <script src="{{asset('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/vendor/animsition/animsition.min.js')}}"></script>
    <!-- <script src="{{asset('assets/js/main.js')}}"></script>  -->


    </body>

</html>
<!-- end document-->