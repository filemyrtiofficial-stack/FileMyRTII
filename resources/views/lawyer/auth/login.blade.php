@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer.css')}}">

@endpush
@section('content')

<!-- <header class="breadcrumb_banner bg_none">
            <img class="img-fluid bg_img" src="images/contact/contact-banner.webp" alt="contact us banner">
                <div class="container">
                    <div class="row banner_row">
                        <div class="col-12 col-sm-12">
                            <div class="breadcrumb">
                               <ol>
                                <li class="fs-24"><a href="javascript:void(0);">Home</a></li>
                                <li class="fs-24 active">My RTI</li>
                               </ol>
                            </div>
                            <div class="breadcrumb_heading">
                                <h1 class="title fs-72">Contact Us</h1>
                            </div>
                        </div>
                    </div>
                </div>
        </header> -->

        <section class="db_lawyer_section">
            <div class="container">
                <div class="row">
                   <div class="col-12 col-sm-12">
                        <div class="db_lawyer_wrap">
                            <div class="modal_login login">
                                <div class="modal_header">
                                    <h4 class="heading">Lawyer Login</h4>
                                    <button class="close">
                                        <img src="images/home/close.webp" alt="">
                                    </button>
                                </div>
                                <div class="modal_body">
                                <form action="{{route('lawyer.singin')}}" class="authentication" method="post">
                                    @csrf

                                    <div class="form_item">
                                        <label for="email_address">Email Address</label>
                                        <input class="form_field" type="email" name="email" id="" placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="form_item">
                                        <label for="pwd">Password</label>
                                        <input class="form_field password" type="password" name="password" id="" placeholder="Enter Your Password">
                                    </div>
                                    <div class="show-password-section mb-1-2">
                                        <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password">Show Password</label>
                                    </div>

                                    <!-- <div class="forgot_pwd">
                                        <a href="javascript:void(0);" class="theme-btn-link singin-register-btn" data-target="forgot-password-step-1">Forgot Password?</a>
                                    </div> -->
                                    <div class="modal_action_bottom text-center">
                                        <button class="theme-btn login-btn" >Login</button>
                                    </div>
                                 

                                </form>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </section>


@endsection