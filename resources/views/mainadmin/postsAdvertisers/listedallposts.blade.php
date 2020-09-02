@extends('master.mainadmin.index')
@section('title_of_page')
	Listed Posts
@endsection


@section('content_to_body')
<style type="text/css">
  .img-center{
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
  }
  #make_process{
    display: none;
  }
  .operation_status{
    background-color: #fffab4;
    padding: 16px 9px 1px 36px;
    border: 1px solid #918b34;
    display: none;
  }
  #fromCount,#toCount{
    font-weight: bold;
  }
  #post_created_success_fully{
    background-color: #fffab4;
    padding: 16px 9px 1px 36px;
    border: 1px solid #918b34;
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
          <li class="breadcrumb-item"><a href="#">Uploaded Posts</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">  

        <div class="tile"> 
        @if(Session::get('post_update_status') == 200)
          <div id="post_created_success_fully">
            <p>Advertiesment deleted successfully</p>
        </div>
        @endif  
        <div class="operation_status">
            <p><b>Review!</b> effected <span id="fromCount">0</span> advertiesment/s from<span id="toCount">0</span> Sended. </p>
        </div>  
             <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="button" id="make_approval_on_advertiesments"><i class="fa fa-fw fa-lg fa-check-circle"></i>Advertise To Public</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" id="make_rejected_on_advertiesments" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Do Not Display</button>
                </div>
              </div>
            </div>
            <br>
          <div class="tile-body table-responsive">
              <table class="table table-sm table-hover table-bordered" id="userPostsedTable">
                <thead>
                  <tr>
                    <th width="10">Select</th>
                    <th width="200">Post Id</th>
                    <th width="100">Post Snap</th>
                    <th>Title</th>
                    <th>Advertiser</th>
                    <th width="100">Added On</th>
                    <th width="150">Location</th>
                    <th width="60">Ad Live</th>
                    <th width="80">Status</th>
                    <th width="100">Option</th>
                  </tr>
                </thead>
                <tbody>
                 	@forelse($available_listed_posts as $key => $posts)

                    <tr>
                        <td style="vertical-align: middle;text-align: center;">
                          <div class="animated-checkbox">
                            <label>
                              <input type="checkbox" class="checking_process" value="{{$posts->pid+(37*125)}}"><span class="label-text"></span>
                            </label>
                          </div>
                        </td>
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
                            <a href="{{route('single_delete_list_post_list',['cq'=>base64_encode($posts->pid/2*5),'q'=>base64_encode($posts->ptitle),'co'=>base64_encode($posts->pacompanyid/2*5+0.25)])}}" class="btn btn-sm btn-danger" target="_self"> Delete </a>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="10">No Posts Found</td>
                    </tr>

                    @endforelse
                 </tbody>
                </table> 
            </div>
          </div>
         </div>
        </div>
        </main>

<script>
  
  let getAll = [];
  $(".checking_process").on("click",function(data){
      let thisValue = data.currentTarget.value;
      if( $(this).is(":checked") == true ){
         getAll.push(thisValue);
      }else{
         getAll.pop(thisValue);
      }
  });


  function make_collect_of_adding_data(data){
      let thisValue = data;
      if( $(this).is(":checked") == true ){
         getAll.push(thisValue);
      }else{
         getAll.pop(thisValue);
      }
     
  }

  $(document).ready(function(){

    let process_started_apt = false;
    $("#make_approval_on_advertiesments").on("click",function(data){
      process_started_apt = true;
      if(process_started_apt){
        $("#make_process").css("display","block");
      }
      var getAllCount = getAll.length;
      
      if(getAllCount > 0 && process_started_apt){
        $(".operation_status").css("display","none");
        $.ajax({
          url:encodeURI('{{route('make_approval_bulk_checked',["operation_type"=>base64_encode(rand(50,100)*500) , "process"=>true,"valid" => "update"])}}'),
          method:"POST",
          data:{
            "data" : getAll
          },
          beforeSend:function(request){
            return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
          },
          success:function(data){
            var ret = JSON.parse(data);
            var checkCount =   ret.returnRows.split("|");
            $("#fromCount").html(checkCount[1]);
            $("#toCount").html(checkCount[0]);
            $(".operation_status").css("display","block");
            process_started_apt = false;
            if(process_started_apt == false){
              $("#make_process").css("display","none");
            }
          },
          error:function(data,error){
            console.log(error);
            $(".operation_status").css("display","block");
            process_started_apt = false;
            if(process_started_apt == false){
              $("#make_process").css("display","none");
            }
          }
        });     
      }else{
        alert("Please Select");
      }
    
    });

    let remove_process_started_apt = false;
    $("#make_rejected_on_advertiesments").on("click",function(data){
      remove_process_started_apt = true;
      if(remove_process_started_apt){
        $("#make_process").css("display","block");
      }
      var getAllCount = getAll.length;
      
      if(getAllCount > 0 && remove_process_started_apt){
        $(".operation_status").css("display","none");
        $.ajax({
          url:encodeURI('{{route('make_approval_bulk_checked',["operation_type"=>base64_encode(rand(110,120)*500) , "process"=>true,"valid" => "update"])}}'),
          method:"POST",
          data:{
            "data" : getAll
          },
          beforeSend:function(request){
            return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
          },
          success:function(data){
            var ret = JSON.parse(data);
            var checkCount =   ret.returnRows.split("|");
            $("#fromCount").html(checkCount[1]);
            $("#toCount").html(checkCount[0]);
            $(".operation_status").css("display","block");
            remove_process_started_apt = false;
            if(remove_process_started_apt == false){
              $("#make_process").css("display","none");
            }
          },
          error:function(data,error){
            console.log(error);
            $(".operation_status").css("display","block");
            remove_process_started_apt = false;
            if(remove_process_started_apt == false){
              $("#make_process").css("display","none");
            }
          }
        });     
      }else{
        alert("Please select");
      }
    
    });

  });

</script>



@endsection