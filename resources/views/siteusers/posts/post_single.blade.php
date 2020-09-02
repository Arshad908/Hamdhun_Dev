@extends('master.webusers.body.index')
@section('website_title')
	ADVERTISE POST MARKETING CATEGORYNAMEHERE
@endsection

@section('content_to_body')
<!-- <main> -->

@php

$post_id;
$post_title;
$post_content;
$post_condition;
$post_visit_link;
$post_created;
$post_expire_on;
$post_price;
$post_ispromotion;
$post_promotional_price;
$post_company;
$post_master_category;
$post_sub_category;

foreach($post_basic_info as $posts_info){
  
  $post_id = $posts_info->pid;
  $post_title = $posts_info->ptitle;
  $post_content = $posts_info->pcontent;
  $post_condition = $posts_info->pcondition;
  $post_created = $posts_info->pliveatposed;
  $post_expire_on = $posts_info->pexpireon;
  $post_visit_link = $posts_info->pvisits;
  $post_price = $posts_info->pamountprice;
  $post_ispromotion = $posts_info->pispromotion;
  $post_promotional_price = $posts_info->promotionprice;
  $post_company = $posts_info->pcompany_name;
  $post_master_category = $posts_info->psubcategory;
  $post_sub_category = $posts_info->psubcategory;

}



