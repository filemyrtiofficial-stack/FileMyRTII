@extends('frontend.layout.layout')
@section('content')
<div class="modal_login login" style="width:30%">
            <div class="modal_header">
                <h4 class="heading">Login</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
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
                        <input class="form_field" type="password" name="password" id="" placeholder="Enter Your Password">
                    </div>
                    <!-- <div class="forgot_pwd">
                        <a href="javascript:void(0);" class="theme-btn-link singin-register-btn" data-target="forgot-password-step-1">Forgot Password?</a>
                    </div> -->
                    <div class="modal_action_bottom">
                        <button class="theme-btn login-btn" href="javascript:void(0);">Login</button>
                    </div>

                </form>
            </div>
        </div>
@endsection