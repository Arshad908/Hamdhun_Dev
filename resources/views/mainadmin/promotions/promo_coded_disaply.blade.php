@extends('master.mainadmin.index')
@section('title_of_page')
	Promocode
@endsection


@section('content_to_body')

<style type="text/css">
  .error_valide{
    color: red;
    display: none;
  }
  #promotion_code_activated{
    background-color: lightgrey;
    border: 1px solid #3a821e;
    padding: 10px;
    color: black;
    font-weight: 500;
    font-size: 16px;
    display: none;
    margin-bottom: 20px;
  }
  #promotion_code_failuer{
    background-color: #f2dcdc;
    border: 1px solid #de0404;
    padding: 10px;
    margin-bottom: 20px;
    display: none;
    color: black;
    font-weight: 500;
    font-size: 16px;
  }
  #display_delete_sucess{
    background-color: #ccdfcc;
    border: 1px #b31b1b solid;
    padding: 12px 5px 1px 30px;
  }
  #display_error_success{
    background-color: #fcd6cd;
    border: 1px #b31b1b solid;
    padding: 12px 5px 1px 30px;
  }
</style>
    @php 
      $lastDayofMonth = \Carbon\Carbon::now()->endOfMonth()->toDateString();
    @endphp
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-cogs"></i> Promocode</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pomocode</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">Promocode - Create</h3>
              <p><button class="btn btn-primary icon-btn" id="admin_create_promocode_new" name="admin_create_promocode_new">Add New Promocode </button></p>
            </div>
            <div id="promotion_code_activated"> Congradulations</div>
            <div id="promotion_code_failuer"> Error</div>
            <div class="tile-body">
             <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group">
                    <label for="promocode_add_company">Company Name</label>
                    <select class="form-control" multiple="" name="promocode_add_company_name" id="promocode_add_company_name" size="20"> 
                      @foreach($listed_all_compnies as $comnpany)  
                      <option value="{{$comnpany->company+1058885489-15849}}">{{ucwords($comnpany->adcompanyname)}}</option>
                      @endforeach
                    </select>
                    <small class="error_valide" id="company_select_empty">Select a company</small>

                  </div>
               </div>
               <div class="col-sm-12 col-md-4 col-lg-3">
                 <div class="form-group">
                    <label for="promocode_add_promocode">Promocode</label>
                    <div class="input-group">
                    <input class="form-control" max="10" name="promocode_add_promocode" id="promocode_add_promocode" maxlength="10" type="text" aria-describedby="promocode_add_promocode" style="text-transform: uppercase;" placeholder="  SPTYD00583">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon1"><input type="checkbox" value="social" name="promocode_socialmedia_adding" id="promocode_socialmedia_adding"></span>
                    </div>
                    </div>
                    <small>* Select option if the promotion on <b>Social media</b>.</small>
                    <small class="error_valide" id="promocode_empty">Add Promocode</small>
                  </div>
               </div>  
               <div class="col-sm-12 col-md-4 col-lg-3 ">
                 <div class="form-group">
                    <label for="">Offer Type</label>
                    <select class="form-control" name="promocode_add_offer_type" id="promocode_add_offer_type">
                      <option value="11">Month Escape</option>
                      <option value="12">Payer Escape</option>
                    </select>
                  </div>
               </div>
               <div class="col-sm-12 col-md-4 col-lg-3 ">
                <label for="">Description</label>
                 <div class="input-group">
                    <input type="text" class="form-control" name="promocode_add_promo_descriptions" id="promocode_add_promo_descriptions" placeholder=" Description">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2">Month/s</span>
                    </div>
                  </div>
                  <small class="error_valide" id="description_type_empty">Add Description</small> 
               </div>
               <div class="col-sm-12 col-md-4 col-lg-3 ">
                <label for="">Last Date</label>
                 <input type="date" id="promocode_add_promo_expire_date" value="{{$lastDayofMonth}}" name="promocode_add_promo_expire_date" class="form-control">
                 <small class="error_valide" id="expire_date_check_empty">Invalid Date</small> 
               </div>
             </div>
              
            </div>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-12">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">Status - Official</h3>
            </div>
            @if(Session::get('delete_promocode_official') == 200)
            <div id="display_delete_sucess">
              <p><b>Done !</b> Promo-Code delete success</p>
            </div>
            <br>
            @elseif(Session::get('delete_promocode_official') == 202)
            <div id="display_error_success">
              <p><b>Error !</b> Promo-Code delete failed</p>
            </div>
            <br>
            @endif
            <div class="tile-body">
             <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-sm table-bordered" id="promo_code_issure_table">
                        <thead>
                          <th width="150">#</th>
                          <th>Code Issued</th>
                          <th>Company Name</th>
                          <th>Offer Type</th>
                          <th>Description</th>
                          <th>Used Status</th>
                          <th>Used Date</th>
                          <th>Active</th>
                          <th width="60">Option</th>
                        </thead>
                        <tbody id="promo_code_issure_table_body">
                          @forelse($listed_all_promos[0] as $key => $poromo)
                          <tr>
                            <td>{{sprintf("%015d",(++$key))}}</td>
                            <td>{{$poromo->prpromocode}}</td>
                            <td>{{$poromo->prcname}}</td>
                            <td>{{($poromo->proffertype == 85) ? "Monthly Escape" : "Payment Escape"}}</td>
                            <td>{{($poromo->prprecentage == 0) ? $poromo->prpromodate . " month/s" : $poromo->prprecentage." % " }}</td>
                            <td>{{( $poromo->prused == 10 ) ? "Pending" : "Used"}}</td>
                            <td>{{( $poromo->prusedon == "" ) ? "Not use" : $poromo->prusedon}}</td>
                            <td>{{( $poromo->practived == 1 ) ? "Active" : "Deactive"}}</td>
                            <td> 
                              <a href="#" onclick="make_delete('{{route('remove_this_promo_codes_from_lst',['check'=>base64_encode($poromo->posted_promo_id+(200.285+0.951)),'usck'=>rand(50,60),'delete'=>true])}}')" class="btn btn-sm btn-danger">Reject</a> 
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="9">No Promo Found</td>
                          </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
             </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-12">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">Social Marketing</h3>
            </div>
            @if(Session::get('delete_promocode_social') == 200)
            <div id="display_delete_sucess">
              <p><b>Done !</b> Promo-Code delete success</p>
            </div>
            <br>
            @elseif(Session::get('delete_promocode_social') == 202)
            <div id="display_error_success">
              <p><b>Error !</b> Promo-Code delete failed</p>
            </div>
            <br>
            @endif
            <div class="tile-body">
             <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-sm table-bordered" id="promo_code_issure_table_social">
                        <thead>
                          <th width="150">#</th>
                          <th>Code Issued</th>
                          <th>Offer Type</th>
                          <th>Description</th>
                          <th>Used Count</th>
                          <th>Last Date</th>  
                          <th width="60">Option</th>
                        </thead>
                        <tbody id="promo_code_issure_table_body">
                          @forelse($listed_all_promos[1] as $key => $socialmarket)
                          <tr>
                            <td>{{sprintf("%015d",(++$key))}}</td>
                            <td>{{$socialmarket->pro_codes}}</td>
                            <td>{{($socialmarket->pro_offertype == 85) ? "Monthly Escape" : "Payment Escape"}}</td>
                            <td>{{($socialmarket->pro_precent == 0) ? $socialmarket->pro_datemonths . " month/s" : $socialmarket->pro_precent." % " }}</td>
                            <td>{{$socialmarket->pro_usedsocialcount}} used</td>  
                            <td>{{\Carbon\Carbon::create($socialmarket->pro_enty_exp)->diffForHumans()}}</td>
                            <td>
                              <a href="#" onclick="make_delete('{{route('remove_this_promo_codes_from_lst',['check'=>base64_encode($socialmarket->pro_id+(385.764+0.254)),'usck'=>rand(150,160),'delete'=>true])}}');"  class="btn btn-sm btn-danger">Reject</a> 
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="9">No Promo Found</td>
                          </tr>
                          @endforelse
                        </tbody>
                    </table>
                </div>
             </div>
            </div>
          </div>
        </div>
        </div>
  	</main>


    <script>
       $(document).ready(function(data){
         
      
         $("#promocode_add_offer_type").on("change",function(data){
            let offer_type = $(this).val();
            if(offer_type == 12){
              $("#basic-addon2").html("%");
            }else{
              $("#basic-addon2").html("Month/s");
            }
         });

         $("#admin_create_promocode_new").on("click",function(data){
            var stratedProcess = false;

            let confirm_companyCheck,promocodeCheck,descriptionCheck;
      
            promocodeCheck = checkFieldsAreDone('checkvalue',$("#promocode_add_promocode").val(),'promocode_empty'); 
            descriptionCheck = checkFieldsAreDone('description',$("#promocode_add_promo_descriptions").val(),'description_type_empty');
    
            if( promocodeCheck && descriptionCheck && stratedProcess == false){
              stratedProcess = true;
              $.ajax({
                url:"{{route('add_promocode.saveit')}}",
                method: "POST",
                data: {
                  "social_s": ($("#promocode_socialmedia_adding").is(":checked") == true) ? $("#promocode_socialmedia_adding").val() : "",
                  "company" : $("#promocode_add_company_name").val(),
                  "promocode" : $("#promocode_add_promocode").val(),
                  "offertype" : $("#promocode_add_offer_type").val(),
                  "description": $("#promocode_add_promo_descriptions").val(),
                  "lastdate": $("#promocode_add_promo_expire_date").val()
                },
                async: false,
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                  stratedProcess = false;
                  $("#promotion_code_activated").css("display","block");
                  $("#promotion_code_failuer").css("display","none");
                },
                error:function(data,xhr){
                  stratedProcess = false;
                  $("#promotion_code_activated").css("display","none");
                  $("#promotion_code_failuer").css("display","block");
                }
              });

            }


         });

         function checkFieldsAreDone(method,from,error){
            let method_used = method;
            let loaded_by = $.trim(from);
            let error_load = error;

            if(loaded_by != ""){
              let description_make = new RegExp('^[0-9]+$');
              if(method_used === "description"  &&  description_make.test(loaded_by) == false ){
                  $('#'+error_load).css('display','block');
                  return false;
              }
                  $('#'+error_load).css('display','none');
                  return true;  
            }else{
              $('#'+error_load).css('display','block');
              return false;
            }

         }

         $("#promo_code_issure_table,#promo_code_issure_table_social").DataTable();
       });

       function make_delete(checked){
            $.notify({
              message: "<strong>Confirm</strong>! Click here to delete this promo-code",
              url: checked,
              target: '_self'
             });
          
        }



    </script>



@endsection  	