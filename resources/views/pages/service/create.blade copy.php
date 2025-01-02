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
        <div class="row col-lg-12">
        <div class="col-lg-8 mt-lg-0 mt-4">
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
                                    <label class="form-label">Icon @if(isset($data) && isset($data['icon'])) <a target="blank" href="{{ asset($data['icon'] ) }}"><img width="50" src="{{ asset($data['icon'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="icon" type="file" class="form-control dropify" id="icon"  @if(isset($data)) data-default-file="{{ asset($data['icon'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Banner @if(isset($data) && isset($data['mobile_banner'])) <a target="blank" href="{{ asset($data['mobile_banner'] ) }}"><img width="50" src="{{ asset($data['mobile_banner'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="mobile_banner" type="file" class="form-control dropify" id="mobile_banner"  @if(isset($data)) data-default-file="{{ asset($data['mobile_banner'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Desktop Banner @if(isset($data) && isset($data['desktop_banner'])) <a target="blank" href="{{ asset($data['desktop_banner'] ) }}"><img width="50" src="{{ asset($data['desktop_banner'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="desktop_banner" type="file" class="form-control dropify" id="desktop_banner"  @if(isset($data)) data-default-file="{{ asset($data['desktop_banner'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Image 1 @if(isset($data) && isset($data['image_1'])) <a target="blank" href="{{ asset($data['image_1'] ) }}"><img width="50" src="{{ asset($data['image_1'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="image_1" type="file" class="form-control dropify" id="image_1"  @if(isset($data)) data-default-file="{{ asset($data['image_1'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Image 2 @if(isset($data) && isset($data['image_2'])) <a target="blank" href="{{ asset($data['image_2'] ) }}"><img width="50" src="{{ asset($data['image_2'] ) }}" alt=""></a> @endif</label>
                                    <div class="input-group">
                                        <input name="image_2" type="file" class="form-control dropify" id="image_2"  @if(isset($data)) data-default-file="{{ asset($data['image_2'] ?? '') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control editor" id="description" rows="5">{{$data['description'] ?? ''}}</textarea>
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
                                            <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
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
                                                    <select type="text" name="is_required[]" class="form-control" required>
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
                <div class="card mt-4">
                        <div class="card-header">
                        <h5>FAQ</h5>
                        </div>
                        <div class="card-body pt-0">
                        <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="faq-list">
                                        @if(!isset($data))
                                        <tr>
                                            <th><textarea name="question[]" class="form-control" id="" required></textarea></th>
                                            <th><textarea name="answer[]" class="form-control" id="" required></textarea></th>
                                            <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                            class="fa fa-trash"></i></button></th>
    
                                        </tr>
                                        @elseif(!empty($data->faq))
                                        <?php $faqs = json_decode($data->faq, true);?>
                                        

                                            @for($index = 0; $index < count($faqs['answer'] ); $index++)
                                                <tr>
                                                <th><textarea name="question[]" class="form-control" id="" required>{{$faqs['question'][$index] ?? ''}}</textarea>
                                                </th>
                                                <th><textarea name="answer[]" class="form-control" id="" required>{{$faqs['answer'][$index] ?? ''}}</textarea></th>
                                                    <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                                    class="fa fa-trash"></i></button></th>
                                                </tr>
                                            @endfor
                                        @endif
                                    </tbody>
                                </table>
                                <button class="btn btn-sm btn-secondary add-more-faq" type="button">Add More Faq</button>
                            </div>
                        </div>
                    </div>
                <div class="mt-5 text-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
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
                                            <select type="text" name="is_required[]" class="form-control" required>
                                            <?php echo booleanListOptions(); ?>
                                            </select>
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