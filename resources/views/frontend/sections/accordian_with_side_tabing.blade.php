<section class="contact_section">
            <div class="container">
                <div class="section_heading">
                    <h2>{{$data['title'] ?? ''}} </h2>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-5">
                        <div class="contact_faq_wrapper">
                            <ul class="contact_faq_list">
                            @foreach($data['category'] as $key =>  $value)
                                <li class="contact_faq_item">
                                    <span class="shape"></span>
                                    <a class="faq_list_item" href="#tab_{{$key}}">{{$value}}</a>
                                </li>
                                @endforeach
                                <li class="contact_faq_item">
                                    <span class="shape"></span>
                                    <a class="faq_list_item" href="#contact_form">Contact Us</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <div class="contact_wrapper">
                            <div class="contact_faq">
                                <!-- <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div> -->
                                <div class="contact_faq_tab_content">

                                @foreach($data['category'] as $key =>  $value)
                                    <div id="tab_{{$key}}" class="contact_faq_tab @if($key == 0) active @endif">
                                        <div class="contact_faq_heading">
                                            <h2>Top queries</h2>
                                        </div>
                                        <div class="faq_item_wrap">
                                        @foreach($data['answer_'.$key] as $answer_key =>  $answer_value)
                                            <div class="faq_item">
                                                <div class="faq_title @if($answer_key == 0) active @endif">
                                                    <h4>{{$data['question_'.$key][$answer_key] ?? ''}}</h4>
                                                </div>
                                                <div class="faq_content">
                                                    <p>{!! $answer_value!!}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                @endforeach


                                    <div id="contact_form" class="contact_faq_tab">
                                        <div class="contact_form">
                                            <div class="contact_form_heading">
                                                We're here to help
                                            </div>
                                            <form action="{{route('contact-form')}}" class="contctus-form-submit" method="post">
                                            <div class="contact_option_list">
                                                <div class="contact_option custom_radio"><input type="radio" id="rti_yes" name="rti_option" checked><label for="rti_yes">I have already applied RTI</label></div>
                                                <div class="contact_option custom_radio"><input type="radio" id="rti_no" name="rti_option"><label for="rti_no">I Want to apply RTI</label></div>
                                            </div>
                                            <div class="contact_form_option">
                                                <div class="form_no">
                                                    <a href="/backend/public/services" class="theme-btn"><span>Apply Now</span></a>
                                                </div>
                                                <div class="form_yes">
                                                    <div class="rti_form">
                                                   
                                                            <div class="form_item">
                                                                <select class="form_field custom_select" name="reason" id="contact_reason">
                                                                    <option value="">Please select a reason</option>
                                                                    <option value="reason1">Lorem ipsum dolor sit amet.</option>
                                                                    <option value="reason2">Lorem ipsum dolor sit amet.</option>
                                                                    <option value="reason3">Lorem ipsum dolor sit amet.</option>
                                                                </select>
                                                            </div>
                                                            <div class="form_item col_2">
                                                                <div class="form_item">
                                                                    <input class="form_field" type="text" name="name" id="contact_name" placeholder="Name">
                                                                </div>
                                                                <div class="form_item">
                                                                    <input class="form_field" type="tel" name="phone_number" id="contact_phone_number" placeholder="Phone No">
                                                                </div>
                                                            </div>
                                                            <div class="form_item">
                                                                <input class="form_field" type="email" name="email" id="contact_email" placeholder="E-mail">
                                                            </div>
                                                            <div class="form_item">
                                                                <input class="form_field" type="text" name="message" id="contact_message" placeholder="Message">
                                                            </div>
                                                            <button type="submit" class="theme-btn"><span>Submit</span></button>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>