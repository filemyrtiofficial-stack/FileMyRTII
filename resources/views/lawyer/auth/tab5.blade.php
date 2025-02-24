<a class="accord_item" href1="#tab5" data-id="tab5" href="{{route('lawyer.my-rti', [$data->application_no.'-'.$data->id, 'approved-rti'])}}">Approved RTI</a>

<div id="tab5" class="contact_faq_tab @if($tab == 'approved-rti')active @endif">
    <div class="approve_rti">
        <div class="db_tab_heading">
            <h2>Approved RTI</h2>
        </div>
        <div class="approval_view">
            @if(!$data->lastRevision)
            <div class="waiting_msg">
                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                <h4 class="heading">Waiting for draft RTI</h4>
                <a href="javascript:void(0);" class="theme-btn"><span>Back</span></a>
            </div>
            @elseif($data->status < 2)
            <div class="waiting_msg">
                <img class="img-fluid" src="{{asset('assets/rti/images/dashboard/waiting.webp')}}" alt="">
                <h4 class="heading">Waiting for approval on the drafted RTI</h4>
                <!-- <a href="javascript:void(0);" class="theme-btn"><span>Back</span></a> -->
            </div>
            @else

            <div class="approval_form_wrap">
                <div class="approval_form v_scroll">
                    {!! $html !!}
                </div>
            </div>
            <div class="form_action">
                <!-- <a href="javascript:void(0);" class="theme-btn"><span>Print RTI</span></a> -->
                <!-- <a href="javascript:void(0);" class="theme-btn"><span>Download</span></a> -->
                <a href="{{route('customer.download-rti', $data->application_no)}}" class="theme-btn @if(!$data->lastRevision ) disabled @endif" target="blank"><span>Download</span></a>

            </div>
            @endif
        </div>
    </div>
</div>

<!-- && empty($data->lastRevision->customer_change_request)) || $data->status < 2 -->