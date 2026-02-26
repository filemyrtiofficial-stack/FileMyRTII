<div class="modal fade" id="mailTemplatePopup" tabindex="-1" role="dialog" aria-labelledby="mailTemplatePopuplLabel" aria-hidden="true">
    <form class="form-submition" action="{{route('mail-template.store')}}" method="post">
        @csrf
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mailTemplatePopuplLabel">Add New Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div>
                            <input type="text" name="name" class="form-control name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label>
                        <div>
                            <input type="text" name="subject" class="form-control subject">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Template</label>
                        <div>
                            <textarea name="template" class="editor template" id=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>  
</div>