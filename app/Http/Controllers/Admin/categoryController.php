<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    function show()
    {
        $cat['category']=category::all();
        return view('admin.category',$cat);
    }
    function manage_category($id='')
    {

        if($id > 0)
        {
            $cat=category::find($id);
            $cat['cat_id']=$cat->id;
            $cat['cat_name']=$cat->cat_name;
            $cat['cat_slug']=$cat->cat_slug;
            $cat['cat_img']=$cat->cat_image;
            $cat['is_home']=($cat->is_home==0) ? '' : 'checked';
            $parent_cat_id=DB::table('categories')->select('parent_cat_id')->where('id',$id)->first();
            $cat['parent_cat_id']=$parent_cat_id->parent_cat_id;
           
        }
        else
        {   
            $cat['cat_id']='';
            $cat['cat_name']='';
            $cat['cat_slug']='';
            $cat['cat_img']='';
            $cat['parent_cat_id']='';
            $cat['is_home']='';
            
            

        }
       
        $cat['all_cats']=DB::table('categories')->whereNull('parent_cat_id')->get();
       return view('admin.manage_category',$cat);
    }
    function manage_category_process(Request $r)
    {
        $r->validate(['categoryName'=>'required','categorySlug'=>'required']);
        $slug=$r->input('categorySlug');
        // if we want to check data exist except a particular id, then we will run this query..
        $check_slug_exist=category::where('id','!=',$r->input('cat_id'))->where('cat_slug',$slug)->count(); 


        if($check_slug_exist > 0)
        {
            $r->session()->flash('error','This slug Already Taken!');
            return redirect('admin/category/manage_category/'.$r->input('cat_id'));
        }
         // if id exist it will update the data otherwise it will add the data into the database..
       if($r->input('cat_id') > 0)
       {
          $update_cat=category::find($r->input('cat_id'));
         $update_cat->cat_name=$r->input('categoryName');
         $update_cat->cat_slug=$r->input('categorySlug');
         $update_cat->parent_cat_id=$r->input('parent_cat');
         if($r->input('is_home')==null)
         {
            $update_cat->is_home=0;
         }
         else
         {
            $update_cat->is_home=1;
         }
         if($r->hasfile('cat_img'))
       {
           $image=$r->file('cat_img');
           $image_name=time().'.'.$image->extension();
           $image->storeAs('/public/media/categories',$image_name);
           
       }
       else
       {
        $image_name=$r->input('cat_previous_img');
       }
       $update_cat->cat_image=$image_name;
         $update_cat->save();
         $r->session()->flash('status','Category Updated Successfully');
         return redirect('admin/category');

       }
       else
       {
       
       $category=$r->input('categoryName');
       $slug=$r->input('categorySlug');
       $parent_cat_id=$r->input('parent_cat');
       if($r->hasfile('cat_img'))
       {
           $image=$r->file('cat_img');
           $image_name=time().'.'.$image->extension();
           $image->storeAs('/public/media/categories',$image_name);

       }
       if($r->input('is_home')==null)
       {
        $is_home=0;
       }
       else
       {
        $is_home=1;
       }
       $record=category::insert(['cat_name'=>$category,'cat_slug'=>$slug,'parent_cat_id'=>$parent_cat_id,'cat_image'=>$image_name,'is_home'=>$is_home]);

       if($record)
       {
           $r->session()->flash('status','Category Added Successfully');
           return redirect('admin/category');
       }
    }


    }
    function delete_category(Request $r,$id)
{
   $cat=category::find($id);
   $cat->delete();
   $r->session()->flash('status','Category  Deleted Successfully');

   return redirect('admin/category');
}

function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=category::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/category');
}
}

