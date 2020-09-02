@extends('master.webadmin.index')
@section('title_of_page')
  Edit Post
@endsection


@section('content_to_body')

@if(session("account_type") == 114 && session("card_info_saved") == true)
 <style>
   #make_user_new_upload{
      width: 100%;
   }
   .error_input_cls{
      border: 2px red solid; 
   }
   .error_input_text{
    color: red;
   }
   #ndl_make_title_post_error,#ndl_make_content_of_post_error,#mstr_select_actegory_error,#sebs_select_catdry_error,#ndl_make_price_chanrge_of_post_error,#ndl_make_pro_price_chanrge_of_post_error,#ndl_make_pro_date_chanrge_of_post_error{
    display: none;
   }
   #post_created_success_fully{
    text-align: center;
    padding: 19px 0px 10px 0px;
    background-color: #cdd0ce;
    margin-bottom: 30px;
    border: 2px #243e24 solid;
   }
   #post_created_failuer{
    text-align: center;
    padding: 19px 0px 10px 0px;
    background-color: #f0d6d6;
    margin-bottom: 30px;
    border: 2px #c60a0a solid;
   }
   .texting_subcategory{
    text-transform: capitalize;
   }
   #promotional_advertising_price_form,#promotional_advertising_date_form{
    display: none;
   }
 </style>
 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="icon fa fa-file-o">&emsp;</i> Post</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('loaddashboardscreen')}}"><i class="fa fa fa-dashboard fa-lg"></i></a></li>
          <li class="breadcrumb-item">Post</li>
          <li class="breadcrumb-item"><a href="#">Create Post</a></li>
        </ul>
      </div>
      <div class="row">
        <form  id="make_user_new_upload" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="tile">
          <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="mb-3 line-head" id="buttons">Post Informations</h2>
            </div>
           
          </div>
          </div>
          @if(Session::get('post_uploade_status') == 200)
           <div class="success post_created" id="post_created_success_fully">
              <h5>Well Done. Post updated successfully. Process started to comfirm</h5>
            </div>
          @endif  
          @if(Session::get('post_uploade_status') == 400)
            <div class="success post_not_created" id="post_created_failuer">
              <h5>Please try again</h5>
            </div>
          @endif  
          <div class="row">
          <div class="clearfix"></div>
          @csrf
          @foreach($post_data as $post_info_data)
          <div class="col-sm-6">
              <div class="col-md-12 mb-4" id="">
                      <label>Title Of Post *</label>
                   <input class="form-control" type="text" name="ndl_make_title_post" id="ndl_make_title_post" value="{{$post_info_data->ptitle}}">
                   <small class="error_input_text" id="ndl_make_title_post_error">Input size between 5 to 50</small>
              </div>
               <div class="col-md-12 mb-4" id="">
                      <label>Content Of Post *</label>
                   <textarea spellcheck="true" class="form-control" rows="7" cols="15" name="ndl_make_content_of_post" id="ndl_make_content_of_post">{{$post_info_data->pcontent}}</textarea>
                   <small class="error_input_text" id="ndl_make_content_of_post_error">Input size between 10 to 1000</small> 
                   <input type="hidden" name="ndl_make_content_selected" id="ndl_make_content_selected" value="{{base64_encode($post_info_data->pid+105248549)}}">
                   <input type="hidden" name="ndl_make_content_image_selected" id="ndl_make_content_ image_selected" value="{{base64_encode($post_info_data->pdisplaypic)}}">
              </div>
              <div class="col-md-12 mb-4" id="">
                      <label>Link the ad to own webpage</label><label style="float: right;" id="i_need_to_add_more_link"></label>
                   <input class="form-control" type="url" value="{{$post_info_data->pvisitlink}}" name="ndl_make_urls_of_post" id="ndl_make_urls_of_post">
              </div>
              <!-- <div class="col-md-12 mb-4" id="">
                      <label>Visit Company Link</label>
                   <input class="form-control" type="url" value="" name="ndl_make_com_vst_links_of_post" id="ndl_make_com_vst_links_of_post">
              </div> -->
              <div class="col-md-12 mb-4">
                  <label>Upload Image</label>
                  <input class="form-control" type="file" multiple name="ndl_make_files_post_of_post[]" id="ndl_make_files_post_of_post[]" accept="image/png, .jpeg, .jpg">

              </div>
          </div>
          <div class="col-sm-6">
            <div class="row">
            <?php
            
              $data = $data_Category;
              $data_j = json_decode($data);

            ?>
            <div class="col-md-6 col-sm-12 mb-4" id="">
                 <label>Main Category *</label>
                 <select class="form-control texting_subcategory" id="mstr_select_actegory" name="mstr_select_actegory">
                  @foreach($data_j[0] as $emails)
                    <option @if($post_info_data->pmaincategory+524 == $emails->mid+524 ) selected @endif  value="{{$emails->mid+524}}">{{ucfirst($emails->mname)}}</option>
                  @endforeach      
                 </select>
                 <small class="error_input_text" id="mstr_select_actegory_error">Select maincategory</small>
            </div>
            <div class="col-md-6 col-sm-12 mb-4" id="">
                 <label>Sub Category</label>
                 <select class="form-control texting_subcategory" id="sebs_select_catdry" name="sebs_select_catdry">

                 </select>
                 <small class="error_input_text" id="sebs_select_catdry_error">Select subcategory</small>
            </div>
            <div class="col-md-6 col-sm-12 mb-4" id="">
                 <label>Complementary Category</label>
                 <select class="form-control texting_subcategory" id="sebs_select_description_catdry" name="sebs_select_description_catdry">

                 </select>
            </div>
            <div class="col-md-6 col-sm-12 mb-4 " id="product_condition_display_content">
                  <label>Product Condition</label><br>
                  <div style="display: inline-flex;margin-top: 5px;">
                  <div class="animated-radio-button">
                   <label>
                          <input type="radio" @if($post_info_data->pcondition == 88 ) checked @endif name="products_conditions_delect" value="new" id="nd_products_condition_detect" ><span class="label-text"></span>New 
                        </label>
                  </div> &emsp;
                  <div class="animated-radio-button">
                   <label>
                          <input type="radio" @if($post_info_data->pcondition == 75 ) checked @endif name="products_conditions_delect" value="used" id="nd_products_condition_detect" ><span class="label-text"></span>Used 
                        </label>
                  </div>
                  </div>
              </div>

            <div class="col-md-6 col-sm-12 mb-4" id="">
                    <label>Currency Type*</label>
                   <select class="form-control" name="ndl_make_price_base_of_post" id="ndl_make_price_base_of_post"> 
                      @foreach($data_currency_nfo as $infocurency)
                        <option  @php if($infocurency->sname == base64_decode(session('user_currency'))){ echo 'selected'; }else{ echo 'disabled'; } @endphp value="{{$infocurency->sname}}">{{$infocurency->sid}} - {{$infocurency->sname}}</option>
                      @endforeach
                   </select>
              </div>
             <div class="col-md-6 col-sm-12 mb-4" id="">
                    <label>Visible Range *</label>
                   <select class="form-control" name="ndl_make_visible_range_of_post" id="ndl_make_visible_range_of_post"> 
                      <option @if(98==$post_info_data->display_word_wide) selected @endif value="@php echo base64_encode(98+5789); @endphp">Word Wide Display</option>
                      <option @if(115==$post_info_data->display_word_wide) selected @endif value="@php echo base64_encode(115+5789); @endphp">Only Local Display</option>
                   </select>
              </div> 
             <div class="col-md-6 col-sm-12 mb-4" id="">
                    <label>Price *</label>
                   <input class="form-control" value="{{number_format($post_info_data->pprice,2)}}" type="text" name="ndl_make_price_chanrge_of_post" id="ndl_make_price_chanrge_of_post">
                   <small class="error_input_text" id="ndl_make_price_chanrge_of_post_error">Price input invalid</small>
              </div>

              <div class="col-md-6 col-sm-12 mb-4" id="">
                   <label> I publish this as an offer</label>
                   <div class="animated-checkbox" style="margin-top: 5px;">
                      <label>
                        <input type="checkbox" @if($post_info_data->pispromotion == 109) checked @endif id="ndl_make_this_offer_of_post" onclick="checkAdvertisingForPromotions()" name="ndl_make_this_offer_of_post"><span class="label-text">Promotion</span>
                      </label>
                   </div>
              </div>
              <div class="col-md-6 col-sm-12 mb-4" id="promotional_advertising_date_form">
                    <label>Offer Expires On</label>
                   <input class="form-control" value="{{$post_info_data->pexpire}}" type="date" name="ndl_make_expire_date_of_post" id="ndl_make_expire_date_of_post">
                   <small class="error_input_text" id="ndl_make_pro_date_chanrge_of_post_error">Invalid date</small>
              </div>
              <div class="col-md-6 col-sm-12 mb-4" id="promotional_advertising_price_form">
                   <label>Promotional Price *</label>
                   <input class="form-control" type="text" value="{{number_format($post_info_data->promotionprice,2)}}" name="ndl_make_offer_price_chanrge_of_post" id="ndl_make_offer_price_chanrge_of_post">
                   <small class="error_input_text" id="ndl_make_pro_price_chanrge_of_post_error">Price input invalid</small>
              </div>
              <div class="col-md-6 col-sm-12 mb-4" id="">
                   <label>Uploaded Files</label>
                   <img src="{{asset($post_info_data->pdisplaypic)}}" width="40%">
              </div>
            </div>
          </div>
          @endforeach
          </form>
          </div>
           <div class="tile-footer">
              <button class="btn btn-primary" type="button" onclick="onCheckPostData();" id="parst_site_post_upload" name="parst_site_post_upload">Update Content</button>
            </div>
          </div>
        </div>
    </div>
    </main>

