<div class="drafted_rti_view">
    <div class="heading">Edit / Request raised by customer</div>
    <div class="drafted_rti_item_wrap">
        <div class="drafted_item">
            <div class="drafted_info_wrap">
                <div class="drafted_info v_scroll">
                    <div class="table">
                        <!-- <div class="seperator"></div> -->
                        <table>
                            <thead>
                                <tr>
                                    <th>Fields</th>
                                    <th>Existing (Previous)</th>
                                    <th>Revised By Customer</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach(rtiPersonalDetailFields() as $key => $value)

                                <tr <?php if(isset($revision_data[$key ]) && isset($change_request[$key]) && strip_tags($revision_data[$key ]) != strip_tags($change_request[$key])) {?> class="text-danger-light" <?php }?>>
                                    <td>{{ $value['label']}}</td>
                                    <td>{{$revision_data[$key ] ?? ''}} </td>
                                    <td>{{$change_request[$key] ?? ''}}</td>
                                </tr>
                                @endforeach

                                @if($data->lastRevision)
                                    @foreach($service_fields['field_type'] ?? [] as $key => $value)
                                        @if((!isset($service_fields['form_field_type'][$key]) || $service_fields['form_field_type'][$key] != 'lawyer' ))

                                            @php
                                                $field_key =  getFieldName($service_fields['field_lable'][$key] ?? '');
                                            @endphp
                                    
                                            <tr <?php if(isset($revision_data[$field_key ]) && isset($change_request[$field_key]) && strip_tags($revision_data[$field_key ]) != strip_tags($change_request[$field_key])) {?> class="text-danger-light" <?php }?> >
                                                <td>{{$service_fields['field_lable'][$key] ?? ''}}</td>
                                                @if($value == 'file')
                                                <td>
                                                    @if(isset($revision_data[$field_key ]) && !empty($revision_data[$field_key ]))
                                                    <a href="{{filePreview(($revision_data[$field_key ] ?? ''))}}">
                                                    <svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg>
                                                    </a> 
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($change_request[$field_key ]) && !empty($change_request[$field_key ]))
                                                        <a href="{{filePreview(($change_request[$field_key ] ?? ''))}}">
                                                        <svg fill="#000000" height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 224.549 224.549"><g><path d="M223.476,108.41c-1.779-2.96-44.35-72.503-111.202-72.503S2.851,105.45,1.072,108.41c-1.43,2.378-1.43,5.351,0,7.729c1.779,2.96,44.35,72.503,111.202,72.503s109.423-69.543,111.202-72.503C224.906,113.761,224.906,110.788,223.476,108.41z M112.274,173.642c-49.925,0-86.176-47.359-95.808-61.374c9.614-14.032,45.761-61.36,95.808-61.36c49.925,0,86.176,47.359,95.808,61.374C198.468,126.313,162.321,173.642,112.274,173.642z"/><path d="M112.274,61.731c-27.869,0-50.542,22.674-50.542,50.543c0,27.868,22.673,50.54,50.542,50.54c27.868,0,50.541-22.672,50.541-50.54C162.815,84.405,140.143,61.731,112.274,61.731z M112.274,147.814c-19.598,0-35.542-15.943-35.542-35.54c0-19.599,15.944-35.543,35.542-35.543s35.541,15.944,35.541,35.543C147.815,131.871,131.872,147.814,112.274,147.814z"/><path d="M112.274,92.91c-10.702,0-19.372,8.669-19.372,19.364c0,10.694,8.67,19.363,19.372,19.363c10.703,0,19.373-8.669,19.373-19.363C131.647,101.579,122.977,92.91,112.274,92.91z"/></g></svg>
                                                        </a> 
                                                    @endif
                                                </td>
                                                @else
                                                <td>{!! $revision_data[$field_key ] ?? '' !!}  </td>
                                                <td>{!! $change_request[$field_key] ?? '' !!}</td>
                                                @endif
                                            </tr>
                                        @endif

                                    @endforeach

                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form_action">
                <!--<form action="{{route('lawyer.approve-change-request', $data->id)}}" class="authentication" method="post">-->
                <!--    @csrf-->
                <!--    <button  class="theme-btn"><span>Apply Changes</span></button>-->
                <!--</form>-->
                <button  class="theme-btn tabings" href="#tab12"><span>Redraft Request</span></button>
            </div>
        </div>
        <div class="drafted_item">
            <div class="drafted_app_view">
                <div class="v_scroll">
                                    <embed type="text/html" src="{{url('download-my-rti/'.$data->id)}}" width="100%" height="100%">

                    <!--<embed src="{{route('sample-rti-template',$data->service_id)}}" type="" width="100%" height="1000">-->
                <!-- <img class="img-fluid" src="images/dashboard/drafted_rti.webp" alt=""> -->
                </div>
            </div>
        </div>
    </div>
</div>