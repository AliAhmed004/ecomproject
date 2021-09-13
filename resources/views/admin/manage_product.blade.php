@extends('layouts.admin_layout')
@section('content')
@section('title', 'Product')
@section('product_active', 'active')
<div class="row" >
   <div class="col-lg-12">
      <?php
      if($product_id!='')
      {
      $attribute_img_rquired ='';
      }
     else
     {
     $attribute_img_rquired='required';
     }
     
      ?>
    
       @if(session()->has('status'))
                                
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <span class="badge badge-pill badge-success">success</span>
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                              @endif 
                      @if(session()->has('sku_exist'))
                                
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Danger</span>
                                {{ session('sku_exist') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                              @endif 
                              @error('attr_img.*')
                                
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Danger</span>
                                {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                              @enderror
                              @error('multiple_images.*')
                                
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Danger</span>
                                {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                                        </div>
                              @enderror
                              
      <h2><b>Manage Product</b></h2>
      <a class="btn btn-primary mt-3" href="{{url('admin/product')}}" role="button">Back</a>
      <form action="{{url('admin/product/manage_product')}}" method="post" enctype="multipart/form-data" >
      <div class="product_container" >
         <div class="card mt-5">
            <div class="card-body">
               @csrf
               <div class="form-group">
                  <label for="title" class="control-label mb-1">Title</label>
                  <input id="title" name="product_title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_title}}">
               </div>
               @error('product_title')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div>
                  <input name="product_id" type="hidden" value="{{$product_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
               </div>
               <div class="form-group has-success">
                  <label for="cat" class="control-label mb-1">Category</label>
                  <select name="product_cat_id" id="product_cat_id" class="form-control">
                     <option value="">Please select</option>
                     @foreach($allcat as $val)
                     @if($product_cat_id==$val->id)
                     <option selected value="{{$val->id}}">{{$val->cat_name}}</option>
                     @else
                     <option  value="{{$val->id}}">{{$val->cat_name}}</option>
                     @endif
                     @endforeach
                  </select>
               </div>
               @error('product_cat_id')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div class="form-group has-success">
                  <label for="product_slug" class="control-label mb-1">Slug</label>
                  <input id="product_slug" name="product_slug" type="text" value="{{$product_slug}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
               </div>
               @error('product_slug')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               @if(session()->has('error'))
               <div class="alert alert-danger" role="alert">
                  {{session('error')}}
               </div>
               @endif
               <div class="form-group has-success">
                  <label for="image" class="control-label mb-1">Image</label>
                  <input id="image" name="product_image" type="file" value="" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <input id="image_hidden" name="product_image_hide" type="hidden" value="{{$product_image}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
               </div>
               @error('product_image')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div class="form-group has-success">
                  <label for="brand" class="control-label mb-1">Brand</label>
                  <select name="product_brand" id="brand" class="form-control">
                     <option value="">Please select</option>
                     @foreach($brand as $val)
                     @if($product_brand==$val->id)
                     <option selected value="{{$val->id}}">{{$val->name}}</option>
                     @else
                     <option  value="{{$val->id}}">{{$val->name}}</option>
                     @endif
                     @endforeach
                  </select>
               </div>

               @error('product_brand')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div class="form-group has-success">
                  <label for="product_desc" class="control-label mb-1">Description</label>
                  <input id="product_desc" name="product_desc" type="text" value="{{$product_desc}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
               </div>
               @error('product_desc')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div class="form-group has-success">
                  <label for="product_model" class="control-label mb-1">Model</label>
                  <input id="product_model" name="product_model" type="text" value="{{$product_model}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
               </div>
               @error('product_model')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror
               <div class="form-group has-success">
                  <label for="product_keyword" class="control-label mb-1">Keyword</label>
                  <input id="product_keyword" name="product_keyword" type="text" value="{{$product_keyword}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                  <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
               </div>
               @error('product_keyword')
               <div class="alert alert-danger" role="alert">
                  {{$message}}
               </div>
               @enderror

                     <div class="form-group has-success">
                           <div class="row" >
                                    <div class="col-lg-4" >
                                          <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                          <input id="lead_time" name="lead_time" type="text" value="{{$lead_time}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                          <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                         
                                    </div>
                                    <div class="col-lg-4" >
                                          <label for="tax" class="control-label mb-1">Tax</label>
                                          <input id="tax" name="tax" type="text" value="{{$tax}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                          <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                         
                                    </div>

                                    <div class="col-lg-4" >
                                          <label for="tax_type" class="control-label mb-1">Tax Type</label>
                                             <input id="tax_type" name="tax_type" type="text" value="{{$tax_type}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                             <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                             
                                    </div>
                           </div>

                        

                     </div>
                       
                     <div class="form-group has-success">
                           <div class="row" >
                                    <div class="col-lg-3" >
                                    <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                    <select name="is_promo" id="is_promo" class="form-control">
                                       <option value="">Please select</option>

                                       @if($is_promo=='1')
                                        <option selected value="1">Yes</option>
                                        <option  value="0">No</option>
                                        @elseif($is_promo=='0')
                                        <option  value="1">Yes</option>
                                        <option selected value="0">No</option>
                                        
                                        @else
                                        <option  value="1">Yes</option>
                                        <option  value="2">No</option>
                                        @endif
                                    </select> 
                                 
                                    </div>
                                    <div class="col-lg-3" >
                                    <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control">
                                    <option value="">Please select</option>

                                       @if($is_featured=='1')
                                       <option selected value="1">Yes</option>
                                       <option  value="0">No</option>
                                       @elseif($is_featured=='0')
                                       <option  value="1">Yes</option>
                                       <option selected value="0">No</option>
                                       
                                       @else
                                       <option  value="1">Yes</option>
                                       <option  value="2">No</option>
                                       @endif
                                    </select> 
                                  
                                    </div>

                                    <div class="col-lg-3" >
                                    <label for="is_trending" class="control-label mb-1">Is Trending</label>
                                    <select name="is_trending" id="is_trending" class="form-control">
                                       <option value="">Please select</option>
                                       @if($is_trending=='1')
                                       <option selected value="1">Yes</option>
                                       <option  value="0">No</option>
                                       @elseif($is_trending=='0')
                                       <option  value="1">Yes</option>
                                       <option selected value="0">No</option>
                                       
                                       @else
                                       <option  value="1">Yes</option>
                                       <option  value="2">No</option>
                                       @endif
                                    </select> 
                                  
                                    </div>
                                    <div class="col-lg-3" >
                                    <label for="is_discounted" class="control-label mb-1"> Is Discounted</label>
                                    <select name="is_discounted" id="is_discounted" class="form-control">
                                       <option value="">Please select</option>
                                       @if($is_discounted=='1')
                                       <option selected value="1">Yes</option>
                                       <option  value="0">No</option>
                                       @elseif($is_discounted=='0')
                                       <option  value="1">Yes</option>
                                       <option selected value="0">No</option>
                                       
                                       @else
                                       <option  value="1">Yes</option>
                                       <option  value="2">No</option>
                                       @endif
                                    </select> 
                                   
                                    </div>
                           </div>

                        

                     </div>
              
            </div>

            
         </div>
         <h2><b>Multiple Images</b></h2>
         <div class="card mt-5" >
               <div class="card-body" >
                   <div class="container" >
                      <div class="row multiple___imgs" >
                      @foreach($product_all_images as $key=>$value)
                      <?php 
                      $allImgs= (array) $value; 
                      ?>
                      <div class="col-lg-6 col-md-4 col-12 multiple_column">
                              <div class="row" >
                             
                                    <div class="col-lg-6" >
                                          <div class="form-group">
                                          <label for="multiple_images" class="control-label mb-1">Image</label>
                                          <input id="multiple_images" {{$attribute_img_rquired}}  name="multiple_images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value="">
                                          <input id="previous_multiple_images" name="previous_multiple_images[]" type="hidden" class="form-control" aria-required="true" aria-invalid="false" value="{{ $allImgs['image']}}">
                                          <input type="hidden" id="m_img_key" name="m_img_key[]" value="{{$allImgs['id']}}"> 
                                         </div>
                                          @if($allImgs['image']!='')
                                           <div class="multiple_images_show" >
                                               <a href="{{asset('storage/media/product_images')}}/{{$allImgs['image']}}" target="_blank" ><img width="50px" height="50px"  src="{{asset('storage/media/product_images')}}/{{$allImgs['image']}}" alt=""></a>
                                          </div>
                                          @endif
                                    </div>
                                    <div class="col-lg-6" >
                                       @if($key==0)
                                          <div class="form-group">
                                          <label for="add_more-images" class=" attr_btn control-label mb-1">&nbsp;</label>
                                          <button id="add_more-images" class="btn btn-success btn-lg" type="submit">
                                          <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add 
                                          </button>
                                          </div>
                                          @else
                                          <div class="form-group">
                                          <label for="remove_exist_img" class=" attr_btn control-label mb-1">&nbsp;</label>
                                          <a href="{{asset('admin/product/single_img_delete')}}/{{$allImgs['id']}}/{{$allImgs['pid']}}" id="remove_exist_img" class="btn text-white btn-danger btn-lg" type="submit">
                                          <i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remove 
                                          </a>
                                          <input type="hidden" value="{{$allImgs['id']}}">
                                          </div>
                                          @endif
                                    </div>
                                    
                              </div>
                    

                    
                          </div>
                          @endforeach


               
                         
                     </div>
                   </div>
               </div>
         </div>
         <!-- Product Attributes  -->
         <h2><b>Product Attributes</b></h2>
         @foreach($attributes as $key=>$value)
         <div class="card mt-5">
           
            
            <div class="card-body">
            <?php $product_attr= (array) $value; ?> 
           
           
            
             <div class="row" >
                    <div class="col-lg-3 col-md-4 col-12" >
               
                        <div class="form-group">
                            <label for="sku" class="control-label mb-1">Sku</label>
                            <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attr['sku']}}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12" >
                    
                        <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attr['price']}}">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12" >
                 
                        <div class="form-group">
                        <label for="size_id" class="control-label mb-1">Size</label>
                            <select name="size_id[]" id="size_id" class="form-control">
                                <option value="">Please select</option>
                                @foreach($sizes as $val)
                                @if($product_attr['size_id']==$val->id)
                                <option selected value="{{$val->id}}">{{$val->size}}</option>
                                @else
                                <option value="{{$val->id}}">{{$val->size}}</option>
                                @endif
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12" >
                 
                        <div class="form-group">
                        <label for="color_id" class="control-label mb-1">Color</label>
                            <select name="color_id[]" id="color_id" class="form-control">
                                <option value="">Please select</option>
                             
                                @foreach($colors as $val)
                                @if($product_attr['color_id']==$val->id)
                                <option selected value="{{$val->id}}">{{$val->color}}</option>
                                @else
                                <option  value="{{$val->id}}">{{$val->color}}</option>
                                @endif
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-12" >
                   
                        <div class="form-group">
                            <label for="qty" class="control-label mb-1">Qty</label>
                            <input id="qty" name="qty[]" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attr['qty']}}">
                            <input id="attribute_id" name="attribute_id[]" type="hidden" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attr['id']}}">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-12" >
                    <div class="form-group">
                            <label for="attr_img" class="control-label mb-1">Image</label>
                            <input id="attr_img" {{$attribute_img_rquired}} name="attr_img[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value="">
                            <input id="previous_img" name="previous_img[]" type="hidden" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_attr['image']}}">
                    </div>
                  </div>
            
                  @if($key==0)
               <div class="col-lg-3 col-md-4 col-12" >
                    <div class="form-group">
                            <label for="add_more" class=" attr_btn control-label mb-1">&nbsp;</label>
                            <button id="add_more" class="btn btn-success btn-lg" type="submit">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add 
                            </button>
                    </div>
               </div>
            @else
               
               <div class="col-lg-3 col-md-4 col-12" >
                   <div class="form-group">
                      <label for="remove_attr" class=" attr_btn control-label mb-1">&nbsp;</label>
                   <a id="" class="btn btn-danger btn-lg" href="{{url('admin/product/delete_attr')}}/{{$product_attr['id']}}/{{$product_attr['pid']}}"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remove </a>
                  </div>
               </div>
                @endif    
             </div>   


            </div>
          
         </div>
         @endforeach

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
@endsection