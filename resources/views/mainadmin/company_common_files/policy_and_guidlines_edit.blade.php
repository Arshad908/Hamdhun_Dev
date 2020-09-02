@extends('master.mainadmin.index')
@section('title_of_page')
	Dashboard
@endsection


@section('content_to_body')
<style type="text/css" scoped="">
    .editor-content{
      padding: 10px;
      margin: 10px 0px;
      border:2px #026259 solid; 
      border-radius: 4px;
    }
    .message_for_about_us_contect,.message_for_advertsiing_policy_contect,.message_for_privacy_policy_contect{
      padding: 10px;
      border: 1px solid #1b8a3a;
      background-color: #e5e5e5;
      color: #0a0000;
      font-weight: 700;
      display: none;
      margin: 0px 0px 10px 0px;
    }
</style>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-cogs"></i> Web Settings</h1>
          <p></p>
        </div>

        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
            <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">About Us</h3>
            <div class="message_for_about_us_contect">
              <p id="message"></p>
            </div>
            <!-- About us content -->
            <textarea spellcheck="true" class="form-control" rows="15" cols="20" id="summernote_about_us">{{$dds[0]["value"]}}</textarea>
            <!-- About us content end -->
            <br>
            <button id="noydl_web_company_content_about_us" name="noydl_web_company_content_about_us" data-type="button" class="btn btn-primary">Update Content</button>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Privacy and Policy</h3>
            <div class="message_for_privacy_policy_contect">
              <p id="message"></p>
            </div>
            <textarea spellcheck="true" class="form-control" rows="15" cols="20" id="summernote_policy_update">{{$dds[1]["value"]}}</textarea>
            <br>
            <button id="noydl_web_company_content_privacy_and_policy" name="noydl_web_company_content_privacy_and_policy" data-type="button" class="btn btn-primary">Update Content</button>
          </div>
        </div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Advertising Policy</h3>
            <div class="message_for_advertsiing_policy_contect">
              <p id="message"></p>
            </div>
<textarea spellcheck="true" class="form-control" rows="15" cols="20" id="summernote_advertiestment_policy">{{$dds[2]["value"]}}</textarea>
            <br/>
            <button id="noydl_web_company_content_advertising_policy" name="noydl_web_company_content_advertising_policy" data-type="button" class="btn btn-primary">Update Content</button>
          </div>
        </div>
 

  
      </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

<script type="text/javascript">
  $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      }); 
      $("#noydl_web_company_content_about_us").on("click",function(){
            let about_us_webcontent = $("#summernote_about_us").val(); 
              
             $.ajax({
                url: "{{route('add_admin_about_us_content')}}",
                method: 'post',
                async:false,
                dataType:"json",
                data: {
                  'master_cat' : about_us_webcontent,
                  'mode_id' : "<?php base64_encode("about_us")?>"
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
                },
                success:function(registerStatus){
                  var datares = registerStatus.status;
                  if(datares == 222){
                    load_content_data("about_us");
                    $(".message_for_about_us_contect").css("display","block");
                    $(".message_for_about_us_contect #message").html("You have updated successfully");
                  }else{
                    $(".message_for_about_us_contect").css("display","block");
                    $(".message_for_about_us_contect #message").html("Something went wrong. Please try again.");
                  }
                },
                error:function(xhr,xht){
                    $(".message_for_about_us_contect").css("display","block");
                    $(".message_for_about_us_contect #message").html("Something went wrong. PLease try again.");
                }
              });

      });

      function load_content_data(type_of_content){
        
      } 


      $("#noydl_web_company_content_privacy_and_policy").on("click",function(){
            let privacy_policy_webcontent = $("#summernote_policy_update").val();  
             $.ajax({
                url: "{{route('add_admin_privacy_and_content')}}",
                method: 'post',
                async:false,
                dataType:"json",
                data: {
                  'master_cat' : privacy_policy_webcontent,
                  'mode_id' : "<?php base64_encode("privacy_content"); ?>"
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
                },
                success:function(registerStatus){
                  var datares = registerStatus.status;
                  if(datares == 222){
                    load_content_data("privacy_content");
                    $(".message_for_privacy_policy_contect").css("display","block");
                    $(".message_for_privacy_policy_contect #message").html("You have updated successfully");
                  }else{
                    $(".message_for_privacy_policy_contect").css("display","block");
                    $(".message_for_privacy_policy_contect #message").html("Something went wrong. Please try again.");
                  }
                },
                error:function(xhr,xht){
                    $(".message_for_privacy_policy_contect").css("display","block");
                    $(".message_for_privacy_policy_contect #message").html("Something went wrong. Please try again.");
                }
              });

      });

      $("#noydl_web_company_content_advertising_policy").on("click",function(){
            let privacy_policy_webcontent = $("#summernote_advertiestment_policy").val();  
             $.ajax({
                url: "{{route('add_admin_advertising_poicy_update')}}",
                method: 'post',
                async:false,
                dataType:"json",
                data: {
                  'master_cat' : privacy_policy_webcontent,
                  'mode_id' : "<?php echo base64_encode("advertising_policy"); ?>"
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
                },
                success:function(registerStatus){
                  var datares = registerStatus.status;
                  if(datares == 222){
                    load_content_data("advertising_policy");
                    $(".message_for_advertsiing_policy_contect").css("display","block");
                    $(".message_for_advertsiing_policy_contect #message").html("You have updated successfully");
                  }else{
                    $(".message_for_advertsiing_policy_contect").css("display","block");
                    $(".message_for_advertsiing_policy_contect #message").html("Something went wrong. Please try again.");
                  }
                },
                error:function(xhr,xht){
                    $(".message_for_advertsiing_policy_contect").css("display","block");
                    $(".message_for_advertsiing_policy_contect #message").html("Something went wrong. Please try again.");
                }
              });

      });



  });  
</script>

@endsection  	