<div class="modal_wrapper customer-modal_wrapper">
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
                        <input class="form_field password" type="password" name="current_password" id="" placeholder="Enter Your Current Password">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Password</label>
                        <input class="form_field password" type="password" name="password" id="" placeholder="Enter Your Password">
                    </div>
                    <div class="form_item">
                        <label for="pwd">Confirm Password</label>
                        <input class="form_field password" type="password" name="confirm_password" id="" placeholder="Confirm Your Password">
                    </div>
                    <div class="show-password-section mb-1-2">
                        <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password">Show Password</label>
                    </div>

                    <div class="modal_action_bottom">
                        <!-- <a class="theme-btn singin-register-btn" data-target="login-step-1" href="javascript:void(0);">Back</a> -->
                        <button class="theme-btn register-btn update-pwd" href="javascript:void(0);">Update Password</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal_bg"></div>
</div>
