<a class="accord_item" href1="#tab2" data-id="tab2" href="{{route('lawyer.my-rti', [$data->application_no, 'pio-address'])}}">PIO Address</a>

<div id="tab2" class="contact_faq_tab @if($tab == 'pio-address')active @endif">
    <div class="pio_address">
        <div class="db_tab_heading">
            <h2>PIO Address</h2>
        </div>
        <form action="{{route('lawyer.assign-pio', $data->id)}}" method="post" class="authentication">
            @csrf
            <div class="faq_item_wrap db_tab_form_wrap">
                <div class="db_item_wrap single">
                    <div class="form_item">
                        <label for="first_name">Customer Entered PIO Address</label>
                        <input class="form_field" type="text" disabled required="">
                    </div>
                </div>

                <div class="db_item_wrap single">
                    <div class="form_item custom_checkbox">
                        <input type="checkbox" id="manual-pio" name="manual_pio">
                        <label for="manual-pio">Manual PIO Address</label>
                    </div>
                </div>

                <div class="search-pio-details">
                    <div class="db_item_wrap single relative">
                        <div class="form_item">
                            <label for="last_name">Search PIO Data Base</label>
                            <input class="form_field search-pio-address" type="text" name="" id="" >
                        </div>
                        <ul class="pio-list hide">
                            
                        </ul>
                    </div>
                </div>
                <div class="manual-pio-details hide ">
                    <div class="db_item_wrap single">
                        <div class="form_item">
                            <label for="first_name">Enter PIO Address Manually</label>
                            <input class="form_field" type="text" name="pio_address" id="pio_address" placeholder="Enter PIO Address">
                        </div>
                    </div>
                   
                </div>
                <div class="form_action_wrap">
                    <div class="form_action">
                        <button class="theme-btn"><span>Save PIO Address</span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>