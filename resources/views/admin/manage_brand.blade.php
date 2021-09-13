@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Brand')
    @section('brand_active', 'active')


    <div class="row" >
    <div class="col-lg-12">
    <h2><b>Manage Brand</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/brand')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/brand/manage_brand')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <label for="brand_name" class="control-label mb-1"> Name</label>
                                                <input id="brand_name" name="brand_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$brand_name}}">
                                            </div>
                                            @error('brand_name')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                            @if(session()->has('error'))
                                           <div class="alert alert-danger" role="alert">
											   {{session('error')}}
									        </div>
                                           @endif
                                             <div>
                                             <input name="brand_id" type="hidden" value="{{$brand_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
                                             </div>

                                             <div class="form-group has-success">
                                                <label for="brand_image" class="control-label mb-1">Image</label>
                                                <input id="brand_image" type="file" name="brand_image"  value="" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <input id="previous_brand_image" type="hidden" name="previous_brand_image"  value="{{$brand_image}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                           
                                            @error('brand_image')
                                            <div class="alert alert-danger" role="alert">
                                             {{$message}}
                                            </div>
                                          @enderror
                                                    <div class="form-group has-success">
                                                        <label for="is_header"   class="control-label mb-1">Show in Header</label>
                                                        <input id="is_header"  name="is_header" {{$is_header}} type="checkbox" class="" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                        </div>
                                                
                                            
                                          @if($brand_image!='')
                                           <div class=" mb-3" >
                                               <a href="{{asset('storage/media/brand_images')}}/{{$brand_image}}" target="_blank" ><img width="50px" height="50px"  src="{{asset('storage/media/brand_images')}}/{{$brand_image}}" alt=""></a>
                                          </div>
                                          @endif
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