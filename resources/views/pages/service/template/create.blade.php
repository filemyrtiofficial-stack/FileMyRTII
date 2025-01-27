@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<style>
    .hide {
        display:none;
    }
</style>
<form method="POST" action="{{isset($data['id']) ? route('service-template.update', [$service['id'], $data['id']]) : route('service-template.store', $service['id'])}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="d-flex justify-content-center mb-5">
        <div class="row col-lg-12">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Template</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="name" name="name" value="{{$data['template_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <div class="input-group">
                                        <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Title">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Sub Title</label>
                                    <div class="input-group">
                                        <input id="title" name="sub_title" value="{{$data['sub_title'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Sub Title">
                                    </div>
                                </div>
                            </div>
                            
                          
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control editor" id="description" rows="5">{{$data['template'] ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="mt-5 text-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-lg-4">
               
                <div class="card">
                    <div class="card-header"><h4>Fields For mapping</h4></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Fields Lable</td>
                                    <td>Fields Key</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td>[first_name]</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>[last_name]</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>[address]</td>
                                </tr>
                                <tr>
                                    <td>Pincode</td>
                                    <td>[pincode]</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>[email]</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>[phone_number]</td>
                                </tr>
                                @if(isset($fields) && isset($fields['field_type']))
                                    @foreach($fields['field_type'] as $key => $field)
                                        <tr>
                                            <td>{{$fields['field_lable'][$key]}}</td>
                                            <td>[{{str_replace("-", "_", Illuminate\Support\Str::slug($fields['field_lable'][$key]))}}]</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>  

</form>


@endsection
@push('js')
<script>
    $(document).on('change', '.field_type', function(){
        if($(this).val() == 'date') {
            $(this).parents().eq(2).find('.date-other-validation').show();
        }
        else {
            $(this).parents().eq(2).find('.date-other-validation').hide();
        }
    });
    $(document).on('click', '.add-more', function(e){
       
        $('.field-list').append(`  <div class="col-md-12">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Field Type</label> <br>
                                        <div class="input-group">
                                        <select type="text" name="field_type[]" class="form-control field_type" required>
                                                    <?php echo fieldListOptions(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Field Lable</label> <br>
                                        <div class="input-group">
                                            <input type="text" name="field_lable[]" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Is Required</label> <br>
                                        <div class="input-group">
                                            <select type="text" name="is_required[]" class="form-control" required>
                                            <?php echo booleanListOptions(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="date-other-validation" style="display:none;">
                                        <div class="form-group">
                                            <label for="">Minimum Date</label> <br>
                                            <div class="input-group">
                                            <input type="date" name="minimum_date[]" class="form-control" >

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Maximum Date</label> <br>
                                            <div class="input-group">
                                            <input type="date" name="maximum_date[]" class="form-control" >

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Dependency Date Field</label> <br>
                                            <div class="input-group">
                                            <input type="" name="dependency_date_field[]" class="form-control" >

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                                </div>
                            </div>
                        </div>`);
    });
    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(2).remove();
    })
</script>
<script>
    $(document).on('click', '.remove-faq-item', function() {
        $(this).parents().eq(1).remove();
    });
    $(document).on('click', '.add-more-faq', function(e) {
    
    $('#faq-list').append(`<tr>
                                <th><textarea name="question[]" class="form-control" id="" required></textarea></th>
                                    <th><textarea name="answer[]" class="form-control" id="" required></textarea></th>
                                    <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                    class="fa fa-trash"></i></button></th>
                            </tr>`);
})
    </script>
@endpush