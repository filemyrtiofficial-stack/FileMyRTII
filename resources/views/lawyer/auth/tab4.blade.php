<a class="accord_item" href1="#tab4" data-id="tab4" href="{{route('lawyer.my-rti', [$data->application_no, 'drafted-rti'])}}">Drafted RTI</a>

<div id="tab4" class="contact_faq_tab @if($tab == 'drafted-rti')active @endif">
    <div class="drafted_rti">
        <div class="db_tab_heading">
            <h2>Drafted RTI</h2>
        </div>
        @if($data->status == 2)
        <div class="approval_form_wrap">
                <div class="approval_form v_scroll">
                    {!! $html !!}
                </div>
            </div>
        @elseif($data->lastRevision && empty($data->lastRevision->customer_change_request))
        <div class="approval_view">
            <div class="waiting_msg">
                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                <h4 class="heading">Waiting for approval on the drafted RTI</h4>
                <!-- <a href="javascript:void(0);" class="theme-btn"><span>Back</span></a> -->
            </div>
        </div>
        @elseif($data->lastRevision && !empty($data->lastRevision->customer_change_request) )
            @include('lawyer.auth.change-request-details')
        @elseif($data->status < 2)
        @include('frontend.profile.rti-file')
       
      
        @endif

      
    </div>
</div>