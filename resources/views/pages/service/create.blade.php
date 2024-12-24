@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<style>
    .hide {
        display:none;
    }
</style>
<form method="POST" action="{{isset($data['id']) ? route('services.update', $data['id']) : route('services.store')}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
            <div class="card mt-4">
                <div class="card-header">
                    <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Service</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="row mt-5">
                        <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                                <div class="input-group">
                                    <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control enable-slug"
                                        type="text" placeholder="Name">
                                </div>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
                                <label class="form-label">Slug</label>
                                <div class="input-group">
                                    <input id="slug" name="slug" value="{{$data->slug->slug ?? ''}}" class="form-control"
                                        type="text" placeholder="Slug">
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-6">
                        <div class="form-group">
                                <label class="form-label">Category</label>
                                <div class="input-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $key => $item)
                                        <option value="{{$item->id}}" @if(isset($data['category_id']) && $data['category_id']==$item->id)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control">
                                        @foreach(commonStatus() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Icon</label>
                                <div class="input-group">
                                    <input name="icon" type="file" class="form-control dropify" id="icon">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="description" rows="5">{{$data['description'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Form Fields</h4>
                </div>
                <div class="card-body pt-0">
                   <div class="row field-list">
                        @if(isset($fields) && isset($fields['field_type']))
                            @foreach($fields['field_type'] as $key => $field)
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="form-group hide">
                                            <label for="">Field Type</label> <br>
                                            <div class="input-group">
                                                <select type="text" name="field_type[]" class="form-control" required>
                                                    {!! fieldListOptions($fields['field_type'][$key]) !!}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Field Lable</label> <br>
                                            <div class="input-group">
                                                <input type="text" name="field_lable[]" class="form-control" required value="{{$fields['field_lable'][$key]}}">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Is Required</label> <br>
                                            <div class="input-group">
                                                <select type="text" name="is_required[]" class="form-control" required>
                                                        {!! booleanListOptions($fields['is_required'][$key] ?? '') !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-sm btn-danger remove-card">Remove</button>
                                    </div>
                                </div>
                      
                            </div>
                            @endforeach
                        @else
                            <div class="col-md-6">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="form-group hide">
                                            <label for="">Field Type</label> <br>
                                            <div class="input-group">
                                                <select type="text" name="field_type[]" class="form-control" required>
                                                    {!! fieldListOptions() !!}
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
                                                <select type="text" name="field_lable[]" class="form-control" required>
                                                        {!! booleanListOptions() !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-sm btn-danger remove-card">Remove</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                   </div>
                   <div class="text-right mt-3">
                        <button type="button" class="btn btn-sm btn-secondary add-more">Add More</button>
                   </div>
                </div>
            </div>
            <div class="mt-5 text-right">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
        console.log(
            '{{fieldListOptions()}}'
        )
        $('.field-list').append(`  <div class="col-md-6">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="form-group hide">
                                        <label for="">Field Type</label> <br>
                                        <div class="input-group">
                                        <select type="text" name="field_type[]" class="form-control" required>
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
                                            <select type="text" name="field_lable[]" class="form-control" required>
                                            <?php echo booleanListOptions(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`);
    });
</script>
@endpush