@extends('master.webadmin.index')
@section('title_of_page')
	User Profile
@endsection


@section('content_to_body')
<style>
  #information_to_change_to_normal_company{
    background: #fcce10;
    padding: 16px 26px 5px;
    margin: 4px -16px;
    border-radius: 5px;
    border: 2px #977d14 solid;
  }
  .settings_data_saved_failed{
    background-color: #fad1d1;
    border: 2px solid red;
    padding: 9px 13px;
    display: none;  
    margin: 0px 2px 10px 0px;
    color: #7e0000;
  }
  .settings_data_saved_success{
    background-color: #e6f6ce;
    border: 2px solid #018000;
    padding: 9px 13px;
    display: none;
    margin: 0px 2px 10px 0px;
    color: #153c0f;
  }
  .display_payment_status{
    background-color: #d9f2d1;
    padding: 3% 0% 1% 4%;
    border: 1px solid #4ca40d;
  }
  .display_payment_status a{
    float: right;
    padding-right: 15%;
    margin-top: -4px;
  }
</style>
  	<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="icon fa fa-user-o">&emsp;</i> Profile</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('loaddashboardscreen')}}"><i class="fa fa fa-dashboard fa-lg"></i></a></li>
          <li class="breadcrumb-item">Profile</li>
          <li class="breadcrumb-item"><a href="#">Details</a></li>
        </ul>
      </div>
      <div class="row user">
        <div class="col-md-12">
    <!--       <div class="profile">
            <div class="info"><img class="user-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg">
              <h4 style="text-transform: capitalize;">{{session('user_first_name')}}</h4>
              <p></p>
            </div>
            <div class="cover-image"></div>
          </div> -->
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              @if(session('account_type') == 114)
              <li class="nav-item @if( session('card_info_saved') == true ) active @endif"><a class="nav-link @if( session('card_info_saved') == true ) active @endif" href="#njk-bill_information" data-toggle="tab">Bill Information</a></li>
              <li class="nav-item @if( session('card_info_saved') == false ) active @endif"><a class="nav-link @if( session('card_info_saved') == false ) active @endif" href="#njk-payment_information" data-toggle="tab">Payment Information</a></li>
              @endif
              <li class="nav-item @if(session('account_type') == 96 || session('account_type') == '' ) active @endif"><a class="nav-link @if(session('account_type') == 96 || session('account_type') == '' ) active @endif" href="#user-settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div>
        </div>
       
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane @if( session('card_info_saved') == true ) active @endif" id="njk-bill_information">
              <div class="tile user-settings">
                <h4 class="line-head">Bill Information</h4>
                <div class="row"> 
                   <div class="col-sm-12 col-md-6">
                      @if (\Session::has('promocodestatus'))
                          <div class="alert alert-default">
                              <ul>
                                  <li>{!! \Session::get('promocodestatus') !!}</li>
                              </ul>
                          </div>
                      @endif
                      @if($pendingPayment_Status["status"] == 1)
                      <div class="display_payment_status">
                          @php
                            $rand_value = rand();
                          @endphp
                          <p>Please pay outstanding bill amount<b> ${{number_format($pendingPayment_Status["amount"],2)}} </b> before 10th of {{date("F")}}. <a href="{{route('payment.post_display_payment_pay',['user_have_to_pay' => 'available','fn'=>'for_payment','based'=> base64_encode($rand_value+109),'tec'=>base64_encode(date('Y')+date('m')+date('d')+$rand_value)])}}" class="btn btn-success">Pay</a></p>
                      </div>
                      <br>
                      @endif
                      <label>Available card info</label>
                      <select class="form-control" id="user_inf-o_saved_info_card" name="user_inf-o_saved_info_card">
                          @forelse($profile_card_data as $card_info => $value)
                          <option id="customeId{{$card_info}}" value="{{$value->pcfinalnumber+(15.5+0.25*1596-25)}}">{{ucwords($value->pccard)}}&emsp;**** **** **** {{$value->pcfinalnumber}} &emsp;&emsp;&emsp;&emsp; <button class="btn btn-success btn-sm" style=""> @if($value->pkasid == 195) Primary @endif </button>  </option>
                          @empty
                          <option>No Card Added</option>
                          @endforelse
                      </select> 
                   </div>
                   @if(count($profile_card_data) > 0 )
                   <div class="col-sm-12 col-md-6">
                     <label>Select card as primary</label><br> 
                     <button class="btn btn-success" id="choose_as_primarycard">Select</button>
                   </div>
                   @endif 
                </div>
                <br>
                 @if(Session::has('user_need_to_be_a_company') && Session::get('user_need_to_be_a_company') == 400)
                  
                 @endif
                <table class="table table-sm table-bordered table-hover">
                  <thead>
                    <th>#No</th>
                    <th>Invoice Number</th>
                    <th>Amout (LKR)</th>
                    <th>Status (pending/paid)</th>
                    <th>Options (view/print/inquiry (if account pay automatically. if pending pay manually))</th>
                  </thead>
                </table>
              </div>
            </div>
            <!-- Display only to company -->
            @if(session('account_type') == 114)
            <div class="tab-pane @if( session('card_info_saved') == false && session('account_type') == 114) active @endif" id="njk-payment_information">
              <div class="tile user-settings">
                <h4 class="line-head">Payment Information</h4>
                <form class="profile_user_payment_card" id="profile_user_payment_card" action="javascript:void(0)">
                  <div class="row">
                    <div class="col-md-8 mb-4">
                     <div style="display: inline-flex;margin: -15px 1px -25px auto"> 
                      <label>Select Your Card Type</label>
                      <div class="animated-radio-button" >
                        <label>
                          <input type="radio" name="cardselect" value="visa" id="nd_profile_display_card_cname_visa" name="nd_profile_display_card_cname_visa"><span class="label-text"></span>
                          <img src="https://cdn4.iconfinder.com/data/icons/major-credit-cards-glyph/48/Sed-26-512.png" style="height: 100px;width: 100px;">  
                        </label>
                      </div>
                      <div class="animated-radio-button" >
                        <label>
                          <input type="radio" name="cardselect" value="amex" id="nd_profile_display_card_cname_amex" name="nd_profile_display_card_cname_amex"><span class="label-text"></span>
                          <img src="https://cdn4.iconfinder.com/data/icons/major-credit-cards-glyph/48/Sed-35-512.png" style="height: 100px;width: 100px;">  
                        </label>
                      </div>
                      <div class="animated-radio-button" >
                        <label>
                          <input type="radio" name="cardselect" value="mast" id="nd_profile_display_card_cname_master" name="nd_profile_display_card_cname_master"><span class="label-text"></span>
                          <img src="https://cdn4.iconfinder.com/data/icons/major-credit-cards-glyph/48/Sed-27-512.png" style="height: 100px;width: 100px;">  
                        </label>
                      </div>
                      <div class="animated-radio-button" >
                        <label>
                          <input type="radio" name="cardselect" value="disc" id="nd_profile_display_card_cname_discover" name="nd_profile_display_card_cname_discover"><span class="label-text"></span>
                          <img src="https://cdn4.iconfinder.com/data/icons/major-credit-cards-glyph/48/Sed-25-512.png" style="height: 100px;width: 100px;">  
                        </label>
                      </div>
                      <div class="animated-radio-button" >
                        <label style="padding-top:16px;">
                          <input type="radio" name="cardselect" value="ppal" id="nd_profile_display_card_cname_paypal" name="nd_profile_display_card_cname_paypal"><span class="label-text"></span>&emsp;
                          <img src="https://image.flaticon.com/icons/png/512/39/39022.png" style="height: 68px;width: 70px;">  
                        </label>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Card Holder </label>
                      <input  class="form-control" type="text" id="nd_profile_display_card_cname" name="nd_profile_display_card_cname">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Card Number *</label>
                      <input  class="form-control" type="text" onkeyup="validateCreditCardNumber()" id="nd_profile_display_card_cnumber" name="nd_profile_display_card_cnumber">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Card Expier *</label>
                      <input class="form-control" type="text" id="nd_profile_display_card_cexp" name="nd_profile_display_card_cexp">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Card CVV *</label>
                      <input class="form-control" type="text" id="nd_profile_display_card_ccvv" name="nd_profile_display_card_ccvv">
                    </div>
                    <div class="clearfix"></div>                 
                    </div>
                    <div class="card_info_omplete_trace" id="card_info_omplete_trace"></div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="button" name="card_information_update" id="card_information_update"> Save Card</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>  
            @endif          
            <div class="tab-pane @if( session('account_type') == 96 || session('account_type') == '') active @endif" id="user-settings">
              <div class="tile user-settings">
                <h4 class="line-head">Settings</h4>

                <form class="profile_user_data" id="profile_user_data" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                  <div class="row col-md-8 col-sm-12 settings_data_saved_failed">
                    <p><b>OOPS !</b> Profile info not saved properly.</p>
                  </div>
                  <div class="row col-md-8 col-sm-12 settings_data_saved_success">
                    <p><b>CONGARTZ !</b> Profile info saved success.</p>
                  </div>    
                  <div class="row mb-4" style="display: none;">  
                    <div class="col-md-4">
                      <label>First Name</label>
                      <input class="form-control" type="" value="{{session('user_first_name')}}" id="nd_profile_first_name" name="nd_profile_first_name">
                    </div>
                    <div class="col-md-4">
                      <label>Last Name</label>
                      <input class="form-control" type="hidden" id="nd_profile_last_name" value="{{session('user_last_name')}}" name="nd_profile_last_name">
                    </div>
                  </div>
                  <div class="display">
                  <?php $iam_advertiser = '';$companyname = '';$company_email = ''; $contct = ''; $adomain = '';$acompanyaddress= '';$ageobase = '';$state = '';$acity = '';$apostvisibility = ''; $acompanyloago = ''; ?>
                  @forelse($profile_data as $pdata)
                    <?php $iam_advertiser = ($pdata->atype == 114) ? 'checked' : ''  ; ?>
                    <?php $companyname = ($pdata->acompanyname == 'check_about_no') ? '' : $pdata->acompanyname  ; ?>
                    <?php $company_email = ($pdata->acompanyemail == '') ? '' : $pdata->acompanyemail; ?>
                    <?php $contct = ($pdata->acontact == '') ? '' : $pdata->acontact  ; ?>
                    <?php $adomain = ($pdata->adomain == 'no') ? '' : $pdata->adomain  ; ?>
                    <?php $acompanyaddress= ($pdata->acompanyaddress == 'no') ? '' : $pdata->acompanyaddress  ; ?>
                    <?php $ageobase = ($pdata->ageobase == '') ? base64_decode(session('user_location')) : $pdata->ageobase ; ?>
                    <?php $state = ($pdata->state == '') ? '' : $pdata->state ; ?>
                    <?php $acity = ($pdata->acity == '') ? '' : $pdata->acity ; ?>
                    <?php $apostvisibility = ($pdata->apostvisibility == 1587) ? '1587' : '3859' ; ?>
                    <?php $acompanyloago = ($pdata->acompanyloago == '') ? '' : $pdata->acompanyloago ; ?>
                  @empty
                    <?php $ageobase = base64_decode(session('user_location')); ?>
                  @endforelse   
                  </div>
                  <div class="row">
                    <div class="col-md-3 mb-4">
                      <label>I am an advertiser</label>
                       <div class="toggle">
                          <label>
                            <input type="checkbox" {{$iam_advertiser}} id="select_account_type" name="select_account_type" ><span class="button-indecator"></span>
                          </label>
                        </div>
                    </div>
                    <div class="col-md-5 mb-4" id="information_to_change_to_normal_company">
                      <p>The advertisers are permitted to place ads,While normal users are not.<br/>But only to like and comment</p> 
                    </div>
                     <div class="clearfix"></div>
                    <div class="col-md-8 mb-4 info_company_profile_detailse" >
                      <label>Company Name</label>
                      <input class="form-control" value="{{$companyname}}" type="text" id="nd_profile_company_name" name="nd_profile_company_name">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Email</label>
                      <input class="form-control" value="{{$company_email}}" type="text" id="nd_profile_compnay_email" name="nd_profile_compnay_email">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Contact Number</label>
                      <input class="form-control" value="{{$contct}}" type="text" id="nd_profile_contact_number" name="nd_profile_contact_number">
                    </div>
                    <div class="col-md-8 mb-4 info_company_profile_detailse">
                      <label>Company Link</label>
                      <input class="form-control" type="text" value="{{$adomain}}"  id="nd_profile_company_domain_name" name="nd_profile_company_domain_name">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Country</label>
                      <select class="form-control" id="nd_profile_company_base_country" name="nd_profile_company_base_country">
                         @foreach($available_countries as $countries)
                         @if($ageobase == $countries->countryCode)
                          <option value="{{$countries->countryCode}}"> {{$countries->countryName}} </option>
                         @endif     
                         @endforeach 
                      </select>
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>State/District</label>
                      <input class="form-control" type="text" value="{{$state}}" id="nd_profile_company_base_state" name="nd_profile_company_base_state">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>City</label>
                      <input class="form-control" type="text" value="{{$acity}}" id="nd_profile_company_base_city" name="nd_profile_company_base_city">
                    </div>
                    <div class="col-md-8 mb-4">
                      <label>Reset Password</label>
                      <input class="form-control" type="text" placeholder="Old Password" id="nd_profile_forgort_older_pasweeord" name="nd_profile_forgort_older_pasweeord">
                      <br>
                      <input class="form-control" type="text" placeholder="New Password" id="nd_profile_forgort_pasweeord" name="nd_profile_forgort_pasweeord">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4 info_company_profile_detailse">
                      <label>My Advertiestments Are Visible For</label>
                      <select class="form-control" id="nd_profile_advertiestment_visibale" name="nd_profile_advertiestment_visibale">
                          <option {{($ageobase == '1587' ) ? 'selected' : '' }} value="1587">Nation Wide</option>
                          <option {{($ageobase == '3859' ) ? 'selected' : '' }} value="3859">Word Wide</option>
                      </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4 info_company_profile_detailse">
                      <label>Company Logo</label>
                      <input class="form-control" type="file" id="nd_profile_company_logo_update" name="nd_profile_company_logo_update">
                    </div>                 
                    </div>
                  
                  <div id="value_update_cc"></div>  
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" id="make_user_profile_update" type="button">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
@endsection


