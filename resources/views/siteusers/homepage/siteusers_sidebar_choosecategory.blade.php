  <style type="text/css" scoped>
    .nav a, .nav label {
  display: block;
  padding: .85rem;
  color: #fff;
  background-color: #151515;
  box-shadow: inset 0 -1px #1d1d1d;
  -webkit-transition: all .25s ease-in;
  transition: all .25s ease-in;
}

.nav a:focus, .nav a:hover, .nav label:focus, .nav label:hover {
  color: rgba(255, 255, 255, 0.5);
  background: #030303;
}

.nav label { cursor: pointer; }
/**
 * Styling first level lists items
 */

.group-list a, .group-list label {
  padding-left: 2rem;
  background: #252525;
  box-shadow: inset 0 -1px #373737;
}

.group-list a:focus, .group-list a:hover, .group-list label:focus, .group-list label:hover { background: #131313; }

/**
 * Styling second level list items
 */

.sub-group-list a, .sub-group-list label {
  padding-left: 2rem;
  background: #353535;
  box-shadow: inset 0 -1px #474747;
}

.sub-group-list a:focus, .sub-group-list a:hover, .sub-group-list label:focus, .sub-group-list label:hover { background: #232323; }

/**
 * Styling third level list items
 */

.sub-sub-group-list a, .sub-sub-group-list label {
  padding-left: 0.5rem;
  background: #454545;
  box-shadow: inset 0 -1px #575757;
}

.sub-sub-group-list a:focus, .sub-sub-group-list a:hover, .sub-sub-group-list label:focus, .sub-sub-group-list label:hover { background: #333333; }

/**
 * Hide nested lists
 */

.group-list, .sub-group-list, .sub-sub-group-list {
  height: 100%;
  max-height: 0;
  overflow: hidden;
  -webkit-transition: max-height .5s ease-in-out;
  transition: max-height .5s ease-in-out;
}

.nav__list input[type=checkbox]:checked + label + ul { /* reset the height when checkbox is checked */
max-height: 1000px; }
label > span {
  float: right;
  -webkit-transition: -webkit-transform .65s ease;
  transition: transform .65s ease;
}

.nav__list input[type=checkbox]:checked + label > span {
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}

  </style>
        <aside class="col-lg-3" id="sidebar">
          <!-- Searching part -->
          <div class="custom-search-input-2 inner-2">
            <form action="{{route('userFilterResultsSesarching')}}" method="POST" accept-charset="UTF-8">
             
            <div class="form-group">
              <input class="form-control" name="product_searching" type="text" placeholder=" I am looking for">
              @csrf 
              <i class="icon_search"></i>
            </div>
            <input type="submit" name="search" id="search" class="btn_search" value="Search">
            </form>
          </div>

          <!-- /custom-search-input-2 -->
          <div id="filters_col">
            <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filter Category </a>
              <nav class="nav" role="navigation">
                
                @php

                  $coloursForData = [
                    "#684D47","#685E47","#626847","#526847","#47684D","#47685E","#4A180D","#4A370D",
                    "#3F4A0D","#214A0D","#0D4A18","#0D4A37","#0D4A23","#0D4A42","#0D344A","#0D154A",
                    "#230D4A","#420D4A","#380D4A","#4A0D3D","#4A0D1F","#4A380D","#3E4A0D","#523843",
                    "#523A38","#524738","#435238","#38523A","#505238","#004B15","#004B3B","#00364B",
                    "#00104B","#15004B","#3A004B","#564C05","#385605","#0F5605","#055623","#05564C",
                    "#053756","#5C511C","#475C1C","#275C1C","#1C5C31","#1C475C","#1C5C51","#1C375C",
                    "#211C5C","#411C5C","#5C1C37","#5C1C57,"#303843","#313043","#3A3043","#433038","#433042"
                    ,"#620D51","#490D62","#1E0D62"];

                  //Array category_data
                  $dataMaster = [];
                  $dataSubMaster = []; 

                @endphp

                 
                <!-- get the compact count -->
                @for($sizeCount = 0;$sizeCount < count($categories_side_bar); $sizeCount++)
                
                @php
                   
                    $matching_founded_master = false;
                    $masterCId = $categories_side_bar[$sizeCount]->postmainCId; 
                    $masterCName = $categories_side_bar[$sizeCount]->postmainCName;
                    $masterSubCId = $categories_side_bar[$sizeCount]->postsubmainCId; 
                    $masterSubCName = $categories_side_bar[$sizeCount]->postsubmainCName;

                    for($count = 0;$count < count($dataMaster) ; $count++){
                      foreach($dataMaster[$count] as $key=>$one){
                        if($key == $masterCId){
                          $matching_founded_master = true;
                        }
                      }
                    }

                    // Master id push
                    if($matching_founded_master == false){
                      array_push($dataMaster,[$masterCId => $masterCName]);
                      //array_push( $dataSubMaster,[$masterCId=>[] ]);
                    }

                    //$counData = count($dataSubMaster)-1;
                    //for($c2 = 0; $c2 < count($dataSubMaster) ; $c2++ ){
                    //    if($c2 == $counData){
                              
                    //    }
                    //}
                    $dataSub = [
                        "mid" => $masterCId,
                        "sid" => $masterSubCId,
                        "sname" => $masterSubCName
                    ];
                    array_push($dataSubMaster,$dataSub);


                @endphp

                @endfor


              

               





                

                




                <ul class="nav__list" style="width: 100%;margin-top: 10px">
                  @php
                    $countingColour = 0;
                  @endphp
                  @for($countp = 0; $countp < count($dataMaster) ; $countp++ )
                      
                  @foreach($dataMaster[$countp] as $key=>$data2 )
                  
                  <li style="color: white">
                    <input id="group-{{$countp}}" type="checkbox" hidden />
                    <label for="group-{{$countp}}" style="color:white;background-color: {{$coloursForData[$countingColour]}};font-weight: bold;text-transform: capitalize;"><span class="fa fa-angle-right"></span>{{$data2}}</label>
                    <ul class="group-list">
                      @php
                          $nowGoingSubId = 0;
                      @endphp  
                      @for($c3 = 0 ; $c3 < count($dataSubMaster) ; $c3++) 
                        
                        @if($dataSubMaster[$c3]['mid'] == $key && $nowGoingSubId != $dataSubMaster[$c3]['sid'])  
                        <li style="text-transform: capitalize;"><a href="{{route('categorypage_LDDTCM_categoryposts_page',['master_id'=>base64_encode($key+15482657816458),'category'=>$data2,'check'=>base64_encode($key+7981)])}}">{{$dataSubMaster[$c3]['sname']}}</a></li>
                        @endif
                        @php
                          $nowGoingSubId = $dataSubMaster[$c3]['sid'];
                        @endphp
                      @endfor    
                    </ul>

                  </li>

                  @endforeach
                  
                      @php
                      ++$countingColour;
                      @endphp
                  

                  @endfor
                </ul>
</nav>
                
          </div>
          <!--/filters col-->
        </aside>
        <!-- /aside -->