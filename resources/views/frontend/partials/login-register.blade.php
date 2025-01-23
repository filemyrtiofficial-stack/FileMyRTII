
@if(!auth()->guard('customers')->check())
<div class="modal_wrapper">
    <div class="modal_login_wrap">
        <div class="modal_login guest" id="login-step-1">
            <div class="modal_header">
                <h4 class="heading">Login / Sign up</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
                <div class="modal_action_top">
                    <a class="theme-btn google" href="{{route('auth.google')}}"><img src="{{asset('assets/rti/images/home/google-logo.webp')}}" alt="">Login With Google</a>
                    <a class="theme-btn guest" href="javascript:void(0);"><img src="{{asset('assets/rti/images/home/user.webp')}}" alt="">Continue as Guest</a>
                </div>
                <div class="modal_content_top"><p>Or use your email Address</p></div>
                <div class="modal_action_bottom">
                    <a class="theme-btn singin-register-btn" href="javascript:void(0);" data-target="login-step">Login</a>
                    <a class="theme-btn singin-register-btn" href="javascript:void(0);" data-target="register-step">Sign up</a>
                </div>
                <div class="modal_content_bottom">
                    <p>*We value your trust. Your information remains private and protected with FileMyRTI</p>
                </div>
            </div>
        </div>
        <div id="login-step" class="hide modal_login login">
            <div class="modal_header">
                <h4 class="heading">Login</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
                <form action="{{route('customer.login')}}" class="authentication" method="post">
                    @csrf

                    <div class="form_item">
                        <label for="email_address">Email Address</label>
                        <input class="form_field" type="email" name="email" id="" placeholder="Enter Your Email Address">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Password</label>
                        <input class="form_field" type="password" name="password" id="" placeholder="Enter Your Password">
                    </div>
                    <div class="forgot_pwd">
                        <a href="javascript:void(0);" class="theme-btn-link singin-register-btn" data-target="forgot-password-step-1">Forgot Password?</a>
                    </div>
                    <div class="modal_action_bottom">
                        <a class="theme-btn singin-register-btn" data-target="login-step-1" href="javascript:void(0);">Back</a>
                        <button class="theme-btn login-btn" href="javascript:void(0);">Login</button>
                    </div>


                    <!-- <div>
                        <label for="">Email Address</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input type="password" name="password">
                    </div>
                    <a  href="javascript:void(0);" class="singin-register-btn" data-target="forgot-password-step-1">Forgot Password</a>
                    <div>
                        <button type="button" class="singin-register-btn" data-target="login-step-1">Back</button>
                        <button>Login</button>

                    </div> -->
                </form>
            </div>
        </div>
        <div id="register-step"  class="hide modal_login register">
            <div class="modal_header">
                <h4 class="heading">Reister</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body ">
            <form action="{{route('customer.register')}}" class="authentication" method="post">
            @csrf
            <div class="form_item">
                        <label for="name">Name</label>
                        <input class="form_field" type="email" name="name" id="" placeholder="Enter Your Name">
                    </div>
                    <div class="form_item">
                        <label for="email_address">Email Address</label>
                        <input class="form_field" type="email" name="email" id="" placeholder="Enter Your Email Address">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Password</label>
                        <input class="form_field" type="password" name="password" id="" placeholder="Enter Your Password">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Confirm Password</label>
                        <input class="form_field" type="password" name="confirm_password" id="" placeholder="Confirm Your Password">
                    </div>
                    <div class="or-seperator"><span>or</span></div>
                    <div class="modal_action_top">
                        <a class="theme-btn google" href="{{route('auth.google')}}"><img src="{{asset('assets/rti/images/home/google-logo.webp')}}" alt="">Login With Google</a>
                    </div>
                    <div class="modal_action_bottom">
                        <a class="theme-btn singin-register-btn" data-target="login-step-1" href="javascript:void(0);">Back</a>
                        <button class="theme-btn register-btn" href="javascript:void(0);">Register</button>
                    </div>
                   
                </form>
            </div>
        </div>
        <div id="forgot-password-step-1"  class="hide modal_login forgot_password">
            <div class="modal_header">
                <h4 class="heading">FORGOT PASSWORD</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
                <form action="{{route('customer.forgot-password')}}" class="authentication forgot_password" method="post">
                @csrf
                   
                <div class="modal_content_bottom">
                        <p>Please enter the email address you signed up with and we'll send you reset password link.</p>
                    </div>
                    <div class="form_item">
                        <label for="email_address">Email Address</label>
                        <input class="form_field" type="email" name="email" id="" placeholder="Enter Your Email Address">
                        <!-- <span class="text-danger form-error-list">The first name field is required.</span> -->
                    </div>
                    <div class="modal_action_bottom">
                        <a class="theme-btn singin-register-btn" data-target="login-step-1" href="javascript:void(0);">Back</a>
                        <button class="theme-btn register-btn" href="javascript:void(0);">Reset</button>
                    </div>
                </form>
            </div>
        </div>
     



    </div>
    <div class="modal_bg"></div>
</div>
@else 
<div class="modal_wrapper">
    <div class="modal_login_wrap">
    
        <div id="register-step"  class="modal_login register">
            <div class="modal_header">
                <h4 class="heading">Change Password</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body ">
            <form action="{{route('customer.change-password')}}" class="authentication" method="post">
                @csrf
                    <div class="form_item">
                        <label for="email_address">Current Password</label>
                        <input class="form_field" type="password" name="current_password" id="" placeholder="Enter Your Current Password">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Password</label>
                        <input class="form_field" type="password" name="password" id="" placeholder="Enter Your Password">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Confirm Password</label>
                        <input class="form_field" type="password" name="confirm_password" id="" placeholder="Confirm Your Password">
                    </div>
                    
                    <div class="modal_action_bottom">
                        <!-- <a class="theme-btn singin-register-btn" data-target="login-step-1" href="javascript:void(0);">Back</a> -->
                        <button class="theme-btn register-btn" href="javascript:void(0);">Update Password</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
    <div class="modal_bg"></div>
</div>
@endif






















