<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function show()
    {
        $product['product']=product::all();
        return view('admin.product',$product);
    }
    function manage_product($id='')
    {
       
        if($id > 0)
        {
            $product=product::find($id);
           
            $product['product_id']=$product->id;
            $product['product_cat_id']=$product->category_id;
            $product['product_slug']=$product->slug;
            $product['product_title']=$product->title;
            $product['product_image']=$product->image;
            $product['product_brand']=$product->brand;
            $product['product_model']=$product->model;
            $product['product_desc']=$product->desc;
            $product['product_keyword']=$product->keywords; 
            $product['lead_time']=$product->lead_time;
            $product['tax']=$product->tax;
            $product['tax_type']=$product->tax_type;
            $product['is_promo']=$product->is_promo;
            $product['is_featured']=$product->is_featured;
            $product['is_trending']=$product->is_trending;
            $product['is_discounted']=$product->is_discounted;
             
            $product['attributes']=DB::table('product_attr')->where('pid',$id)->get();
            $product['product_all_images']=DB::table('multiple_images')->where('pid',$id)->get();      

        }
        else
        {  
            $product['product_id']='';
            $product['product_cat_id']='';
            $product['product_title']='';
            $product['product_slug']='';
            $product['product_image']='';
            $product['product_brand']='';
            $product['product_model']='';
            $product['product_desc']='';
            $product['product_keyword']='';
            $product['lead_time']='';
            $product['tax']='';
            $product['tax_type']='';
            $product['is_promo']='';
            $product['is_featured']='';
            $product['is_trending']='';
            $product['is_discounted']='';
            $product['attributes']['0']['id']=''; 
            $product['attributes']['0']['sku']='';
            $product['attributes']['0']['pid']='';
            $product['attributes']['0']['image']='';
            $product['attributes']['0']['mrp']='';
            $product['attributes']['0']['price']=''; 
            $product['attributes']['0']['size_id']='';
            $product['attributes']['0']['color_id']='';
            $product['attributes']['0']['qty']=''; 
            $product['product_all_images']['0']['id']='';
            $product['product_all_images']['0']['image']='';  
       
        }
        $product['allcat']=DB::table('categories')->get();
        $product['colors']=DB::table('colors')->get();
        $product['sizes']=DB::table('sizes')->get();
        $product['brand']=DB::table('brands')->get();
      
       
       return view('admin.manage_product',$product);
    }

    function manage_product_process(Request $r)
    { 
    //                 print_r($r->file('multiple_images'));
               
    //             die();
       if($r->input('product_id')> 0)
       {
           $image_required='';
           $attr_image_required='';
       }
       else
       {
        $image_required='required|mimes:jpg,jpeg,png';
        $attr_image_required='mimes:jpg,jpeg,png';
       }
  
       $product_slug=$r->input('product_slug');
       // if we want to check data exist except a particular id, then we will run this query..
       $check_slug_exist=product::where('id','!=',$r->input('product_id'))->where('slug',$product_slug)->count(); 


       if($check_slug_exist > 0)
       {
           $r->session()->flash('error','This Slug Already Exsist');
           return redirect('admin/product/manage_product/'.$r->input('product_id'));
       }

     // Validating All Fields
        $r->validate(['product_cat_id'=>'required','product_title'=>'required',
        'product_image'=>$image_required,'product_brand'=>'required','product_model'=>'required',
        'product_desc'=>'required','product_keyword'=>'required','attr_img.*'=>'mimes:jpg,jpeg,png',
         'multiple_images.*'=>'required|mimes:jpg,jpeg,png']);

       //----------Start---- Updating 
       if($r->input('product_id') > 0)
        {
            
                
                // -------- Start -------- Update a Product Section
                $update_product=product::find($r->input('product_id'));
                $update_product->category_id=$r->input('product_cat_id');
                $update_product->title=$r->input('product_title');
                $update_product->slug=$r->input('product_slug');
                $update_product->brand=$r->input('product_brand');
                $update_product->model=$r->input('product_model');
                $update_product->desc=$r->input('product_desc');
                $update_product->keywords=$r->input('product_keyword');

                $update_product->lead_time=$r->input('lead_time');
                $update_product->tax=$r->input('tax');
                $update_product->tax_type=$r->input('tax_type');
                $update_product->is_promo=$r->input('is_promo');
                $update_product->is_discounted=$r->input('is_discounted');
                $update_product->is_trending=$r->input('is_trending');
                $update_product->is_featured=$r->input('is_featured');
                
                if($r->hasfile('product_image'))
                {
                    $image=$r->file('product_image');
                    $image_name=time().'.'.$image->extension();
                    $image->storeAs('/public/media',$image_name);
                    $update_product->image=$image_name;
        
                }
                else
                {
                $update_product->image=$r->input('product_image_hide');
                }
                
                $update_product->save();
              //---------- End ---- Update Product section 


                //---------- Start ---- Updating Attributes Section
                foreach($r->input('sku') as $key=>$value) 
                {

                    $product_sku=$r->input('sku')[$key];
                    $attribute_id= !empty($r->input('attribute_id')[$key])  ? $r->input('attribute_id')[$key] : '';
                    // if we want to check data exist except a particular id, then we will run this query..
                    $check_sku_exist=DB::table('product_attr')->where('id','!=',$attribute_id)->where('sku',$product_sku)->count();
                    if($check_sku_exist > 0)
                    {
                        $r->session()->flash('sku_exist','This '.$product_sku.' SKU Already Exsist');
                        return redirect('admin/product/manage_product/'.$r->input('product_id'));
                    } 
                        
                    if($attribute_id !='') // Updating Existing Attributes
                    {
                            $get_img= !empty($r->file('attr_img')[$key]) ? $r->file('attr_img')[$key] : '';
                            if($get_img)
                            {
                                $img_attr=time().$key.'.'.$get_img->extension();
                                $get_img->storeAs('/public/media/product_attributes',$img_attr);
                            }

                            else
                            {
                                $img_attr=$r->input('previous_img')[$key];
                            }
                        
            
                            DB::table('product_attr')->where('id','=',$r->input('attribute_id')[$key])
                            ->update(['sku'=>$r->input('sku')[$key],'price'=>$r->input('price')[$key],
                            'size_id'=>$r->input('size_id')[$key],'color_id'=>$r->input('color_id')[$key],'image'=>$img_attr,'qty'=>$r->input('qty')[$key]
                            ]);
                    } 
                            
                    else // Add new  Attributes
                    {
                            $get_img=$r->file('attr_img')[$key];
                            $img_attr=time().$key.'.'.$get_img->extension();
                            $get_img->storeAs('/public/media/product_attributes',$img_attr);

                            DB::table('product_attr')->insert(['pid'=>$r->input('product_id'),'sku'=>$r->input('sku')[$key],'price'=>$r->input('price')[$key],
                            'size_id'=>$r->input('size_id')[$key],'color_id'=>$r->input('color_id')[$key],'image'=>$img_attr,'qty'=>$r->input('qty')[$key]
                             ]);
                    }
                    
                } 
                            

                // --------Start--------- Updating Multiple Images
                foreach($r->input('m_img_key') as $key=>$value)
                {
                    $img_key=!empty($r->input('m_img_key')[$key]) ? $r->input('m_img_key')[$key] : '';
                         if($img_key!='')
                    {

                            $update_multiple_img= !empty($r->file('multiple_images')[$key]) ? $r->file('multiple_images')[$key] : '';
                    
                        if($update_multiple_img!='')
                        {
                            $upd_img_attr=time().$key.'.'.$update_multiple_img->extension();
                            $update_multiple_img->storeAs('/public/media/product_images',$upd_img_attr);
                        }

                        else
                        {
                            $upd_img_attr=$r->input('previous_multiple_images')[$key];
                        }
                        DB::table('multiple_images')->where('id',$r->input('m_img_key')[$key])->update(['image'=>$upd_img_attr]);
                    }  
                    
                    else
                    {
                        $insert_multiple_img=$r->file('multiple_images')[$key];
                    
                        $insert_multiple_img_name=time().$key.'.'.$insert_multiple_img->extension();
                        $insert_multiple_img->storeAs('/public/media/product_images',$insert_multiple_img_name);
                        DB::table('multiple_images')->insert(['image'=>$insert_multiple_img_name,'pid'=>$r->input('product_id')]);
                   
                    }
                }
                $r->session()->flash('status','Product Updated Successfully');
                return redirect('admin/product');

        }

         //----------End---- Updating 

       else // ----- Start ----  Adding Data 
        {
           
            foreach($r->input('sku') as $key=>$value)
            {
                $product_sku=$r->input('sku')[$key];
                // if we want to check data exist except a particular id, then we will run this query..
                $check_sku_exist=DB::table('product_attr')->where('sku',$product_sku)->count();
                if($check_sku_exist > 0)
                {
                    $r->session()->flash('sku_exist','This '.$product_sku.' SKU Already Exsist');
                    return redirect('admin/product/manage_product');
                } 
            }
                 // ----- Start ----  Adding Product Section 
                    $addproduct=new product;
                    $addproduct->category_id=$r->input('product_cat_id');
                    $addproduct->title=$r->input('product_title');
                    $addproduct->slug=$r->input('product_slug');
                    $addproduct->brand=$r->input('product_brand');
                    $addproduct->model=$r->input('product_model');
                    $addproduct->desc=$r->input('product_desc');
                    $addproduct->keywords=$r->input('product_keyword');
                    if($r->hasfile('product_image'))
                    {
                        $image=$r->file('product_image');
                        $image_name=time().'.'.$image->extension();
                        $image->storeAs('/public/media',$image_name);

                    }
                    $addproduct->image=$image_name;
                    $addproduct->save();
                    $pid=$addproduct->id;

                     // ----- End ----  Adding Product Section 


                    //----- Start ---- Adding Attributes
                    foreach($r->input('sku') as $key=>$value)
                    {
                        

                            $get_img=$r->file('attr_img')[$key];
                            $img_attr=time().$key.'.'.$get_img->extension();
                            $get_img->storeAs('/public/media/product_attributes',$img_attr);

                            DB::table('product_attr')->insert(['pid'=>$pid,'sku'=>$r->input('sku')[$key],'price'=>$r->input('price')[$key],
                            'size_id'=>$r->input('size_id')[$key],'color_id'=>$r->input('color_id')[$key],'image'=>$img_attr,'qty'=>$r->input('qty')[$key]
                            ]);
                    } 
                      //----- End ---- Adding Attributes

                       //----- Start ---- Adding multiple images
                       foreach($r->file('multiple_images') as $key=>$value)
                       {
                                
                            $multiple_img=$r->file('multiple_images')[$key];
                            $img_name=time().$key.'.'.$multiple_img->extension();
                            $multiple_img->storeAs('/public/media/product_images',$img_name);
                            DB::table('multiple_images')->insert(['image'=>$img_name,'pid'=>$pid]);
                       }
                   
                    $r->session()->flash('status','Product Added Successfully');
                    return redirect('admin/product');
                   
        
        }
        // ----- End ----  Adding Data 


    }


    function delete_product(Request $r,$id)
{
   $product=product::find($id);
   $product->delete();
   DB::table('product_attr')->where('pid',$id)->delete();
   $r->session()->flash('status','Product  Deleted Successfully');

   return redirect('admin/product');
}
// Multiple Image delete
function delete_single_img(Request $r,$id,$pid)
{
  DB::table('multiple_images')->where('id',$id)->delete();
    $r->session()->flash('status','image  Deleted Successfully');
    return redirect('admin/product/manage_product/'.$pid);

}
// Delete Attribute
function delete_attribute(Request $r,$id,$pid)
{
     DB::table('product_attr')->where('id',$id)->delete();
     $r->session()->flash('status','Attribute  Deleted Successfully');
 
    return redirect('admin/product/manage_product/'.$pid);
}
// status
function status(Request $r,$id,$status_value)
{
    // return ['id'=>$id,'status'=>$status_value];
    $status=product::find($id);
    $status->status=$status_value;
    $status->save();
    $r->session()->flash('status','Status Updated Successfully');
    return redirect('admin/product');
}
}
