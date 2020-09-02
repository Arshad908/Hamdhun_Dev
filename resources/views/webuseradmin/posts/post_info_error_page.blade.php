@extends('master.webadmin.index')
@section('title_of_page')
	Post Info Not Found
@endsection


@section('content_to_body')
<main class="app-content">
      <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> Error : incorrect post information.</h1>
        <p>The page you have requested is not found.</p>
        <p><a class="btn btn-primary" href="{{route('webadminuserlikeandsaved')}}">View Post</a></p>
      </div>
    </main>
@endsection