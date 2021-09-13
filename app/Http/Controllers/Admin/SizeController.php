<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $size['size']=size::all();
        return view('admin.size',$size);
    }
    function manage_size($id='')
    {

        if($id > 0)
        {
            $size=size::find($id);
            $size['size_id']=$size->id;
            $size['size']=$size->size;

        }
        else
        {    
            $size['size_id']='';
            $size['size']='';

        }
       return view('admin.manage_size',$size);
    }
    function manage_size_process(Request $r)
    {
        $r->validate(['size'=>'required']);
        $size=$r->input('size');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_size_exist=size::where('id','!=',$r->input('sizeId'))->where('size','=',$size)->count(); 


        if($check_size_exist > 0)
        {
            $r->session()->flash('error','This Size Already Exsist');
            return redirect('admin/size/manage_size/'.$r->input('sizeId'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('sizeId') > 0)
       {
          $update_size=size::find($r->input('sizeId'));
         $update_size->size=$r->input('size');
         $update_size->save();
         $r->session()->flash('status','Size Updated Successfully');
         return redirect('admin/size');

       }
       else
       {
        
       $size_title=$r->input('size');
       $add_size=size::insert(['size'=>$size_title]);

       if($add_size)
       {
           $r->session()->flash('status','Size Added Successfully');
           return redirect('admin/size');
       }
    }


    }
    function delete_size(Request $r,$id)
{
   $size=size::find($id);
   $size->delete();
   $r->session()->flash('status','Size  Deleted Successfully');

   return redirect('admin/size');
}
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=size::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/size');
}
}
