@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Color')
    @section('color_active', 'active')

    <div class="row" >
    <div class="col-lg-12">
    <h2><b>Manage Color</b></h2>
                              <a class="btn btn-primary mt-3" href="{{url('admin/color')}}" role="button">Back</a>
                             
                                <div class="card mt-5">
                                  
                                    <div class="card-body">
                                      
                                        <form action="{{url('admin/color/manage_color')}}" method="post" >
                                        @csrf
                                            <div class="form-group">
                                                <label for="color" class="control-label mb-1">Color</label>
                                                <input id="color" name="color" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$color}}">
                                            </div>
                                            @error('color')
                                            <div class="alert alert-danger" role="alert">
								            {{$message}}
									      	</div>
                                            @enderror
                                             <div>
                                             <input name="colorId" type="hidden" value="{{$color_id}}" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
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