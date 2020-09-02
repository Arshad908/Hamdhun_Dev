@extends('master.webusers.body.index')
@section('website_title')
	ADVERTISE POST MARKETING PUBLISHED ADS
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
<!-- <main> -->
    
    <section class="hero_in tours">
      <div class="wrapper">
        <div class="container">
          <h1 class="fadeInUp"><span></span>
             <!-- WELCOME  -->
          </h1>
        </div>
      </div>
    </section>
    <!--/hero_in-->
    
    <div class="collapse" id="collapseMap">
      <div id="map" class="map"></div>
    </div>
    <!-- End Map -->

    <div class="container-fluid margin_60_35" style="padding-right: 5%;padding-left: 5%;">
      <div class="row">
        
        <div class="col-lg-9">
            <!-- Start category -->
            <div class="row">
              @foreach($category_data as $category_m)
               <div class="col-sm-6 col-lg-3 col-md-4 ">
                 <a target="_blank" href="{{route('categorypage_LDDTCM_categoryposts_page',['master_id'=>base64_encode($category_m->number+15482657816458),'category'=>$category_m->master_name,'check'=>base64_encode($category_m->number+7981)])}}">
                   <div class="card text-center category_select">
                      <div class="card-body">
                        {{$category_m->master_name}}
                      </div>
                    </div>
                 </a>
               </div> 
              @endforeach  
            </div>
            <!-- End category -->
            <br><br>
            @if(count($company_post_uploads) > 0 )
            <div class="main_title_3">
              <span><em></em></span>
              <h2>Advertisers</h2>
              <br><br>
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-touch="true">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="grid">
        <ul class="">
          @foreach($company_post_uploads as $company_info)
          <a target="_blank" href="{{route('advertisers_LDDTCM_view_advertisers',['company_id'=>base64_encode($company_info->cid+1954658223564),'company'=>$company_info->cname])}}">
          <li style="float: left;">
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="{{ ($company_info->cimage == '') ? asset('common_includes/blg/noyel_masters_logo_dark.png') : $company_info->cimage }}" class="card-img-top home_page_compnay_logo_display" alt="{{$company_info->cname}}">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">{{$company_info->cname}} </p>
                </div>
            </div>
          </li>
          </a>
          @endforeach
          <!-- <a href="" target="_blank">
          <li>
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">No Company {{base64_decode(session("user_location"))}}</p>
                </div>
            </div>
          </li>
          </a> -->
        </ul>
      </div>
                  </div>
