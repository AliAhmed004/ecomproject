@extends('layouts.admin_layout')
    @section('content')
    @section('title', 'Customer')
    @section('customer_active', 'active')
    <div class="row m-t-30">
                            <div class="col-md-12">
                            @if(session()->has('status'))
                                
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                <span class="badge badge-pill badge-success">Success</span>
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              @endif 
                            
                              <h2><b>Customer</b></h2>
                              <a class=" my-3 btn btn-primary" href="{{url('admin/customer')}}" role="button">Back</a>
                              
                              <!-- DATA TABLE-->
                              <div class="top-campaign">
                                    <h3 class="title-3 m-b-30"><b>Customer Details</b></h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{$customer->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td>{{$customer->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td>{{$customer->password}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact No</td>
                                                    <td>{{$customer->mobile}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{$customer->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td>City</td>
                                                    <td>{{$customer->city}}</td>
                                                </tr>
                                                <tr>
                                                    <td>GstPk</td>
                                                    <td>{{$customer->gstpk}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>{{$customer->status}}</td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

    
@endsection