@extends('master.mainadmin.index')
@section('title_of_page')
	Category Management
@endsection


@section('content_to_body')
    <style type="text/css">
      #add_category_process_start{
        display: none;
        animation-delay: 1s;
      }
      #add_category_success_data,#add_category_failiur_data,#add_categroy_success_data,#add_categroy_failiur_data,#add_sub_categroy_success_data,#add_sub_categroy_failiur_data{
        display: none;
      }
      #mst_add_subbing_cat{
        text-transform: capitalize;
      }
      #confirmation_promt{
        display: none;
      }
      #succeess_operation_111,#succeess_operation_222{
        display: none;
      }
      #confirmation_promt_sum_load,#confirmation_promt_csum_load{
        display: none;
      }
      #succeess_operation_111_sub_load,#succeess_operation_222_sub_load,#succeess_operation_111_csub_load,#succeess_operation_222_csub_load{
        display: none;
      }
    </style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-cogs"></i> Category</h1>
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
            <h3 class="tile-title">Add Category</h3>
            <p><i>
               *  &emsp; Please keep the master category as much as shorter.<br/>
               *  &emsp; Can include single and multiple sub categories. Please use  " |"  to separate each category to multiple sub categories. 
            </i></p>
            <form id="category_load">
            <div class="row">
              <div class="col-md-4">
                <p><b>Master Category</b> <span style="float: right"><a data-toggle="modal" href="#add_new_pp">Add New</a></span></p><?php $d = $master_category; $data =  json_decode($d); ?> 
                <select id="mst_add_master_cat" class="form-control" onchange="Display_selected_sub_category()">
                @foreach($data as $reload)
                  <option value="{{$reload->ndl_category_id}}">{{ucfirst($reload->ndl_category_name)}}</option>
                @endforeach
                </select>  
                <!-- <input class="form-control" id="mst_add_master_cat" type="text" placeholder=" Electronics"> --> 
              </div>
              <div class="col-md-4">
                <p><b>Sub Category</b><span style="float: right"><a data-toggle="modal" href="#add_new_sub_pp">Add New</a></span></p>
                <select class="form-control" id="mst_add_subbing_cat" name="mst_add_subbing_cat">
                    
                </select> 
              </div>
              <div class="col-md-4">
                <p><b>Sub Category - Filter One</b></p>
                <input class="form-control" id="mst_add_subbing_cat_more_filter" name="mst_add_subbing_cat_more_filter" type="text" placeholder=" Head Set"> 
              </div>
              <br/><br/><br/><br/>
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary add_site_category_data" type="button" id="add_site_category_data"><i class="fa fa-spinner fa-spin" id="add_category_process_start" ></i>Complete</button>
                </div>
            </div>
            </form>
            <br/>

            <div class="bs-component" id="add_category_success_data">
              <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Well done!</strong> Category added success.
              </div>
            </div>
            <div class="bs-component" id="add_category_failiur_data">
              <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Oh snap!</strong>something goes wrong.
              </div>
            </div>

          </div>
        </div>
 
        <div class="col-md-12">
          <div class="tile">
            <div class="overlay" id="loading_process_category_load">
              <div class="m-loader mr-4">
                <svg class="m-circular" viewBox="25 25 50 50">
                  <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/>
                </svg>
              </div>
              <h3 class="l-text">Loading</h3>
            </div>
            <div class="tile-title-w-btn">
              <h3 class="title">All Categories</h3>
              <!-- <p><a class="btn btn-primary icon-btn" href=""><i class="fa fa-plus"></i>Add Item </a></p> -->
            </div>
            <div class="tile-body" style="border: 1px solid #dee2e6;">
              <div>
                 <table class="table table-sm table-bordered" id="category_list_table">
                    <thead>
                      <th>Main Category</th>
                      <th>Sub Category</th>
                      <th>Complementory category</th>
                    </thead>
                    <tbody id="category_list_table_">
                     @php

                         $masters = json_decode($master_category_pageall)[0];
                         $subs = json_decode($master_category_pageall)[1];
                         $complementory = json_decode($master_category_pageall)[2];
                         $groupByCode = json_decode($master_category_pageall)[3];  

                         $on_going_master = 0;$on_going_submaster = 0;


                        $arrayCountSubCat = []; 
                        foreach($complementory as $key => $cdata){
                              $founded = false;
                              foreach($arrayCountSubCat as $key1 => $values){
                                if($cdata->sid == $key1 ){
                                  $founded = true;
                                }
                              }
                              if($founded == false){
                                array_push($arrayCountSubCat,[$cdata->sid => 0]);
                              }
                        }



                         foreach($masters as $key => $mdata){
            
                            $mcolspan = 1;
                            foreach($subs as $key => $sdata){
                              if($sdata->mid == $mdata->mid){
                                $mcolspan++;   
                              }
                            }
                            foreach($complementory as $key1 => $cdata){
                              if($cdata->mid == $mdata->mid){
                                $mcolspan++;
                              }
                            }

            
                            if($on_going_master != $mdata->mid){
                              $on_going_master = $mdata->mid;
                              $masterID= base64_encode($mdata->mid+155040-355);
                              echo "<tr><td style='text-transform: capitalize;' rowspan='$mcolspan'>$mdata->mname<div  style='float: right;color: white' class='btn-group' role='group' aria-label='Basic example'>
                <button    data-loadingid='$masterID' data-loadingname='$mdata->mname' class='btn btn-sm btn-success update_my_content' type='button'><i class='fa fa-edit'></i></button>
              </div></td>";
                            }




                            foreach($subs as $key => $sdata1){
                              if($sdata1->mid == $mdata->mid){
                                $subID= base64_encode($sdata1->sid+155040-355);
                                $mscolspan = 1;
                                foreach($groupByCode as $key => $data1){
                                  if($sdata1->sid == $data1->sid){
                                    $mscolspan = $data1->total+1;

                                  }
                                }
                                echo "<tr><td style='text-transform: capitalize;' rowspan='$mscolspan'>$sdata1->sname <div  style='float: right;color: white' class='btn-group' role='group' aria-label='Basic example'>
                <button    data-loadingid='$subID' data-loadingname='$sdata1->sname' class='btn btn-sm btn-success update_my_sub_content' type='button'><i class='fa fa-edit'></i></button>
              </div></td>";
                              }


                               foreach($complementory as $key => $cdata1){
                                  if($cdata1->sid == $sdata1->sid && $mdata->mid == $cdata1->mid){
                                    $subCID= base64_encode($cdata1->cid+155040-355);
                                    echo "<tr><td style=''>$cdata1->cname &nbsp; <div  style='float: right;color: white' class='btn-group' role='group' aria-label='Basic example'>
                <button    data-loadingid='$subCID' data-loadingname='$cdata1->cname' class='btn btn-sm btn-success update_my_sub_complementory_content' type='button'><i class='fa fa-edit'></i></button>
              </div>
            </td>";
                                  }
                                  //if($cdata1->sid != $sdata1->sid && $mdata->mid == $cdata1->mid){
                                  //  echo "<tr><td></td>";
                                  //}
                                }

                            }


                         }

                   
                     @endphp
                    </tbody>
                 </table> 
              </div>
            </div>
          </div>
        </div>
 
      </div>
       
  	</main>
    <!-- Add New Category -->
  <div id="add_new_pp" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Add new category content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title">Modal Header</h4> -->
          </div>
          <div class="modal-body">
            <h5>Add New Main Category</h5>
            <p>Can include single and multiple main categories. Please use  "|"  to separate each category to multiple main.</p>
            <input class="form-control" id="mst_add_new_master_cat" type="text" placeholder=" Electronics"> 
            <br>
            <!-- Messages -->
            <div class="bs-component" id="add_categroy_success_data">
              <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Well done!</strong> Category added success.
              </div>
            </div>
            <div class="bs-component" id="add_categroy_failiur_data">
              <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Oh snap!</strong>something goes wrong.
              </div>
            </div>
            <!-- End Messages -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add_new_master_01">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
    <!-- Add New Category -->
  <div id="add_new_sub_pp" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Add new category content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <h5>Add New Subcategory Category</h5>
            <p>Can include single and multiple main categories. Please use  "|"  to separate each category to multiple main.</p>
            <p>Please re-check the main category is selcted correctly before you save.</p>
            <input class="form-control" id="mst_add_new_sub_master_cat" type="text" placeholder=" Mobile"> 
            <br>
            <!-- Messages -->
            <div class="bs-component" id="add_sub_categroy_success_data">
              <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Well done!</strong> Category added success.
              </div>
            </div>
            <div class="bs-component" id="add_sub_categroy_failiur_data">
              <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Oh snap!</strong>something goes wrong.
              </div>
            </div>
            <!-- End Messages -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add_new_sub_master_02">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>    





























    <!-- Modal -->