<!--                                 <div class="carousel-item active">
                     <div class="grid">
        <ul class="">
          <li>
            <a href="">
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="https://wallpaperaccess.com/full/147448.jpg" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">Choose data-Id of this </p>
                </div>
            </div>
            </a>
          </li>
          <li>
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="https://wallpaperaccess.com/full/147448.jpg" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">Choose data-Id of this </p>
                </div>
            </div>
          </li>
          <li>
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="https://wallpaperaccess.com/full/147448.jpg" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">Choose data-Id of this </p>
                </div>
            </div>
          </li>
          <li>
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="https://wallpaperaccess.com/full/147448.jpg" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">Choose data-Id of this </p>
                </div>
            </div>
          </li>
        </ul>
      </div>
                  </div> -->
                </div>
              </div>
            </div>
            @endif
            <br>
            
            <!-- Start Advertisers -->

            <!-- End Advertisers -->

             <br><br>
             @if(count($company_post_searchings) > 0 )
              <div class="main_title_3">
                <span><em></em></span>
                <h2>Most Search</h2>
                <br><br>
                              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-touch="true">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="grid">
              <ul>
                <div class="row"> 
          @foreach($company_post_searchings as $company_info)
            <div class="col-sm-6 col-md-2 padding_5555">
                      <a target="_blank" href="{{route('single_advetrtisers',['post_name_title'=>$company_info->ptitle,'sec'=>base64_encode($company_info->pid+1502154+58254282),'sect'=>false ] )}}">   
                      <div class="card text-left post_ad_color post_ad_color" >
                    <img src="{{asset($company_info->pimagedisplay)}}" alt="{{$company_info->ptitle}}" style="width: 100%;height: 140px;">
                    <div class="card-body">
                      <p class="card-text" style="font-size: 15px;color: black;margin-bottom: 0px;text-transform: capitalize;">
                        {{$company_info->ptitle}} 
                     </p>
                      <p class="card-text" style="margin-bottom: 4px"><small class="text-muted">
                          {{$company_info->pcreated}}        
                      </small>@if($company_info->pispromotion == 109)<small style="float: right;padding-top: 4px;">Limited Offer</small>@endif
                       <br>
                       <center class="colourblackcenter">{{session('user_convert_currency_type')}}</center>
                       <hr style="margin: 2px 0 5px 0;border-color: #ededed;">
                       <!-- check the price type -->
                    @if($company_info->pcurrencytype == session('user_convert_currency_type') )
                       @if($company_info->pispromotion == 109)
                       <p style="display: flex;"><span class="offer_load_spinner" style="background-color: white;">{{number_format($company_info->ppostprice,2)}}</span><span class="offer_load_spinner_1" style="background-color: white;text-align: center;">&nbsp;|</span><span class="offer_load_spinner_2" style="background-color: white;text-align: end;">{{number_format($company_info->ppromotionprice,2)}}</span></p> 
                      @elseif($company_info->pispromotion == 110)
                       <p style="display: flex;"><span class="offer_load_spinner_2" style="background-color: white">{{number_format($company_info->ppostprice,2)}}</span></p> 
                      @endif
                    @else
                      @if($company_info->pispromotion == 109)
                       <p style="display: flex;"><span class="offer_load_spinner" style="background-color: white;">
                        @php
                          $master_eur_price = $company_info->pcommoneur;
                          $new_price = $master_eur_price*session('this_translated_currency_value');
                          echo number_format($new_price,2);
                        @endphp  

                       </span><span class="offer_load_spinner_1" style="background-color: white;text-align: center;">&nbsp;|</span><span class="offer_load_spinner_2" style="background-color: white;text-align: end;">
                        @php
                          $master_promotional_eur_price = $company_info->pcommonpromeur;
                          $new_price = $master_promotional_eur_price*session('this_translated_currency_value');
                          echo number_format($new_price+1,2);
                        @endphp
                      </span></p> 
                      @elseif($company_info->pispromotion == 110)
                       <p style="display: flex;"><span class="offer_load_spinner_2" style="background-color: white">
                        @php
                          $master_eur_price = $company_info->pcommoneur;
                          $new_price = $master_eur_price*session('this_translated_currency_value');
                          echo number_format($new_price+1,2);
                        @endphp 
                       </span></p> 
                      @endif
                    @endif
                      </p>

                    </div>
                  </div>
                  </a>
            </div>
          @endforeach
          <!-- <div class="col-sm-2" >
          <a href="#" target="_blank">
            <div class="card" style="border: 1px solid #dcdbdb;padding: 7px;">
                <img src="" class="card-img-top home_page_compnay_logo_display" alt="...">
                <div class="card-body text-center">
                    <p class="card-text" style="color: black">No Company</p>
                </div>
            </div>
          </a>
          </div> -->
          </div>
              </ul>
      </div>
                  </div>
                </div>
              </div>
              </div>
              @endif
              <br>
               
            <!-- Most Search Start  -->

            <!-- Most Search End  -->  
        </div>
        <!-- /col -->
        @include('siteusers.homepage.siteusers_sidebar_choosecategory',['categories_side_bar'=>$categories_side_bar])  
      </div>    
    </div>
    <!-- /container -->
    
    <!-- <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="row">
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
        </div>
        /row -->
      <!-- </div> -->
      <!-- /container    </div> -->
    <!-- /bg_color_1 -->
    
  <!-- </main> -->
  <!--/main-->
    

@endsection