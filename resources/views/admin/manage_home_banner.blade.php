@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Home Banner')
    @section('banner_active', 'active')
    <?php
     !empty($banner_id) ? $required='' : $required='required'; 
    ?>
    <div class="row" >
    <div class="col-lg-12">

    <h2><b>Manage Banner</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/home_banner')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/home_banner/manage_home_banner')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <div class="row" >
                                                    <div class="col-lg-6" >
                                                        <label for="btn_txt" class="control-label mb-1">Button Text</label>
                                                        <input id="btn_txt" name="btn_txt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$btn_txt}}">
                                                            @error('btn_txt')
                                                            <div class="alert alert-danger" role="alert">
                                                            {{$message}}
                                                            </div>
                                                            @enderror
                                                    </div>
                                                

                                                       
                                                  
                                                    <div class="col-lg-6" >
                                                    <label for="btn_link" class="control-label mb-1">Button Link</label>
                                                        <input id="btn_link" name="btn_link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$btn_link}}">
                                                            @error('btn_link')
                                                            <div class="alert alert-danger" role="alert">
                                                            {{$message}}
                                                            </div>
                                                            @enderror
                                                    </div>

                                                    <div class="col-lg-6" >
                                                        <div class="form-group has-success">
                                                        <label for="image" class="control-label mb-1">image</label>
                                                        <input id="image" {{$required}}  width="50px" height="50px" name="banner_img" type="file" value="" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                        <input id="previous_banner_img"  name="previous_banner_img" type="hidden" value="{{$banner_img}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                        @error('banner_img')
                                                            <div class="alert alert-danger" role="alert">
                                                            {{$message}}
                                                            </div>
                                                            @enderror
                                                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                        </div>
                                                       
                                                    </div>

                                                </div>

                                              </div>
                                           
                                             <div>
                                             <input name="banner_id" type="hidden" value="{{$banner_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
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