@extends('layouts/front_layout')
@section('front_title','Order Placed')
@section('front_content')
 
<div class="verified_msg" >

  <h2>
   Order Placed Successfully<br>
   Order id:- {{$customer_id}}
  </h2>
</div>

@endsection