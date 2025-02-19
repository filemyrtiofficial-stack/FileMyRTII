@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

    
    <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome User</h3>
                </div>
                <!-- <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                 </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="col-md-3 stretch-card transparent">
                <div class="card card-tale">
                <div class="card-body">
                    <p class="mb-4">Total Blog</p>
                    <p class="fs-30 mb-2">40</p>
                </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card transparent">
                <div class="card card-dark-blue">
                <div class="card-body">
                    <p class="mb-4">Active Lawyers</p>
                    <p class="fs-30 mb-2">{{count($lawyers)}}</p>
                </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card transparent">
                <div class="card card-light-blue">
                <div class="card-body">
                    <p class="mb-4">Approved RTI</p>
                    <p class="fs-30 mb-2">{{count($approved_application)}}</p>
                </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card transparent">
                <div class="card card-light-danger">
                <div class="card-body">
                    <p class="mb-4">Pending RTI</p>
                    <p class="fs-30 mb-2">{{count($pending_application)}}</p>
                </div>
                </div>
            </div>
            
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                       <h4> Total RTI</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h4 class="text-danger">Total</h4>
                                <br>
                                <h5>{{count($applications)}}</h5>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-danger">Pending</h4>
                                <br>
                                <h5>{{count($pending_application)}}</h5>
                            </div>
                            <div class="col-md-3">
                            <h4 class="text-danger">Approved</h4>
                                <br>
                                <h5>{{count($approved_application)}}</h5>
                            </div>
                            <div class="col-md-3">
                            <h4 class="text-danger">Filed</h4>
                                <br>
                                <h5>{{count($filed_application)}}</h5>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 mt-3">
            <div class="card">
                    <div class="card-header">
                       <h4>RTI Type</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <h4 class="text-danger">Initial Appeal</h4>
                                <br>
                                <h5>{{count($initial_application)}}</h5>
                            </div>
                            <div class="col-md-3">
                                <h4 class="text-danger">First Appeal</h4>
                                <br>
                                <h5>{{count($first_application)}}</h5>
                            </div>
                            <div class="col-md-3">
                            <h4 class="text-danger">Second Appeal</h4>
                                <br>
                                <h5>{{count($second_application)}}</h5>
                            </div>
                           

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card mt-3">
                  <div class="card-header">
                      <h4>Today Applications</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive p-0">
                          <table class="table align-items-center mb-0">
                              <thead>
                                  <tr>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Application No   </th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Name   </th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                                      </th>
                                     
                                      
                                      
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number   </th>
                                    
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Service Name   </th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Service Category </th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">  Payment Status </th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                          Status
                                      </th>
                                   
                                      <th
                                          class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                          Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($today_applications as $item)
                                  <tr>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->application_no}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->first_name}} {{$item->last_name}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->email}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->phone_number}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->service->name ?? ($item->service_id == 0 ? "Custom Request" : '')}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->serviceCategory->name ?? ''}}</h6>
                                              </div>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="d-flex px-3 py-1">
                                              <div class="d-flex flex-column justify-content-center">
                                                  <h6 class="mb-0 text-sm">{{$item->payment_status ?? ''}}</h6>
                                              </div>
                                          </div>
                                      </td>
      
                                        <td>
                                          <span class="{{applicationStatus()[$item->status]['class'] ??''}}"><b>{{applicationStatus()[$item->status]['name'] ??''}}</b></span>
                                      </td>
                                     
                                      <td class="align-middle text-end">
                                          <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                         
                                              <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary"
                                                  href="{{route('rtiapplication.view', $item->id)}}">View</a>
                                          </div>
                                      </td>
                                      
                                  </tr>
                                  @endforeach
      
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
               
            </div>
            <div class="col-md-6 mt-3">
               

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Lawyer Request</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Application No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lawyer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">message </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Create Date</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($close_request as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                    <a href="{{route('rtiapplication.view', $item->rtiApplication->id ?? '')}}" target="_blank">{{$item->rtiApplication->application_no ?? ''}}</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('lawyers.edit',( $item->lawyer->id ?? ''))}}" target="blank">{{$item->lawyer->first_name ?? ""}} {{$item->lawyer->last_name ?? ""}}</a>
                                        </td>
                                    
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->message}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                    
                                        <td>
                                            <span class="{{applicationCloseRequestsStatus()[$item->status]['class'] ??''}}"><b>{{applicationCloseRequestsStatus()[$item->status]['name'] ??''}}</b></span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{Carbon\Carbon::parse($item->created_at)->format('d M, Y')}}
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a class="text-sm font-weight-bold mb-0 ps-2 btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModal_{{$item->id}}" data-whatever="@mdo"
                                                    href="javascript:void(0)">View</a>
                                            </div>
                                            <div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <form class="form-submit" action="{{route('approve.layer.request',( $item->id ?? ''))}}" method="post">
                                            <input type="hidden" name="application_id" value="{{$item->application_id ?? ''}}"  >
                                            <div class="modal-body">
                                                
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message</label>
                                                    <textarea class="form-control" id="message-text" name="message">
                                                    {{$item->message}}
                                                    </textarea>
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            @if($item->status == '0')  
                                            <button type="submit" class="btn btn-primary">Approve</button>
                                            @endif
                                            </div>
                                            </form>
                                            </div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          

@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