@section('content_to_body_scripts')
<script>
  $(document).ready(function(){

  var options = $("#nd_profile_company_base_country option");                            
options.detach().sort(function(a,b) {               
    var at = $(a).text();
    var bt = $(b).text();         
    return (at > bt)?1:((at < bt)?-1:0);            
});
options.appendTo("#nd_profile_company_base_country");      



  user_make_company_accout();  

  $("#select_account_type").click(function(data){
    user_make_company_accout();
  });

  function user_make_company_accout(){
  if($("#select_account_type").is(":not(:checked)")){
    var number = 0;
  }else{
    var  number = 1;
  }

  if(number == 1){
    $(".info_company_profile_detailse").css("display","block");
  }
  if(number == 0){
    $(".info_company_profile_detailse").css("display","none");
  }
  }


 $("#make_user_profile_update").on('click', function(){
    

    if( $("#select_account_type").is(":not(:checked)") ){  
        
        var user_html_id,user_create_id;
        user_html_id = [
            "nd_profile_first_name",
            "nd_profile_last_name",
            "select_account_type",
            "nd_profile_compnay_email",
            "nd_profile_contact_number",
            "nd_profile_company_base_country",
            "nd_profile_company_base_state",
            "nd_profile_company_base_city",
            "nd_profile_forgort_pasweeord"
          ];
        user_create_id = [
            "nd_pirofile_first_name",
            "nd_pirofile_last_name",
            "select_aiccount_type",
            "nd_pirofile_compnay_email",
            "nd_pirofile_contact_number",
            "nd_pirofile_company_base_country",
            "nd_pirofile_company_base_state",
            "nd_pirofile_company_base_city",
            "nd_pirofile_forgort_pasweeord"
        ];  


    for (var i = 0; i < user_html_id.length ; i++) {

          var load_value = make_different_data($('#'+user_html_id[i]).val());
          var input = document.createElement("input");
          input.type = "hidden";
          input.className = user_create_id[i];
          input.id = user_create_id[i]; 
          input.setAttribute("value",load_value);
          document.getElementById("value_update_cc").appendChild(input);  

    }  


    $.ajax({
       url:"{{ route('update_user_profile_info') }}",
       method:"POST",
       data:{
        "firstname": $('#'+user_create_id[0]).val(),
        "lastname": $('#'+user_create_id[1]).val(),
        "advertiser": $('#'+user_create_id[2]).val(),
        "emailid": $('#'+user_create_id[3]).val(),
        "contactnumber": $('#'+user_create_id[4]).val(),
        "country": $('#'+user_create_id[5]).val(),
        "statedisc": $('#'+user_create_id[6]).val(),
        "city": $('#'+user_create_id[7]).val(),
        "passwordreset": $('#'+user_create_id[8]).val(),
        "keygot": "<?=base64_encode($key)?>"
       },
       dataType:'JSON',
       beforeSend:function(request){
          return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
       },
       success:function(data)
       {
          if(data == true){ 
              for (var i = 0; i < user_create_id.length ; i++) {
                $("#"+user_create_id[i]).attr("id","user_create_id"+[i]);  
              }  
              $("#value_update_cc").empty();
              $(".settings_data_saved_success").css("display","block");
              $(".settings_data_saved_failed").css("display","none");
          }else{
            for (var i = 0; i < user_create_id.length ; i++) {
                $("#"+user_create_id[i]).attr("id","user_create_id"+[i]);  
              }  
              $("#value_update_cc").empty();
              $(".settings_data_saved_success").css("display","none");
              $(".settings_data_saved_failed").css("display","block");
          }
       },
       error:function(dd,data){
          var data = dd.status;
          if(data == 200){
              for (var i = 0; i < user_create_id.length ; i++) {
                $("#"+user_create_id[i]).attr("id","user_create_id"+[i]);  
              }  
              $("#value_update_cc").empty();
              $(".settings_data_saved_success").css("display","block");
              $(".settings_data_saved_failed").css("display","none");
          }
       }
    });
    
    }else{
        let form = new FormData($("#profile_user_data")[0]);
        form.append('file', $('#nd_profile_company_logo_update')[0].files[0]);
            $.ajax({
               url:"{{ route('update_user_profile_info_if_company') }}",
               method:"POST",
               data:form,
               processData: false,
               contentType: false,
               beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
               },
               success:function(data)
               {
                  $(".settings_data_saved_success").css("display","block");
                  $(".settings_data_saved_failed").css("display","none");
               },
               error:function(dd,data){
                  var data = dd.status;
                  $(".settings_data_saved_success").css("display","none");
                  $(".settings_data_saved_failed").css("display","block");
               }
            });
    }

 });





});

 function make_different_data(form_input_value){ 
        var key = <?php echo $key;?>;
        var plaintext = form_input_value;
            encrypted = CryptoJS.AES.encrypt(JSON.stringify(plaintext), key, {format: CryptoJSAesJson}).toString();
            return encrypted;
}     


