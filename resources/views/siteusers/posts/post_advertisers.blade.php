@extends('master.webusers.body.index')
@section('website_title')
	ADVERTISE POST MARKETING COMPANYNAMEHERE
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
      .colourblackcenter{
        color: black;
      }
    </style>


<!-- <main> -->

	<!-- Category Name -->
    <section class="hero_in tours" style="height: 120px">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp" style="font-size: 20px;font-weight: 100;"><span></span>
             {{$company_name}}
          </h1>
        </div>
      </div>
    </section>
    <!--/hero_in-->


        <div class="container-fluid margin_20_35" style="padding-right: 5%;padding-left: 5%;background-color: white;">
      <div class="row">

      	<!-- Search Products -->
<!--       				<div class="col-lg-12">
				<div class="row no-gutters custom-search-input-2 inner">
					<div class="col-sm-7 ">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="What are you looking for...">
							<i class="icon_search"></i>
						</div>
					</div>
					<div class="col-lg-3">
						<select class="wide">
							<option>All Categories</option>	
							<option>Restaurants</option>
							<option>Bars</option>
							<option>Coffee Bars</option>
						</select>
					</div>
					<div class="col-lg-2">
						<input type="submit" class="btn_search" value="Search">
					</div>
				</div>
 -->				<!-- /row -->
			<!-- </div> -->
			<!-- /custom-search-input-2 -->
        @php 

        $checked_categoryies = [];  
        $sub_checked_categoryies = [];
        $vailable_advertiesments = [];  

        @endphp

        @foreach($load_company_advertiesments as $company_posts_data)
              
              <!--  -->
              @if(!array_key_exists($company_posts_data->pmid,$checked_categoryies))
                <?php   
                  $matchin_founded = false;
                  for($cnt = 0 ; $cnt < count($checked_categoryies) ; $cnt++) {
                    foreach ($checked_categoryies[$cnt] as $key => $value) {
                      if($key == $company_posts_data->pmid ){
                          $matchin_founded = true;
                      }
                    }
                  }
                  if($matchin_founded == false){
                    array_push( $checked_categoryies,array($company_posts_data->pmid => $company_posts_data->pmname));
                  }
 
                ?>
              @endif

              @if(!array_key_exists($company_posts_data->psmid, $sub_checked_categoryies))
                <?php array_push( $sub_checked_categoryies,array($company_posts_data->psmid => $company_posts_data->psname) ); ?>
              @endif              
              
              @php
                $ptitle=$company_posts_data->ptitle;
                $pid=$company_posts_data->pid;
                $pcreated = \Carbon\Carbon::create($company_posts_data->pcreated)->diffForHumans();
                $post_info_array = array($pid => array(
                      "pmid" => $company_posts_data->pmid,
                      "psmid" => $company_posts_data->psmid,
                      "ptitle" => $ptitle,
                      "pid" => $pid,
                      "displayimage" => $company_posts_data->pimagedisplay,
                      "pcreated" => $pcreated,
                      "pispromotion" => $company_posts_data->pispromotion,
                      "ppostprice" => $company_posts_data->ppostprice,
                      "ppromotionprice" => $company_posts_data->ppromotionprice 
                ));
                array_push($vailable_advertiesments,$post_info_array);  
              @endphp

        @endforeach

        @php $checked_categoryies; @endphp
        @php $vailable_advertiesments; @endphp   
        @php $sub_checked_categoryies; @endphp     
        
        <div class="col-lg-12">

            <!-- Start category -->
       <!--      <div class="row">
               <div class="col-sm-6 col-lg-3 col-md-4 ">
                 <a href="">
                   <div class="card text-center category_select">
                      <div class="card-body">
                        Category
                      </div>
                    </div>
                 </a>
               </div>
            </div> -->
            <!-- End category -->
            <br><br>

            @php 

              $make_ordered_category = '';
              $make_ordered_posts = '';

            @endphp  

            @php 
              $next_array_master_id_value = 0;
              $is_title_printed = false;
              $is_sub_category_breaked = false;
              $now_ongoing_array_master_key = 0;
              $now_ongoing_array__submaster_key = 0; 
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