<div class="modal fade" id="update_master_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Master Category</h5>
        <button type="button" class="close" data-dismiss="modal" id="check_clear_info" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="bs-component make_it_to_confirm" id="confirmation_promt">
          <div class="alert alert-dismissible alert-default" style="border-radius: 0px;">
            <strong>I have rechecked the informations</strong>&nbsp;<button class="btn btn-sm btn-info" id="make_update_change_master">Confirm</button>
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_111">
          <div class="alert alert-dismissible alert-success" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Success!</strong><a class="alert-link" href=""> Refresh </a> the page to get new content.
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_222">
          <div class="alert alert-dismissible alert-warning" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Failed!</strong><a class="alert-link" href=""> Refresh</a> and try again.
          </div>
      </div>
      <div class="modal-body">
        <input type="text" style="text-transform: capitalize;" name="master_update_compose_rate" value="" id="master_update_compose_rate" class="form-control">
        <div class="animated-radio-button">
              <br/>
              <label>
                Operation Type &emsp;
              </label>
              <label>
                <input type="radio" name="select_operation_master" value="1"><span class="label-text">Update</span>
              </label>&emsp;
              <label>
                <input type="radio" name="select_operation_master" value="2"><span class="label-text">Remove</span>
              </label>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-success" id="make_master_update_master" name="make_master_update_master"   data-loaded=""   >Next</button>
      </div>
    </div>
  </div>
