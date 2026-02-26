<div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refund Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-submition" action="{{route('refund-request.update',( $item->id ?? ''))}}" method="post">
                <input type="hidden" name="application_id" value="{{$item->application_id ?? ''}}"  >
                <div class="modal-body">

                    <div class="form-group">
                        <label for="message-text">Reason</label>
                        <textarea class="form-control" id="message-text" name="message" disabled>{{$item->reason}}</textarea>
                    </div>


                    <div class="form-group">
                        <label for="message-text" >Status</label>
                        <select name="status" id="" class="form-control"  @if($item->status != 'pending') disabled @endif>
                            @foreach(refundRequestStatus() as $key =>  $value)
                                <option value="{{$key}}" @if($item->status == $key) selected @endif>{{$value['name'] ?? ''}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text">Comment</label>
                        <textarea class="form-control" id="message-text" name="comment"  @if($item->status != 'pending') disabled @endif>{{$item->comment}}</textarea>
                    </div>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if($item->status == 'pending')
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                
                </div>
            </form>
        </div>
    </div>
</div>