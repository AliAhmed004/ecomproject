@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Coupon')
    @section('coupon_active', 'active')

    <div class="row" >
    <div class="col-lg-12">
    <h2><b>Manage Coupon</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/coupon')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/coupon/manage_coupon')}}" method="post" >
                                        @csrf
                                            <div class="form-group">
                                                <div class="row" >
                                                     <div class="col-lg-6" >
                                                     <label for="couponTitle" class="control-label mb-1">Title</label>
                                                     <input id="couponTitle" name="couponTitle" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$coupon_title}}">
                                                     <input name="couponId" type="hidden" value="{{$coupon_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                             
                                                     @error('couponTitle')
                                                    <div class="alert alert-danger" role="alert">
                                                    {{$message}}
                                                    </div>
                                                    @enderror
                                                     </div>
                                                     <div class="col-lg-6" >
                                                     <label for="couponCode" class="control-label mb-1">Code</label>
                                                <input id="couponCode" name="couponCode" type="text" value="{{$coupon_code}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            
                                          @if(session()->has('error'))
                                           <div class="alert alert-danger" role="alert">
											   {{session('error')}}
									        </div>
                                           @endif
                                                     </div>
                                                </div>
                                               </div>
                                           
                                             <div>
                                               
                                             </div>


                                            <div class="form-group has-success">
                                                <div class="row" >
                                                    <div class="col-lg-6" >
                                                                <label for="couponValue" class="control-label mb-1">Value</label>
                                                            <input id="couponValue" name="couponValue" type="text" value="{{$coupon_value}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                        @error('couponValue')
                                                        <div class="alert alert-danger" role="alert">
                                                        {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6" >
                                                                <label for="tax_type" class="control-label mb-1">Type</label>
                                                                <select name="tax_type" id="tax_type" class="form-control">
                                                                <option value="">Please select</option>

                                                                @if($tax_type=='value')
                                                                    <option selected value="value">value</option>
                                                                    <option  value="per">Percentage</option>
                                                                    @elseif($tax_type=='per')
                                                                    <option selected value="value">value</option>
                                                                    <option  selected value="per">Percentage</option>
                                                                    
                                                                    @else
                                                                    <option value="value">value</option>
                                                                    <option  value="per">Percentage</option>
                                                                @endif
                                                                </select> 
                                                                @error('tax_type')
                                                                <div class="alert alert-danger" role="alert">
                                                                {{$message}}
                                                                </div>
                                                                @enderror
                                                    </div>
                                                </div>
                                             </div>
                                           
                                             <div class="form-group has-success">
                                                <div class="row" >
                                                    <div class="col-lg-6" >
                                                                <label for="min_order_am" class="control-label mb-1">Minimum Order Ammount</label>
                                                            <input id="min_order_am" name="min_order_am" type="text" value="{{$min_order_am}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                        @error('min_order_am')
                                                        <div class="alert alert-danger" role="alert">
                                                        {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6" >
                                                                <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                                                <select name="is_one_time" id="is_one_time" class="form-control">
                                                                <option value="">Please select</option>

                                                                @if($is_one_time=='1')
                                                                    <option selected value="1">Yes</option>
                                                                    <option  value="0">No</option>
                                                                    @elseif($is_one_time=='0')
                                                                    <option  value="1">Yes</option>
                                                                    <option selected value="0">No</option>
                                                                    
                                                                    @else
                                                                    <option  value="1">Yes</option>
                                                                    <option  value="2">No</option>
                                                                @endif
                                                                </select> 
                                                                @error('is_one_time')
                                                                <div class="alert alert-danger" role="alert">
                                                                {{$message}}
                                                                </div>
                                                                @enderror
                                                    </div>
                                                </div>
                                             </div>

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