</div>

























    <!-- Modal -->
<div class="modal fade" id="update_sub_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Sub Category</h5>
        <button type="button" class="close" data-dismiss="modal" id="check_clear_info_sub" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="bs-component make_it_to_confirm" id="confirmation_promt_sum_load">
          <div class="alert alert-dismissible alert-default" style="border-radius: 0px;">
            <strong>I have rechecked the informations</strong>&nbsp;<button class="btn btn-sm btn-info" id="make_update_change_master_sub">Confirm</button>
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_111_sub_load">
          <div class="alert alert-dismissible alert-success" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Success! </strong><a class="alert-link" href=""> Refresh </a> the page to get new content.
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_222_sub_load">
          <div class="alert alert-dismissible alert-warning" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Failed!</strong><a class="alert-link" href=""> Refresh</a> and try again.
          </div>
      </div>
      <div class="modal-body">
        <input type="text" style="text-transform: capitalize;" name="sub_master_update_compose_rate" value="" id="sub_master_update_compose_rate" class="form-control">
        <div class="animated-radio-button">
              <br/>
              <label>
                Operation Type &emsp;
              </label>
              <label>
                <input type="radio" name="select_operation_master_sub" value="1"><span class="label-text">Update</span>
              </label>&emsp;
              <label>
                <input type="radio" name="select_operation_master_sub" value="2"><span class="label-text">Remove</span>
              </label>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-success" id="make_master_update_master_sub" name="make_master_update_master_sub"   data-loaded=""   >Next</button>
      </div>
    </div>
  </div>
</div>


















    <!-- Modal -->
