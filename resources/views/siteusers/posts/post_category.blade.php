@extends('master.webusers.body.index')
@section('website_title')
	ADVERTISE POST MARKETING CATEGORYNAMEHERE
@endsection

@section('content_to_body')
<style type="text/css">
      .category_select{
        border: 1px solid #c5c5c5;
        text-transform: capitalize;
        color: black; 
      }
      .category_select:hover{
        color: gray; 
      }
      .offer_load_spinner{
        text-decoration: line-through;
        color: black;
        background-color:white;
      }
      .offer_load_spinner_1{
        background-color:white;
        color: black;
      }
      .offer_load_spinner_2{
        color: black;
        background-color:white;
      }
    </style>
<main>

	<!-- Category Name -->
    <section class="hero_in tours" style="height: 120px">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp" style="font-size: 20px;font-weight: 100;"><span></span>
              {{$category_name}}
          </h1>
        </div>
      </div>
    </section>
    <!--/hero_in-->


        <div class="container-fluid margin_20_35" style="padding-right: 5%;padding-left: 5%;">
      <div class="row">

      	<!-- Search Products -->
      				<!-- <div class="col-lg-12">
				<div class="row no-gutters custom-search-input-2 inner">
					<div class="col-sm-7 ">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="What are you looking for...">
							<i class="icon_search"></i>
						</div>
					</div>
					<div class="col-lg-3">
						<select class="wide" >
							<option>All Categories</option>	
              @foreach($load_sub_category as $scategorys)
							<option value="{{$scategorys->sid}}">{{$scategorys->sname}}</option>
              @endforeach
						</select>
					</div>
					<div class="col-lg-2">
						<input type="submit" class="btn_search" value="Search">
					</div>
				</div> -->
				<!-- /row -->
		<!-- 	</div> -->
			<!-- /custom-search-input-2 -->

        <div class="col-lg-12">

          
        @php 

        $checked_categoryies = [];  
        $sub_checked_categoryies = [];
        $vailable_advertiesments = [];  

        @endphp

        @foreach($load_master_category_advertiesments as $mcategory_posts_data)
              
              @if(!array_key_exists($mcategory_posts_data->psubmasterid, $checked_categoryies))
                <?php   
                  $matchin_founded = false;
                  for($cnt = 0 ; $cnt < count($checked_categoryies) ; $cnt++) {
                    foreach ($checked_categoryies[$cnt] as $key => $value) {
                      if($key == $mcategory_posts_data->psubmasterid ){
                          $matchin_founded = true;
                      }
                    }
                  }
                  if($matchin_founded == false){
                    array_push( $checked_categoryies,array($mcategory_posts_data->psubmasterid => $mcategory_posts_data->psubname));
                  }
 
                ?>
              @endif
              
              @php
                $ptitle=$mcategory_posts_data->ptitle;
                $pid=$mcategory_posts_data->pid;
                $pcreated = \Carbon\Carbon::create($mcategory_posts_data->pcreated)->diffForHumans();
                $post_info_array = array($pid => array(
                      "psubmasterid" => $mcategory_posts_data->psubmasterid,
                      "ptitle" => $ptitle,
                      "pid" => $pid,
                      "displayimage" => $mcategory_posts_data->pimagedisplay,
                      "pcreated" => $pcreated,
                      "pispromotion" => $mcategory_posts_data->pispromotion,
                      "ppostprice" => $mcategory_posts_data->ppostprice,
                      "ppromotionprice" => $mcategory_posts_data->ppromotionprice 
                ));
                array_push($vailable_advertiesments,$post_info_array);  
              @endphp

        @endforeach

        @php $checked_categoryies; @endphp
        @php $vailable_advertiesments; @endphp 


            <!-- Start category -->
            <div class="row">
              @foreach($load_sub_category as $scategorys)
               <div class="col-sm-6 col-lg-3 col-md-4 ">
                 <a href="">
                   <div class="card text-center category_select">
                      <div class="card-body">
                        {{$scategorys->sname}}
                      </div>
                    </div>
                 </a>
               </div>
               @endforeach 
            </div>
            <!-- End category -->
            <br><br>


            @php 

              $make_ordered_category = '';
              $make_ordered_posts = '';

            @endphp  

            @php 
              $next_array_master_id_value = 0;
              $is_title_printed = false; 
              $now_ongoing_array_master_key = 0;
            @endphp

            @for($categories = 0; $categories < count($checked_categoryies) ; $categories++) 


            <div class="main_title_3">
              @php

                $mastercategorykey = array_keys($checked_categoryies[$categories]);
                for($i = 0 ; $i < 1 ; $i++){
                  $mastercategorykey = $mastercategorykey[$i];
                }
                $now_ongoing_array_master_key = $mastercategorykey;
              @endphp


              @if($is_title_printed == false)  
                
                @php $is_title_printed = true; @endphp
              <span><em></em></span>
              <h2>{{ ucwords($checked_categoryies[$categories][$mastercategorykey]) }}</h2>
              <br><br>

              @endif
        				<div class="row" >	

                  @for($posts = 0 ; $posts < count($vailable_advertiesments) ; $posts++)  

                  @foreach($vailable_advertiesments[$posts] as $data) 

                  @if($data["psubmasterid"] == $now_ongoing_array_master_key)
        					                 <div class="col-sm-6 col-md-3 col-lg-2 padding_5555">
                      <a target="_blank" href="{{route('single_advetrtisers',['post_name_title'=>$data['ptitle'],'sec'=>base64_encode($data['pid']+1502154+58254282),'sect'=>false] )}}">   
                      <div class="card text-left post_ad_color post_ad_color" >
                    <img src="{{asset($data['displayimage'])}}" alt="{{$data['ptitle']}}" style="width: 100%;height: 140px;">
                    <div class="card-body">
                      <p class="card-text" style="font-size: 15px;color: black;margin-bottom: 0px;text-transform: capitalize;">
                        {{$data["ptitle"]}}
                     </p>
                      <p class="card-text" style="margin-bottom: 4px"><small class="text-muted">
                          {{$data['pcreated']}}       
                      </small>@if($data["pispromotion"] == 109)<small style="float: right;padding-top: 4px;">Limited Offer</small>@endif
                       <br>
                       <center class="colourblackcenter">{{session('user_convert_currency_type')}}</center>
                       <hr style="margin: 2px 0 5px 0;border-color: #ededed;">
                       @if($data["pispromotion"] == 109)
                       <p style="display: flex;"><span class="offer_load_spinner" style="background-color: white;">{{number_format($data["ppostprice"],2)}}</span><span class="offer_load_spinner_1" style="background-color: white;text-align: center;">|</span><span class="offer_load_spinner_2" style="background-color: white;text-align: end;">{{number_format($data["ppromotionprice"],2)}}</span></p> 
                      @elseif($data["pispromotion"] == 110)
                       <p style="display: flex;"><span class="offer_load_spinner_2" style="background-color: white">{{number_format($data["ppostprice"],2)}}</span></p> 
                      @endif
                      </p>

                    </div>
                  </div>
                  </a>
                  </div>   

                   @endif

                  @endforeach
                  
                  @php

                    if(count($vailable_advertiesments) == ($posts+1) ){
                  
                      $is_title_printed = false;
                  
                    }
                  
                  @endphp

                  @endfor



        				</div>