@endphp

	<!-- Category Name -->
    <section class="hero_in tours">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp" style="font-size: 20px;font-weight: 100;"><span></span>
             {{ucwords($post_title)}}
          </h1>
        </div>
      </div>
    </section>
    <!--/hero_in-->


    <!-- Description -->

    <div class="bg_color_1">
      <nav class="secondary_nav sticky_horizontal">
        <div class="container">
          <ul class="clearfix">
            <li><a href="#description" class="active">Description</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="#sidebar">Booking</a></li>
          </ul>
        </div>
      </nav>
      <div class="container margin_60_35">
        <div class="row">
          <div class="col-lg-8">
           <div class="container margin_60_35"> 
            <div class="grid">
              <ul class="magnific-gallery">
                @if(count($post_basic_images) > 0 )
                @foreach($post_basic_images as $images)
                <li style="height: 150px;">
                  <figure>
                    <img src="{{asset($images->pfiles)}}" alt="noydl.com">
                    <figcaption>
                      <div class="caption-content">
                        <a href="{{asset($images->pfiles)}}" title="Photo title" data-effect="mfp-zoom-in">
                          <i class="pe-7s-albums"></i>
                          <p>View</p>
                        </a>
                      </div>
                    </figcaption>
                  </figure>
                </li>
                @endforeach
               @else 
                <li style="height: 150px;">
                  <figure>
                    <img src="https://bitsofco.de/content/images/2018/12/broken-1.png" alt="">
                    <figcaption>
                      <div class="caption-content">
                        <a href="https://bitsofco.de/content/images/2018/12/broken-1.png" title="File Not Found" data-effect="mfp-zoom-in">
                          <i class="pe-7s-albums"></i>
                          <p>Not Found</p>
                        </a>
                      </div>
                    </figcaption>
                  </figure>
                </li>
                @endif                
               </ul>
              </div>
             </div>   
            <section id="description">
              <h2>Description</h2>
              {!!nl2br($post_content)!!}
              <br><br><br>
              <!-- End Map -->
            </section>
            <!-- /section -->
          
            <section id="reviews">
              <h2>Reviews</h2>
              <div class="reviews-container">
                <div class="row">
                  <div class="col-lg-3">
                    <div id="review_summary">
                      <strong>8.5</strong>
                      <em>Superb</em>
                      <small>Based on 4 reviews</small>
                    </div>
                  </div>
                  <div class="col-lg-9">
                    <div class="row">
                      <div class="col-lg-10 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                      <div class="col-lg-10 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                      <div class="col-lg-10 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                      <div class="col-lg-10 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
                    </div>
                    <!-- /row -->
                    <div class="row">
                      <div class="col-lg-10 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
                    </div>
                    <!-- /row -->
                  </div>
                </div>
                <!-- /row -->
              </div>

              <hr>

              <div class="reviews-container">

                <div class="review-box clearfix">
                  <figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
                  </figure>
                  <div class="rev-content">
                    <div class="rating">
                      <i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                    </div>
                    <div class="rev-info">
                      Admin – April 03, 2016:
                    </div>
                    <div class="rev-text">
                      <p>
                        Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                      </p>
                    </div>
                  </div>
                </div>
                <!-- /review-box -->
                <div class="review-box clearfix">
                  <figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
                  </figure>
                  <div class="rev-content">
                    <div class="rating">
                      <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                    </div>
                    <div class="rev-info">
                      Ahsan – April 01, 2016:
                    </div>
                    <div class="rev-text">
                      <p>
                        Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                      </p>
                    </div>
                  </div>
                </div>
                <!-- /review-box -->
                <div class="review-box clearfix">
                  <figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
                  </figure>
                  <div class="rev-content">
                    <div class="rating">
                      <i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
                    </div>
                    <div class="rev-info">
                      Sara – March 31, 2016:
                    </div>
                    <div class="rev-text">
                      <p>
                        Sed eget turpis a pede tempor malesuada. Vivamus quis mi at leo pulvinar hendrerit. Cum sociis natoque penatibus et magnis dis
                      </p>
                    </div>
                  </div>
                </div>
                <!-- /review-box -->
              </div>
              <!-- /review-container -->
            </section>
            <!-- /section -->
            <hr>

              <div class="add-review">
                <h5>Leave a Review</h5>
                <form>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Name and Lastname *</label>
                      <input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Email *</label>
                      <input type="email" name="email_review" id="email_review" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Rating </label>
                      <div class="custom-select-form">
                      <select name="rating_review" id="rating_review" class="wide">
                        <option value="1">1 (lowest)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5 (medium)</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10 (highest)</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Your Review</label>
                      <textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
                    </div>
                    <div class="form-group col-md-12 add_top_20">
                      <input type="submit" value="Submit" class="btn_1" id="submit-review">
                    </div>
                  </div>
                </form>
              </div>
          </div>
          <!-- /col -->
          
          <aside class="col-lg-4" id="sidebar">
            <div class="box_detail booking">

              <div class="price">
                <span>45 <small>people viewed this post</small></span>
                <!-- <div class="score"><span>Good<em>350 Reviews</em></span><strong>7.0</strong></div> -->
              </div>
              
              <h6>Advertise By</h6>
              <p>{{$post_company}}</p>

              <h6>Post Category</h6>
              <p>{{ucwords($post_master_category)}} / {{ucwords($post_sub_category)}} </p>

              <h6>Published On</h6>
              <p>{{\Carbon\Carbon::create($post_created)->diffForhumans()}}</p>

              <h6>{{($post_expire_on == '') ? '' : 'Expired On' }}</h6>
              <p>{{($post_expire_on == '') ? '' : \Carbon\Carbon::create($post_expire_on)->diffForhumans()}}</p>
              <hr>
              <ul class="share-buttons">
                <li value="liked_post" id="looking_posts_{{rand(10,99)}}{{$post_id}}_Xxaj87887AbdGTfd"><a class="fb-share" href="javascript:void(0)"><span aria-hidden="true" class="icon_like"></span>&emsp; Like</a></li>
                <li value="saved_post" id="saving_posts_{{rand(10,99)}}{{$post_id}}_{{rand()}}"><a class="twitter-share" href="javascript:void(0)"><span aria-hidden="true" class="icon_bag"></span>&emsp; Save</a></li>
              </ul>
            </div>
          </aside>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_color_1 -->

<script>
  $(document).ready(function(){
     
     $(".share-buttons li").on("click",function(data){
        let make_liked = data.currentTarget.id;
        let dd = $(this).attr("id");
        let update_like_post = data_trasfer(make_liked); 
        $.ajax({
               url:"{{route('site_user_liked_this_post')}}",
               method:"POST",
               data:{
                "like_update_post":update_like_post,
                "base_code":'<?php echo base64_encode($key); ?>'
               },
               beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
               },
               success:function(data)
               {
                  console.clear();
                  if(data){
                    $("#"+dd +" a" ).html("Success");
                  }
               },
               error:function(dd,data){
                  var data = dd.status;
               }
        });
     }); 
  });
</script>
<script type="text/javascript">
      var key = "<?=$key?>";
      function data_trasfer(form_input_value){ 
        var plaintext = form_input_value;
            encrypted = CryptoJS.AES.encrypt(JSON.stringify(plaintext), key, {format: CryptoJSAesJson}).toString();
            return encrypted;
      }
    
  </script>



@endsection    