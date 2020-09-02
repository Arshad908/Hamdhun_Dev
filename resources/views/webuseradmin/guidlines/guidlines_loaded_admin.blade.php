@extends('master.webadmin.index')
@section('title_of_page')
	Guid Lines To Advertisers
@endsection


@section('content_to_body')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-indent"></i>&emsp;User Guide</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('loaddashboardscreen')}}"><i class="fa fa fa-dashboard fa-lg"></i></a></li>
          <li class="breadcrumb-item">Post</li>
          <li class="breadcrumb-item"><a href="#">Guide Lines</a></li>
        </ul>
      </div>
      <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="mb-3 line-head" id="buttons">Guidance To Crteate Post</h2>
            </div>
            <div style="padding: 0px 0px 0px 18px">
              @forelse($guidance_to_create_ppost as $data)
              {!!nl2br($data->cont)!!}
              @empty
              Updating content
              @endforelse
            </div>
          </div>
        </div>
      </div>
</main>      

@endsection