@extends('master.mainadmin.index')
@section('title_of_page')
	Dashboard
@endsection


@section('content_to_body')
  <style type="text/css" scoped>
    .make_txt_change{
      overflow: overlay;  
    }
  </style>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info make_txt_change" >
              <h4>Advertiesments</h4>
              <p><b>{{$available_summery[1]}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>User Accounts</h4>
              <p><b>{{$available_summery[0]}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Pending Advertise</h4>
              <p><b>{{$available_summery[2]}}</b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-money fa-3x"></i>
            <div class="info">
              <h4>Payment State</h4>
              <p><b>0*</b></p>
            </div>
          </div>
        </div>
      </div>
       <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="row">
              <div class="col-sm-12">
               <h4 class="mb-3">Promo-Code details<span style="font-size:15px;float: right;"><a href="{{route('loadview_.promocodeview')}}">View Info</a></span></h4>   
               <table class="table table-sm table-bordered">
                 <thead>
                   <th>#</th>
                   <th>Promo-code</th>
                   <th>Type</th>
                   <th>Issued On</th>
                 </thead>
                 <tbody >
                  @forelse($available_summery[3] as $key =>  $promocodeDetailse)
                    <tr>
                      <td>{{sprintf('%010d',(++$key) )}}</td>
                      <td>{{$promocodeDetailse->dash_pcode}}</td>
                      <td>{{($promocodeDetailse->dash_pcodetype == 185) ? "Social Marketing" : "Commercial" }}</td>
                      <td>{{\Carbon\Carbon::create($promocodeDetailse->dash_cpreaded)->toDateString()}}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4">No info founded</td>
                    </tr>    
                  @endforelse  
                 </tbody>
               </table> 
              </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="row">
              <div class="col-sm-12">
               <h4 class="mb-3">New created profiles <span style="font-size:15px;float: right;"><a href="{{route('stfprocromb_checkApprposts')}}">View Info</a></span></h4>   
               <table class="table table-sm table-bordered">
                 <thead>
                   <th>#</th>
                   <th>Account Type</th>
                   <th>Register From</th>
                   <th>Mail Address</th>
                   <th>Activated On</th>
                 </thead>
                 <tbody >
                  @forelse($available_summery[4] as $key =>  $profileCreatedDetailse)
                    <tr>
                      <td>{{sprintf('%010d',(++$key) )}}</td>
                      <td>{{($profileCreatedDetailse->dash_acc_type == 96) ? "Normal" : "Company" }}</td>
                      <td>{{$profileCreatedDetailse->dash_chosed_country}}</td>
                      <td>{{$profileCreatedDetailse->dash_compnymail}}</td>
                      <td>{{\Carbon\Carbon::create($profileCreatedDetailse->dash_created_on)->toDateString()}}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5">No info founded</td>
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
      <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="row">
              <div class="col-sm-12">
               <h4 class="mb-3">Latest currency update <span style="font-size:15px;float: right;"><a href="{{route('stftrckchatclient_clients')}}">View Info</a></span></h4>   
               <table class="table table-sm table-bordered">
                 <thead>
                   <th>#</th>
                   <th>Country</th>
                   <th>Rate </th>
                 </thead>
                 <tbody >
                  @php
                    $currency = ["USD","LKR","INR","JEP","IQD","IMP","PKR","PGK","ZMW","XPF"];
                  @endphp
                  @forelse($available_summery[5] as $key =>  $currency_info)
                    
                    <tr>
                      <td>{{sprintf('%010d',(++$key) )}}</td>
                      <td>{{$currency[--$key]}}</td>
                      <td>{{number_format($currency_info,2,'.','')}}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3">No info founded</td>
                    </tr>  
                  @endforelse 
                 </tbody>
               </table> 
              </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="row">
              <div class="col-sm-12">
               <h4 class="mb-3">Ask Question - FAQ <span style="font-size:15px;float: right;"><a href="">View Info</a></span></h4>   
               <table class="table table-sm table-bordered">
                 <thead>
                   <th width="130">#</th>
                   <th width="250">Request From</th>
                   <th>Message</th>
                 </thead>
                 <tbody >
                    <tr>
                      <td>000000000001</td>
                      <td>Mohammed Arshad</td>
                      <td>Halo sir, how to login to site?</td>
                    </tr>
                 </tbody>
               </table> 
              </div>
              </div>
            </div>
          </div>
        </div>
       </div>
      <!--  <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="mb-3 line-head" id="buttons">Section Two</h2>
              <div class="row">
              <div class="col-sm-6">
               <h4 class="mb-3">Advertisers</h4> 
               <table class="table">
                 <thead>
                   <th>#</th>
                   <th>Company Name</th>
                   <th>From</th>
                   <th>Registered On</th>
                 </thead>
                 <tbody >
                    <tr>
                      <td>1</td>
                      <td>Son & Sons</td>
                      <td>Sri Lanka</td>
                      <td>5 Days ago</td>
                    </tr>
                 </tbody>
               </table>   
              </div>
              </div>
            </div>
          </div>
        </div>
       </div> -->
  	</main>
@endsection  	