@endif    
@endsection

@section('content_to_body_scripts')

@if(session("account_type") == 114 && session("card_info_saved") == true)
<script>
  
      $(document).ready(function(data){
        checkAdvertisingForPromotions();
        Display_selected_sub_category();
        $("#mstr_select_actegory").on("change click",function(data){
          Display_selected_sub_category();
          make_more_filter_option();
          display_or_not_prodcuts_condition();
        });
        $("#sebs_select_catdry").on("change click",function(data){
          make_more_filter_option();
        });

      });

      function checkAdvertisingForPromotions(){

        let adForPromotion = $("#ndl_make_this_offer_of_post").is(":checked");
        if(adForPromotion){
            $("#promotional_advertising_price_form").css("display","block");
            $("#promotional_advertising_date_form").css("display","block");
        }else{
            $("#promotional_advertising_price_form").css("display","none");
            $("#promotional_advertising_date_form").css("display","none");
            $("#ndl_make_offer_price_chanrge_of_post").val('');
            $("#ndl_make_expire_date_of_post").val("");
        }

      }

      function onCheckPostData(){ 
          let rq_advertisement_postTitle,rq_advertisement_postContent,rq_advertisement_mainCat,rq_advertisement_subCat,rq_advertisement_price,rq_advertisement_prm_price,rq_advertisement_prm_date;
          rq_advertisement_postTitle = checkPostInfo($("#ndl_make_title_post"),"ndl_make_title_post_error");
          rq_advertisement_postContent = checkPostInfo($("#ndl_make_content_of_post"),"ndl_make_content_of_post_error");
          rq_advertisement_mainCat = checkPostInfo($("#mstr_select_actegory"),"mstr_select_actegory_error"); 
          rq_advertisement_subCat = checkPostInfo($("#sebs_select_catdry"),"sebs_select_catdry_error"); 
          rq_advertisement_price = checkPostInfo($("#ndl_make_price_chanrge_of_post"),"ndl_make_price_chanrge_of_post_error");
          rq_advertisement_prm_price = checkProPostInfo($("#ndl_make_expire_date_of_post"),"ndl_make_pro_date_chanrge_of_post_error",true);
          rq_advertisement_prm_date = checkProPostInfo($("#ndl_make_offer_price_chanrge_of_post"),"ndl_make_pro_price_chanrge_of_post_error",false);
            
          if(rq_advertisement_postTitle && rq_advertisement_postContent && rq_advertisement_mainCat && rq_advertisement_subCat && rq_advertisement_price && rq_advertisement_prm_price && rq_advertisement_prm_date)
          {
              $("#make_user_new_upload").attr("method","post");
              $("#make_user_new_upload").attr("action","{{route('make_user_upload_posts_updated_content_market')}}");
              $("#make_user_new_upload").submit();
          }
          
      }

      function checkPostInfo(receivedData,errorReportMessage){
        var valuesPost = receivedData.val(); 
        var inputdata = $.trim(valuesPost);
        if(inputdata == ""){
            $("#"+errorReportMessage).css("display","block");
            return false;
        }else{
            if(errorReportMessage == "ndl_make_price_chanrge_of_post_error"){
                var price_val = "^[0-9]\d{0,9}(\.)";
                if(valuesPost.match(price_val)){
                   $("#"+errorReportMessage).css("display","none");     
                   return true;
                }else{
                  $("#"+errorReportMessage).css("display","block");  
                  return false;
                }
            }else if(errorReportMessage == "ndl_make_title_post_error"){
                if(inputdata.length < 5 || inputdata.length > 50){
                  $("#"+errorReportMessage).css("display","block");      
                  return false;
                }else{
                  $("#"+errorReportMessage).css("display","none");
                  return true;
                }
            }else if(errorReportMessage == "ndl_make_content_of_post_error"){
                if(inputdata.length < 10 || inputdata.length > 1000){
                  $("#"+errorReportMessage).css("display","block");      
                  return false;
                }else{
                  $("#"+errorReportMessage).css("display","none");
                  return true;
                }
            }
            return true;
        }     
      }

      function checkProPostInfo($value,$error,$price){
        var price_val = "^[0-9]\d{0,9}(\.)";
        let promotionCheck = $("#ndl_make_this_offer_of_post").is(":checked");
        let value = $.trim($value.val());
        let error = $error;  

        if(promotionCheck){

          if(value != ""){

            if($price || value.match(price_val)){
              $("#"+error).css("display","none");
              return true;  
            }else{
              $("#"+error).css("display","block");
              return false;
            }

            if($price == false){
              $("#"+error).css("display","none");
              return true;
            }

            
          }else{
            $("#"+error).css("display","block");
            return false;
          }

        }else{
          $("#"+error).css("display","none");
          return true;
        }

      }

      function loadcategory(){
        
        let massc_id,sbsec_id;
        massc_id = $("#mstr_select_actegory").val();
        sbsec_id = $("#sebs_select_catdry").val();

        $('#sebs_select_catdry').children('optgroup[class='+massc_id+']').attr("disabled","disabled");
  
      }

      function Display_selected_sub_category(){
        var d = new Date();
        var n = d.getTime();

        var master_categry_id = $("#mstr_select_actegory").val();  
        if(master_categry_id == 605 || master_categry_id == 617 || master_categry_id == 618 ){
          $("#product_condition_display_content").css("display","none");
        }else{
          $("#product_condition_display_content").css("display","block");
        }
        $.getJSON("{{asset('category_data/subcategory_category_file.json')}}", function(json){
          $("#sebs_select_catdry").html("");
          var result,results_set;
          result = json;
          
          for (var i = 0; i < result.length; i++) {
              if((master_categry_id-524) == result[i].smid ){
                let selected= '';
                if({{$post_info_data->psubcategory}} == result[i].sid){
                  selected = 'selected';
                }
                results_set = "<option "+selected+" value="+result[i].sid+" >"+result[i].sname+"</option>";
                $("#sebs_select_catdry").append(results_set); 
              }
          }
        });

      }

      function make_more_filter_option(){

        var master_categry_id = $("#mstr_select_actegory").val();
        var masters_categry_id = $("#sebs_select_catdry").val();  
        $.getJSON("{{asset('category_data/subcategoryfilter1_category_file.json')}}", function(json){
          $("#sebs_select_description_catdry").html("");
          var result,results_set;
          result = json;
          
          if(result.length > 0){
          for (var i = 0; i < result.length; i++) {
              if((master_categry_id-524) == result[i].mcid && masters_categry_id == result[i].smcid  ){
                results_set = "<option  value="+result[i].fid+" >"+result[i].sfmname+"</option>";
                $("#sebs_select_description_catdry").append(results_set); 
              }
          }
          }else{
              results_set = "<option>No matching found</option>";
              $("#sebs_select_description_catdry").append(results_set); 
          }
        });

      }

    </script>
@endif  

@endsection