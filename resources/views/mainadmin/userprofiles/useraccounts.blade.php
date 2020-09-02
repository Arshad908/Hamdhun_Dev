@extends('master.mainadmin.index')
@section('title_of_page')
	User Profiles
@endsection


@section('content_to_body')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-address-book-o"></i> Profiles</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Profile</li>
          <li class="breadcrumb-item"><a href="#">Users Profile</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile"> 
          <div class="tile-body table-responsive">
              <table class="table table-sm table-hover table-bordered" id="advertisersTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Domain</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Active</th>
                    <td>Country</td>
                    <th width="65">Option</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($available_listed_advertisers as $salute => $advertisers)
                 	<tr>
                 		<td>{{sprintf("%015d",($salute+1))}}</td>
                 		<td>{{$advertisers->adcompanyname}}</td>
                 		<td>{{$advertisers->adrealdomain}}</td>
                 		<td>{{$advertisers->adcontact}}</td>
                 		<td>{{$advertisers->adcompanyemail}}</td>
                 		<td>{{($advertisers->adactive) ? "Active":"Deactive"}}</td>
                    <td>{{$advertisers->adcountry}}</td>
                 		<td>
                 			<a href="{{route('view_user_profile_info_to_MA',['id'=>base64_encode(rand(15,100)), 'qr'=>$advertisers->adcompanyname,'ck'=>base64_encode(rand(9999,100000)),'gt'=>$advertisers->adcompanyid,'prom'=>'view_info'])}}" class="btn btn-sm btn-info ">View Info</a> 
                 		</td>
                 	</tr>
                  @empty
                  <tr> 
                    <td colspan="8">No Advertisers Founded</td>
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