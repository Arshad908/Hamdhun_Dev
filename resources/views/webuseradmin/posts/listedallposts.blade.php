@extends('master.webadmin.index')
@section('title_of_page')
	My Uploads
@endsection


@section('content_to_body')
<style type="text/css">
  .view_selected{
    background-color: #009688;
    padding: 5px 12px 7px 10px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }
  .remove_selected{
    background-color: red;
    padding: 5px 12px 7px 10px;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }
  #update_success{
    background-color: #eaffea;
    padding: 14px 10px 0px 25px;
    color: #225d11;
    border: 1px #135113 solid;
  }
  #update_failuer{
    background-color: #ffeaea;
    padding: 14px 10px 0px 25px;
    color: #5d1111;
    border: 1px #511313 solid;
  }  
</style>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-upload"></i>&emsp; Post</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('loaddashboardscreen')}}"><i class="fa fa fa-dashboard fa-lg"></i></a></li>
          <li class="breadcrumb-item">Post</li>
          <li class="breadcrumb-item"><a href="#">Uploaded Posts</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile"> 
          @if(Session::get('post_uploade_status') == 200)  
          <div id="update_success">
             <p>Advertiesment update successfully completed.</p> 
          </div>
          <br>
          @endif
          @if(Session::get('post_uploade_status') == 400)
          <div id="update_failuer">
             <p>Something goes wrong on update. PLease try again.</p> 
          </div>
          <br>
          @endif  
          <div class="tile-body table-responsive">
              <table class="table table-sm table-hover table-bordered" id="userPostsedTable">
                <thead>
                  <tr>
                    <th width="13%">Post Id</th>
                    <th width="6%">Post Snap</th>
                    <th>Title</th>
                    <th>Added On</th>
                    <th>Ad Live</th>
                    <th>Status</th>
                    <th width="130">Options</th>
                  </tr>
                </thead>
                <tbody>	
                  @forelse($all_listed_posts as $key => $postdata)
                  {{$status_of_post = ''}}
                  @if($postdata->plivestatus == "29")
                  <?php $status_of_post = "Pending" ; ?>
                  @elseif($postdata->plivestatus == '50')
                 <?php $status_of_post = "Removed"; ?>
                  @elseif($postdata->plivestatus == '95')
                  <?php $status_of_post = "Pending Payment" ; ?>
                  @else
                  <?php $status_of_post = "Live On Web" ; ?>
                  @endif
                  
                  <tr>
                    <td >{{sprintf("POST-%015d",($key+1))}}</td>
                    <td><img width="50" height="50"  src="{{ ( $postdata->imagelive != '' ) ? asset($postdata->imagelive) : asset('common_includes/blg/noyel_masters_logo_dark.png')  }}"></td>
                    <td width="600">{{ucwords($postdata->ptitle)}}</td>
                    <td>{{\Carbon\Carbon::create($postdata->pcreatedon)->diffForHumans()}}</td>
                    <td>{{($postdata->papproved == '0') ? "Pending" : (($postdata->papproved == '95') ? "Approved" : "Rejected") }}</td>
                    <td>{{$status_of_post}}</td>
                    <td style="padding-top: 10px"><div class="bs-component" style="margin-bottom: 15px;">
              <div  style="color: white" class="btn-group" role="group" aria-label="Basic example">
                @if($postdata->plivestatus == "29" || $postdata->plivestatus == "110")
                <a href="{{route('webadmin_make_post_edit',['operation_name'=>'edit', 'def'=>base64_encode($postdata->pid),'state'=>true,'prom'=>rand(10,99)])}}" class="btn btn-sm btn-success" type="button"><i class="fa fa-edit"></i></a>
                @endif
                <a href="{{route('webadmin_make_post_edit',['operation_name'=>'view','def'=>base64_encode($postdata->pid),'state'=>false,'prom'=>rand(1000,9999)])}}" class="btn btn-sm btn-warning" type="button"><i class="fa fa-external-link"></i></a>
                <a onclick="make_post_delete('{{route('webadmin_make_post_edit',['operation_name'=>'delete','def'=>base64_encode($postdata->pid),'state'=>false,'prom'=>rand(101,999)])}}')" href="#" class="btn btn-sm btn-danger" type="button"><i class="fa fa-trash"></i></a>
              </div>
            </div></td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7"> <b>No Data Found</b> </td>
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
  
  function make_post_delete(checked) {
    $.notify({
      message: "<strong>Confirm</strong>! Click here to delete this post",
      url: checked,
      target: '_self'
     });
  }


</script>


@endsection