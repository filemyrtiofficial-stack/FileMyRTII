<?php
    $data = App\Models\Setting::getSettingData('header-footer-setting');

?>
<nav class="navbar">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a class="header_logo" href="/">
                    <img class="img-fluid" src="{{asset( $data['primary_logo'] ?? '')}}" alt="logo">
                </a>
            </div>
            <div class="col-9">
                <div class="nav_wrapper">
                    <ul class="menu">

                    @foreach(App\Models\MenuSetting::getMenuData('header') as $key => $item)
                   
                   <li class="fs-24    @if(isset($item['children'])) has-dropdown @endif"><a href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}  </a>
                       @if(isset($item['children']))
                     
                           @include('frontend.partials.menu-item',['submenu' => $item['children']])
                       @endif
                   </li>
                   @endforeach


                        <li class="mobile_menu">
                            <ul class="nav_menu">
                                @foreach(App\Models\MenuSetting::getMenuData('second_header') as $key => $item)

                                <li class="fs-28"><a href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}</a></li>
                                @endforeach
                               
                                <li class="fs-28"><a href="javascript:void(0);"><span class="call"><img
                                                class="img-fluid" src="{{asset('assets/rti/images/call-support.png')}}"
                                                alt=""></span>Support Team</a></li>
                            </ul>
                            <ul class="nav_details">
                                <li class="fs-18">Email: <a
                                        href="mailto:{{$data['email'] ?? ''}}">{{$data['email'] ?? ''}}</a></li>
                                <li class="fs-18">Phone: <a href="tel:{{$data['contact_no'] ?? ''}}">{{$data['contact_no'] ?? ''}}</a></li>
                                <li class="fs-18">{{$data['timing'] ?? ''}}</li>
                            </ul>
                        </li>
                    </ul>
                    <a href="javascript:void(0);" class="nav_btn">
                        <div class="toggler"></div>
                    </a>
                    <a href="javascript:void(0);" class="nav_btn_m">
                        <div class="toggler"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>