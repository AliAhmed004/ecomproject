@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Customer')
    @section('customer_active', 'active')

    <div class="row" >
    <div class="col-lg-12">
    <h2><b>Manage Customer</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/customer')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/customer/manage_customer')}}" method="post" >
                                        @csrf
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">Name</label>
                                                <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_name}}">
                                            </div>
                                            @error('name')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                             <div>
                                             <input name="customer_id" type="hidden" value="{{$customer_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
                                             </div>
                                             <div class="form-group">
                                                <label for="email" class="control-label mb-1">Email</label>
                                                <input id="email" name="email" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_email}}">
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                            @if(session()->has('error'))
                                           <div class="alert alert-danger" role="alert">
											   {{session('error')}}
									        </div>
                                           @endif
                                            <div id="customer__pass__field" class="form-group">
                                                <label for="password" class="control-label mb-1">Password</label>
                                                <input id="password" name="password" type="password" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_password}}">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                <!-- <i class="fa fa-eye-slash" aria-hidden="true"></i> -->
                                            </div>
                                            @error('password')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="mobile" class="control-label mb-1">Mobile</label>
                                                <input id="mobile" name="mobile" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_mobile}}">
                                            </div>
                                            @error('mobile')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">Address</label>
                                                <input id="address" name="address" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_address}}">
                                            </div>
                                            @error('address')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror

                                          @if(session()->has('error'))
                                           <div class="alert alert-danger" role="alert">
											   {{session('error')}}
									        </div>
                                           @endif

                                           <div class="form-group">
                                                <label for="city" class="control-label mb-1">City</label>
                                                <input id="city" name="city" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_city}}">
                                            </div>
                                            @error('city')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="gstpk" class="control-label mb-1">Gstpk</label>
                                                <input id="gstpk" name="gstpk" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$customer_gstpk}}">
                                            </div>
                                            @error('gstpk')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror

                                         

                                         
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <!-- <i class="fa fa-lock fa-lg"></i>&nbsp; -->
                                                    <span id="payment-button-amount">Add</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
    </div>
@endsection