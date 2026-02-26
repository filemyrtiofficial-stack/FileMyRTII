@foreach($list as $item)
<div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-submition" action="{{route('customers.update',[$item->id])}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="name" class="col-form-label">First Name</label>
                        <input class="form-control first_name" name="first_name" value="{{$item->first_name}}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Last Name</label>
                        <input class="form-control last_name" name="last_name" value="{{$item->last_name}}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Email</label>
                        <input class="form-control email" name="email" value="{{$item->email}}">
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Phone Number</label>
                       <div>
                            <input class="form-control phone_no" name="phone_no" value="{{$item->phone_no}}">
                       </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
