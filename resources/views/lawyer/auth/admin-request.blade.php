
<div class="lawyer_req_info_modal modal" id="admin-request">
    <div class="lawyer_req_info_modal_wrap">
        <form action="{{route('lawyer.send-back-to-admin', $data->id)}}" class="authentication" method="post">
            @csrf
            <div class="modal_header">
                <h4 class="heading">Send Back To Admin</h4>
                <button class="close close-rti-popup" type="button">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                        </svg>
                </button>
            </div>
         
            <div class="modal_body">
                <div class="db_tab_form">
                    <div class="db_item_wrap single">
                        <div class="form_item">
                            <textarea class="form_field" name="message" id="" required  @if($data->closeRequest && $data->closeRequest->request_type == 'new')           readonly  @endif >@if($data->closeRequest && $data->closeRequest->request_type == 'new') {{$data->closeRequest->message ?? ''}} @endif</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal_action">
            @if($data->closeRequest && $data->closeRequest->request_type == 'new')   
            <span style="color:red"> Requested has already been sent to admin. Please wait for approval.</span>
            @else
            <button class="theme-btn"><span>Send</span></button>
            @endif
            </div>
        </form>
    </div>
    <div class="modal_bg"></div>
</div>