<!--               		<nav aria-label="...">
						<ul class="pagination pagination-sm">
							<li class="page-item disabled">
								<a class="page-link" href="#" tabindex="-1">Previous</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#">Next</a>
							</li>
						</ul>
					</nav>
					 /pagination --> 

            </div>

            @endfor  

            <br>
            
            <!-- Start Advertisers -->

            <!-- End Advertisers -->

             <br><br>
<!--               <div class="main_title_3">
                <span><em></em></span>
                <h2>Category Three</h2>
                <br><br>
                              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-touch="true">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="grid">
        <ul class="magnific-gallery">
          <li>
            <figure>
              <a href="#">
              <img src="https://wallpaperaccess.com/full/147448.jpg" alt="">
              </a>
              <figcaption>
                <div class="caption-content">
                  <a href="https://wallpaperaccess.com/full/147448.jpg" title="Photo title" data-effect="mfp-zoom-in">
                    <i class="pe-7s-albums"></i>
                    <p>Your caption</p>
                  </a>
                </div>
              </figcaption>
            </figure>
          </li>
        </ul>
      </div>
                  </div>
                </div>
              </div>
              </div> -->
              <br>
               
            <!-- Most Search Start  -->

            <!-- Most Search End  -->  
        </div>
        <!-- /col -->


        <!-- include('siteusers.homepage.siteusers_sidebar_choosecategory') -->  
      </div>    
    </div>
    <!-- /container -->

 </main>   

@endsection	