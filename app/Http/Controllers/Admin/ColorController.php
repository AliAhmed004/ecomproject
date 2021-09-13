<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $color['color']=color::all();
        return view('admin.color',$color);
    }
    function manage_color($id='')
    {

        if($id > 0)
        {
            $color=color::find($id);
            $color['color_id']=$color->id;
            $color['color']=$color->color;

        }
        else
        {    
            $color['color_id']='';
            $color['color']='';

        }
       return view('admin.manage_color',$color);
    }
    function manage_color_process(Request $r)
    {
        $r->validate(['color'=>'required']);
        $color=$r->input('color');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_color_exist=color::where('id','!=',$r->input('colorId'))->where('color','=',$color)->count(); 


        if($check_color_exist > 0)
        {
            $r->session()->flash('error','This color Already Exsist');
            return redirect('admin/color/manage_color/'.$r->input('colorId'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('colorId') > 0)
       {
          $update_color=color::find($r->input('colorId'));
         $update_color->color=$r->input('color');
         $update_color->save();
         $r->session()->flash('status','Color Updated Successfully');
         return redirect('admin/color');

       }
       else
       {
        
       $color_title=$r->input('color');
       $add_color=color::insert(['color'=>$color_title]);

       if($add_color)
       {
           $r->session()->flash('status','Color Added Successfully');
           return redirect('admin/color');
       }
    }


    }
    function delete_color(Request $r,$id)
{
   $color=color::find($id);
   $color->delete();
   $r->session()->flash('status','Color  Deleted Successfully');

   return redirect('admin/color');
}
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=color::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Color Updated Successfully');
    return redirect('admin/color');
}
}
