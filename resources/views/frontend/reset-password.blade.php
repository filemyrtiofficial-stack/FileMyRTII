@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-lawyer.css')}}">
<style>
    .mb-10 {
        margin-bottom: 10px;
    }
</style>
@endpush
@section('content')





      
<section class="db_lawyer_section">
            <div class="container">
                <div class="row">
                   <div class="col-12 col-sm-12">
                        <div class="db_lawyer_wrap">
                            <div class="modal_login login">
                                <div class="modal_header">
                                    <h4 class="heading">Reset Password</h4>
                                    <button class="close">
                                        <img src="images/home/close.webp" alt="">
                                    </button>
                                </div>
                                <div class="modal_body">
                                <form action="{{route('customer.update-password')}}" class="authentication" method="post">
                                    <input type="hidden" name="key" value="{{encryptString($customer->id)}}">
                                    <div class="form_item">
                                        <label for="pwd">Password</label>
                                        <input class="form_field password" type="password" name="password" id="" placeholder="Enter Your Password">
                                    </div>
                                    <div class="form_item">
                                        <label for="email_address">Confirm Password</label>
                                        <input class="form_field password" type="password" name="confirm_password" id="" placeholder="Enter Your Confirm Password">
                                    </div>
                                      <div class="show-password-section mb-10">
                                            <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password">Show Password</label>
                                        </div>
                                  
                                    <div class="modal_action_bottom text-center">
                                        <button class="theme-btn login-btn" >Reset Password</button>
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
@push('js')

@endpush