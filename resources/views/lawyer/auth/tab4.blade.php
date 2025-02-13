<a class="accord_item" href="#tab4" data-id="tab4">Draft RTI</a>

<div id="tab4" class="contact_faq_tab">
    <div class="drafted_rti">
        <div class="db_tab_heading">
            <h2>Drafted RTI</h2>
        </div>
        @if($data->lastRevision && !empty($data->lastRevision->customer_change_request) )
            @include('lawyer.auth.change-request-details')
        @elseif($data->status < 2)
        @include('frontend.profile.rti-file')
        @endif

      
    </div>
</div>