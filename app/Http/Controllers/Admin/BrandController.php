<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $brand['brand']=brand::all();
        return view('admin.brand',$brand);
    }
    function manage_brand($id='')
    {

        if($id > 0)
        {
            $brand=brand::find($id);
            $brand['brand_id']=$brand->id;
            $brand['brand_name']=$brand->name;
            $brand['brand_image']=$brand->image;
            $brand['is_header']=($brand->is_header==0) ? '' : 'checked';
 
        }
        else
        {   
            $brand['brand_id']='';
            $brand['brand_name']='';
            $brand['brand_image']='';
            $brand['is_header']='';

        }
       return view('admin.manage_brand',$brand);
    }
    function manage_brand_process(Request $r)
    {
        if($r->input('brand_id') > 0)
        {
            $required='';
        }
        else
         {
            $required='required';
         }
        $r->validate(['brand_name'=>'required','brand_image'=>$required]);
        $brand=$r->input('brand_name');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_brand_exist=brand::where('id','!=',$r->input('brand_id'))->where('name',$brand)->count(); 


        if($check_brand_exist > 0)
        {
            $r->session()->flash('error','This Brand Already Exsist');
            return redirect('admin/brand/manage_brand/'.$r->input('brand_id'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('brand_id') > 0)
       {
          $update_brand=brand::find($r->input('brand_id'));
         
         $update_brand->name=$r->input('brand_name');
         if($r->hasfile('brand_image'))
         {
             $image=$r->file('brand_image');
             $image_name=time().'.'.$image->extension();
             $image->storeAs('/public/media/brand_images',$image_name);
  
         }
         else
         {
            $image_name=$r->input('previous_brand_image');
         }
         $update_brand->image=$image_name;
         if($r->input('is_header')==null)
         {
            $update_brand->is_header=0;
         }
         else
         {
            $update_brand->is_header=1;
         }
         $update_brand->save();
         $r->session()->flash('status','Brand Updated Successfully');
         return redirect('admin/brand');

       }
       else
       {
        
       $brand_name=$r->input('brand_name');
      
       if($r->hasfile('brand_image'))
       {
           $image=$r->file('brand_image');
           $image_name=time().'.'.$image->extension();
           $image->storeAs('/public/media/brand_images',$image_name);

       }
       if($r->input('is_header')==null)
       {
        $is_header=0;
       }
       else
       {
        $is_header=1;
       }
       $brand=brand::insert(['name'=>$brand_name,'image'=>$image_name,'is_header'=>$is_header]);

       if($brand)
       {
           $r->session()->flash('status','Brand Added Successfully');
           return redirect('admin/brand');
       }
    }


    }
    function delete_brand(Request $r,$id)
{
   $brand=brand::find($id);
   $brand->delete();
   $r->session()->flash('status','Brand  Deleted Successfully');

   return redirect('admin/brand');
}
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=brand::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/brand');
}
}
