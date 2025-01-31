@extends('frontend.layout.layout')
@push('style')
<link rel="stylesheet" href="{{asset('assets/rti/css/dashboard-form.css')}}">

@endpush
@section('content')

        


<section class="contact_section dashboard_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab1">Case Details</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab2">PIO Address</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab3">Draft RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab4">Drafted RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab5">Approved RTI</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab6">Enter Tracking No.</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab7">First Appeal</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab8">Second Appeal</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-8">
                <div class="contact_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content">
                            <div id="tab1" class="contact_faq_tab ">
                                <div class="contact_faq_heading text-center">
                                    <h2>Case Details</h2>
                                </div>
                                <div class="faq_item_wrap">
                                   <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Date
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                                {{Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Application No.
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                                {{$data->application_no?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Name of Applicant
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                                {{$data->fullName ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                               Service Choosen
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                                {{$data->service->name ?? 'Custom Request'}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                               PIO Details
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                               RTI Info
                                            </div>
                                            <div class="col-md-1">
                                                :
                                            </div>
                                            <div class="col-md-5">
                                            </div>
                                        </div>
                                        <a type="button" class="draft-application" href="{{route('lawyer.draft-rti', $data->application_no)}}">Draft This Application</a>
                                    </div>
                                    <div class="col-md-6"></div>

                                   </div>
                                </div>
                            </div>
                            <div id="tab2" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Draft RTI</h2>
                                </div>
                                <div class="faq_item_wrap">
                                   <div class="row">
                                        <div class="col-md-6">
                                                <div>
                                                    <h4>Personal Details</h4>
                                                    <p>
                                                        {{$data->fullName}} <br>
                                                        {{$data->address}} <br>
                                                        {{$data->email}} <br>
                                                        {{$data->phone_number}}
                                                    </p>
                                                    <div>
                                                        <?php
                                                        $fields = json_decode($data->service_fields, true)['field_data'] ?? [];
                                                        ?>
                                                        <h4>RT Details</h4>
                                                        <table>
                                                            <thead>
                                                                @foreach( $fields  as $field)
                                                                <tr>
                                                                    <th>{{$field['lable'] ?? ''}}</th>
                                                                    <th>{{$field['value'] ?? ''}}</th>


                                                                </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                           
                                        </div>
                                   </div>
                                   
                                </div>
                            </div>
                            <div id="tab4" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap ">
                                    @include('frontend.profile.rti-file')
                                </div>
                            </div>
                            <div id="tab5" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab6" class="contact_faq_tab">
                                <div class="contact_faq_heading text-center">
                                    <h2>Enter Tracking No.</h2>
                                </div>
                                <div class="faq_item_wrap">
                                   @include('lawyer.tab-section.tacking-number')
                                </div>
                            </div>
                            <div id="tab7" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab8" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab9" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab10" class="contact_faq_tab">
                                <div class="contact_form">
                                    <div class="contact_form_heading">
                                        Lorem ipsum dolor sit ametcerat mi auctor
                                    </div>
                                    <div class="contact_option_list">
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_yes" name="rti_option" checked><label for="rti_yes">I have already applied RTI</label></div>
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_no" name="rti_option"><label for="rti_no">I Want to apply RTI</label></div>
                                    </div>
                                    <div class="contact_form_option">
                                        <div class="form_no">
                                            <button type="submit" class="theme-btn"><span>Apply Now</span></button>
                                        </div>
                                        <div class="form_yes">
                                            <div class="rti_form">
                                                <form action="">
                                                    <div class="form_item">
                                                        <select class="form_field custom_select" name="reason" id="">
                                                            <option value="selected">Please select a reason</option>
                                                            <option value="reason1">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason2">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason3">Lorem ipsum dolor sit amet.</option>
                                                        </select>
                                                    </div>
                                                    <div class="form_item col_2">
                                                        <div class="form_item">
                                                            <input class="form_field" type="text" name="study_year" id="" placeholder="Name">
                                                        </div>
                                                        <div class="form_item">
                                                            <input class="form_field" type="tel" name="study_year" id="" placeholder="Phone No">
                                                        </div>
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="email" name="email" id="" placeholder="E-mail">
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="text" name="study_year" id="" placeholder="Message">
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span>Submit</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    $(document).on('change', '#document-upload', function () {
        let _this = $(this);
        var form_data = new FormData($(this).closest('form')[0]);

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $.ajax({
            url: "{{route('upload-images')}}",
            method: "POST",
            data: form_data,
            cache : false,
            processData: false,
            contentType: false,
            dataType : 'json',
            success : function(response){
                $('.upload-file-img').attr('src', response.data);
              $('.image-input').val(response.data);


            },
            error : function(error) {}
         });
      });
</script>
<script>
    renderHtml()
    function renderHtml() {
        let data = $('.draft-form').serializeArray();

        let html = `<?php echo view('frontend.profile.rti-file1', ['template' => $data->service->templates[0] ?? []])->render();?>`;
        $.each(data, function(index, value){
            html = html.replaceAll("["+value['name']+"]", value['value']);
        });
        $('.draft-rti-html1').html(html)

    }
   
    $(document).on('keyup', '.change-value', function(){
        renderHtml()
    })
</script>
@endpush
