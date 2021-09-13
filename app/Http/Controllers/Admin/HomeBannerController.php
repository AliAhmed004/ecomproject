<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\homebanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $home_banner['home_banner']=homebanner::all();
        return view('admin.home_banner',$home_banner);
    }
    function manage_home_banner($id='')
    {

        if($id > 0)
        {
            $home_banner=homebanner::find($id);
            $home_banner['banner_id']=$home_banner->id;
            $home_banner['btn_txt']=$home_banner->btn_txt;
            $home_banner['btn_link']=$home_banner->btn_link;
            $home_banner['banner_img']=$home_banner->image;
           
        }
        else
        {   
            $home_banner['banner_id']='';
            $home_banner['btn_txt']='';
            $home_banner['btn_link']='';
            $home_banner['banner_img']='';
            
            

        }
       return view('admin.manage_home_banner',$home_banner);
    }
    function manage_home_banner_process(Request $r)
    {
        !empty($r->input('banner_id')) ? $required='' : $required='required'; 
        $r->validate(['btn_txt'=>'required','btn_link'=>'required','banner_img'=>$required]);
        
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('banner_id') > 0)
       {
          $update_banner=homebanner::find($r->input('banner_id'));
          $update_banner->btn_txt=$r->input('btn_txt');
          $update_banner->btn_link=$r->input('btn_link');
         if($r->hasfile('banner_img'))
       {
           $image=$r->file('banner_img');
           $image_name=time().'.'.$image->extension();
           $image->storeAs('/public/media/home_banner',$image_name);
           
       }
       else
       {
        $image_name=$r->input('previous_banner_img');
       }
       $update_banner->image=$image_name;
         $update_banner->save();
         $r->session()->flash('status','Banner Updated Successfully');
         return redirect('admin/home_banner');

       }
       else
       {
       
       $btn_txt=$r->input('btn_txt');
       $btn_link=$r->input('btn_link');
       if($r->hasfile('banner_img'))
       {
           $image=$r->file('banner_img');
           $image_name=time().'.'.$image->extension();
           $image->storeAs('/public/media/home_banner',$image_name);

       }
       $record=homebanner::insert(['btn_txt'=>$btn_txt,'btn_link'=>$btn_link,'image'=>$image]);

       if($record)
       {
           $r->session()->flash('status','Banner Added Successfully');
           return redirect('admin/home_banner');
       }
    }


    }
    function delete_home_banner(Request $r,$id)
{
   $home_banner=homebanner::find($id);
   $home_banner->delete();
   $r->session()->flash('status','Banner  Deleted Successfully');

   return redirect('admin/home_banner');
}

function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=homebanner::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/home_banner');
}
}
