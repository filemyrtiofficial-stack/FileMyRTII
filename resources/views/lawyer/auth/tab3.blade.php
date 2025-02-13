<a class="accord_item" href1="#tab3" data-id="tab3" href="{{route('lawyer.my-rti', [$data->application_no, 'draft-rti'])}}">Draft RTI</a>

<div id="tab3" class="contact_faq_tab @if($tab == 'draft-rti')active @endif">
    <div class="rti_application draft_rti">
        <div class="db_tab_heading">
            <h2>Draft RTI</h2>
        </div>
        <div class="draft_rti_wrap">
            <div class="draft_rti_left">
                <div class="draft_rti_details v_scroll">
                    <div class="draft_rti_view">
                        <div class="heading">Personal Details</div>
                        <div class="content">
                            <p class="name">{{$data->fullName}}</p>
                            <p class="address">{{$data->address}} {{$data->postal_code}}</p>
                            <p class="emial">{{$data->email}}</p>
                            <p class="phone_number">{{$data->phone_number}}</p>
                        </div>
                    </div>
                    <div class="draft_rti_view">
                        <div class="heading">RTI Details</div>
                        <div class="content">
                            <div class="table">
                                <div class="seperator"></div>
                                <table>
                                    <tbody>
                                    @foreach($service_fields['field_type'] ?? [] as $key => $value)
                                        @php
                                            $field_key =  getFieldName($service_fields['field_lable'][$key]);
                                        @endphp
                                
                                        <tr>
                                            <td>{{$service_fields['field_lable'][$key] ?? ''}} </td>
                                            <td>{{$revision_data[$field_key ] ?? ( $service_field_data[$field_key] ?? '')}}</td>
                                        </tr>

                                    @endforeach


                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="draft_rti_view">
                        <div class="heading">PIO address give by customer:</div>
                        <div class="content">
                            <p>Public Information Officer</p>
                            <p>
                                {{!empty($data->customer_pio_address) ? $data->customer_pio_address : "PIO address is not provided by customer"}}
                            </p>
                       
                        </div>
                        <div class="pio_action">
                            <a href="javascript:void(0);" class="theme-btn rti-popup" data-id="attachment-popup"><span>View Attachment</span></a>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="draft_rti_right">
                <div class="select_draft_wrap">
                    <div class="select_draft">
                        <input class="form_field" name="" id="" value="{{$data->service->name ?? ''}}" disabled>
                    </div>
                    <div class="view_draft">
                        <div class="view_draft_area">
                            <!-- <a href="javascript:void(0);" class="download-btn">
                                <span class="icon"><img class="img-fluid" src="images/dashboard/download-template.svg" alt=""></span>
                                Download Template
                            </a> -->
                            <div><embed src="{{route('sample-rti-template',$data->service_id)}}" type="" width="100%" height="500"></div>
                            <!-- <img class="img-fluid view_form_img" src="images/dashboard/view_draft.webp" alt=""> -->
                        </div>
                        <div class="view_draft_heading">{{$data->service->name ?? ''}}</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>