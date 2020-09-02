@extends('master.mainadmin.index')
@section('title_of_page')
	View Post 
@endsection


@section('content_to_body')
<style type="text/css">
	.table tbody tr td:first-child{
		width:250px;
		white-space: nowrap;
	}
	.table tbody tr td{
		border-top: none;
	}
  .advertise{
    padding: 0.5% 1%;
    font-weight: 800; 
  }
  .update_success{
    display: none;
    background-color: #c9ddc9;
  }
  .update_failuer{
    display: none;
    background-color: #f6a7a7;
  }
</style>
<noscript></noscript>
<main class="app-content">
      @forelse($get_post_info as $posts_data)
      <div class="app-title">
        <div>
          <h1><i class="fa fa-info-o"></i>&emsp; Post Info </h1>
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
      		<div class="advertise update_success">
            <p>Halo</p>
          </div>
          <div class="advertise update_failuer">
            <p>Dele</p>
          </div>
      		<div class="table-responsive">
      		<table class="table table-hover">
      			<tbody>
      			<tr>
      				<td colspan="2">
      					<h5 style="padding-top: 5px">{{ucwords($posts_data->ptitle)}}</h5>
      				</td>
      			</tr>
      			<tr>
      				<td>Company Name</td>
      				<td>{{$posts_data->pcompanyname}}</td>
      			</tr>
      			<tr>
      				<td>Content</td>
      				<td style="overflow-wrap: anywhere;">{!!nl2br($posts_data->pcontent)!!}</td>
      			</tr>
      			<tr>
      				<td>Condition</td>
      				<td>{{ ($posts_data->pcondition == 88) ? "New"  : "Used"}}</td>
      			</tr>
      			<tr>
      				<td>Visit Link</td>
      				<td><a href="{{$posts_data->pvisitlink}}" style="overflow-wrap: anywhere;">{{$posts_data->pvisitlink}}</a></td>
      			</tr>
      			<tr>
      				<td>Price</td>
      				<td>{{number_format($posts_data->pprice,2)}} &ensp;{{$posts_data->plocationprice}}</td>
      			</tr>
      			<tr>
      				<td>Promotion</td>
      				<td>{{($posts_data->pispromotion == 109) ? "Under Promotion" : "Not Promoting"}}</td>
      			</tr>
      			<tr>
      				<td>Promotional Price</td>
      				<td>{{number_format($posts_data->promotionprice,2)}}&ensp;{{$posts_data->plocationprice}}</td>
      			</tr>
      			<tr>
      				<td>Promotion Expire</td>
      				<td>{{ ($posts_data->pexpire == "") ? "Display Till Last" : $posts_data->pexpire }}</td>
      			</tr>
      			<tr>
      				<td>Images</td>
      				<td>{{ ($posts_data->pimages == 109 ) ? "Have" : "No"}}</td>
      			</tr>
      			<tr>
      				<td>Master Category</td>
      				<td>{{ucwords($posts_data->pmcategory)}}</td>
      			</tr>
      			<tr>
      				<td>Sub Category</td>
      				<td>{{ucwords($posts_data->psubcategory)}}</td>
      			</tr>
      			<tr>
      				<td>Post Approved Status</td>
      				<td>{{($posts_data->papprooved == 8 ) ? "Rejected" : ( ($posts_data->papprooved == 95 ) ? "Approved" : "Pending For Approve" ) }}</td>
      			</tr>
      			<tr>
      				<td>Active Status</td>
      				<td>{{($posts_data->pactivestate == 29 ) ? "Pending To Approve" : ( ($posts_data->pactivestate == 50 ) ? "Deleted" : "Pending For Payment" ) }}</td>
      			</tr>
      			<tr>
      				<td>Display Area</td>
      				<td>{{($posts_data->pdisplaytype == 98 ) ? "World Wide" : "Nation Wide"}}</td>
      			</tr>
      			</tbody>	
      		</table>
      		</div>
      		
          <!-- This button display only if the post is not approved yet. it means on pending list. And active of post also in pending. If user delete this post before approve then no display this button  -->
      		@if($posts_data->papprooved ==  0 && $posts_data->pactivestate == 29)
      		<div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="button" name="public_post_approval_type_10_{{base64_encode($posts_data->pid/2*5)}}_{{base64_encode($posts_data->pcid/2*5+0.25)}}" id="public_post_approval_type_10_{{base64_encode($posts_data->pid/2*5)}}_{{base64_encode($posts_data->pcid/2*5+0.25)}}"><i class="fa fa-fw fa-lg fa-check-circle"></i>Advertise To Public</button>&nbsp;&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" name="public_post_approval_type_25_{{base64_encode($posts_data->pid/2*5)}}_{{base64_encode($posts_data->pcid/2*5+0.25)}}" id="public_post_approval_type_25_{{base64_encode($posts_data->pid/2*5)}}_{{base64_encode($posts_data->pcid/2*5+0.25)}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Do Not Display</button>
                </div>
              </div>
            </div>
            @endif
      		</div>
      </div>
     </div>
     @empty
     No data Found
     @endforelse 
</main>

<script>
	
	$(document).ready(function(data){

		$("button").on("click",function(data){
			let make_update = data.currentTarget.id;
		  let process_start = false;
      if(process_start == false){
        process_start = true;
    	$.ajax({
				url:"{{route('make_adverttise_to_public')}}",
				method:"POST",
				
				cache:false,
				async:false,
				data:{
					"dataParse" : make_update
				},
				beforeSend:function(request){
		          return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
		    },
				success:function(data){
					process_start = false;
          var data_rec = data;
          $("html, body").animate({ scrollTop: 0 }, "slow");
          if(data_rec == 200){
            $(".update_success").css("display","block");
            $(".update_failuer").css("display","none");
            $(".update_success p").html("Process completed");
          }else{
            $(".update_success").css("display","none");
            $(".update_failuer").css("display","block");
            $(".update_failuer p").html("Process not complete");
          }
				},
				error:function(data,sss){
            $("html, body").animate({ scrollTop: 0 }, "slow");
          	process_start = false;
            $(".update_success").css("display","none");
            $(".update_failuer").css("display","block");
            $(".update_failuer p").html("Process not complete");
				}
			});
      }
		});
	});

</script>

@endsection