<div class="upload_doc_modal modal" id="pio-popup">

    <div class="upload_doc_modal_wrap">
        <div class="modal_header">
            <h4 class="heading">PIO Details</h4>
            <button class="close close-rti-popup">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                    </svg>
            </button>
        </div>
        <div class="modal_body ">
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
                                    <input class="form_field search-pio-address" type="text" name="search_pio" id="" >
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
    <div class="modal_bg"></div>
</div>