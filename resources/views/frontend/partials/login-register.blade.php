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
                    <a class="theme-btn google" href="javascript:void(0);"><img src="{{asset('assets/rti/images/home/google-logo.webp')}}" alt="">Login With Google</a>
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
        <div id="login-step" class="hide modal_login guest">
            <div class="modal_header">
                <h4 class="heading">Login</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
                <form action="{{route('customer.login')}}" class="authentication" method="post">
                    @csrf
                    <div>
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

                    </div>
                </form>
            </div>
        </div>
        <div id="register-step"  class="hide modal_login guest">
            <div class="modal_header">
                <h4 class="heading">Login</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
            <form action="{{route('customer.register')}}" class="authentication" method="post">
            @csrf
                <div>
                        <label for="">Name</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label for="">Email Address</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input type="password" name="password">
                    </div>
                    <div>
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password">
                    </div>
                    <a class="theme-btn google" href="javascript:void(0);"><img src="{{asset('assets/rti/images/home/google-logo.webp')}}" alt="">Login With Google</a>

                    <div>
                        <button type="button" class="singin-register-btn" data-target="login-step-1">Back</button>
                        <button>Register</button>

                    </div>
                </form>
            </div>
        </div>
        <div id="forgot-password-step-1"  class="hide modal_login guest">
            <div class="modal_header">
                <h4 class="heading">FORGOT PASSWORD</h4>
                <button class="close">
                    <img src="{{asset('assets/rti/images/home/close.webp')}}" alt="">
                </button>
            </div>
            <div class="modal_body">
                <form action="{{route('customer.forgot-password')}}" class="authentication" method="post">
                @csrf
                   
                    <div>
                        <label for="">Email Address</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <button type="button" class="singin-register-btn" data-target="login-step-1">Back</button>
                        <button>Reset</button>
                    </div>
                </form>
            </div>
        </div>
     



    </div>
    <div class="modal_bg"></div>
</div>