@extends('master.webadmin.index')
@section('title_of_page')
	My Likes And Saved Posts
@endsection


@section('content_to_body')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-heart-o"></i>&emsp;My Wish List</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('loaddashboardscreen')}}"><i class="fa fa fa-dashboard fa-lg"></i></a></li>
          <li class="breadcrumb-item">Post</li>
          <li class="breadcrumb-item"><a href="#">Save And Liked Posts</a></li>
        </ul>
      </div>
      <div class="row">
             <div class="col-md-12">
          <div class="tile"> 
          <div class="tile-body table-responsive">
              <table class="table table-sm table-hover table-bordered" id="userPostsedTable">
                <thead>
                  <tr>
                    <th width="10%">#</th>
                    <th width="5%">Post Snap</th>
                    <th>Title</th>
                    <th width="150">Added On</th>
                    <th width="150">Advertiesment Live</th>
                    <th width="150">Status</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody> 
                  @forelse($saved_posts_by_user as $key => $postdata)
                  {{$status_of_post = '', $user_still_liked = ''}}
                  @if($postdata->is_in_system == "85")
                  <?php $status_of_post = "Active" ; ?>
                  @elseif($postdata->is_in_system == '99')
                 <?php $status_of_post = "Title Removed"; ?>
                  @endif

                  @if($postdata->is_active_to_user == "15")
                  <?php $user_still_likedv = "You Removed" ; ?>
                  @elseif($postdata->is_active_to_user == '75')
                 <?php $user_still_liked = "You Liked"; ?>
                  @endif
                  
                  <tr>
                    <td>{{sprintf("%015d",($key+1))}}</td>
                    <td><img width="50" height="50" src="{{ ( $postdata->imagelive != '' ) ? asset($postdata->imagelive) : asset('common_includes/blg/noyel_masters_logo_dark.png')  }}"></td>
                    <td>{{ucwords($postdata->ptitle)}}</td>
                    <td>{{\Carbon\Carbon::create($postdata->saved_on)->diffForHumans()}}</td>
                    <td>{{$status_of_post}}</td>
                    <td>{{$user_still_liked}}</td>
                    <td width="80">
                      <div  style="color: white" class="btn-group" role="group" aria-label="Basic example">
                
                <a  class="btn btn-sm btn-warning" href="{{route('single_advetrtisers',['post_name_title'=>$postdata->ptitle,'sec'=>base64_encode($postdata->pid+1502154+58254282),'sect'=>false] )}}" type="button"><i class="fa fa-external-link"></i></a>
                <a onclick="liked_status_post_remove('{{route('webadmin_make_post_liked_remove',['operation_name'=>'delete','def'=>base64_encode($postdata->pid*158),'state'=>false,'prom'=>rand(101,999)*25])}}')" href="#" class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></a>
              </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7"><b>No Data Found</b></td>
                  </tr>
                  @endforelse
                 </tbody>
                </table> 
            </div>
          </div>
         </div>

        </div>
        </main>  	


<script type="text/javascript">
  
  function liked_status_post_remove(checked) {
    $.notify({
      message: "<strong>Confirm</strong>! Click here to remove from your wish list.",
      url: checked,
      target: '_self'
     });
  }


</script>


@endsection