<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $coupon['coupon']=coupon::all();
        return view('admin.coupon',$coupon);
    }
    function manage_coupon($id='')
    {

        if($id > 0)
        {
            $coupon=coupon::find($id);
            $coupon['coupon_id']=$coupon->id;
            $coupon['coupon_title']=$coupon->title;
            $coupon['coupon_code']=$coupon->code;
            $coupon['coupon_value']=$coupon->value;
            $coupon['tax_type']=$coupon->type;
            $coupon['min_order_am']=$coupon->min_order_am;
            $coupon['is_one_time']=$coupon->is_one_time;

        }
        else
        {   
            $coupon['coupon_id']='';
            $coupon['coupon_title']='';
            $coupon['coupon_code']='';
            $coupon['coupon_value']='';
            $coupon['tax_type']='';
            $coupon['min_order_am']='';
            $coupon['is_one_time']='';

        }
       return view('admin.manage_coupon',$coupon);
    }
    function manage_coupon_process(Request $r)
    {
        $r->validate(['couponTitle'=>'required','couponCode'=>'required','couponValue'=>'required',
        'tax_type'=>'required','min_order_am'=>'required','is_one_time'=>'required']);
        $code=$r->input('couponCode');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_code_exist=coupon::where('id','!=',$r->input('couponId'))->where('code',$code)->count(); 


        if($check_code_exist > 0)
        {
            $r->session()->flash('error','This Code Already Exsist');
            return redirect('admin/coupon/manage_coupon/'.$r->input('couponId'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('couponId') > 0)
       {
          $update_coupon=coupon::find($r->input('couponId'));
         $update_coupon->title=$r->input('couponTitle');
         $update_coupon->code=$r->input('couponCode');
         $update_coupon->value=$r->input('couponValue');

         $update_coupon->type=$r->input('tax_type');
         $update_coupon->min_order_am=$r->input('min_order_am');
         $update_coupon->is_one_time=$r->input('is_one_time');
         $update_coupon->save();
         $r->session()->flash('status','Coupon Updated Successfully');
         return redirect('admin/coupon');

       }
       else
       {
        
       $coupon_title=$r->input('couponTitle');
       $coupon_code=$r->input('couponCode');
       $coupon_value=$r->input('couponValue');
       
       $coupon_tax_type=$r->input('tax_type');
       $coupon_min_order_am=$r->input('min_order_am');
       $coupon_is_one_time=$r->input('is_one_time');
       $coupon=coupon::insert(['title'=>$coupon_title,'code'=>$coupon_code,'value'=>$coupon_value,
       'type'=>$coupon_tax_type,'min_order_am'=>$coupon_min_order_am,'is_one_time'=>$coupon_is_one_time]);

       if($coupon)
       {
           $r->session()->flash('status','Coupon Added Successfully');
           return redirect('admin/coupon');
       }
    }


    }
    function delete_coupon(Request $r,$id)
{
   $coupon=coupon::find($id);
   $coupon->delete();
   $r->session()->flash('status','Coupon  Deleted Successfully');

   return redirect('admin/coupon');
}
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=coupon::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/coupon');
}
}
