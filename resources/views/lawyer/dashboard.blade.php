@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer-overview.css')}}">
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">


@endpush
@section('content')

<section class="dashboard_section overview_table_section">
            <div class="container">

                <div class="section_heading">
                    <h2>Welcome Lawyer Name</h2>
                </div>


                <div class="col_box_main">
                    <div class="col_box_left">

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon1.png')}}" alt=""> </div>
                            <h2 class="title_part">  {{$total_rti['active']}} </h2>
                            <p> Active RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon2.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['pending']}} </h2>
                            <p> Pending RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon3.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['filed']}} </h2>
                            <p> Filed RTIs </p>
                        </div>

                        <div class="col_box">
                            <div class="col_box_ico"> <img src="{{asset('assets/rti/images/dashboard-overview/rti-icon4.png')}}" alt=""> </div>
                            <h2 class="title_part"> {{$total_rti['total']}} </h2>
                            <p> Total RTIs </p>
                        </div>

                    </div>


                    <div class="col_box_right">
                        <div class="col_logo"> R </div>
                        <div class="arrow_col"> 
                            <a href="#!" class="click_col"> 
                                <span class="dot"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </a> 

                            <div class="col_dropdown">
                                <ul>
                                    <li> <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="personal_detail_modal" > <span> <img src="{{asset('assets/rti/images/dashboard-overview/user-new.png')}}" alt=""> </span> Profile Edit </a> </li>
                                    <li> <a href="javascript:void(0);"  class="change-password-modal"> <span> <img src="{{asset('assets/rti/iimages/dashboard-overview/password.png')}}" alt=""> </span> Change Password</a> </li>
                                    <li> <a href="javascript:void(0);"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <span> <img src="{{asset('assets/rti/iimages/dashboard-overview/log-out.png')}}" alt=""> </span> Log Out </a> </li>



                                
                                <form role="form" method="post" action="{{ route('lawyer.logout') }}" id="logout-form">
                                    @csrf
                                    
                                </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                         
                </div>


                <div class="tab_overview">
              
                     <div class="tab_overview_up">
                        <ul>
                            <li><a href="#!" class="overview_click active" data-id="active_rti"> Active RTIs </a></li>
                            <li><a href="#!" class="overview_click" data-id="pending_rti"> Pending RTIs </a></li>
                            <li><a href="#!" class="overview_click" data-id="filed_rti"> Filed RTIs </a></li>
                            <li><a href="#!" class="overview_click" data-id="total_rti"> Total RTIs </a></li>
                        </ul>
                     </div>


                     <div class="tab_overview_bottom">

                        <div class="overview_data tab-active" data-id="active_rti"> 
                             <div class="tab_overview_data">
                                <table>
                                     <thead> 
                                        <th> Date</th>    
                                        <th> Application No </th>    
                                        <th> Name</th>    
                                        <th> Status </th>    
                                    </thead>

                                    <tbody>
                                        @foreach($list as $item)
                                        <tr>
                                                <td><a href="#!"> <div class="date_month_table"> <span class="date_table"> 10 </span> <span class="month_table"> DEC 24 </span> </div> </a> </td>
                                                <td><a href="#!"> {{$item->application_no}} </a></td>
                                                <td><a href="#!"> <div class="strong_data">{{$item->fullName}}</div></a> </td>
                                                <td><a href="{{route('lawyer.my-rti', $item->application_no)}}"><div class="status_btn"> Active <span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83928 23.6492C6.32516 24.1169 7.11186 24.1169 7.5965 23.6492L17.8721 13.7329C18.8426 12.7964 18.8426 11.277 17.8721 10.3404L7.52209 0.350952C7.04119 -0.111943 6.26429 -0.117941 5.77717 0.338959C5.27886 0.805452 5.27409 1.57414 5.76369 2.04783L15.2365 11.1882C15.7224 11.6571 15.7224 12.4162 15.2365 12.8851L5.83928 21.9535C5.3534 22.4212 5.3534 23.1815 5.83928 23.6492Z" fill="#0384D4"/>
                                                    </svg> </span></a> </div>
                                                </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                                <div class="btn_view_more">
                                    <a href="#!" class="theme-btn"> <span> View More </span> </a>
                                </div>

                             </div>
                        </div>


                        <div class="overview_data" data-id="pending_rti"> 
                            <div class="tab_overview_data">
                               2
                            </div>
                        </div>


                         <div class="overview_data" data-id="filed_rti"> 
                            <div class="tab_overview_data">
                              3
                            </div>
                         </div>

                        <div class="overview_data" data-id="total_rti"> 
                            <div class="tab_overview_data">
                              4
                            </div>
                        </div>


                     </div>


                </div>


                
                
               
            </div>
        </section>


        
    @include('lawyer.auth.my-profile')
@endsection


