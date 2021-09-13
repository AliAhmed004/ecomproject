@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Size')
    @section('size_active', 'active')

    <div class="row" >
    <div class="col-lg-12">
    <h2><b>Manage Size</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/size')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/size/manage_size')}}" method="post" >
                                        @csrf
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1">Size</label>
                                                <input id="size" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$size}}">
                                            </div>
                                            @error('size')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                             <div>
                                             <input name="sizeId" type="hidden" value="{{$size_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
                                             </div>

                                          @if(session()->has('error'))
                                           <div class="alert alert-danger" role="alert">
											   {{session('error')}}
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