</script>
<script type="text/javascript" >


$("#card_information_update").on("click",function(daat){
   
   let user_card_complete_data,user_card_replica_data,sendData;


   user_card_complete_data = [
      "cardselect" ,
      "nd_profile_display_card_cname",
      "nd_profile_display_card_cnumber",
      "nd_profile_display_card_cexp",
      "nd_profile_display_card_ccvv"
   ];
   user_card_replica_data = [
      "cardeselect" ,
      "nd_porfile_display_card_cname",
      "nd_porfile_display_card_cnumber",
      "nd_porfile_display_card_cexp",
      "nd_porfile_display_card_ccvv"
   ];

   let user_card_dt = [];

   for (var i = 0; i < user_card_complete_data.length; i++) {
      let user_card_type_q;
      if(i == 0){
          user_card_type_q = $("input[name='cardselect']:checked").val();
      }else{
          user_card_type_q = $("#"+user_card_complete_data[i]).val(); 
      }

      user_card_dt[i] = user_card_type_q;
      
   }

   for (var i = 0; i < user_card_complete_data.length ; i++) {

      var load_value = "";
      if(i == 0){
          load_value = data_trasfer($("input[name='cardselect']:checked").val());
      }else{
          load_value = data_trasfer($('#'+user_card_complete_data[i]).val());
      }

             
            var input = document.createElement("input");
          input.type = "hidden";
          input.className = user_card_replica_data[i];
          input.id = user_card_replica_data[i]; 
            input.setAttribute("value",load_value);
            document.getElementById("card_info_omplete_trace").appendChild(input);  

          }

          var $data = [];

          $data[0] = $("#cardeselect").val();
          $data[1] = $("#nd_porfile_display_card_cname").val();
          $data[2] = $("#nd_porfile_display_card_cnumber").val();
          $data[3] = $("#nd_porfile_display_card_cexp").val();
          $data[4] =  $("#nd_porfile_display_card_ccvv").val();

            $.ajax({
               url:"{{route('update_user_profile_card_information')}}",
               method:"POST",
               data:{
                "card_info_data":$data,
                "base_code":'<?php echo base64_encode(session('card_encryption_key')); ?>',
               },
               beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
               },
               success:function(data)
               {
                  console.clear();
                  var status = JSON.parse(data);
                  if(status["status"] == 255){
                     alert("saved");
                     $("#card_info_omplete_trace").html(""); 
                  }else{
                    alert("Please try again");
                    $("#card_info_omplete_trace").html(""); 
                  }
               },
               error:function(dd,data){
                  var data = dd.status;
                  $("#card_info_omplete_trace").html(""); 
               }
            });




});



      function data_trasfer(form_input_value){
        var key = "<?=session('card_encryption_key');?>"; 
        var plaintext = form_input_value;
            encrypted = CryptoJS.AES.encrypt(JSON.stringify(plaintext), key, {format: CryptoJSAesJson}).toString();
            return encrypted;
      }

