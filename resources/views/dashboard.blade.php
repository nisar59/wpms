<!-- start page title -->
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-12">
      <img src="{{url('img/dashboard/cws_main_banner.png')}}" width="100%" alt="">
    </div>
  </div>
</div>
<!-- end page title -->
<div class="row">
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:linear-gradient(to right, #0095da 0%, #005aaa 40%); border-radius: 15px;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 bg-transparent text-white">
            <img src="{{url('img/dashboard/total_school.png')}}" style="max-width: 100%!important;" alt="">
          </div>
          <h5 class="fw-bold fs-4 text-white text-uppercase">{{number_format($total_school)}}</h5>
          <h4 class="fw-bold font-size-16 text-white">Total School Supported</h4>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:linear-gradient(to right, #ff9900 55%, #ffcc00 100%); border-radius: 15px;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 bg-transparent text-white">
            <img src="{{url('img/dashboard/students.png')}}" style="max-width: 100%!important;" alt="">
          </div>
          <h5 class="fw-bold fs-4 text-white text-uppercase">{{number_format($students_benefited)}}</h5>
          <h4 class="fw-bold font-size-16 text-white">Student Benefited</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:linear-gradient(to right, #005aaa 10%, #8ed8f8 100%); border-radius: 15px;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 bg-transparent text-white">
            <img src="{{url('img/dashboard/plants install.png')}}" style="max-width: 100%!important;" alt="">
          </div>
          <h5 class="fw-bold fs-4 text-white text-uppercase">{{number_format($plants_installed)}}</h5>
          <h4 class="fw-bold font-size-16 text-white" style="font-size:12px;">Water Filtration Plants Installed</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6">
    <div class="card mini-stat text-dark" style="background:linear-gradient(to right, #006666 42%, #009999 100%); border-radius: 15px;">
      <div class="card-body">
        <div class="mb-4">
          <div class="float-start mini-stat-img me-4 bg-transparent text-white">
            <img src="{{url('img/dashboard/in_process.png')}}" style="max-width: 100%!important;" alt="">
          </div>
          <h5 class="fw-bold fs-4 text-white text-uppercase">{{number_format($plants_in_process)}}</h5>
          <h4 class="fw-bold font-size-16 text-white" style="font-size:12px;">Water Plants Installation In-Process</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-white">
        <h4>Plants Installed</h4>
      </div>
      <div class="card-body">        
        <canvas id="plants-installed" height="250"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-white">
        <h4>Plants Type</h4>
      </div>
      <div class="card-body">
        <canvas id="plants-type" height="250px"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card bg-danger">
      <div class="card-header bg-danger text-white">
        <h4>Pending</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <img src="{{url('img/dashboard/pending_banner.jpg')}}" width="100%" alt="">
          </div>
          <div class="col-4 row align-items-center ">
            <p class="text-white"><span class="fw-bold fs-1">13</span> <br> <span>Schools are pending for water filtration plants</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header bg-white">
        <h4>Geo Tagging</h4>
      </div>
      <div class="card-body">
        <div id="map" style="height: 240px;"></div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-body p-0">
        <div class="row m-0">
          <div class="col-12 m-0 p-0">
            <table class="table">
              <thead class="bg-primary text-white text-center">
                <th>Sr No.</th>
                <th>School Name</th>
                <th>Plant Type</th>
                <th>No. of Benefiting Students</th>
                <th>Plant Installed on</th>
                <th>Action</th>
              </thead>
              <tbody>
              @foreach ($all_schools as $key => $school)
                @php
                  $plants=[];

                  foreach($school->SchoolPlants as $sp){
                    $plants[]=Plants($sp->plant_id);
                  }
                  $plants=implode(',', $plants);
                @endphp

                <tr class="text-center">
                  <td>{{$key+1}}</td>
                  <td>{{$school->name}}</td>
                  <td>{{$plants}}</td>
                  <td>{{number_format($school->no_of_students)}}</td>
                  <td>{{number_format($school->SchoolPlants->count())}}</td>
                  <td><a class="btn btn-info btn-sm" href="{{url('school/view/'.$school->id)}}"><i class="fas fa-eye"></i></a></td>
                </tr>    
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script>    

/*  function initMap() {
      const myLatLng = { lat: -25.36579103011043, lng: 131.06820442343616 };
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 14,
        center: myLatLng,
      });

      new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Hello World!",
      });
    }

    window.initMap = initMap;*/
   
/*const properties = [
  {
    address: "215 Emily St, MountainView, CA",
    description: "Single family house with modern design",
    price: "$ 3,889,000",
    type: "home",
    bed: 5,
    bath: 4.5,
    size: 300,
    position: {
      lat: 37.50024109655184,
      lng: -122.28528451834352,
    },
  }];*/
var properties=JSON.parse('{!! $gis !!}');
console.log(properties);
function buildContent(property) {
  const content = document.createElement("div");

  content.classList.add("property");
  content.innerHTML = `
    <div class="card text-white" style="background-color:`+property.color+`">
      <div class="card-body p-2">
      <div class="row text-center m-0">
        <div class="col-12 m-0 p-0">
          <i class="fs-1 fas fa-home fa-lg"></i>
        </div>
        <div class="col-12 m-0 p-0">
          <p class="m-0"><b class="fs-6">School Name</b><br>`+property.name+`</p>
          <p class="m-0"><b class="fs-6">Students</b><br>`+property.students+`</p>
        </div>
      </div> 
      </div>
    </div>
  `;
  return content;
}


function toggleHighlight(markerView, property) {
window.open(property.url, '_blank');
}







async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
  const { LatLng } = await google.maps.importLibrary("core");
  const center = new LatLng(30.646750061918258, 73.27698189640144);
  const map = new Map(document.getElementById("map"), {
    zoom: 11,
    center,
    mapId: "4504f8b37365c3d0",
  });

  for (const property of properties) {
    const AdvancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
      map,
      content: buildContent(property),
      position: property.position,
      title: property.description,
    });

    AdvancedMarkerElement.addListener("click", () => {
      toggleHighlight(AdvancedMarkerElement, property);
    });
  }
}


$(document).ready(function() {
    const api='AIzaSyD_lu0WQ-e7WtC9QNr1Of2VGfD66FXx-QM';







    const deposits = JSON.parse('{!!$barchart!!}');
    console.log(deposits);
    new Chart($('#plants-installed'), {
        type: 'bar',
        data: deposits,
        options: {
            responsive: true,
            maintainAspectRatio: false
        },
    });

    const pie = JSON.parse('{!!$pie!!}');
    console.log(pie);

    new Chart($('#plants-type'), {
        type: 'pie',
        data: pie,
        options: {
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            responsive: true,
            maintainAspectRatio: false,
        },
    });
});
</script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_lu0WQ-e7WtC9QNr1Of2VGfD66FXx-QM&callback=initMap&v=weekly"
      defer
    ></script>

@endsection
