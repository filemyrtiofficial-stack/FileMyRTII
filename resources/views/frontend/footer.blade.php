<?php
    $data = App\Models\Setting::getSettingData('header-footer-setting');

?>
<footer class="footer">
    <div class="container">
        <div class="row footer_top">
            <div class="col-12 col-sm-8">
                <div class="footer_logo">
                    <a href="javaScript:void(0);"><img class="img-fluid"
                            src="{{asset($data['secondary_logo'] ?? '')}}" alt="Logo"></a>
                    <p class="footer_tagline fs-24">{{$data['footer_logo_tagline'] ?? ''}}</p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="footer_social">
                    <ul>
                        <li><a href="{{$data['linkedin'] ?? ''}}"><img class="img-fluid"
                                    src="{{asset('assets/rti/images/footer/linkdin.webp')}}" alt="Linkedin"></a>
                        </li>
                        <li><a href="{{$data['facebook'] ?? ''}}"><img class="img-fluid"
                                    src="{{asset('assets/rti/images/footer/facebook.webp')}}" alt="Facebook"></a>
                        </li>
                        <li><a href="{{$data['twitter'] ?? ''}}"><img class="img-fluid"
                                    src="{{asset('assets/rti/images/footer/twitter.webp')}}" alt="Twitter"></a></li>
                        <li><a href="{{$data['intagram'] ?? ''}}"><img class="img-fluid"
                                    src="{{asset('assets/rti/images/footer/insta.webp')}}" alt="Instagram"></a></li>
                        <li><a href="{{$data['youtube'] ?? ''}}"><img class="img-fluid"
                                    src="{{asset('assets/rti/images/footer/youtube.webp')}}" alt="YouTube"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row footer_middle">
            <div class="col-12 col-sm-8">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="footer_info">
                            <div class="footer_info_li">
                                <div class="li_icon">
                                    <img class="img-fluid" src="{{asset('assets/rti/images/footer/mdi_location.webp')}}"
                                        alt="location icon">
                                </div>
                                <div class="li_text fs-20">{{$data['address'] ?? ''}}</div>
                            </div>
                            <div class="footer_info_li">
                                <div class="li_icon">
                                    <img class="img-fluid"
                                        src="{{asset('assets/rti/images/footer/ic_baseline-phone.webp')}}"
                                        alt="call icon">
                                </div>
                                <div class="li_text fs-20"><a href="tel:{{$data['contact_no'] ?? ''}}">{{$data['contact_no'] ?? ''}}</a></div>
                            </div>
                            <div class="footer_info_li">
                                <div class="li_icon">
                                    <img class="img-fluid"
                                        src="{{asset('assets/rti/images/footer/material-symbols_mail.webp')}}"
                                        alt="mail icon">
                                </div>
                                <div class="li_text fs-20"><a
                                        href="mailto:{{$data['email'] ?? ''}}">{{$data['email'] ?? ''}}</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="footer_nav">
                            <div class="footer_heading fs-20 fw-700">Quick Links</div>
                            <div class="footer_links">
                                <ul>
                                @foreach(App\Models\MenuSetting::getMenuData('quick_links') as $key => $item)

                                    <li class="fs-20"><a href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">

                <div class="footer_subscribe">
                    <div class="footer_heading fs-24 fw-700">Remain Updated</div>
                    <form action="#">
                        <input class="form-field" type="email" placeholder="Your Email Address">
                        <button class="theme-btn fs-24"><span>Sign up</span></button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row footer_bottom">
            <div class="col-12 col-sm-6">
                <p class="fs-20">Copyright @ {{date('Y')}} A product of New AI Technologies</p>
            </div>
            <div class="col-12 col-sm-6">
                <div class="footer_terms">
                    @foreach(App\Models\MenuSetting::getMenuData('footer_links') as $key => $item)
                        <a class="fs-20" href="{{$item['href'] ?? ''}}">{{$item['text'] ?? ''}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</footer>