<!--               <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-touch="true">
                <div class="carousel-inner">
                  <div class="carousel-item active"> -->
        			
                <div class="row" >	
                 
                 @for($posts = 0 ; $posts < count($vailable_advertiesments) ; $posts++)  

                  @foreach($vailable_advertiesments[$posts] as $data) 

                  @if($data["pmid"] == $now_ongoing_array_master_key)

                  @if($data["psmid"] != $now_ongoing_array__submaster_key)
                    @php
                      $now_ongoing_array__submaster_key = $data["psmid"];
                      echo "</div>";
                      echo "<div class='row'>";
                    @endphp
                        
                  @endif
                  
                  <!-- Post print -->
                  <div class="col-sm-6 col-md-3 col-lg-2  padding_5555">
                      <a target="_blank" href="{{route('single_advetrtisers',['post_name_title'=>$data['ptitle'],'sec'=>base64_encode($data['pid']+1502154+58254282),'sect'=>false] )}}">   
                      <div class="card text-left post_ad_color post_ad_color" >
                    <img src="{{asset($data['displayimage'])}}" alt="{{$data['ptitle']}}" style="width: 100%;height: 140px;">
                    <div class="card-body">
                      <p class="card-text" style="font-size: 15px;color: black;margin-bottom: 0px;text-transform: capitalize;">
                        {{$data["ptitle"]}} 
                     </p>
                      <p class="card-text" style="margin-bottom: 4px"><small class="text-muted">
                          {{$data["pcreated"]}}        
                      </small>@if($data["pispromotion"] == 109)<small style="float: right;padding-top: 4px;">Limited Offer</small>@endif
                       <br>
                       <center class="colourblackcenter">{{session('user_convert_currency_type')}}</center>
                       <hr style="margin: 2px 0 5px 0;border-color: #ededed;">
                       @if($data["pispromotion"] == 109)
                       <p style="display: flex;"><span class="offer_load_spinner" style="background-color: white;">{{number_format($data["ppostprice"],2)}}</span><span class="offer_load_spinner_1" style="background-color: white;text-align: center;">&nbsp;|</span><span class="offer_load_spinner_2" style="background-color: white;text-align: end;">{{number_format($data["ppromotionprice"],2)}}</span></p> 
                      @elseif($data["pispromotion"] == 110)
                       <p style="display: flex;"><span class="offer_load_spinner_2" style="background-color: white">{{number_format($data["ppostprice"],2)}}</span></p> 
                      @endif

                      </p>

                    </div>
                  </div>
                  </a>
                  </div>
                  <!-- Post print -->



                  <!-- Remove which post are printed -->
                  @php
        					 $post_id_key = $data["pid"];
                   unset($vailable_advertiesments[$posts][$post_id_key]); 
                  @endphp 
                  <!-- Remove which post are printed -->  

                  <!-- If key not exist then break the loop. If array length 100 and only two elements matches > then 98 of loop are wasted. so it break the loop and get the new master products -->
                  @else
                      @break;
                  @endif

                  @endforeach
                  
                  @php

                    if(count($vailable_advertiesments) == ($posts+1) ){
                  
                      $is_title_printed = false;
                  
                    }
                  
                  @endphp

                  @endfor

      					        					        					        					
        				</div>
<!--                   </div>
                </div>
              </div> -->

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
					</nav> -->
					<!-- /pagination -->

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
                  <div class="carousel-item">
      <div class="grid">
        <ul class="magnific-gallery">
          
             <li>
            <figure>
              <img src="https://wallpaperaccess.com/full/147448.jpg" alt="">
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
    <div class="carousel-item">
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




       <!--  <div class="bg_color_1">
      <div class="container margin_60_35"> -->
      <!--   <div class="row">
          <div class="col-md-4">
            <a href="#0" class="boxed_list">
              <i class="pe-7s-help2"></i>
              <h4>Need Help? Contact us</h4>
              <p>Cum appareat maiestatis interpretaris et, et sit.</p>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#0" class="boxed_list">
              <i class="pe-7s-wallet"></i>
              <h4>Payments</h4>
              <p>Qui ea nemore eruditi, magna prima possit eu mei.</p>
            </a>
          </div>
          <div class="col-md-4">
            <a href="#0" class="boxed_list">
              <i class="pe-7s-note2"></i>
              <h4>Cancel Policy</h4>
              <p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>
            </a>
          </div>
        </div> -->
        <!-- /row -->
      <!-- </div> -->
      <!-- /container -->
    <!-- </div> -->
    <!-- /bg_color_1 -->

@endsection	