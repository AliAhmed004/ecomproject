$(document).ready(function(){

    //--------------Admin Header Part---------

    $('.header-button').click(function(){
        $(this).find('.account-item').toggleClass('show-dropdown')
    })

    // mobile toggle menu 
    const btnToggle = $('.header-mobile-inner .hamburger--slider');
    const Menu = $('nav.navbar-mobile')

    btnToggle.click(function(e){
        $(this).toggleClass('is-active')
        Menu.slideToggle();
    })

// --------------Add More Attributes-------------------

$('#add_more').click(function(e){
    e.preventDefault();
    let size= $('.card-body #size_id').html();
    let color= $('.card-body #color_id').html();
    let html='<div class="card mt-5"><div class="card-body"> <div class="row" >';
    html +='<div class="col-lg-3 col-md-4 col-12" ><div class="form-group"><label for="sku" class="control-label mb-1">Sku</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value=""></div></div>'
    html +='<div class="col-lg-3 col-md-4 col-12" ><div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="mrp" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value=""></div></div>'
    html+='<div class="col-lg-2 col-md-4 col-12" > <div class="form-group"><label for="size_id" class="control-label mb-1">Size</label><select name="size_id[]" id="size_id" class="form-control">'+size+'</select></div></div>'
    html+='<div class="col-lg-2 col-md-4 col-12" ><div class="form-group"><label for="color_id" class="control-label mb-1">Color</label><select name="color_id[]" id="color_id" class="form-control">'+color+'</select></div></div>'
    html+='<div class="col-lg-2 col-md-4 col-12" ><div class="form-group"><label for="qty" class="control-label mb-1">Qty</label><input id="qty" name="qty[]" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_title}}"></div></div>'
    html+='<div class="col-lg-3 col-md-4 col-12" ><div class="form-group"><label for="attr_img" class="control-label mb-1">Image</label><input id="attr_img" required  name="attr_img[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value=""></div></div>'
    html+='<div class="col-lg-3 col-md-4 col-12" > <div class="form-group"><label for="remove_attr" class=" attr_btn control-label mb-1">&nbsp;</label><button id="remove_attr" class="btn btn-danger btn-lg" type="submit"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remove </button></div></div>'
    html +='</div></div></div>';
    $('.product_container').append(html);
})

// --------------Remove Attributes-------------------
$(document).on('click','#remove_attr',function(e){
    e.preventDefault();
    $(this).parents('.card').remove();
});

// Add Multiple Images

$('#add_more-images').click(function(e){
    e.preventDefault();
    let html='<div class="col-lg-6 col-md-4 col-12 multiple_column"><div class="row" >';
    html+='<div class="col-lg-6" ><div class="form-group"><label for="multiple_images" class="control-label mb-1">Image</label><input id="multiple_images" required name="multiple_images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value=""></div></div>'
   html+='<div class="col-lg-3 col-md-4 col-12"> <div class="form-group"><label for="remove_multiple_imgs" class=" attr_btn control-label mb-1">&nbsp;</label><button id="remove_multiple_imgs" class="btn btn-danger btn-lg" type="submit"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remove </button></div></div>';
  
      html+='</div></div>';
     $('.multiple___imgs').append(html);
})
// Remove Multiple Images
$(document).on('click','#remove_multiple_imgs',function(e){
    e.preventDefault();
    $(this).parents('.multiple_column').remove();
});

// Password Show or Not

$('#customer__pass__field i').click(function(){
    if($('#password + i').hasClass('fa-eye-slash'))
    {
        $('#password + i').removeClass('fa-eye-slash');
        $('#password + i').addClass('fa-eye');
        $(this).parent().find('#password').attr('type','text');
    }
    else
    {
        $('#password + i').removeClass('fa-eye');
        $('#password + i').addClass('fa-eye-slash');
        $(this).parent().find('#password').attr('type','password'); 
    }
     
})
});// End Document