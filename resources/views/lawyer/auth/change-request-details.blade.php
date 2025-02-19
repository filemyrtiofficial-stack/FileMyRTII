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

                                <tr>
                                    <td>{{ $value['label']}}</td>
                                    <td>{{$revision_data[$key ] ?? ''}} </td>
                                    <td>{{$change_request[$key] ?? ''}}</td>
                                </tr>
                                @endforeach

                                @if($data->lastRevision)
                                    @foreach($service_fields['field_type'] ?? [] as $key => $value)
                                        @if((!isset($service_fields['form_field_type'][$key]) || $service_fields['form_field_type'][$key] == 'customer' ) && $value != 'file')

                                            @php
                                                $field_key =  getFieldName($service_fields['field_lable'][$key]);
                                            @endphp
                                    
                                            <tr>
                                                <td>{{$service_fields['field_lable'][$key] ?? ''}}</td>
                                                <td>{{$revision_data[$field_key ] ?? ''}} </td>
                                                <td>{{$change_request[$field_key] ?? ''}}</td>
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
                <form action="{{route('lawyer.approve-change-request', $data->id)}}" class="authentication" method="post">
                    @csrf
                    <button  class="theme-btn"><span>Apply Changes</span></button>
                </form>
            </div>
        </div>
        <div class="drafted_item">
            <div class="drafted_app_view">
                <div class="v_scroll">
                    <embed src="{{route('sample-rti-template',$data->service_id)}}" type="" width="100%" height="1000">
                <!-- <img class="img-fluid" src="images/dashboard/drafted_rti.webp" alt=""> -->
                </div>
            </div>
        </div>
    </div>
</div>