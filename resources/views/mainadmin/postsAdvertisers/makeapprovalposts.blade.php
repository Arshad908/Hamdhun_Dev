@extends('master.mainadmin.index')
@section('title_of_page')
	Pending Posts
@endsection


@section('content_to_body')
<style type="text/css">
  .img-center{
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;

  }
</style>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-o"></i> Post</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Post</li>
          <li class="breadcrumb-item"><a href="#">Pending Posts</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile"> 
          <div class="tile-body table-responsive">
              <table class="table table-sm table-hover table-bordered" id="userPostsedTable">
                <thead>
                  <tr>
                    <th width="200">#</th>
                    <th width="100">Post Snap</th>
                    <th>Title</th>
                    <th>Advertiser</th>
                    <th width="120">Added On</th>
                    <th width="150">Location</th>
                    <th width="50">Ad Live</th>
                    <th width="100">Status</th>
                    <th width="100">Option</th>
                  </tr>
                </thead>
                <tbody>
                 	  @forelse($available_listed_posts_not_approved as $posts)

                    <tr>
                        <td>{{sprintf("POST-%015d",$posts->pid)}}</td>
                        <td>
                          <img class="img-center" width="75" height="75" src="{{ ($posts->imagelive != '')  ? asset($posts->imagelive) : asset('common_includes/blg/noyel_masters_logo_dark.png') }}">
                        </td>
                        <td>{{ucwords($posts->ptitle)}}</td>
                        <td>{{$posts->pcompany}}</td>
                        <td>{{\Carbon\Carbon::create($posts->pcreated)->diffForHumans()}}</td>
                        <td>{{$posts->pcountry}}</td>
                        <td>{{ ($posts->plive == 29) ? 'Pending' : (($posts->plive == 50) ? 'Deleted' : (($posts->plive == 110) ? "Live" : "Pending For Payment" )   )}}</td>
                        <td>{{ ($posts->papproved == 95) ? "Approved" : (($posts->papproved == 8) ? 'Rejected' : "Not Confirmed" )}}</td>
                        <td>
                            <a href="{{route('view_individual_load_post',['id'=>$posts->pid,'q'=>base64_encode($posts->ptitle),'co'=>base64_encode($posts->pid+15480)])}}" class="btn btn-sm btn-success">View</a> 
                            <a href="{{route('single_delete_list_post_list',['cq'=>base64_encode($posts->pid/2*5),'q'=>base64_encode($posts->ptitle),'co'=>'check'])}}" target="_self" class="btn btn-sm btn-danger"> Delete </a>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="9">No Posts Found To Approve</td>
                    </tr>

                    @endforelse
                 </tbody>
                </table> 
            </div>
          </div>
         </div>
        </div>
        </main>

@endsection