<div class="modal fade" id="update_complmentory_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Complementory Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="bs-component make_it_to_confirm" id="confirmation_promt_csum_load">
          <div class="alert alert-dismissible alert-default" style="border-radius: 0px;">
            <strong>I have rechecked the informations</strong>&nbsp;<button class="btn btn-sm btn-info" id="make_update_change_master_csub">Confirm</button>
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_111_csub_load">
          <div class="alert alert-dismissible alert-success" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Success!</strong><a class="alert-link" href=""> Refresh </a> the page to get new content.
          </div>
      </div>
      <div class="bs-component make_it_to_confirm" id="succeess_operation_222_csub_load">
          <div class="alert alert-dismissible alert-warning" style="border-radius: 0px;">
            <button class="close" type="button" data-dismiss="alert">×</button><strong>Failed!</strong><a class="alert-link" href=""> Refresh</a> and try again.
          </div>
      </div>
      <div class="modal-body">
        <input type="text" style="text-transform: capitalize;" name="subc_master_update_compose_rate" value="" id="subc_master_update_compose_rate" class="form-control">
        <div class="animated-radio-button">
              <br/>
              <label>
                Operation Type &emsp;
              </label>
              <label>
                <input type="radio" name="select_operation_master_csub" value="1"><span class="label-text">Update</span>
              </label>&emsp;
              <label>
                <input type="radio" name="select_operation_master_csub" value="2"><span class="label-text">Remove</span>
              </label>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-success" id="make_master_update_master_sub_complementory" name="make_master_update_master_sub_complementory"   data-loaded=""   >Next</button>
      </div>
    </div>
  </div>
