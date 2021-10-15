/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    // jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
    //     loading_image: 'demo/images/loading.gif'
    // });

    // jQuery('#demo-1 .simpleLens-big-image').simpleLens({
    //     loading_image: 'demo/images/loading.gif'
    // });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       var start_price=$('.start_price').val() !='' ? $('.start_price').val() : 10;
       var end_price=$('.end_price').val() !='' ? $('.end_price').val() : 1900;

        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '20%': 300,
                '30%': 500,
                '40%': 700,
                '50%': 900,
                '60%': 1100,
                '70%': 1300,
                '80%': 1500,
                '90%': 1700,
                'max': 1900
            },
            snap: true,
            connect: true,
            start: [start_price, end_price]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});


$(document).ready(function(){
// Slider image change

  $(".simpleLens-thumbnails-container img").click(function(){
    var img_src = $(this).attr('src');
       $('.simpleLens-container .simpleLens-big-image-container a').attr('data-lens-image',img_src);
       $('.simpleLens-container .simpleLens-big-image-container a img').attr('src',img_src);
   });

  $('.aa-color-tag a').click(function(e){
    e.preventDefault();
    $('.in_case .incase_color').remove();
    $('.color_name').val($(this).attr('color'));
    $('.aa-color-tag a').removeClass('clicked');
   var img_path= $(this).attr('product-attr-img');
   $('.simpleLens-container .simpleLens-big-image-container a').attr('data-lens-image','http://127.0.0.1:8000/storage/media/product_attributes/'+img_path);
   $('.simpleLens-container .simpleLens-big-image-container a img').attr('src','http://127.0.0.1:8000/storage/media/product_attributes/'+img_path);
   $(this).addClass('clicked');  
  })
//  End Slider image change

// Showing colors on the bases of Sizes
$('.aa-prod-view-size a').click(function(e){
  e.preventDefault();
  $('.in_case .incase_size').remove();
  // $('.aa-color-tag a').removeClass('clicked');
  $('.aa-prod-view-size a').removeClass('clicked');
  var size=$(this).attr('size_variant');
   $('.size_name').val(size);
   $('.color_name').val('');
  $('.aa-color-tag a').hide();
  $(this).addClass('clicked');
  $('.aa-color-tag [sizes='+size+']').show();
})

//Add to Cart

$(document).on('click','.atc',function(e){
  e.preventDefault();
  
  if($('.size_name').val()=='')
  {
    $('.in_case').html('<div class="alert alert-danger mt-5 incase_size" role="alert">Please Select the Size</div>');
   return false
  }
  else if($('.color_name').val()=='')
  {
    $('.in_case').html('<div class="alert alert-danger mt-5 incase_color" role="alert">Please Select the Color</div>');
  }
   else
   {
    var qty =$('#atc_form .product_qty').attr('value',$('#quantity').val());
    var product_id =$('#atc_form .product_cart_id').attr('value',$('#products_id').val());
     
     $.ajax({
      
       url:'/add_to_cart',
       data:$('#atc_form').serialize(),
       dataType:"json",
       success: function(response){
         if(response.Item_count)
         {
           
           $('.aa-cart-notify').text(response.Item_count)
           $('.container_cartbox').html('')
           var html ='<div class="aa-cartbox-summary"><ul>'
           var i=0
           $.each(response.data,function(index,val){
             i=(parseInt(val.qty) * parseInt(val.price)) + parseInt(i)
              html +='<li><a class="aa-cartbox-img" href="#"><img src='+PRODUCT_IMG+'/'+val.image+' alt="img"></a><div class="aa-cartbox-info"><h4><a href="'+val.slug+'">'+val.title+'</a></h4><p>'+val.qty+' x '+val.price+'</p></div> <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a></li>'
             
           
           })
           html +='<li><span class="aa-cartbox-total-title">Total</span><span class="aa-cartbox-total-price">'+i+'</span></li>'
           html +='</ul></div>'
           $('.container_cartbox').append(html)
         }
        // alert('product '+response.status);
       }
   
      })
   }
})
// Home Add to cart
var pqty =$('#home_atc_form .product_qty').attr('value',$('#hp_quantity').val());
var pid =$('#home_atc_form .product_attr_id').attr('value',$('#hp_products_id').val());

$('.add_to_cart_home').click(function(e){
  e.preventDefault();
var pqty =$('#home_atc_form .product_attr_id').attr('value',$(this).parents('li').find('#product_attr_id').val());
var pid =$('#home_atc_form .product_id').attr('value',$(this).parents('li').find('#hp_product_id').val());
  
  $.ajax({
      
    url:'/home_add_to_cart',
    data:$('#home_atc_form').serialize(),
    dataType:"json",
    success: function(response){
     alert('product '+response.status);
    }

   })
})
// Cart Product Delete

$('.remove').click(function(e){
  e.preventDefault();
 
  $('#cart_item_delete .cart_item_id').attr('value',$(this).parent('td').find('#cart_product_id').val())
  $(this).parents('tr').remove();
  $.ajax({
    
    url:'/cart_product_delete',
    data:$('#cart_item_delete').serialize(),
    dataType:"json",
    success: function(response){
    $('.aa-cart-notify').text(response.Item_count)
    if(response.Item_count==0)
    {
      $('.container_cartbox').html('')
    }
    if(response.Item_count)
    {
      
      $('.aa-cart-notify').text(response.Item_count)
     $('.container_cartbox').html('')
           var html ='<div class="aa-cartbox-summary"><ul>'
           
           $.each(response.data,function(index,val){
   
              html +='<li><a class="aa-cartbox-img" href="#"><img src='+PRODUCT_IMG+'/'+val.image+' alt="img"></a><div class="aa-cartbox-info"><h4><a href="'+val.slug+'">'+val.title+'</a></h4><p>'+val.qty+' x '+val.price+'</p></div> <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a></li>'
             $('.container_cartbox').append(html)
       
           })
           html +='</ul></div>'
    }
    // alert(response.status)
    }

   })

})

// Update Cart page Product quantity

$('.aa-cart-quantity').change(function(){
  var price=parseInt($(this).parent('td').prev().text())
  var qty=parseInt($(this).val())
 $(this).parent('td').next().addClass('list_total').text(price*qty)
  $('#cart_products #cart_qty').attr('value',qty)
  var item_id=$(this).parents('tr').find('.crt_id').val()
  // var item_id=$(this).parent('td').find('#cart_product_id').attr('value');
  //  $('#cart_products .crt_id').attr('value',item_id);
  //  console.log(qty,item_id)
  $.ajax({
    url:'/cart_items_update',
    data:{qty:qty,item_id:item_id},
    dataType:"json",
    success: function(response){
    
      }
  })
 
})


// Category Sorting

$('#cat_sort_by').change(function(){
  
  var action =$(this).val();
  
  $('#category_filter .sorting_action').attr('value',action)
  // $('#category_filter .sorting_txt').attr('value',action)
 $('#category_filter').submit();
  
})

// Price Filter
$('.aa-filter-btn').click(function(e){
  e.preventDefault();
  var start_price=$('#skip-value-lower').text();
  var end_price=$('#skip-value-upper').text();
  $('#category_filter .start_price').attr('value',start_price)
  $('#category_filter .end_price').attr('value',end_price)
  $('#category_filter').submit();
})

// Search

$('#search').click(function(e){
  e.preventDefault();

  var search = $('#search_content').val();
  if(search != '')
  {
    window.location.href='/search/'+search+''
  }
})

//  Registration

$(document).on('click','#register_btn',function(event){
  event.preventDefault();

  $.ajax({
    url:'/register',
    data:$('#helo').serialize(),
    dataType:"json",
    success: function(response){
    
      if(response.status=='Error')
      {
      $('#helo span').remove();
      
      jQuery.each(response.error,function(key,val){
       
          $('#helo [name='+key+']').after('<span class="r_alert alert-danger" >'+val+'</span>');
      })
    }
    if(response.status=='success')
    {
       $('.success_registration').addClass('r_success').html(response.msg);
       $('#helo')[0].reset();
    }
   

    
    }
  })
})

// Login Customer
$('#login_user').click(function(e){
  e.preventDefault(); 
 
  $.ajax({
    url:'/login_customer',
    data:$('#customer_login').serialize(),
    dataType:"json",
    type:"post",
    success: function(response){
      $('.login_status').removeClass('alert-danger').empty();
      $('#customer_login span').remove(); 
      if(response.status=='Error')
      {
       jQuery.each(response.error,function(key,val){
       
          $('#customer_login [name='+key+']').after('<span class="r_alert alert-danger" >'+val+'</span>');
      })
    }
    if(response.status=='invalid_email')
    {
      $('.login_status').addClass('r_alert alert-danger').html(response.msg);
      
    }
    if(response.status=='invalid_password')
    {
      $('.login_status').addClass('r_alert alert-danger').html(response.msg);
      
    }
    if(response.status=='success')
    {
      window.location.href='/'
      
    }
      
    if(response.status=='NotValid')
    {
      $('.login_status').addClass('r_alert alert-danger').html(response.msg);
    }
    
    }
  })
})

// Coupon Code

$('.apc').click(function(e){
  e.preventDefault()
 var code = $('.aa-coupon-code').val()
  if(code!='')
  {
    
  $.ajax({
    url:'/coupon_code',
    type:'post',
    data:{coupon_code:code,_token:$('[name=_token]').val()},
    dataType:"json",
    type:"post",
    success: function(response){
      if(response.status=='invalid')
      {
        $('.coupon_panel').html('<div class="alert alert-danger mt-5" role="alert">'+response.msg+'</div>')
      }
      if(response.status=='min_order_am')
      {
        $('.coupon_panel').html('<div class="alert alert-danger mt-5" role="alert">'+response.msg+'</div>')
      }
      if(response.status=='deactivate')
      {
        $('.coupon_panel').html('<div class="alert alert-danger mt-5" role="alert">'+response.msg+'</div>')
      }
      if(response.status=='success')
      {
        $('.applied_code').removeClass('hide')
        $('.applied_code th').removeClass('hide').html(response.msg + '<br><a href="" class="remove_coupon_code">Remove</a>')
        $('.applied_code td').removeClass('hide').html(code)
        $('.aapc_total td').html(response.total)
        $('.aa-checkout-coupon').addClass('hide');
      }
      
    }
  })
  }
  else
  {
    $('.coupon_panel').html('<div class="alert alert-danger mt-5" role="alert">Please add a Copuon Code</div>')
  }
})

// Remove Coupon Code
$(document).on('click','.remove_coupon_code',function(e){
  e.preventDefault()
 var code = $('.aa-coupon-code').val()
$('.applied_code').addClass('hide')
    
  $.ajax({
    url:'/remove_coupon_code',
    data:{coupon_code:code,_token:$('[name=_token]').val()},
    dataType:"json",
    type:"post",
    success: function(response){
      $('.aapc_total td').html(response.total)
      $('.aa-checkout-coupon').removeClass('hide');
      $('.aa-coupon-code').val('')
    }
  })
 
 
})

// Place Order
$('#place_order').click(function(e){
  e.preventDefault();

  $.ajax({
    url:'/place_order',
    data:$('#items_order').serialize(),
    dataType:"json",
    type:"post",
    success: function(response){
    
    }
  })
})
}) // End of Document ready