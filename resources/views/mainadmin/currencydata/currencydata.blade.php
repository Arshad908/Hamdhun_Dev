@extends('master.mainadmin.index')
@section('title_of_page')
	Currency State
@endsection


@section('content_to_body')

 <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-money"></i> Currency</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Currency</a></li>
        </ul>
      </div>
       <div class="tile mb-4">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="mb-3 line-head" id="buttons">Listed Currency Info - EUR</h2>
            </div>
            @foreach($countries_rates['rates'] as $currency => $count)
            <div class="col-sm-6 col-lg-2 col-md-3">
            		<div class="card " style="padding: 16px;border-color: #f5f5f500;">
            		<div class="card-body text-center" style="border:1px solid rgba(193, 174, 174, 0.81);">
                    <p>{{$currency}}</p>
                    <hr>
		                <p>{{number_format($count,2,'.','')}}</p>
		            </div>	
            		</div>	
            </div>
            @endforeach
            </div>
          </div>
        </div>
       </div>
  	</main>
        
@endsection