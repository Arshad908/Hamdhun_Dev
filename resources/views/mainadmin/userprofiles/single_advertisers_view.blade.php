@extends('master.mainadmin.index')
@section('title_of_page')
  User Profile
@endsection


@section('content_to_body')

<style type="text/css">
  #select_chenaged{
    color: #030303;
    border-left: 6px #dedede solid;
    padding: 10px 21px 4px 15px;
    border-top: 1px #dedede solid;
    border-bottom: 1px #dedede solid;
    border-right: 1px #dedede solid;
  }
</style>
    
    @php

    $firstn = "";
    $lastname = "";
    $company_name = "";
    $account_type = "";
    $company_domain_name = "";
    $contact_number = "";
    $contact_email = "";
    $company_address = "";
    $geo_location = "";
    $state = "";
    $city = "";
    $logo = "";
    $active = "";

    foreach($loadprofile_info[0] as $profile_info){

          $firstn = $profile_info->pdfirstnm;
          $lastname = $profile_info->pdlastnm;
          $company_name = $profile_info->pdcomname;
          $account_type = $profile_info->pdacctype;
          $company_domain_name = $profile_info->pdrealDomain;
          $contact_number = $profile_info->pdcontdeta;
          $contact_email = $profile_info->pdcomemail;
          $company_address = $profile_info->pdcompanyadd;
          $geo_location = $profile_info->pdimwhere;
          $state = $profile_info->pdstate;
          $city = $profile_info->pdcity;
          $logo = $profile_info->pdlogo;
          $active = $profile_info->pdactive;

    }

    @endphp
    
    <main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile" >
            <div class="info" style="width: 100%;background-size: 300px 250px;background-repeat: no-repeat;background-position: center;"><img class="user-img" style="" width="300" height="100" src="{{ ($logo == '') ? 'https://www.kluneo.com/static/avatar.svg' : asset($logo) }}">
              <h4>{{$firstn."  ".$lastname}}</h4>
              @if($account_type == 114)
              <h5 style="font-weight: 100">Created - {{$company_name}}</h5>
              @endif
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Profile Info</a></li>
             
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post">
                
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Profile User Name</label>
                  </blockquote>  
                  
                  <label>{{$firstn."  ".$lastname}}</label>
                </div>
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Company name</label>
                  </blockquote>  
                  
                  <label>{{($account_type == 114) ? $company_name : "I am not an advertiser" }}</label>
                </div>
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Contact details</label>
                  </blockquote>  
                  <div class="row">
                      <div class="col-sm-6">
                        <p><span>Address : </span>{{$company_address}}</p>
                        <p><span>State : </span>{{$state}}</p>
                        <p><span>City : </span>{{$city}}</p>
                      </div>
                      <div class="col-sm-6">
                        <p><span>Contact : </span>{{$contact_number}}</p>
                        <p><span>Email : </span>{{$contact_email}}</p>
                        <p><span>Visit From : </span>{{$geo_location}}</p>
                      </div>
                  </div>
                </div>
                @if($account_type == 114)
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Company Domain</label>
                  </blockquote>  
                  
                  <label>{{$company_domain_name}}</label>
                </div>
                @endif
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Active Account</label>
                  </blockquote>  
                  
                  <label>{{($active==1) ? "Active" : "Deactive" }}</label>
                </div>
                
              


              </div>
          

            </div>
      <!--       <div class="tab-pane fade" id="user-settings">
              <div class="tile user-settings">
                <div class="form-group">
                  <blockquote id="select_chenaged">
                    <label class="control-label">Profile User Name</label>
                  </blockquote>  
                  
                  <label>{{$firstn."  ".$lastname}}</label>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </main>


@endsection    