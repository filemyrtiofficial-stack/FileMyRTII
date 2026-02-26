<a class="accord_item" href1="#tab4" data-id="tab4" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'drafted-rti'])}}">Drafted RTI</a>
@if($tab == 'drafted-rti')
<div id="tab4" class="contact_faq_tab @if($tab == 'drafted-rti')active @endif">
    <div class="drafted_rti">
        <div class="db_tab_heading">
            <h2>Drafted RTI</h2>
        </div>
        @if($data->status >= 2)
        <div class="approval_form_wrap">
                <div class="approval_form v_scroll">
                     <embed type="text/html" src="{{url('download-my-rti/'.$data->id)}}" width="100%" height="100%">
                </div>
            </div>
        @elseif($data->lastRevision && empty($data->lastRevision->customer_change_request))
        <div class="approval_view">
              <div class="approval_form v_scroll">
                     <embed type="text/html" src="{{url('download-my-rti/'.$data->id)}}" width="100%" height="100%">
                    

                </div>
                @if($data->lastRevision->send_client == 0)
                <div class="draft-rti-btn">
                    <a href="javascript:void(0);" class="theme-btn edi-drat-rti-btn"><span>Edit</span></a> 

                    <a href="javascript:void(0);" class="theme-btn"  onclick="event.preventDefault(); document.getElementById('send-request-form').submit();"><span>Send To Customer</span></a> 
                
             
                    <form role="form" method="post" action="{{route('lawyer.send-customer-for-approval', $data->lastRevision->id)}}" id="send-request-form">
                      @csrf
                    </form>
                </div>
                <div class="draft-edit-rti-form hide">

                    @include('frontend.profile.rti-file')
                </div>
                @endif
            <!--<div class="waiting_msg">-->
          
            <!--    <h4 class="heading">Waiting for approval on the drafted RTI</h4>-->
                <!-- <a href="javascript:void(0);" class="theme-btn"><span>Back</span></a> -->
            <!--</div>-->
        </div>
        @elseif($data->lastRevision && !empty($data->lastRevision->customer_change_request) )
            @include('lawyer.auth.change-request-details')
        @elseif($data->status < 2)
        @include('frontend.profile.rti-file')
       
      
        @endif

      
    </div>
</div>
@endif

@include('frontend.sections.pio-popup')