function validateCreditCardNumber() {

    var visaPattern = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var mastPattern = /^(?:5[1-5][0-9]{14})$/;
    var amexPattern = /^(?:3[47][0-9]{13})$/;
    var discPattern = /^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/; 


    var ccNum  = $("#nd_profile_display_card_cnumber").val();

    var isVisa = visaPattern.test( ccNum ) === true;
    var isMast = mastPattern.test( ccNum ) === true;
    var isAmex = amexPattern.test( ccNum ) === true;
    var isDisc = discPattern.test( ccNum ) === true;

    if( isVisa || isMast || isAmex || isDisc ) {
        if( isVisa ) {
            console.log("Visa");
        }
        else if( isMast ) {
             console.log("Master");
        }
        else if( isAmex ) {
            console.log("Amex");
        }
        else if( isDisc ) {
            console.log("Disc");
        }
    }
    else {
        console.log("Please enter a valid card number.");
    }
}

function valid() { 

  var RegExp = new RegExp(/^\d*\.?\d*$/); 
  var val = document.getElementById("input").value; 
  
  if (RegExp.test(elem.value)) { 
        val = elem.value; 
        el_down.innerHTML = "Typed Valid Character."; 
  } else { 
        elem.value = val; 
        el_down.innerHTML = "Typed Invalid Character."; 
  }
} 

</script>
<script>
  let primary_card_start = false;
  $("#choose_as_primarycard").on("click",function(){
      $("#choose_as_primarycard").html("Please Wait");
    let myCard = $("#user_inf-o_saved_info_card").val();
    if(primary_card_start == false){
              primary_card_start = true;
             $.ajax({
               url:"{{route('make_selected_as_primary_card')}}",
               method:"POST",
               data:{
                "card_number" : myCard
               },
               beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
               },
               success:function(data)
               {
                  $("#choose_as_primarycard").html("Select");
                  primary_card_start = false;
                  console.clear();
                  
               },
               error:function(dd,data){
                  $("#choose_as_primarycard").html("Select");
                  primary_card_start = false; 
               }
            });
    }         
  }); 
</script>

@endsection