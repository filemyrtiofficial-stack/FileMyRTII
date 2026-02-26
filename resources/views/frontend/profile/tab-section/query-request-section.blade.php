


<div class="faq_item_wrap db_tab_form_wrap v_scroll">
        
        <div class="db_item_wrap">
            
           
    
            <div class="form_item">
                <label for="">Lawyer Query</label>
                <textarea type="text"  class="form_field" disabled>{{($data->lastRtiQuery->message ?? '')}}</textarea>
            </div>
            <div class="form_item">
                <label for="">Enter Your Reply</label>
               @if(!auth()->guard('customers')->check())
                
                <textarea type="text" name="reply" class="form_field login-modal "  readonly></textarea>

                @else
                <textarea type="text" name="reply" class="form_field " disabled=""></textarea>
                @endif
            </div>
        </div>


       
        
    </div>
       


