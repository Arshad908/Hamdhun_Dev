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
          <li class="breadcrumb-item"><a href="#">New Profiles</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile"> 
          <div class="tile-body table-responsive">
              <table class="table  table-hover table-bordered" id="userPostsedTable">
                <thead>
                  <tr>
                    <th>User Id</th>
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>Company Name</th>
                    <th>Account Type</th>
                    <th>Email</th>
                    <th width="50">Option</th>
                  </tr>
                </thead>
                <tbody>
                 	<tr>
                 		<td>#1234567890</td>
                 		<td>First Name</td>
                 		<td>last Name</td>
                 		<td>Second Name</td>
                 		<td>Company Name</td>
                 		<td>company@gmail.com</td>
                 		<td>
                 			<a href="#" class="btn btn-sm btn-info ">View Info</a>
                   	</td>
                 	</tr>
                 	<tr>
                    <td>#1234567890</td>
                    <td>First Name</td>
                    <td>last Name</td>
                    <td>Second Name</td>
                    <td>Company Name</td>
                    <td>company@gmail.com</td>
                    <td>
                      <a href="#" class="btn btn-sm btn-info ">View Info</a>
                    </td>
                  </tr>
                 </tbody>
                </table> 
            </div>
          </div>
         </div>
        </div>
        </main>

@endsection