</div>














    <script type="text/javascript" src="{{asset('macklomposts/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('macklomposts/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('adminposts/C_custome_js/category.js')}}"></script>
   

    <script type="text/javascript">
      $(document).ready(function(){

      Display_selected_sub_category();
      
      $("#loading_process_category_load").css("display","none");
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      }); 
      $("#add_new_sub_master_02").on("click",function(datas){
          let saveProcessStart = false;
          $("#add_category_process_start").css("display","block");
          let masterFields,subFields,masterCatFir,subCatFir;
          masterFields = checkmasterField("dec_mlt");
          subFields = checkSubField();
          let data = new Category("<?= $enc_key["enc_key"];?>",masterFields,subFields);
          let masterFieldsData= data.createMasterCategory(); 
          let subFieldData= data.createSubCategory();
          let userCreateCategory = ["administrator_m_cat","administrator_s_cat"];

          for (var i = 0; i < 2; i++) {
          
            var input = document.createElement("input");
            input.type = "hidden";
            input.className = userCreateCategory[i];
            input.id = userCreateCategory[i]; 
            document.getElementById("category_load").appendChild(input); 

          } 

          masterCatFir = $("#administrator_m_cat").val(masterFieldsData);
          subCatFir = $("#administrator_s_cat").val(subFieldData);
          if(saveProcessStart == false){
          $.ajax({
            url: "{{route('add_admin_category_ms_category')}}",
            method: 'post',
            async:false,
            dataType:"json",
            data: {
              'master_cat' : masterFieldsData,
              'submast_cat' : subFieldData,
              'ad_key' : "<?=$enc_key["enc_key"]?>",
            },
            beforeSend:function(request){
              return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
            },
            success:function(registerStatus){
               saveProcessStart = false;
               $("#add_category_process_start").css("display","none"); 
               let newregistration = registerStatus;

               for (var i = 0; i < newregistration.length; i++) {
                  var status = newregistration[i];
                  if(status == false){
                    $("#add_sub_categroy_success_data").css("display","none");
                    $("#add_sub_categroy_failiur_data").css("display","block");
                  }else if(status == true){
                    $("#mst_add_master_cat").val("");
                    $("#mst_add_new_sub_master_cat").val("");
                    $("#add_sub_categroy_success_data").css("display","block");
                    $("#add_sub_categroy_failiur_data").css("display","none");
                  }else{
                    $("#add_sub_categroy_success_data").css("display","none");
                    $("#add_sub_categroy_failiur_data").css("display","none");
                  }
               }

            },
            error:function(xhr,xht){
              console.log("data");
            }
            
          });
          }
    
      });

      $("#add_site_category_data").on("click",function(){

        var load_value = ["mst_add_master_cat","mst_add_subbing_cat","mst_add_subbing_cat_more_filter"];
        var mdata,sdata,smdata;  
        mdata = $("#"+load_value[0]).val();
        sdata = $("#"+load_value[1]).val();
        smdata = $.trim($("#"+load_value[2]).val());

        if (smdata != "") {
          $.ajax({
            url: "{{route('add_admin_category_ms_more_category')}}",
            method: 'post',
            async:false,
            dataType:"json",
            data: {
              'master_cat' : mdata,
              'submast_cat' : sdata,
              'submore_cat' : smdata,
            },
            beforeSend:function(request){
              return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
            },
            success:function(registerStatus){
              
               let newregistration = registerStatus;
                  if(newregistration.status == 403){
                    $("#add_category_success_data").css("display","none");
                    $("#add_category_failiur_data").css("display","block");
                  }else if(newregistration.status == 203){
                    $("#mst_add_subbing_cat_more_filter").val("");
                    $("#add_category_success_data").css("display","block");
                    $("#add_category_failiur_data").css("display","none");
                  }
               

            },
            error:function(xhr,xht){
              console.log("data"+xht);
            }
            
          });  
        }else{
          
        }




      });

      $("#add_new_master_01").on("click",function(data){
        let saveProcessStart = false;
        let masterFields,masterCatFir;
          masterFields = checkmasterField("dec_sig");
          let dataClass = new Category("<?= $enc_key["ivText"];?>",masterFields,"");
          let masterFieldsData= dataClass.createMasterCategory(); 
          let userCreateCategory = ["administrator_m_cat"];

          for (var i = 0; i < 1; i++) {
          
            var input = document.createElement("input");
            input.type = "hidden";
            input.className = userCreateCategory[i];
            input.id = userCreateCategory[i]; 
            document.getElementById("category_load").appendChild(input); 
          } 

          masterCatFir = $("#administrator_m_cat").val(masterFieldsData);  
      
          if(saveProcessStart == false){
          $.ajax({
            url: "{{route('single_master_add_admin_category_ms_category')}}",
            method: 'post',
            async:false,
            dataType:"json",
            data: {
              'master_cat' : masterFieldsData,
            },
            beforeSend:function(request){
              return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
            },
            success:function(registerStatus){
              saveProcessStart = false;
               var status = registerStatus;
                  
                  if(status = false){
                    $("#add_categroy_success_data").css("display","none");
                    $("#add_categroy_failiur_data").css("display","block");
                  }else if(status = true){
                    make_new_load_main_category();
                    $("#mst_add_new_master_cat").val("");
                    $("#add_categroy_success_data").css("display","block");
                    $("#add_categroy_failiur_data").css("display","none");
                  }else{
                    $("#add_categroy_success_data").css("display","none");
                    $("#add_categroy_failiur_data").css("display","none");
                  }
            

            },
            error:function(xhr,xht){
              console.log("data");
            }
            
          });
          }


      });
      
      function checkmasterField(data){
          if(data=="dec_mlt"){
          let $masterFields = $("#mst_add_master_cat").val();
            if($.trim($masterFields) != ""){
              return $masterFields;
            }else{
              return "negative";
            }  
          }else if(data=="dec_sig"){
          let $masterFields = $("#mst_add_new_master_cat").val();
            if($.trim($masterFields) != ""){
              return $masterFields;
            }else{
              return "negative";
            }    
          } 
      }

      function checkSubField(){
          let $subFields = $("#mst_add_new_sub_master_cat").val();
          if($.trim($subFields) != ""){
            return $subFields;
          }else{
            return "negative";
          } 
      } 

      

      function make_new_load_main_category(){
            $.ajax({
                url: "{{route('single_master_add_admin_category_ms_category')}}",
                method: 'post',
                async:false,
                dataType:"json",
                data: {
                  'master_cat' : "get_new",
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'))
                },
                success:function(registerStatus){
                    let new_categories = registerStatus; 
                    let options;
                    for (var i=0; i < new_categories.length ; i++) {
                      options += "<option value="+new_categories[i]["categoryid"]+">"+new_categories[i]["categoryname"]+"</option>";
                    }
                    $("#mst_add_master_cat").empty().append(options);  

                }
          });
      }  
      });



      function ssite_category_load(){
            $.ajax({
                url: "{{route('site_make_load_saved_categories')}}",
                method: 'get',
                
                contentType: 'application/json',
                success:function(registerStatus){
                      let data =  registerStatus;
                      let dataTable;
                      for (var i=0; i < data.length; i++) {
                           dataTable += "<tr><td> "+(i+1)+" </td><td style='text-transform:capitalize;'>"+data[i]["m_c_name"]+"</td><td style='text-transform:capitalize;'>"+data[i]["m_s_c_name"]+"</td></tr>";
                      } 
                      $("#category_list_table_b").empty().html(dataTable);  
                }
          });
      }  

      
      function site_category_load(){
      $.ajax({
            'url': "{{route('site_make_load_saved_categories')}}",
            'method': "GET",
            'contentType': 'application/json'
        }).done( function(data) {
            console.log(data);
            $('#category_list_table').dataTable( {
                "aaData": data,
                "columns": [
                    {"data": "m_c_name"},
                    {"data": "m_s_c_name"},
                    {"data": "m_s_c_com_name"}
                ]
            })
        })
       } 


      function Display_selected_sub_category(){
        var d = new Date();
        var n = d.getTime();

        console.clear();
      
      var master_categry_id = $("#mst_add_master_cat").val();  
      $.getJSON("{{asset('category_data/subcategory_category_file.json')}}", function(json){
        $("#mst_add_subbing_cat").html("");
        var result,results_set;
        result = json;
        
        for (var i = 0; i < result.length; i++) {
            if(result[i].smid == master_categry_id){
              results_set = "<option value="+result[i].sid+">"+result[i].sname+"</option>";
              $("#mst_add_subbing_cat").append(results_set); 
            }
        }
      });
      }
    </script>





    <script>
      
      $(".update_my_content").on("click",function(){
      
          var mid = $(this).data("loadingid");
          var mname = $(this).data("loadingname");
          $("#make_master_update_master").attr("data-loaded",mid);
          $("#master_update_compose_rate").val(mname);
          $("#update_master_cat").modal({
            backdrop: 'static',
            keyboard: false,
            show:true
          });
      
      });
      
      $("#make_master_update_master").on("click",function(){
      
        $("#confirmation_promt").css("display","block");
      
      });

      var masterDarted = false;  
      $("#make_update_change_master").on("click",function(){
        
        var _name = $.trim($("#master_update_compose_rate").val());
        var _id = $("input[name='select_operation_master']:checked").val();
        var _checked = $("#make_master_update_master").attr("data-loaded");
        if(_name != "" && _id != ""){
            
          if(masterDarted == false){
              masterDarted = true;

              $.ajax({
                url:encodeURI('{{route('make_chamges_on_master_category')}}'),
                method:"POST",
                data:{
                  "data1" : _name,
                  "data2" : _id,
                  "data3" : _checked
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                   masterDarted = false;
                   $("#succeess_operation_111").css("display","block");
                   $("#succeess_operation_222").css("display","none");
                },
                error:function(data,error){
                   masterDarted = false;
                   $("#succeess_operation_111").css("display","none");
                   $("#succeess_operation_222").css("display","block"); 
                }
              }); 

          }else{
            alert("Please wait");
          }

        }

      });

      $("#check_clear_info").on("click",function(){
      
        $("#confirmation_promt").css("display","none");
        $("#make_master_update_master").removeAttr("data-loaded");
        $("#master_update_compose_rate").val("");
      
      });
    </script>
    <script>
      
      $(".update_my_sub_content").on("click",function(){
      
          var sid = $(this).data("loadingid");
          var sname = $(this).data("loadingname");
          $("#make_master_update_master_sub").attr("data-loaded",sid);
          $("#sub_master_update_compose_rate").val(sname);
          $("#update_sub_cat").modal({
            backdrop: 'static',
            keyboard: false,
            show:true
          });
      
      });

      $("#make_master_update_master_sub").on("click",function(){
        $("#confirmation_promt_sum_load").css("display","block");
      });

      $("#check_clear_info_sub").on("click",function(){
        $("#confirmation_promt_sum_load").css("display","none");
        $("#make_master_update_master_sub").removeAttr("data-loaded");
        $("#sub_master_update_compose_rate").val("");
      });  

      var SubmasterDarted = false;  
      $("#make_update_change_master_sub").on("click",function(){
        
        var _name = $.trim($("#sub_master_update_compose_rate").val());
        var _id = $("input[name='select_operation_master_sub']:checked").val();
        var _checked = $("#make_master_update_master_sub").attr("data-loaded");
        if(_name != "" && _id != ""){
            
          if(SubmasterDarted == false){
              SubmasterDarted = true;

              $.ajax({
                url:encodeURI('{{route('make_chamges_on_sub_master_category')}}'),
                method:"POST",
                data:{
                  "data1" : _name,
                  "data2" : _id,
                  "data3" : _checked
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                   SubmasterDarted = false;
                   $("#succeess_operation_111_sub_load").css("display","block");
                   $("#succeess_operation_222_sub_load").css("display","none");
                   
                },
                error:function(data,error){
                   SubmasterDarted = false;
                   $("#succeess_operation_111_sub_load").css("display","none");
                   $("#succeess_operation_222_sub_load").css("display","block");
                }
              }); 

          }else{
            alert("Please wait");
          }

        }

      });
    </script>
    <script>
      
      $(".update_my_sub_complementory_content").on("click",function(){
      
          var sid = $(this).data("loadingid");
          var sname = $(this).data("loadingname");
          $("#make_master_update_master_sub_complementory").attr("data-loaded",sid);
          $("#subc_master_update_compose_rate").val(sname);
          $("#update_complmentory_cat").modal({
            backdrop: 'static',
            keyboard: false,
            show:true
          });
      
      });

      $("#make_master_update_master_sub_complementory").on("click",function(){
        $("#confirmation_promt_csum_load").css("display","block");
      });

      $("#check_clear_info_csub").on("click",function(){
        $("#confirmation_promt_csum_load").css("display","none");
        $("#make_master_update_master_sub_complementory").removeAttr("data-loaded");
        $("#subc_master_update_compose_rate").val("");
      });  

      var SubmasterDarted = false;  
      $("#make_update_change_master_csub").on("click",function(){
        
        var _name = $.trim($("#subc_master_update_compose_rate").val());
        var _id = $("input[name='select_operation_master_csub']:checked").val();
        var _checked = $("#make_master_update_master_sub_complementory").attr("data-loaded");
        if(_name != "" && _id != ""){
            
          if(SubmasterDarted == false){
              SubmasterDarted = true;

              $.ajax({
                url:encodeURI('{{route('make_chamges_on_csub_master_category')}}'),
                method:"POST",
                data:{
                  "data1" : _name,
                  "data2" : _id,
                  "data3" : _checked
                },
                beforeSend:function(request){
                  return request.setRequestHeader('X-CSRF-Token',$("meta[name='csrf-token']").attr('content'));
                },
                success:function(data){
                   SubmasterDarted = false;
                   $("#succeess_operation_111_csub_load").css("display","block");
                   $("#succeess_operation_222_csub_load").css("display","none");
                },
                error:function(data,error){
                   SubmasterDarted = false;
                   $("#succeess_operation_111_csub_load").css("display","none");
                   $("#succeess_operation_222_csub_load").css("display","block"); 
                }
              }); 

          }else{
            alert("Please wait");
          }

        }

      });
    </script>
@endsection  	