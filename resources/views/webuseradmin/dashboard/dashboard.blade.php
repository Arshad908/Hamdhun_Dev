@extends('master.webadmin.index')
@section('title_of_page')
	Dashboard
@endsection


@section('content_to_body')
    <style>
      #buttons-up-lines{
        font-weight: 400;
      }
      .social-card-header{
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    height: 96px;
}
.social-card-header i {
    font-size: 32px;
    color:#FFF;
}
.bg-facebook {
    background-color:#3b5998;
}
.text-facebook {
    color:#3b5998;
}
.bg-google-plus{
    background-color:#dd4b39;
}
.text-google-plus {
    color:#dd4b39;
}
.bg-twitter {
    background-color:#1da1f2;
}
.text-twitter {
    color:#1da1f2;
}
.bg-pinterest {
    background-color:#bd081c;
}
.text-pinterest {
    color:#bd081c;
}
.share:hover {
        text-decoration: none;
    opacity: 0.8;
}
    </style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i>&emsp;Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      @if(session("account_type") == 114)
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Post on live</h4>
              <p><b>{{$listed_all_onlive}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-heart fa-3x"></i>
            <div class="info">
              <h4>Wish list</h4>
              <p><b>{{$listed_all_wishlisted}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Payment State</h4>
              <p><b>0 Pending</b></p>
            </div>
          </div>
        </div>
      </div>
      @endif
       <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
           <div class="col-lg-12">
              <h5 class="mb-3 line-head" id="buttons-up-lines">Latest Viewed Advertiesments</h5>
            </div>
          </div>
        </div>
        <div class="row">
              @forelse($latest_viewed_posts as $viwed_post)
                @php
                  $vactive = 0;
                @endphp
                @if($viwed_post->pstatus == 95 && $viwed_post->pactives == 110 )
                  @php
                    $vactive = 1;
                  @endphp
                @endif
              <div class="col-sm-2" style="width: 100%">
               <div class="card">
                  <img class="card-img-top" src="{{assets($viwed_post->pimage)}}" alt="Card image cap">
                  <div class="card-body">
                     <h6 style="font-weight: 100" class="card-title border-bottom pb-3">{{$viwed_post->ptitle}}</h6>
                     {{\Carbon\Carbon::create($viwed_post->pdate)->diffForHumans()}}<a href="@if($vactive == 1) {{route('single_advetrtisers',['post_name_title'=>$viwed_post->ptitle,'sec'=>base64_encode($viwed_post->pid+1502154+58254282),'sect'=>false] )}} @endif" class="float-right">View<i class="fa  fa-link"></i></a>
                  </div>
               </div>
              </div>
              @empty
                <p style="padding: 0px 0px 0px 1%;font-weight: 500;">No viewed found</p>  
              @endforelse
       </div>
       </div>

      @if(session("account_type") == 114)
       <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
           <div class="col-lg-12">
              <h5 class="mb-3 line-head" id="buttons-up-lines">Latest Viewed Advertiesments</h5>
            </div>
          </div>
        </div>
        <div class="row">
              @forelse($listed_all_wishlisted_details as $wishlisted_post)
                @php
                  $active = 0;
                @endphp
                @if($wishlisted_post->pstatus == 95 && $wishlisted_post->pactives == 110 )
                  @php
                    $active = 1;
                  @endphp
                @endif
              <div class="col-sm-2" style="width: 100%">
               <div class="card">
                  <img class="card-img-top" src="{{assets($viwed_post->pimage)}}" alt="Card image cap">
                  <div class="card-body">
                     <h6 style="font-weight: 100" class="card-title border-bottom pb-3">{{assets($viwed_post->ptitle)}}</h6>
                     {{\Carbon\Carbon::create($wishlisted_post->pdate)->diffForHumans()}}<a href="@if($active == 1) {{route('single_advetrtisers',['post_name_title'=>$wishlisted_post->ptitle,'sec'=>base64_encode($wishlisted_post->pid+1502154+58254282),'sect'=>false] )}} @endif" class="float-right">View<i class="fa fa-star"></i></a>
                  </div>
               </div>
              </div>
              @empty
                <p style="padding: 0px 0px 0px 1%;font-weight: 500;">Wishlist empty</p>  
              @endforelse
       </div>
       </div>
       @endif
  	</main>
@endsection  	