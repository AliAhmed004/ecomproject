<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $customer['customer']=customer::all();
        return view('admin.customer',$customer);
    }
    function manage_customer($id='')
    {

        if($id > 0)
        {
            $customer=customer::find($id);
            $customer['customer_id']=$customer->id;
            $customer['customer_name']=$customer->name;
            $customer['customer_email']=$customer->email;
            $customer['customer_password']=$customer->password;
            $customer['customer_mobile']=$customer->mobile;
            $customer['customer_address']=$customer->address;
            $customer['customer_city']=$customer->city;
            $customer['customer_gstpk']=$customer->gstpk;
        }
        else
        {   
            $customer['customer_id']='';
            $customer['customer_name']='';
            $customer['customer_email']='';
            $customer['customer_password']='';
            $customer['customer_mobile']='';
            $customer['customer_address']='';
            $customer['customer_city']='';
            $customer['customer_gstpk']='';

        }
       return view('admin.manage_customer',$customer);
    }
    function manage_customer_process(Request $r)
    {
        $r->validate(['name'=>'required','email'=>'required','password'=>'required','mobile'=>'required','address'=>'required',
        'city'=>'required','gstpk'=>'required']);
        $email=$r->input('email');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_email_exist=customer::where('id','!=',$r->input('customer_id'))->where('email','=',$email)->count(); 


        if($check_email_exist > 0)
        {
            $r->session()->flash('error','This Email Already Exsist');
            return redirect('admin/customer/manage_customer/'.$r->input('customer_id'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('customer_id') > 0)
       {
         $update_customer=customer::find($r->input('customer_id'));
         $update_customer->name=$r->input('name');
         $update_customer->email=$r->input('email');
         $update_customer->password=$r->input('password');
         $update_customer->mobile=$r->input('mobile');
         $update_customer->address=$r->input('address');
         $update_customer->city=$r->input('city');
         $update_customer->gstpk=$r->input('gstpk');
         $update_customer->save();
         $r->session()->flash('status','Customer Updated Successfully');
         return redirect('admin/customer');

       }
       else
       {
        
         $name=$r->input('name');
         $email=$r->input('email');
         $password=$r->input('password');
         $mobile=$r->input('mobile');
         $address=$r->input('address');
         $city=$r->input('city');
         $gstpk=$r->input('gstpk');
         $add_customer=customer::insert(['name'=>$name,'email'=>$email,'password'=>$password,
         'mobile'=>$mobile,'address'=>$address,'city'=>$city,'gstpk'=>$gstpk
        ]);

       if($add_customer)
       {
           $r->session()->flash('status','Customer Added Successfully');
           return redirect('admin/customer');
       }
    }


    }

    function view_customer($id)
    {
        $customer['customer']=customer::find($id);
        return view('admin.view_customer',$customer);
    }
    function delete_customer(Request $r,$id)
{
   $customer=customer::find($id);
   $customer->delete();
   $r->session()->flash('status','Customer  Deleted Successfully');

   return redirect('admin/customer');
}
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=customer::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Customer Updated Successfully');
    return redirect('admin/customer');
}
}
